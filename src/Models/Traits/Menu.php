<?php namespace Ognestraz\Admin\Models\Traits;

trait Menu {
    
    public function menu()
    {
        
        return $this->hasMany("Ognestraz\Admin\Models\Menu", 'element_id');
        
    }
    
    public function inMenu()
    {
        
        $inMenu = array();
        
        if ($this->id) {
        
            $menuSite = \Ognestraz\Admin\Models\Menu::where('element_id', $this->id)
                    ->where('module', 'site')
                    ->get();


            foreach ($menuSite as $m) {

                $node = $m->rootNode();
                if (!empty($node)) {
                    $inMenu[$node] = true;
                }

            }
        
        }

        $menu = \Ognestraz\Admin\Models\Menu::where('parent', 0)
                ->get();

        $return = array();
        foreach ($menu as $m) {
            $return[] = array('menu' => $m, 'checked' => isset($inMenu[$m->id]));
        }        
        
        return $return;
        
    }      
    
}