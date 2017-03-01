<?php

namespace App\Http\Controllers\Admin\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Pages\Components\CreatePageComponentRequest;
use App\Http\Requests\Admin\Pages\Components\UpdatePageComponentRequest;
use App\Http\Requests\Admin\Pages\Components\SortPageComponentsRequest;

use App\Models\Pages\Page;

use App\Models\Pages\Sections\Type;
use App\Models\Pages\Sections\Section;
use App\Models\Pages\Sections\Components\Component;

use App\Publish;

use Redirect;
use Response;

class ManagePagesComponentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePageComponentRequest $request, Section $page_section)
    {

        $new_component = Component::create([
              "section_id"  => $page_section->id,
        ]);

        if (!$new_component) {
            return Response::json([
                'error' => ["La seccion no pudo ser creada"]
            ], 422);
        }

        return Response::json([ // todo bien
            'data'    => Component::getWithTranslations()->find($new_component->id),
            'message' => ["La seccion fue creada correctamente"],
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
    public function update(UpdatePageComponentRequest $request, Section $page_section, Component $section_component)
    {
        $input = $request->all();

        $page_edit->publish_at    = $input["publish_at"];
        $page_edit->publish_id    = $input["publish_id"];
        $page_edit->parent_id     = (empty($input["parent_id"]) || $page_edit->main || !$page_edit->childs->isEmpty())? null : $input["parent_id"];
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

        return Redirect::back()->with('status', "Página correctamente actualizada");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $page_section, Component $section_component)
    {

        if (!$page_section->type->unlimited) {
            return Response::json([
                'error' => ["El componente no puede ser borrado"]
            ], 422);
        }

        if (!$section_component->photos->isEmpty()) {
            if (!$section_component->photos()->detach()) {
                return Response::json([
                    'error' => ["El componente no pudo ser borrado porque tiene imagenes associadas"]
                ], 422);
            }
        }

        if (!$section_component->languages()->detach()) {
            return Response::json([
                'error' => ["El componente no pudo ser borrado"]
            ], 422);
        }

        if (!$section_component->delete()) {
            return Response::json([
                'error' => ["El componente no pudo ser borrado"]
            ], 422);
        }

        return Response::json([ // todo bien
            'message' => ["El componente fue correctamente borrado"],
            'success' => true
        ]);

    }

    public function sort(SortPageComponentsRequest $request,Section $page_section)
    {
        $input = $request->all();

        if (!Component::whereIn("id",$input["components"])->update(["order" => null])) {
            return Response::json([
                'error' => ["El nuevo orden no pudo ser actualizado"]
            ], 422);
        }

        foreach ($input["components"] as $order => $id) {
            if (!Component::where(["id"=>$id ])->update(["order" => $order])) {
                return Response::json([
                    'error' => ["El nuevo orden no pudo ser actualizado"]
                ], 422);
            }
        }

        return Response::json([ // todo bien
            "data"    => $page_section->load("components")->components->pluck("id","order"),
            'message' => ["Orden correctamente guardado"],
            'success' => true
        ]);
    }
}
