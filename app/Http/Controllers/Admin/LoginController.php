<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    
    function permission()
    {
       return view('permission');  
    }
    function index()
    {

      return view('login.index');
    }
   public function check(Request $request)
    {
      $messages =  [
        'email.required' => 'Email is emty',
        'password.required'  =>  'Password is emty',
        'password.min'  => 'Min lenght password is 5 Digit',
        'captcha.required'  =>  'Captcha is empty',
        'captcha.captcha'  =>  'Captcha not Valid',

    ];
       $valid=  $this->validate($request, [
                'email' => 'required',
                'password' => 'required|min:5',
                'captcha' => 'required|captcha'
            ],$messages);
        $email =  $request->input('email');
        $password =  $request->input('password');

     $users = DB::table('users')
                                 ->where('email', $email)
                                 ->where('password', md5($password))
                                 ->get();
     
     if (count($users)==1) {
        $request->session()->put('lg_key', $users[0]->active_key);
        //$value = $request->session()->get('lg_key');
       return redirect()->to('profile');

     }else
     {

    // add an error
    return redirect()->to('login')->withErrors(new \Illuminate\Support\MessageBag(['no_find'=>'User Not Found']));
        

     }

    }

    function logout(Request $request){
    $request->session()->forget('lg_key');
       //$this->session->unset_userdata($array_items);
    return redirect()->to('login');
     }
    
}
