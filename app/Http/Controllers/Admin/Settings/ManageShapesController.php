<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Settings\UpdateShapeRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Settings\Shape;

use Response;
use Redirect;

class ManageShapesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'shapes_by_page' => Shape::with("photos")->get()->groupBy(function($shape){
                return $shape->clean_route_name;
            }),
        ];

        return view('admin.settings.shapes.index', $data);
    }


}
