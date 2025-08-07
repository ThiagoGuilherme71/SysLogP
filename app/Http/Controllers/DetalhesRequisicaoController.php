<?php

namespace App\Http\Controllers;

use App\Models\TelescopeEntries;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class DetalhesRequisicaoController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function buscarDados()
    {
        if (\App\Models\VersaoSistema::getLastSystemVersion() != '-') {
            $contNotificacoes = 0;
            $dataUltimaVersao = \App\Models\VersaoSistema::getLastSystemVersion()['data_versao'];
            $dtUltimaVerComMaisUmaSem = strtotime($dataUltimaVersao . '+1 week');
            if (strtotime($dataUltimaVersao) <= $dtUltimaVerComMaisUmaSem) {
                $dataNotificacao = new DateTime($dataUltimaVersao);
                $dataNotificacao = str_replace('-', '/', $dataNotificacao->format('d-m-Y'));
                $msg = "Há um nova versão deste sistema disponível, Confira já!!";
                $contNotificacoes++;
                return view('requisicao.index', compact('msg', 'dataNotificacao', 'contNotificacoes'));
            }
        }
        return view('welcome');
    }

    public function datatable()
    {
 
        $logs = TelescopeEntries::select([
            'uuid',
            'created_at',
            'status_entries.descricao',
            'sequence as sequence_id',
            DB::raw('DBMS_LOB.SUBSTR(content, 4000, 1) as content')
        ])
            ->join('status_entries', 'telescope_entries.id_status_entries', '=', 'status_entries.id')
            ->where('type', '=', 'request')
            ->get();

        return DataTables::of($logs)
            ->addColumn('action', function ($logs) {
                return '<a href="' . route('detail.show', ['idLog' => $logs->uuid]) . '">
            <i class="fa fa-eye"></i> </a>';
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function visualizarDetalhesRequest($id)
    {
        $requestDetalhado =TelescopeEntries::select(['telescope_entries.content', 'telescope_entries.id_status_entries', 'status_entries.descricao', 'telescope_entries.responsavel'])
            ->join('status_entries', 'telescope_entries.id_status_entries', '=', 'status_entries.id')
            ->where('uuid', $id)
            ->first();


        if (!$requestDetalhado) {
            return redirect()->route('detail.request')->with('message', 'Nenhum Request Encontrado');
        }

        // Decodificar o JSON do content
        $content = json_decode($requestDetalhado->content, true);


        // Armazenar em variáveis individuais
        $controller_action = $content['controller_action'] ?? 'N/A';
        $response_status = $content['response_status'] ?? 'N/A';
        $ip_address = $content['ip_address'] ?? 'N/A';
        $memory = $content['memory'] ?? 'N/A';
        $mensagemErro = $content['message'] ?? 'Mensagem não encontrada';
        $mensagemLimpa = explode("Stack trace:", $mensagemErro)[0];
        $usuarioId = $content['user']['id'] ?? 'ID não disponível';
        $usuarioEmail = $content['user']['email'] ?? 'Email não informado';
        return view('requisicao.RequestDetalhado', [
            'controller_action' => $controller_action,
            'response_status' => $response_status,
            'ip_address' => $ip_address,
            'memory' => $memory,
            'mensagemErro' => $mensagemLimpa,
            'MensagemErroCompleta' => $mensagemErro,
            'usuarioId' => $usuarioId,
            'usuarioEmail' => $usuarioEmail,
            'descricaoStatus' => $requestDetalhado->id_status_entries,
            'uuid' => $id,
            'responsavel' => $requestDetalhado->responsavel,
        ]);
    }



}
