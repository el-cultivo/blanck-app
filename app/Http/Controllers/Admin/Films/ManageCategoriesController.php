<?php

namespace App\Http\Controllers\Admin\Films;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Films\Categories\CreateCategoryRequest;
use App\Http\Requests\Admin\Films\Categories\UpdateCategoryRequest;


use App\Http\Controllers\Controller;

use App\Models\Films\Category;

use Response;

class ManageCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::with("languages")->GetWithTranslations()->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        return view('admin.films.categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();

        $category = Category::create([]);

        if (!$category) {
            return Response::json([
                'error' => ["La categoría no pudo ser creada"]
            ], 422);
        }


        foreach ($this->languages as $language) {
            $name = $input["label"][$language->iso6391];
            $category->updateTranslationByIso($language->iso6391,[
                'label'=> $name,
                'slug' => Category::generateUniqueSlug($name)
            ]);
        }

        return Response::json([ // todo bien
            'data'=> Category::GetWithTranslations()->with("languages")->find($category->id),
            'message' => ["La categoría fue creada correctamente"],
            'success' => true
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request,Category $category)
    {
        $input = $request->all();

        foreach ($this->languages as $language) {
            $name = $input["label"][$language->iso6391];
            $category->updateTranslationByIso($language->iso6391,[
                'label' => $name,
                'slug'  => $category->updateUniqueSlug($name,$language->iso6391),
            ]);
        }

        return Response::json([ // todo bien
            'data'    => Category::with('languages')->GetWithTranslations()->find($category->id),
            'message' => ["La categoría fue correctmente actualizada"],
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (!$category->isDeletable()) {
            return Response::json([
                'error' => ["La categoría que desea borrar tiene actividades asociadas"]
            ], 422);
        }

        if (!$category->languages()->detach()) {
            return Response::json([
                'error' => ["La categoría no pudo ser borrada"]
            ], 422);
        }

        if (!$category->delete()) {
            return Response::json([
                'error' => ["La categoría no pudo ser borrada"]
            ], 422);
        }

        return Response::json([ // todo bien
            'message' => ["La categoría fue borrada correctmente"],
            'success' => true
        ]);
    }

}
