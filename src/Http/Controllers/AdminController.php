<?php namespace Ognestraz\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return response("Hello! This is Admin package.");
    }
}
