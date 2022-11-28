<?php

namespace App\Http\Views;

class MenuViewComposer
{

    public function composer($view)
    {

        $roleUser = auth()->user()->role;

        $modulesFiltred = [];

        foreach ($roleUser->modules  as $key => $module) {

            $modulesFiltred[$key]['name'] = $module->name;

            foreach ($module->resources as $resource) {
                if ($resource->roles->contains($roleUser)) {
                    $modulesFiltred[$key]['resources'][] = $resource;
                }
            }

        }

        // dd($modulesFiltred);

        return $view->with('modules', $modulesFiltred);
    }


}
