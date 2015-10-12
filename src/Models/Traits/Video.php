<?php
namespace App\Models\Traits;

trait Video 
{

    public function videos($part = null)
    {
        $model = $this->hasMany('App\Models\Video', 'model_id');
        return !empty($part) ? $model->where('part', $part) : $model;
    }
    
    public function video()
    {
        return $this->videos('main')->orderBy('sort', 'asc')->first();
    }

}
