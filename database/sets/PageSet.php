<?php

use Illuminate\Console\Command;

class PageSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "pages";

    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return "App\Page";
    }

    /**
     * valores a ser introducidos en la base
     */
    protected function CltvoGetItems()
    {
        return [
            "home" => [
                'home'   => 1,
                'header' => 1,
                'footer' => 1,
                'order'  => 0,
                'publish'=> 1,
                'es'        => [
                    'name'  => 'El Cultivo',
                ],
            ],
            "el-festival" => [
                'header' => 1,
                'footer' => 1,
                'order'  => 1,
                'publish'=> 1,
                'es'        => [
                    'name'  => 'El Festival',
                ],
            ],
            "aliados" => [
                'header' => 1,
                'footer' => 1,
                'order'  => 1,
                'publish'=> 0,
                'es'        => [
                    'name'  => 'Aliados',
                ],
            ],
            "programa" => [
                'header' => 1,
                'footer' => 1,
                'order'  => 2,
                'publish'=> 1,
                'es'        => [
                    'name'  => 'Programa',
                ],
            ],
            "boletos" => [
                'header' => 1,
                'footer' => 1,
                'order'  => 3,
                'publish'=> 1,
                'es'        => [
                    'name'  => 'Boletos',
                ],
            ],
            "contacto" => [
                'header' => 0,
                'footer' => 1,
                'order'  => 4,
                'publish'=> 1,
                'es'        => [
                    'name'  => 'Contacto',
                ],
            ],
            // "help" => [
            //     'es'        => [
            //         'name'  => 'Ayuda',
            //     ],
            //     'childs'    => [
            //         "politicas-devolucion" => [
            //             'es'        => [
            //                 'name'  => 'Políticas de devolución',
            //             ],
            //         ],
            //     ]
            // ],
        ];
    }

    /**
     * metodo de introduccion de valores
     * @param array   $model_args argumentos que definiran el
     * @param Command $comand     comando actual
     */
    protected function CltvoSower(array $model_args, Command $comand){

        $pages = $this->CltvoGetItems();

        foreach ($pages as $value) {

            $page = App\Page::getObjectBySlug(str_slug($value['es']['name']));

            if(!$page){

                $page = new App\Page;

                $page->home = isset($value['home']) ? $value['home'] : null;
                $page->order = isset($value['order']) ? $value['order'] : 0;
                $page->tblank = isset($value['tblank']) ? $value['tblank'] : 0;
                $page->editable = isset($value['editable']) ? $value['editable'] : 1;
                $page->header = isset($value['header']) ? $value['header'] : 1;
                $page->footer = isset($value['footer']) ? $value['footer'] : 1;

                if ($page->save()) {
                    $comand->line('<info>Page '.$value["es"]['name'].':</info>'." successfully set.");
                }else{
                    $comand->line('<error>Page '.$value["es"]['name'].':</error>'." not successfully set.");
                    return;
                }

                $page->draft();

                if ($value['publish']) {
                    $page->publicate();
                }


                foreach (App\Language::all() as $language) {

                    if (array_has($value, $language->iso6391)) {

                        $translation = [
                                'slug'      => str_slug($value[$language->iso6391]['name']),
                                'name'      => $value[$language->iso6391]['name'],
                        ];

                        $page->updateTranslation($language, $translation);
                    }
                }
            }

            if (array_has($value, 'childs')) {

                foreach ($value['childs'] as $child_value) {

                    $child_page = App\Page::getObjectBySlug(str_slug($child_value["es"]['name']));

                    if(!$child_page){

                        $child_page = new App\Page;

                        $child_page->home = isset($child_value['home']) ? $child_value['home'] : null;
                        $child_page->order = isset($child_value['order']) ? $child_value['order'] : 0;
                        $child_page->tblank = isset($child_value['tblank']) ? $child_value['tblank'] : 0;
                        $child_page->editable = isset($child_value['editable']) ? $child_value['editable'] : 1;

                        if ($page->childs()->save($child_page)) {
                            $comand->line('<info>Page |----- '.$child_value["es"]['name'].'</info>'." successfully set.");
                        }else{
                            $comand->line('<error>Page |-----  '.$child_value["es"]['name'].'</error>'." not successfully set.");
                            return;
                        }

                        $child_page->draft();

                        foreach (App\Language::all() as $language) {

                            if (array_has($child_value, $language->iso6391)) {

                                $translation = [
                                        'slug'      => str_slug($child_value[$language->iso6391]['name']),
                                        'name'      => $child_value[$language->iso6391]['name'],
                                ];

                                $child_page->updateTranslation($language, $translation);
                            }
                        }
                    }

                }
            }
        }

    }

}
