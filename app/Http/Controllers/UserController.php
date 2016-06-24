<?php

namespace App\Http\Controllers;

use App\User;
use App\Niveluser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller {

   public function index() {

      $title = 'Usuários';

      $user = User::join('niveluser', 'user.idniveluser','=','niveluser.idniveluser')
                    ->orderBy('userfirstname','asc')->get();

      return view('user.index', compact('title', 'user'));

   }

   public function create() {

      $title = 'Cadastrar Usuário';

      $niveluser = Niveluser::orderBy('nomeniveluser', 'asc')->get();

      $url = '/user/register';

      return view('user.form', compact('title', 'url', 'niveluser'));

   }
   public function save(Request $request) {

      $rules = [];

      $rules = [
         'userfirstname'         => 'required',
         'userlastname'       	=> 'required',
         'userlogin'             => 'required',
         'idniveluser'           => 'required'
      ];

      $request['userpasswd'] = md5($request['userlogin'].'1234');

      $usuario = $request['userfirstname'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('UserController@create')
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar cadastrar o usuário, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $unit = User::create($request->all());

         return redirect()->action('UserController@index')
            ->with('class', 'success')
            ->with('msg', 'Cadastro de Usuário "'.$usuario.'" realizado com sucesso!');

      }

   }

   public function delete($id) {

      $user = User::find($id);

      $usuario = $user['userfirstname'];

      $user->delete();

      return redirect()->action('UserController@index')
         ->with('class', 'success')
         ->with('msg', 'Usuário "'.$usuario.'" excluido com sucesso!');

   }

   public function edit($id) {

      $title = 'Editar Usuário';

      $query = User::find($id);

      $niveluser = Niveluser::all();

      $url = '/user/edit/';

      return view('user.form', compact('title', 'query', 'url', 'niveluser'));

   }

   public function update(Request $request) {

      
      $rules = [];

      $rules = [
         'userfirstname'         => 'required',
         'userlastname'          => 'required',
         'userlogin'             => 'required',
         'idniveluser'           => 'required'
      ];

      $usuario = $request['userfirstname'];

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {

         return redirect()->action('UserController@edit',['id'=>$request['userid']])
            ->with('class', 'danger')
            ->with('msg', 'Erro ao tentar alterar o Usuário, por favor atente para os erros listados abaixo:')
            ->withErrors($validator)
            ->withInput();

      } else {

         $user = User::find($request['userid']);
         $user->update($request->all());

         return redirect()->action('UserController@index')
            ->with('class', 'success')
            ->with('msg', 'Usuário "'.$usuario.'" alterado com sucesso!');

      }

   }

   public function redefinirsenha($id, $login){

      $user = User::find($id);
      $user->update(['userpasswd' => md5($login.'1234')] );

      return redirect()->action('UserController@index')
         ->with('class', 'success')
         ->with('msg', 'Usuário "'.$login.'" excluido com sucesso!');

   }

}
