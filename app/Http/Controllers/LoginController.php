<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Semge\Autenticacao\SemgeLogin;

class LoginController extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect('/');
        }
        return view('login');
    }

    public function autenticar(Request $request)
    {
        $class = "\\App\\Models\\$request->tipo";
        $usuario = new $class;
        $usuario->setCpf($this->remove_formatacao($request->cpf));
        $usuario->setSenha($request->senha);
        if (SemgeLogin::logar($usuario)) {
            $model =  $class::where('cpf', $usuario->getCpf())->first();
            Auth::login($model);
            return redirect('/')->with('message', 'Autenticado com sucesso!');
        }

        return redirect('/login')->with('message-error', 'CPF ou senha incorretos');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('message', 'Volte sempre!');
    }

    public function remove_formatacao($numero)
    {
        $numero = str_replace(['.', '-', '/', ','], '', $numero);
        return $numero;
    }
}
