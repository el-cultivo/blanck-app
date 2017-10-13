<?php

namespace App\Http\Controllers\Admin\Photos;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Photos\AssociatePhotoRequest;
use App\Http\Requests\Admin\Photos\DisassociatePhotoRequest;
use App\Http\Requests\Admin\Photos\SortPhotoRequest;
use App\Http\Requests\Admin\Photos\CreatePhotoRequest;
use App\Http\Requests\Admin\Photos\UpdatePhotoRequest;

use App\Models\Photo;

use Response;

class ManagePhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        $data = [
            "photos"    => Photo::orderBy("updated_at" ,"DESC")->GetWithTranslations()->get()
        ];
        return view('admin.media_manager.index',$data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "photos"    => Photo::orderBy("updated_at" ,"DESC")->GetWithTranslations()->get()
        ];

        return Response::json([
            'data' => $data
        ]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePhotoRequest $request)
    {
        $input = $request->all();

        $newImage = Photo::createImageFile($input["file_input"]);

        if (!$newImage) {
            return Response::json([
                'error' => [trans( "manage_photo.create.error")]
            ], 422);
        }

        if (Photo::existsPhoto($newImage)) {
            return Response::json([
                'error' => [trans( "manage_photo.create.exist")]
            ], 422);
        }

        $photo = Photo::create([
            "filename"  => $newImage,
            "type"      => $input["file_input"]->getMimeType(),
        ]);

        if (!$photo) {

            Storage::delete($file_path);
            Storage::delete(str_replace(Photo::STORAGE_PATH, Photo::THUMBNAILS_STORAGE_PATH, $file_path)  );
            return Response::json([
                'error' => [trans( "manage_photo.create.store")]
            ], 422);
        }

        return Response::json([ // todo bien
            'data'=> $photo->load("languages"),
            'message' => [trans( "manage_photo.create.success")],
            'success' => true
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        // dd($photo);
        if (!$photo) {
            return Response::json([
                'error' => [trans( "manage_photo.edit.error")]
            ], 422);
        }

        $photo = $photo;
        $photo->src = $photo->getImageThumbnailUrl();
        return $photo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $input = $request->all();

        foreach ($this->languages as $language) {
            $photo->updateTranslationByIso($language->iso6391,[
                'title'         =>  $input["title"][$language->iso6391],
                'alt'           =>  $input["alt"][$language->iso6391],
                'description'   =>  $input["description"][$language->iso6391],
            ]);
        }

        return Response::json([ // todo bien
            'message' => [trans( "manage_photo.update.success")],
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        if (!$photo->isDeletable()) {
            return Response::json([
                'error' => [trans( "manage_photo.deletable.error")]
            ], 422);
        }

        if (!$photo->languages()->detach()) {
            return Response::json([
                'error' => [trans( "manage_photo.delete.error")]
            ], 422);
        }

        $photo->deleteImageFiles();

        if (!$photo->delete()) {
            return Response::json([
                'error' => [trans( "manage_photo.delete.error")]
            ], 422);
        }

        return Response::json([ // todo bien
            'message' => [trans( "manage_photo.delete.success")],
            'success' => true
        ]);
    }

    public function associate(AssociatePhotoRequest $request,Photo $photo)
    {
        $input = $request->all();

        $photoable_class = Photo::$associable_models[$input["photoable_type"]];
        $photoable = $photoable_class::find($input["photoable_id"]);
        $is_gallery = in_array($input['use'], $photoable_class::$image_galleries);

        $use_order_class = [
            "use"   => $input["use"],
            "order" => $input["order"] == "null" ? null : $input["order"],
            "class" => $input["class"],
        ];

        if(!$is_gallery || !is_null($use_order_class['order']))
        {
            if ($photoable->hasPhotoTo($use_order_class) ) {
                return Response::json([
                    'error' => [trans( "manage_photo.associate.exist")]
                ], 422);
            }
        }

        if ($photoable->cantUsePhotoFor($photo,$use_order_class["use"]) ) {
            return Response::json([
                'error' => [trans( "manage_photo.associate.use")]
            ], 422);
        }

        if (!$photoable->associateImage($photo,$use_order_class)) {
            return Response::json([
                'error' => [trans( "manage_photo.associate.error")]
            ], 422);
        }

        return Response::json([ // todo bien
            'message' => [trans( "manage_photo.associate.success")],
            'success' => true
        ]);
    }


    public function disassociate(DisassociatePhotoRequest $request, Photo $photo)
    {

        $input = $request->all();
        $photoable_class = Photo::$associable_models[$input["photoable_type"]];
        $photoable = $photoable_class::find($input["photoable_id"]);
        $use_order_class = [
            "use"   => $input["use"],
            "order" => $input["order"] == "null" ? null : $input["order"],
            "class" => $input["class"],
        ];

        if (!$photoable->hasPhotoTo($use_order_class) ) {
            return Response::json([
                'error' => [trans( "manage_photo.dissasociate.use")]
            ], 422);
        }

        if (!$photoable->disassociateImage($photo,$use_order_class)) {
            return Response::json([
                'error' => [trans( "manage_photo.dissasociate.error")]
            ], 422);
        }

        return Response::json([ // todo bien
            'message' => [trans( "manage_photo.dissasociate.success")],
            'success' => true
        ]);
    }


    public function sort(SortPhotoRequest $request)
    {
        $input = $request->all();
        $photoable_class = Photo::$associable_models[$input["photoable_type"]];
        $photoable = $photoable_class::find($input["photoable_id"]);

		$photos =  $photoable->getPhotosTo(["use" => $input["use"]]);

		foreach ($photos as $photo) {
			$photoable->photos()
				->wherePivot('use', $input["use"])
				->updateExistingPivot($photo->id, ["order" => null]);
		}

		foreach ($input["photos"] as $photo_new_order => $photo_id) {
            $photoable->photos()
				->wherePivot('use', $input["use"])
                ->updateExistingPivot($photo_id, ["order" => $photo_new_order ]);
        }

        return Response::json([ // todo bien
            "data"    => $input["photos"] ,
            'message' => [trans( "manage_photo.sort.success")],
            'success' => true
        ]);
    }

}
