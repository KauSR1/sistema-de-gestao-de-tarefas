<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function userlogin(){
    return view('auth.login');
  }

  public function userLoginSubmit(Request $request) {
     $request->validate(
      [
        'text_username' => 'required',
        'text_password' => 'required|min:6|max:20'
      ],
      [
        'text_username.required' => 'Informe seu usuário.',
        'text_password.required' => 'Informe sua senha.',
        'text_password.min'      => 'A senha deve ter no mínimo :min caracteres.',
        'text_password.max'      => 'A senha deve ter no máximo :max caracteres.',
      ]);

      $username = $request->input('text_username');
      $password = $request->input('text_password');

      if(!Auth::attempt(['username' => $username,'password' => $password,])){
        return redirect()->back()->with('loginError', 'Usuário ou senha incorretos.');
      }

      if(!Auth::User()->active){
        Auth::logout();
        return redirect()->back()->with('loginError', 'Sua conta ainda não foi ativada.');
      }

      return redirect()->route('dashboard');
  }

    public function userRegister() {
    return view('auth.register');
  }

  public function userRegisterSubmit(Request $request) {
    $request->validate(
      [
        'name'                  => 'required|min:5|max:20',
        'email'                 => 'required|email|unique:users,email',
        'username'              => 'required|min:4|unique:users,username',
        'password'              => 'required|min:6|max:20|confirmed',
        'password_confirmation' => 'required'
      ],
      [
        'name.required'                  => 'Informe seu nome completo.',
        'name.min'                       => 'O nome deve ter no mínimo :min caracteres.',
        'name.max'                       => 'O nome deve ter no máximo :max caracteres.',
        'email.required'                 => 'Informe um endereço de e-mail.',
        'email.unique'                   => 'Este e-mail já está cadastrado.',
        'username.required'              => 'Informe um nome de usuário.',
        'username.min'                   => 'O nome de usuário deve ter no mínimo :min caracteres.',
        'username.unique'                => 'Este nome de usuário já está em uso.',
        'password.required'              => 'Informe uma senha.',
        'password.min'                   => 'A senha deve ter no mínimo :min caracteres.',
        'password.max'                   => 'A senha deve ter no máximo :max caracteres.',
        'password.confirmed'             => 'A confirmação de senha não confere.',
        'password_confirmation.required' => 'Confirme sua senha.',
      ]);

    User::create([
    'name'     => $request->name,
    'email'    => $request->email,
    'username' => $request->username,
    'password' => $request->password,
    ]);


      return redirect()->route('login')->with('success', 'Cadastro realizado! Aguarde a aprovação do administrador.');
  }
}
