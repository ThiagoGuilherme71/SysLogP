<?php

namespace App\Http\Controllers;

use App\Models\TelescopeEntries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (\App\Models\VersaoSistema::getLastSystemVersion() != '-'){
            $contNotificacoes = 0;
            $dadosErros = $this->dashboard();
            $dataUltimaVersao = \App\Models\VersaoSistema::getLastSystemVersion()['data_versao'];
            $dtUltimaVerComMaisUmaSem = strtotime($dataUltimaVersao . '+1 week');
            if (strtotime($dataUltimaVersao) <= $dtUltimaVerComMaisUmaSem) {
                $dataNotificacao = new DateTime($dataUltimaVersao);
                $dataNotificacao = str_replace('-', '/', $dataNotificacao->format('d-m-Y'));
                $msg = "Há um nova versão deste sistema disponível, Confira já!!";
                $contNotificacoes++;
                return view('welcome', compact('msg', 'dataNotificacao','contNotificacoes', 'dadosErros'));
            }
        }

        return view('welcome');
    }
    public function getStatus($uuid)
    {

        $entry = TelescopeEntries::select('id_status_entries')->where('uuid', $uuid)->first();

        if (!$entry) {
            return response()->json(['success' => false, 'message' => 'Entrada não encontrada.'], 404);
        }
        $entry = $entry->id_status_entries;
        return response()->json(['success' => true, 'status' => $entry]);
    }

    public function mudarStatus($uuid, $novoStatus)
    {
        $usuario = Auth::user()->nome;
        $entry = TelescopeEntries::where('uuid', $uuid)->first();

        if (!$entry) {
            return response()->json(['success' => false, 'message' => 'Entrada não encontrada.'], 404);
        }
        if ($novoStatus == 1 ){
            $usuario = null;
            $entry->update([
                'id_status_entries' => $novoStatus,
                'responsavel' => $usuario,
            ]);
            return response()->json(['success' => true, 'message' => 'Status atualizado com sucesso.']);
        }

        $entry->update([
            'id_status_entries' => $novoStatus,
            'responsavel' => $usuario,
        ]);
        return response()->json(['success' => true, 'message' => 'Status atualizado com sucesso.']);
    }


    public function getBatchId($nomeSistema)
    {
        if ($nomeSistema == "null" || is_null($nomeSistema)) {
            return null;
        }
        $filtroRegistros = DB::table('telescope_entries')
            ->select('batch_id')
            ->whereRaw('DBMS_LOB.INSTR(content, ?) > 0', [$nomeSistema])
            ->orderBy('batch_id', 'desc')
            ->first();

        return $filtroRegistros->batch_id ?? null;
    }

    public function datatable($type, $nome) {
        $batchId = $this->getBatchId($nome);

        $logs = DB::table('telescope_entries')
            ->select([
                'telescope_entries.uuid',
                'status_entries.descricao',
                'telescope_entries.responsavel',
                'telescope_entries.sequence as sequence_id',
                'telescope_entries.created_at',
                DB::raw('DBMS_LOB.SUBSTR(telescope_entries.content, 4000, 1) as content')
            ])
            ->join('status_entries', 'telescope_entries.id_status_entries', '=', 'status_entries.id')
            ->where('telescope_entries.type', '=', $type);

        if (!is_null($batchId)) {
            $logs->where('telescope_entries.batch_id', '=', $batchId);
        }

        $logs = $logs->orderBy('telescope_entries.created_at', 'desc')
            ->get();

        return DataTables::of($logs)
            ->addColumn('action', function ($log) use ($type) {
                // Retorna apenas o UUID, a lógica de rota será no JavaScript
                return $log->uuid;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function dashboard()
    {
        $dadosErros = [
            'totalErros' => DB::table('telescope_entries')->count(),
            'errosPorTipo' => DB::table('telescope_entries')
                ->select('type', DB::raw('count(*) as total'))
                ->groupBy('type')
                ->get(),
            'errosPorStatus' => DB::table('telescope_entries as te')
                ->join('status_entries as se', 'te.id_status_entries', '=', 'se.id')
                ->select('se.descricao', DB::raw('count(*) as total'))
                ->groupBy('se.descricao')
                ->get(),
            'errosHoje' => DB::table('telescope_entries')
                ->whereDate('created_at', Carbon::today())
                ->count(),
            'errosSemana' => DB::table('telescope_entries')
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->count(),
            'errosMes' => DB::table('telescope_entries')
                ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->count(),
            'Responsaveis' => DB::table('telescope_entries')
                ->whereNotNull('responsavel') // opcional, se quiser ignorar nulos
                ->distinct('responsavel')
                ->count('responsavel'),


        ];

        return $dadosErros;
    }

}
