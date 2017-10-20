<?php

namespace App\Http\Controllers\Admin\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Pages\Sections\CreatePageSectionRequest;
use App\Http\Requests\Admin\Pages\Sections\UpdatePageSectionRequest;

use App\Models\Pages\Sections\Section;
use App\Models\Pages\Sections\Type;
use App\Models\Pages\Sections\Components\Component;

use Response;


class ManagePagesSectionsController extends Controller
{
    public function indexView()
    {
        $data = [
            'types_list'     => Type::get()->pluck('label_description','id'),
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
              "description"         => $input["description"],

              "components_max"      => (!$type->unlimited && !$type->protected) ? $input["components_max"] : null ,
              "editable_contents"   => !$type->protected ? $input["editable_contents"] : [],
        ]);

        if (!$page_section) {
            return Response::json([
                'error' => [trans('manage_pages.sections.create.error')]
            ], 422);
        }

        return Response::json([ // todo bien
            'data'    => $page_section->load("type","pages"),
            'message' => [trans('manage_pages.sections.create.success')],
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
    public function update(UpdatePageSectionRequest $request, Section $page_section)
    {
        $input = $request->all();
        $page_section->template_path = $input["template_path"];
        $page_section->description = $input["description"];

        if (!$page_section->type->protected) {
            $page_section->editable_contents   = $input["editable_contents"];
            if (!$page_section->type->unlimited) {
                $page_section->components_max  = $input["components_max"];
            }
        }

        if (!$page_section->save()) {
            return Response::json([
                'error' => [trans('manage_pages.sections.update.error')]
            ], 422);
        }

        return Response::json([ // todo bien
            'data'    => $page_section->load("type","pages"),
            'message' => [trans('manage_pages.sections.update.success')],
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $page_section)
    {
        if (!$page_section->isDeletable()) {
            return Response::json([
                'error' => [trans('manage_pages.sections.delete.soft.error')]
            ], 422);
        }

        if (!$page_section->delete()) {
            return Response::json([
                'error' => [trans('manage_pages.sections.delete.error')]
            ], 422);
        }

        return Response::json([ // todo bien
            'message' => [trans('manage_pages.sections.delete.success')],
            'success' => true
        ]);
    }
}
