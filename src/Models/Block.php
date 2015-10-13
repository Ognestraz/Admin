<?php namespace Ognestraz\Admin\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model {

    use SoftDeletes, Traits\Tree, Traits\Act;
    
    protected $table = 'block';
    protected $visible = array(
        'id',
        'name',
        'content',
        'parent'
    );

}
