<?php namespace Ognestraz\Admin\Http\Controllers\Traits;

use DB;
use Input;
use App\Helpers\Result;
 
trait Menu {
    
    protected function _record($model, $action) {
        
        parent::_record($model, $action);
        
        $module = $this->modelName;
        
        if (Input::get('inmenu') && is_array(Input::get('menu'))) {

            $menuSite = \App\Models\Menu::where('element_id', $this->result['model']['id'])
                    ->where('module', $module)
                    ->get();

            $inMenu = array();
            $isMenu = array();

            foreach ($menuSite as $m) {

                $inMenu[$m->id] = $m->rootNode();

                if (in_array($inMenu[$m->id], Input::get('menu'))) {

                    $isMenu[] = $inMenu[$m->id];

                    $menu = $m;
                    $menu->module = $module;
                    $menu->name = $this->result['model']['name'];
                    $menu->path = $this->result['model']['path'];

                    $model->menu()->save($menu);                

                } else {

                    $m->forceDelete();

                }

            }    

            $newMenu = array_diff(Input::get('menu'), $isMenu);

            foreach ($newMenu as $mn) {

                $menu = new \App\Models\Menu();

                $menu->module = $module;
                $menu->name = $this->result['model']['name'];
                $menu->path = $this->result['model']['path'];

                $menu->parent = $mn;

                if ($this->result['model']['parent']) {

                    $parent = \App\Models\Menu::where('element_id', $this->result['model']['parent'])
                            ->where('module', $module)
                            ->get();

                    foreach ($parent as $m) {

                        $node = $m->rootNode();   

                        if ($node == $mn) {

                            $menu->parent = $m->id;

                        }

                    }

                } 

                $model->menu()->save($menu);

            }
            
        }
        
        return $this->result();
        
    }
    
}

?>
