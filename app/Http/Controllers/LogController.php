<?php

namespace App\Http\Controllers;

use App\Models\TelescopeEntries;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Log as LaravelLog;
use Laravel\Telescope\Telescope;

class LogController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'system_name' => 'required|string',
            'log_level' => 'required|string',
            'message' => 'required|string',
            'exception' => 'nullable|string',
            'timestamp' => 'required|date',
        ]);

        try {
            $log = ([
                'system_name' => $validated['system_name'],
                'log_level' => $validated['log_level'],
                'message' => $validated['message'],
                'exception' => $validated['exception'] ?? null,
                'timestamp' => $validated['timestamp'],
            ]);

            $context = [
                'system_name' => $validated['system_name'],
                'timestamp' => $validated['timestamp'],
                'environment' => $validated['enviroment'] ?? app()->environment(),
            ];

            if (!empty($validated['exception'])) {
                $context['exception'] = $validated['exception'];
            }

            LaravelLog::channel('stack')->info($validated['message'], $validated);

            if (!empty($validated['exception'])) {
                report(new \Exception("({$validated['system_name']}) " . $validated['exception']));
            }

            return response()->json(['message' => 'Log recebido com sucesso!', 'data' => $log], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao salvar o log.', 'error' => $e->getMessage()], 500);
        }
    }
    public function visualizarDetalhes($id)
    {
        $requestDetalhado = TelescopeEntries::select(['telescope_entries.content', 'telescope_entries.id_status_entries', 'status_entries.descricao', 'telescope_entries.responsavel'])
            ->join('status_entries', 'telescope_entries.id_status_entries', '=', 'status_entries.id')
            ->where('uuid', $id)
            ->first();


        if (!$requestDetalhado) {
            return redirect()->route('welcome')->with('message', 'Nenhum Request Encontrado');        }

        // Decodificar o JSON do content
        $content = json_decode($requestDetalhado->content, true);

        // Armazenar em variáveis individuais
        $nivelErro = $content['level'] ?? 'N/A';
        $mensagemErro = $content['message'] ?? 'Mensagem não encontrada';
        $mensagemLimpa = explode("Stack trace:", $mensagemErro)[0];
        $hostname = $content['hostname'] ?? 'Hostname não informado';
        $usuarioId = $content['user']['id'] ?? 'ID não disponível';
        $usuarioEmail = $content['user']['email'] ?? 'Email não informado';
        return view('log.visualizar', [
            'nivelErro' => $nivelErro,
            'mensagemErro' => $mensagemLimpa,
            'MensagemErroCompleta' => $mensagemErro,
            'hostname' => $hostname,
            'usuarioId' => $usuarioId,
            'usuarioEmail' => $usuarioEmail,
            'descricaoStatus' => $requestDetalhado->id_status_entries,
            'uuid' => $id,
            'responsavel' => $requestDetalhado->responsavel,
        ]);
    }

    public function visualizarDetalhesDetail($id)
    {
        $requestDetalhado = TelescopeEntries::select(['content'])->where('uuid', $id)->first();

        if (!$requestDetalhado) {
            return redirect()->route('detail.request')->with('message', 'Nenhum Request Encontrado');
        }

        // Decodificar o JSON do content
        $content = json_decode($requestDetalhado->content, true);

        // dd($requestDetalhado->content);

        // Armazenar em variáveis individuais
        $controller_action = $content['controller_action'] ?? 'N/A';
        $response_status = $content['response_status'] ?? 'N/A';
        $ip_address = $content['ip_address'] ?? 'N/A';
        $memory = $content['memory'] ?? 'N/A';
        $mensagemErro = $content['message'] ?? 'Mensagem não encontrada';
        $mensagemLimpa = explode("Stack trace:", $mensagemErro)[0];
        $usuarioId = $content['user']['id'] ?? 'ID não disponível';
        $usuarioEmail = $content['user']['email'] ?? 'Email não informado';
        return view('detalhes_requisicao.detailLog', [
            'controller_action' => $controller_action,
            'response_status' => $response_status,
            'ip_address' => $ip_address,
            'memory' => $memory,
            'mensagemErro' => $mensagemLimpa,
            'MensagemErroCompleta' => $mensagemErro,
            'usuarioId' => $usuarioId,
            'usuarioEmail' => $usuarioEmail,
        ]);
    }

}
