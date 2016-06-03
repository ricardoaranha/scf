<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   public function index() {

      $title = 'Login';

      return view('login.login', compact('title'));
   }

   public function auth(Request $request) {

      $request = $request->all();
      $request['userpasswd'] = md5($request['userpasswd']);
      $user = User::auth($request['userlogin'],$request['userpasswd']);

      if ($user) {
         $user = [
            'userid' => $user->userid,
            'userfirstname' => $user->userfirstname,
				'userlastname' => $user->userlastname
         ];

         session()->put('user', $user);

         return redirect()->action('HomeController@index')
            ->with('msg', 'Login realizado com sucesso!');
      } else {
         return redirect()->action('LoginController@index')
            ->with('class', 'danger')
            ->with('msg', 'Login e/ou senha invalidos, por favor tente novamente!');
      }

   }

   public function logout(Request $request) {

      $request->session()->flush();
      
      return redirect()->action('LoginController@index')
      ->with('class', 'success')
      ->with('msg', 'Logout realizado com sucesso!');

   }
}
