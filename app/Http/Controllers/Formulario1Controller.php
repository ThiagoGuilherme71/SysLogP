<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Formulario1Controller extends Controller
{
    public function index()
    {
        return view('secao_1.index');
    }

    public function create(){
       
        return view('secao_1.formulario');
    }

    public function store(Request $request){
       
    }

    public function edit($id){

    }

    public function update(Request $request, $id){
    
    }

    public function destroy($id){

    }
}
