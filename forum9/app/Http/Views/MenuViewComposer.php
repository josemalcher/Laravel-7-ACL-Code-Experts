<?php

namespace App\Http\Views;

class MenuViewComposer
{

    public function composer($view)
    {

        $roleUser = auth()->user()->role;

        $modulesFiltred = session()->get('modules');

        if (!$modulesFiltred) {
            foreach ($roleUser->modules as $key => $module) {

                $modulesFiltred[$key]['name'] = $module->name;

                foreach ($module->resources as $resource) {
                    if ($resource->roles->contains($roleUser)) {
                        $modulesFiltred[$key]['resources'][] = $resource;
                    }
                }
            }

            dump('Dentro do if de geração dos menus');
            session()->put('modules', $modulesFiltred);
        }


        // dd($modulesFiltred);

        return $view->with('modules', $modulesFiltred);
    }


}
