<?php namespace Ognestraz\Admin\Http\Controllers;

class BlockController extends AdminBaseController {

    use Traits\Tree, Traits\Act;
    
    protected $modelName = 'block';
    protected $model = null;
    
}
