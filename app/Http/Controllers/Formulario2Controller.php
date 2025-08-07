<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Formulario2Controller extends Controller
{
    public function index()
    {
        return view('secao_2.index');
    }

    public function create(){
       
        return view('secao_2.formulario2');
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
