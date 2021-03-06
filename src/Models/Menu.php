<?php namespace Ognestraz\Admin\Models;

use URL;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model {

    use SoftDeletes, Traits\Tree, Traits\Act;
    
    protected $table = 'menu';
    protected $visible = array('id', 'parent', 'name', 'preview', 'path', 'autopath');

    public function active($parent = false) 
    {
        
        $path = substr(URL::current(), strlen(URL::to('/')) + 1);
        
        if ($parent) {
            
            $p = explode('/', $path);
            return !empty($p[0]) && $p[0] == $this->path;
            
        }
        
        return $this->path == $path;
        
    }
    
    public function site()
    {
        
        return $this->belongsTo('Ognestraz\Admin\Models\Site', 'element_id');
        
    }    
    
    public function link() 
    {
        
        return URL::to('/').'/'.$this->path;
        
    }    
    
    public function save(array $options = array()) 
    {
        
        if (empty($this->id)) {
            
            $max_sort = DB::table($this->table)
                    ->where('parent', !empty($this->parent) ? $this->parent : 0)
                    ->where('deleted_at', null)
                    ->max('sort');
            $this->sort = is_numeric($max_sort) ? $max_sort + 1 : 0;
            
        }
        
        if (!empty($this->element_id)) {
            
            if (empty($this->module)) {
        
                $this->element_id = 0;
                
            } else {
                
                $module = 'Ognestraz\\Admin\\Models\\'.ucfirst($this->module);
                $element = $module::find($this->element_id);
                
                if (!empty($element->id)) {
                
                    $this->path = $element->path;
                    
                }
                
            }
            
        }
        
        return parent::save($options);
        
    }
    
}
