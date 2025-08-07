<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Formulario3Controller extends Controller
{
    public function index()
    {
        return view('secao_3.index');
    }

    public function create(){
    }

    public function store(Request $request){
    }

    public function edit($id){
    }

    public function update(Request $request, $id){
    }

    public function destroy($id){
    }

    public function multiselect(){
        return view('secao_3.seletores');
    }
}
