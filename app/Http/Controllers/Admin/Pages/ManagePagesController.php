<?php

namespace App\Http\Controllers\Admin\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Pages\CreatePageRequest;

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
            "pages_list"        => Page::with([
                    "languages"
                ])
                ->orderBy('index', 'ASC')->get()->pluck('index','id'),
            "publishes_list"    => Publish::get()->pluck('label','id'),

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

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
