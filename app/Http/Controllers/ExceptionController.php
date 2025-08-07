<?php

namespace App\Http\Controllers;

use App\Models\TelescopeEntries;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ExceptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('exceptions.exception');
    }

    public function visualizarException($id)
    {
        $exceptionDetalhada = TelescopeEntries::select(['telescope_entries.content', 'telescope_entries.id_status_entries', 'status_entries.descricao', 'telescope_entries.responsavel'])
            ->join('status_entries', 'telescope_entries.id_status_entries', '=', 'status_entries.id')
            ->where('uuid', $id)
            ->first();
        if (!$exceptionDetalhada) {
            return redirect()->route('exceptions.exception')->with('message', 'Nenhuma exceptions encontrada');
        }

        // Decodificar o JSON do content
        $content = json_decode($exceptionDetalhada->content, true);

        // Armazenar em variáveis individuais
        $linePreview = $content['line_preview'];
        $nivelErro = $content['level'] ?? 'N/A';
        $mensagemErro = $content['message'] ?? 'Mensagem não encontrada';
        $mensagemLimpa = explode("Stack trace:", $mensagemErro)[0];
        $system = $content['context']['system'] ?? 'Sistema não identificado';
        $hostname = $content['hostname'] ?? 'Hostname não informado';
        $usuarioId = $content['user']['id'] ?? 'ID não disponível';
        $usuarioEmail = $content['user']['email'] ?? 'Email não informado';
        return view('exceptions.exceptionDetalhada', [
            'linePreview' => $linePreview,
            'nivelErro' => $nivelErro,
            'mensagemErro' => $mensagemLimpa,
            'system' =>$system,
            'MensagemErroCompleta' => $mensagemErro,
            'hostname' => $hostname,
            'usuarioId' => $usuarioId,
            'usuarioEmail' => $usuarioEmail,
            'descricaoStatus' => $exceptionDetalhada->id_status_entries,
            'uuid' => $id,
            'responsavel' => $exceptionDetalhada->responsavel,
        ]);
    }

    public function datatable()
    {
        $exceptions = TelescopeEntries::select([
            'uuid',
            'sequence as sequence_id',
            'created_at',
            'status_entries.descricao',
            DB::raw('DBMS_LOB.SUBSTR(content, 4000, 1) as content')
        ])
            ->join('status_entries', 'telescope_entries.id_status_entries', '=', 'status_entries.id')
            ->where('type', '=', 'exception')
            ->orderBy('sequence_id', 'desc')
            ->get();
            // dd($exceptions[0]);

        return DataTables::of($exceptions)
            ->addColumn('action', function ($exception) {
            return '<button class="btn btn-warning btn-sm font-weight-bold" onclick="visualizarException(\'' . $exception->uuid . '\')">Mais Detalhes</button>';
            })

            ->rawColumns(['action'])
            ->make(true);
    }


}