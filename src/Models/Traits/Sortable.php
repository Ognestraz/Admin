<?php namespace Ognestraz\Admin\Models\Traits;

trait Sortable {
    
    public function scopeSort($query, $by = 'asc')
    {
        return $query->orderBy('sort', $by);
    }        
    
}

?>
