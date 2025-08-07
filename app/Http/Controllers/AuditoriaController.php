<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Semge\Audit\Models\Auditoria;

class AuditoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $dados_auditoria = Auditoria::all();
        // return view('auditoria.index', ['dados_auditoria' => $dados_auditoria]);
        return view('auditoria.index');
    }

}
