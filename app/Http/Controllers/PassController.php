<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class PassController extends Controller {
 

   public function index($id) {

      $title = 'Mudar Senha';

      $query = User::find($id);

      $url = '/password/edit/';

      return view('password.form', compact('title', 'query', 'url'));

   }

   public function update(Request $request) {
      
      $rules = [];

      $rules = [
         'userpasswd'             => 'required'
      ];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('PassController@index',['id'=>$request['userid']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar alterar a Senha, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $user = User::find($request['userid']);
         $user->update(['userpasswd' => md5($request['userpasswd'])] );

         return redirect()->action('LoginController@logout')
            ->with('class', 'success')
            ->with('msg', 'Senha alterada com sucesso, faça o login com sua nova Senha!');

      }

   }

}
