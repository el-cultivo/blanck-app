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

use App\Models\Publish;

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
                'error' => [trans('manage_pages.create.error')]
            ], 422);
        }

        return Response::json([ // todo bien
            'data'    => Component::getWithTranslations()->find($new_component->id),
            'message' => [trans('manage_pages.create.success')],
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

        $section_component->index = $input['index'];

        if (!$section_component->save()) {
            return Response::json([
                'error' => [trans('manage_pages.update.error')]
            ], 422);
        }

        $editables   = $page_section->all_editable_contents;

        foreach ($this->languages as $language) {

            $update = [];

            if ($editables->title) {
                $update['title']  = $input["title"][$language->iso6391];
            }
            if ($editables->subtitle) {
                $update['subtitle']  = $input["subtitle"][$language->iso6391];
            }
            if ($editables->excerpt) {
                $update['excerpt']  = $input["excerpt"][$language->iso6391];
            }
            if ($editables->content) {
                $update['content']  = $input["content"][$language->iso6391];
            }
            if ($editables->iframe) {
                $update['iframe']  = $input["iframe"][$language->iso6391];
            }
            if ($editables->link) {
                $update['link_url']  = $input["link_url"][$language->iso6391];
                $update['link_title']  = $input["link_title"][$language->iso6391];
                $update['link_tblank']  = isset($input["link_tblank"]) && isset($input["link_tblank"][$language->iso6391]);
            }

            $section_component->updateTranslationByIso($language->iso6391,$update);
        }

        return Response::json([ // todo bien
            'data'    => Component::with('languages','photos')->GetWithTranslations()->find($section_component->id),
            'message' => [trans('manage_pages.update.success')],
            'success' => true
        ]);



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
                'error' => [trans('manage_pages.delete.error')]
            ], 422);
        }

        if (!$section_component->photos->isEmpty()) {
            if (!$section_component->photos()->detach()) {
                return Response::json([
                    'error' => [trans('manage_pages.delete.images')]
                ], 422);
            }
        }

        if (!$section_component->languages()->detach()) {
            return Response::json([
                'error' => [trans('manage_pages.delete.error')]
            ], 422);
        }

        if (!$section_component->delete()) {
            return Response::json([
                'error' => [trans('manage_pages.delete.error')]
            ], 422);
        }

        return Response::json([ // todo bien
            'message' => [trans('manage_pages.delete.success')],
            'success' => true
        ]);

    }

    public function sort(SortPageComponentsRequest $request,Section $page_section)
    {
        $input = $request->all();

        if (!Component::whereIn("id",$input["components"])->update(["order" => null])) {
            return Response::json([
                'error' => [trans('manage_pages.sort.error')]
            ], 422);
        }

        foreach ($input["components"] as $order => $id) {
            if (!Component::where(["id"=>$id ])->update(["order" => $order])) {
                return Response::json([
                    'error' => [trans('manage_pages.sort.error')]
                ], 422);
            }
        }

        return Response::json([ // todo bien
            "data"    => $page_section->load("components")->components->pluck("id","order"),
            'message' => [trans('manage_pages.sort.success')],
            'success' => true
        ]);
    }
}
