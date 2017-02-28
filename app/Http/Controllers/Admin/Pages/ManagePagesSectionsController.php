<?php

namespace App\Http\Controllers\Admin\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Pages\Sections\CreatePageSectionRequest;

use App\Models\Pages\Sections\Section;
use App\Models\Pages\Sections\Type;
use Response;


class ManagePagesSectionsController extends Controller
{
    public function indexView()
    {
        $data = [
            'types_list'     => Type::get()->pluck('label','id'),
            'editable_parts' => Component::EDITABLE_CONTENTS,
        ];

        return view('admin.pages.sections.index',$data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Section::with("type","pages")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePageSectionRequest $request)
    {
        $input = $request->all();

        $type = Type::find($input["type_id"]);

        $page_section = Section::create([
              "index"               => $input["index"],
              "template_path"       => $input["template_path"],
              "type_id"             => $input["type_id"],
              "components_max"      => (!$type->unlimited && !$type->protected) ? $input["components_max"] : null ,
              "editable_contents"   => !$type->protected ? $input["editable_contents"] : [],
        ]);

        if (!$page_section) {
            return Response::json([
                'error' => ["La seccion no pudo ser creada"]
            ], 422);
        }

        return Response::json([ // todo bien
            'data'    => $page_section->load("type","pages"),
            'message' => ["La seccion fue creada correctamente"],
            'success' => true
        ]);

    }
    //
    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(UpdatePageSectionRequest $request, Section $page)
    // {
    //     $input = $request->all();
    //
    //     $page->name              = $input['name'];
    //     $page->phone             = $input['phone'];
    //     $page->references        = $input['references'];
    //
    //     $page->country_id        = $input['country_id'];
    //     $page->street1           = $input['street1'];
    //     $page->street2           = $input['street2'];
    //     $page->street3           = $input['street3'];
    //     $page->city              = $input['city'];
    //     $page->state             = $input['state'];
    //     $page->zip               = $input['zip'];
    //
    //     $page->longitude         = $input['longitude'];
    //     $page->latitude          = $input['latitude'];
    //
    //     $page->pagetype_id   = $input['pagetype_id'];
    //
    //     if (!$page->save()) {
    //         return Response::json([
    //             'error' => ["La seccion no pudo ser actualizada"]
    //         ], 422);
    //     }
    //
    //     return Response::json([ // todo bien
    //         'data'    => Section::with("pagetype","country","country.languages")->find($page->id),
    //         'message' => ["La seccion fue correctamente actualizada"],
    //         'success' => true
    //     ]);
    // }
    //
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
