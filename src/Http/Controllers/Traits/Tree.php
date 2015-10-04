<?php namespace Ognestraz\Admin\Http\Controllers\Traits;

use Input;
use Response;

trait Tree {
    
    public function makeMove($id)
    {

        $model = $this->model($id);

        if ($model->id) {

            $model->move($id, Input::get('parent'), Input::get('position'));

            $this->result['action'] = 'move';
//            $this->result['module'] = strtolower($this->name());
//            $this->result['result'] = true;             

        } else {

            $this->errors[] = 'Not Model';

        }

        return $this->result();

    }         

    public function tree()
    {

        return $this->model()->createTree();

    }   
    
}

?>
