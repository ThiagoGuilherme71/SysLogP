<?php

namespace App\Http\Controllers;

use App\Models\VersaoSistema;

class VersaoSistemaController extends Controller
{
    public function index ()
    {
        $thisModel = new VersaoSistema();

        return view
        (
            'timeline.index',
            [
                'versao' => $thisModel->getAllSystemVersions()
            ]
        );
    }
}
