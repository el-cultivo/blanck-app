<?php

namespace App\Http\Controllers\Traits;

use File;
use Route;
use Lang;

trait CltvoAdminTrait {


	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index',$this->menu_items);
    }


	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manuals()
    {
        return view('admin.manuals');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function siteMap()
    {
        $data =[
            "route_groups"  => collect(Route::getRoutes())
                ->sortBy([$this, "orderRoutes"])
                ->groupBy([$this, "groupRoutes"])
				->map([$this, "mapRoutes"])
        ];
        return view('admin.site-map',$data);
    }

	public function orderRoutes($route)
	{
		$route_name_parts =  explode(".",$route->getName());

		if (isset($route_name_parts[1])) {
			return str_replace(".".end($route_name_parts), "", $route->getName() );
		}

		$route_name_parts =  explode("::",$route->getName());

		return isset($route_name_parts[1]) ? $route_name_parts[0] : $route->getName();
	}

	public function groupRoutes($route,$keys)
	{
		$route_name_parts =  explode(".",$route->getName());

		if (isset($route_name_parts[1])) {
			return str_replace(".".end($route_name_parts), "", $route->getName() );
		}

		$route_name_parts =  explode("::",$route->getName());

		return isset($route_name_parts[1]) ? $route_name_parts[0] : "errores";
	}

	public function mapRoutes($route_group)
	{
		return $route_group->sortBy(function($route){
			return $route->getName();
		});
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function translations()
    {

		$files = collect($this->trans_paths)
			->map([$this,"pathsMap"])
			->flatten();

        $data =[
            "not_complete_files"  => $files->filter(function($file){
										return !$file->complete;
									})->sortBy(function($file){
										return $file->file_name;
									}),
			"total_files" 		=> $files->count(),
			"total_trans_find"	=> $files->reduce(function($count,$file){
										return $count+$file->matches;
									}),

			"total_trans_checked" => $files->reduce(function($count,$file){
										return $count+$file->lines->reduce(function($count,$line){
											return $count+$line->matches;
										});
									}),

			"total_trans_no_complete"	=> $files->reduce(function($count,$file){
										return $count+$file->lines->reduce(function($count,$line){
											return $count+$line->not_completed->count();
										});
									})
        ];
        return view('admin.translations',$data);
    }

	public function fileRead($file)
	{
		$regex = '/(trans\()/';
		$file_name = $file->getPathname();

		$file_content = File::get($file_name);

		$local_filename =  str_replace(base_path()."/","",$file_name);
		return (object)[
			"file_name"			=> $local_filename,
			"content" 			=> $file_content,
			"matches" 			=> preg_match_all($regex, $file_content),
			"lines"	  			=> collect(preg_grep($regex, explode("\n", $file_content))),
			"file_base_key"		=> strpos($local_filename,"Notification") !== false ?  "notifications.".collect(explode("/",str_replace(["app/Notifications/","Notification",".php"], "", $local_filename )))
				->map(function($part){
					return snake_case($part);
				})->implode(".")."." : "",
		];
	}

	public function pathsMap($path)
	{
		$extensions = $this->trans_files_extensions;

		return collect(File::allFiles(base_path($path)))
			->filter(function($file) use ($extensions){
				return in_array($file->getExtension(), $extensions);
			})
			->map([$this,'fileRead'])
			->filter(function($file_info) {
				return $file_info->matches > 0;
			})->map([$this,'fileInfo']);
	}



	public function fileInfo($file_info)
	{

		$file_info->lines = $file_info->lines->map(function($text) use ($file_info){


			$trans_find = explodeTranstationsLine($text)
				->map(function($part){
					$part = trim($part);
					return (object) [
						"text"	=> str_replace(["'", " "], ["\"", "", ], $part),
						"first"	=> strpos($part, "(") === 0
					];
				})->filter(function($part){
					return $part->first;
				})->map(function($part) use ($file_info) {

					$trans_key = $file_info->file_base_key.str_replace("\"", "", strtok( strtok($part->text,"\(\)"),"," )) ;

                    $posible_dinamics = strpos($trans_key, "$") !== false;

					$non_translateds = collect( config("app.available_langs"))->map(function($lang,$iso) use ( $trans_key ,$posible_dinamics){

                        if($posible_dinamics ){
                            if (strpos($trans_key, '.$lang_iso.') !== false) {
                                return (object)[
                                    "exists"	=> collect( config("app.available_langs"))->filter(function($lang,$iso) use ($trans_key){
                                        return  !Lang::has( str_replace('.$lang_iso.',$iso , $trans_key),$iso,false);
                                    })->isEmpty(),
                                    "language"	=> $lang,
                                ];
                            }
                        }


						return (object)[
							"exists"	=> Lang::has($trans_key,$iso,false),
							"language"	=> $lang,
						];
					})->filter(function($trans){
						return !$trans->exists;
					}) ;

					return (object) [
                        "posible_empty"     => empty($trans_key),
                        "posible_dinamic"   => $posible_dinamics,
						"trans_key"			=> $trans_key,
						"non_translateds"	=> $non_translateds,
					];
				});

			return (object) [
				"posible_dinamic"	=> !$trans_find->filter(function($tranlations_find){
					return $tranlations_find->posible_dinamic;
				})->isEmpty(),
                "posible_empty"             => !$trans_find->filter(function($tranlations_find){
					return $tranlations_find->posible_empty;
				})->isEmpty(),
				"matches"		=> substr_count($text,getTransFindKey()),
				"checkeds"		=> $trans_find->count(),
				"not_completed"	=> $trans_find->filter(function($tranlations_find){
					return !$tranlations_find->non_translateds->isEmpty();
				})
			];
		});

		return (object) [
			"file_name" => $file_info->file_name,
			"matches"	=> $file_info->matches,
			"lines"		=> $file_info->lines,
			"complete"	=> $file_info->lines->filter(function($line){
				return !$line->not_completed->isEmpty();
			})->isEmpty()
		];
	}

}
