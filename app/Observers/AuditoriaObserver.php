<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Semge\Audit\Models\Auditoria;
use Semge\Audit\Observers\BaseObserver;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use App;
use Carbon\Carbon;

class AuditoriaObserver extends BaseObserver
{
    public function updated(Model $model)
    {
        $dataDiff = $this->arrayDiff($model->getOriginal(), $model->getAttributes());
        foreach($dataDiff as $attribute => $attribute_value) {
            $dataOriginal = $model->getOriginal();

            $auditoria = new Auditoria;
            $auditoria->id_usuario      = $this->getUsuarioId();
            $auditoria->nome_usuario    = $this->getNomeUsuario();
            $auditoria->id_registro     = $model->getKey();
            $auditoria->acao            = $this->thisGetAction();
            $auditoria->atributo        = $attribute;
            $auditoria->nome_tabela     = $model->getTable();
            $auditoria->valor_antigo    = $dataOriginal[$attribute];
            $auditoria->valor_novo      = $model[$attribute];
            $auditoria->ip              = $this->getCurrentIp();
            $auditoria->data_hora       = Carbon::now();
            $auditoria->save();
        }
    }

    //
    public function getNomeUsuario()
    {
        if (App::runningInConsole()) {
            return null;
        }
        else {
            return Auth::guard(session('guard'))->user()->nome;
        }
    }

}