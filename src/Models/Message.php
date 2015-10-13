<?php namespace Ognestraz\Admin\Models;

class Message extends Model {

    protected $table = 'message';
    protected $visible = array('id', 'user', 'recipient', 'title', 'text');

    protected $softDelete = true;

    public function user()
    {
      return $this->belongsTo('Ognestraz\Admin\Models\User', 'user_id');
    }    
    
   /* static public $rules = array(
        'name' => 'required|min:2|max:32'
    );      
    
    static public $messages = array(
        'name' => 'Имя не может быть короче :min и длиннее :max символов!'
    );    */
    

}