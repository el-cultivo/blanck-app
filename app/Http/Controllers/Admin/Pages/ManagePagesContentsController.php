<?php

namespace App\Http\Controllers\Admin\Pages;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Pages\UpdatePagesOrderRequest;

use View;
use Response;
use Redirect;
use App\Models\Pages\Page;
use App\Publish;

use Carbon\Carbon;

class ManagePagesContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages_groups = Page::with([
                "languages",
                "publish",
                "parent",
                "childs"
            ])
            ->orderBy('main', 'DESC')
            ->orderBy('parent_id', 'ASC')
            ->orderBy('order', 'ASC')
            ->get()
            ->groupBy(Function($page){
                return $page->parent_index  ;
            })->mapWithKeys(Function($pages){
                $page = $pages->first();
                return [
                    // no se define la key para que sea automatica
                    [
                        "parent_index"  => $page->parent_index,
                        "parent_label"  => $page->parent_label,
                        "pages"         => $pages
                    ]
                ];
            })
            ;

        $data = [
            'pages_groups' => $pages_groups,
        ];

        return view('admin.pages.contents.index', $data );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page_edit_content)
    {

        $data = [
            'page_edit'      => $page_edit_content
        ];

        return view('admin.pages.contents.edit', $data );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Page $page)
    {
        $input = $request->all();

        dd("karen",$input);

        $page->order    = $input['order'];
        $page->page_id  = isset($input['page_id']) && !empty($input['page_id']) ? $input['page_id'] : null;

        $page->tblank = isset($input['tblank']) && !empty($input['tblank']) ? $input['tblank'] : false;
        $page->header = isset($input['header']) && !empty($input['header']) ? $input['header'] : false;
        $page->footer = isset($input['footer']) && !empty($input['footer']) ? $input['footer'] : false;

        $page->publish_id = $input['publish_id'];

        if ($input['publish_id'] == Publish::getPublish()->id) {
            $page->publish_at = Carbon::now();
        }else {
            $page->publish_at = null;
        }

        foreach ($this->languages as $language) {

            $page->updateTranslationByIso( $language->iso6391, [
                'name'          => $input["name"][$language->iso6391],
                'slug'          => $page->updateUniqueSlug( $input['slug'][$language->iso6391], $language->iso6391),
                'content'       => $input['content'][$language->iso6391],
            ]);

        }

        if (!$page->save()) {
            return Redirect::back()->withErrors(["La página no pudo ser actualizada"]); //Enviar el mensaje con el idioma que corresponde
        }

        return Redirect::route( 'admin::pages.edit', [ $page->id ])->with('status', "La página fue correctamente actualizada");


        dd($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sort(UpdatePagesOrderRequest $request)
    {
        $input = $request->all();

        if (!Page::whereIn("id",$input["pages"])->update(["order" => null])) {
            return Redirect::back()->withErrors(["El orden anterior no pudo ser borrado"]);
        }

        foreach ($input["pages"] as $order => $id) {
            if (!Page::where(["id"=>$id ])->update(["order" => $order])) {
                return Redirect::back()->withErrors(["El nuevo orden no pudo ser actualizado"]);
            }
        }

        return Redirect::route('admin::pages.content.index')->with('status', "El orden se actualizó correctamente");
    }

}
