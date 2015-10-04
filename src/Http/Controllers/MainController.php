<?php namespace Ognestraz\Admin\Http\Controllers;

    use Auth;
    //use Controller;
    use App;
    use App\Http\Controllers\Controller;
    use Input;
    use Redirect;
    use View;

    class MainController extends AdminController
    {
        
        public function logout()
        {
            
            Auth::logout();
            return Redirect::to('admin');
            
        }         
        
        public function login()
        {

            if (Input::has('name') && Input::has('password')) {

                if (Auth::attempt(['email' => Input::get('name'), 'password' => Input::get('password')], Input::get('remember'))) {

                    return Redirect::to('admin');

                }               

            }
            
            return View::make('admin.login');
            
        }         
        
        public function index()
        {
            
            if (Auth::check()) { 

                switch (Auth::user()->role_id) {
                    
                    case 1: return View::make('admin.index');
                    case 2: return Redirect::to('/');
                    case 3: return Redirect::to('/');
                    default: return $this->login();
                    
                }
                
                return $this->login();

            }

            return $this->login();

        }
        
    }