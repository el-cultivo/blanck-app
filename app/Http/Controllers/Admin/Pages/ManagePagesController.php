<?php

namespace App\Http\Controllers\Admin\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Pages\CreatePageRequest;
use App\Http\Requests\Admin\Pages\UpdatePageRequest;

use App\Models\Pages\Page;
use App\Publish;

use Redirect;

class ManagePagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pages' => Page::with([
                    "languages",
                    "sections"
                ])
                ->orderBy('main', 'DESC')
                ->orderBy('parent_id', 'ASC')
                ->orderBy('order', 'ASC')
                ->get(),
        ];

        return view('admin.pages.index', $data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "page_edit"         => new Page
        ];

        return view('admin.pages.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePageRequest $request)
    {
        $input = $request->all();

        $new_page = Page::create([
            "index"         => $input["index"],
            "publish_at"    => $input["publish_at"],
            "publish_id"    => $input["publish_id"],
            "parent_id"     => empty($input["parent_id"]) ? null : $input["parent_id"],
            "tblank"        => isset($input["tblank"])  ,
        ]);

        if(!$new_page){
            return Redirect::back()->withErrors(["No se pudo crear la página"]);
        }

        foreach ($this->languages as $language) {
            $name = $input["label"][$language->iso6391];
            $new_page->updateTranslationByIso($language->iso6391,[
                'label'         => $name,
                'slug'          => Page::generateUniqueSlug($name)
            ]);
        }

        return Redirect::route( 'admin::pages.edit', [$new_page->id] )->with('status', "Página correctamente creada");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page_edit)
    {
        $data = [
            "page_edit"         => $page_edit
        ];

        return view('admin.pages.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page_edit)
    {
        $input = $request->all();

        $page_edit->publish_at    = $input["publish_at"];
        $page_edit->publish_id    = $input["publish_id"];
        $page_edit->parent_id     = (empty($input["parent_id"]) || $page_edit->main)? null : $input["parent_id"];
        $page_edit->tblank        = $page_edit->main ? false : isset($input["tblank"]);

        if ($this->user->hasPermission('manage_pages')) {
            $page_edit->index     = $input["index"];
        }

        if(!$page_edit->save()){
            return Redirect::back()->withErrors(["No se pudo actualizar la página"]);
        }

        foreach ($this->languages as $language) {
            $name = $input["label"][$language->iso6391];
            $page_edit->updateTranslationByIso($language->iso6391,[
                'label'         => $name,
                'slug'          => $page_edit->updateUniqueSlug($name,$language->iso6391)
            ]);
        }

        return Redirect::route( 'admin::pages.edit', [$page_edit->id] )->with('status', "Página correctamente actualizada");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page_edit)
    {
        if ($page_edit->main) {
            return Redirect::back()->withErrors(["No puedes borrar la página principal del sitio"]);
        }

        if (!$page_edit->sections->isEmpty()) {
            if (!$page_edit->sections()->detach()) {
                return Redirect::back()->withErrors(["La página que desea borrar tiene secciones asociadas"]);
            }
        }

        if (!$page_edit->languages()->detach()) {
            return Redirect::back()->withErrors(["La página no pudo ser borrada"]); //Enviar el mensaje con el idioma que corresponde
        }

        if (!$page_edit->delete()) {
            return Redirect::back()->withErrors(["La página no pudo ser borrada"]);
        }

        return Redirect::route('admin::pages.index')->with('status', "La página fue correctamente borrada");

    }
}
