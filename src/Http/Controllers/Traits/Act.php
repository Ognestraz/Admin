<?php namespace Ognestraz\Admin\Http\Controllers\Traits;

use DB;
use Input;
use App\Helpers\Result;
 
trait Act {
    
    public function act($id)
    {

        $act = (int) $this->model($id)->act();
        return $this->result(['act' => $act]);

    }    
    
}

?>
