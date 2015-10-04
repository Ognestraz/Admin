<?php namespace Ognestraz\Admin\Http\Controllers;

use Input;
use View;

class Site extends AdminController {

    use Traits\Tree, Traits\Act, Traits\Menu, Traits\SoftDeletes;
    
    protected $modelName = 'site';
    protected $makeList = ['move'];

    public function template($id)
    {
        
        $model = $this->model($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            
            return View::make($this->templatePath().'.template', array($this->model => $model)); 
            
        } else {
            
            $template = $model->template(Input::get('template'), Input::get('template_childs'));
            
            return json_encode(array('action' => 'template', 'template' => $template, 'result' => true));
            
        }

    }   
    
    public function settings($id)
    {
        
        $model = $this->model($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            
            return View::make($this->templatePath().'.settings', array($this->model => $model)); 
            
            
        }

    }    
    
    public function reimage($id)
    {
        
        $model = $this->model($id);
        
        $images = $model->images()->get();
        
        foreach ($images as $image) {
            
            $image->variantImage();
            
        }

    }     
    
//    protected function _record($model, $action) {
//        
//        parent::_record($model, $action);
//        
//        if (Input::get('inmenu') && is_array(Input::get('menu'))) {
//
//            $menuSite = Menu::where('element_id', $this->result['model']['id'])
//                    ->where('module', 'site')
//                    ->get();
//
//            $inMenu = array();
//            $isMenu = array();
//
//            foreach ($menuSite as $m) {
//
//                $inMenu[$m->id] = $m->rootNode();
//
//                if (in_array($inMenu[$m->id], Input::get('menu'))) {
//
//                    $isMenu[] = $inMenu[$m->id];
//
//                    $menu = $m;
//                    $menu->module = 'site';
//                    $menu->name = $this->result['model']['name'];
//                    $menu->path = $this->result['model']['path'];
//
//                    $model->menu()->save($menu);                
//
//                } else {
//
//                    $m->forceDelete();
//
//                }
//
//            }    
//
//            $newMenu = array_diff(Input::get('menu'), $isMenu);
//
//            foreach ($newMenu as $mn) {
//
//                $menu = new Menu();
//
//                $menu->module = 'site';
//                $menu->name = $this->result['model']['name'];
//                $menu->path = $this->result['model']['path'];
//
//                $menu->parent = $mn;
//
//                if ($this->result['model']['parent']) {
//
//                    $parent = Menu::where('element_id', $this->result['model']['parent'])
//                            ->where('module', 'site')
//                            ->get();
//
//                    foreach ($parent as $m) {
//
//                        $node = $m->rootNode();   
//
//                        if ($node == $mn) {
//
//                            $menu->parent = $m->id;
//
//                        }
//
//                    }
//
//                } 
//
//                $model->menu()->save($menu);
//
//            }
//        
//        }
//                
//        return $this->result();
//        
//    }
    
}