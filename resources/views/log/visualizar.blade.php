@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <!-- Card de Status -->
        <div class="status-card">
            <div id="statusDisplay" class="status-container">
                <span id="statusBadge" class="badge">Status</span>
                <div class="status-info">
                    <p id="statusDescription">Descrição</p>
                    @if($responsavel)
                        <p>Responsável: {{$responsavel}}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Card de Informações -->
        <div class="portlet light info-card">
            <div class="error">
                <h3 class="bold error-title">Nível do Log: <span class="error-level uppercase">{{$nivelErro}}</span></h3>
                <ul>
                    <li><strong>Host:</strong> {{$hostname}}</li>
                    <li><strong>ID Usuário:</strong> {{$usuarioId}}</li>
                    <li><strong>Email:</strong> {{$usuarioEmail}}</li>
                </ul>
                <h4 id="mensagem" class="bold">{{$mensagemErro}}</h4>
                <button id="toggleMensagem" class="styled-button">Mensagem completa</button>
            </div>
        </div>

        <!-- Botões de Status -->
        <div>
            <a href="{{ route('welcome') }}" class="btn btn-default">Voltar</a>
            @switch($descricaoStatus)
                @case(1)
                    <button class="btn btn-warning-custom" onclick="mudarStatus(2)">Tratar Erro</button>
                    <button class="btn btn-secondary" onclick="mudarStatus(3)">Monitorar Erro</button>
                    @break
                @case(2)
                    <button class="btn btn-success" onclick="mudarStatus(4)">Erro Resolvido</button>
                    <button class="btn btn-secondary" onclick="mudarStatus(3)">Monitorar Erro</button>
                    @break
                @case(3)
                    <button class="btn btn-success" onclick="mudarStatus(4)">Erro Resolvido</button>
                    @break
                @case(4)
                    <button class="btn btn-danger" onclick="mudarStatus(1)">Reabrir</button>
                    @break
                @default
                    <button class="btn btn-info" onclick="mudarStatus(1)">Em Aberto</button>
            @endswitch
        </div>
    </div>

    <style>


        .btn {
            padding: 8px 14px; /* Menor espaço interno */
            border-radius: 2px !important;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: auto;
            height: 35px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* Botão Voltar - Cinza neutro */
        .btn-default {
            background: linear-gradient(135deg, #8c8c8c 0%, #9a9a9a 100%);
            color: white;
        }

        .btn-default:hover {
            background: linear-gradient(135deg, #8c8c8c 0%, #888888 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        /* Em Tratativa - Laranja (Atenção/Análise) */
        .btn-warning-custom {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
        }

        .btn-warning-custom:hover {
            background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.4);
        }

        /* Em Andamento - Vermelho (Urgente/Ativo) */
        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4);
        }

        /* Resolvido - Verde (Sucesso/Concluído) */
        .btn-success {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #229954 0%, #1e8449 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.4);
        }

        /* Status Desconhecido - Azul (Informativo) */
        .btn-secondary {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #0984e3 0%, #0770c4 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(116, 185, 255, 0.4);
        }

        .button-group {
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .button-group {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                min-width: auto;
            }
        }
        .status-info {
            margin-top: 15px;
            font-size: 17px;
            font-weight: 600;
            color: #3a3a3a;
        }

        .styled-button {
            padding: 7px 7px;
            font-size: 1.4rem;
            font-weight: 500;
            color: white;
            background-color: rgb(248, 193, 18);
            border: none;
            border-radius: 5px !important;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin: 10px;
        }

        .styled-button:hover {
            background-color: rgb(207, 161, 14);
            transform: translateY(-2px);
            box-shadow: 0 1px 3px rgba(104, 104, 104, 0.72);
            font-weight: 600;
        }

        .styled-button:active {
            transform: scale(0.95);
        }

    </style>
@endsection

@section('js')
    <script>
        const UUID = @json($uuid);
        fetch(`/getStatus/${UUID}`)
            .then(response => response.text()) // <- Primeiro captura como texto
            .then(text => {
                console.log("Resposta do servidor:", text); // Verifique o conteúdo real antes do parse
                return JSON.parse(text); // Agora tenta converter para JSON
            })
            .then(data => {
                if (data.success) {
                    updateCardVisual(data.status);
                } else {
                    console.error("Erro ao obter status:", data.message);
                }
            })
            .catch(error => console.error("Erro na requisição de status:", error));

        // ✅ Disponível no escopo global
        function mudarStatus(novoStatus) {
            fetch(`/mudarStatus/${UUID}/${novoStatus}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let timerInterval;
                        Swal.fire({
                            title: "Carregando!",
                            html: "Em: <b></b> milliseconds.",
                            timer: 800,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                    timer.textContent = `${Swal.getTimerLeft()}`;
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log("completo");
                            }
                        });
                        setTimeout(function (){
                            window.location.reload();
                        },800)

                    } else {
                        alert(`Erro ao atualizar: ${data.message}`);
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert(`Erro: ${error}`);
                });
        }


        function updateCardVisual(status) {
            const container = document.getElementById('statusDisplay');
            const badge = document.getElementById('statusBadge');
            const description = document.getElementById('statusDescription');

            container.className = 'status-container';
            badge.className = 'badge';
            switch(status) {
                case "1":
                    container.classList.add('danger');
                    badge.classList.add('danger');
                    badge.textContent = 'Em aberto';
                    description.textContent = 'O problema ainda não foi tratado.';
                    break;
                case "2":
                    container.classList.add('warning');
                    badge.classList.add('warning');
                    badge.textContent = 'Em Tratamento';
                    description.textContent = 'O problema está sendo analisado pela equipe técnica.';
                    break;
                case "3":
                    container.classList.add('monitoring'); // Criar uma classe CSS específica se necessário
                    badge.classList.add('monitoring');
                    badge.textContent = 'Em Monitoramento';
                    description.textContent = 'A equipe está monitorando a situação para prevenir novos problemas.';
                    break;
                case "4":
                    container.classList.add('success');
                    badge.classList.add('success');
                    badge.textContent = 'Corrigido';
                    description.textContent = 'O problema foi solucionado com sucesso!';
                    break;
                default:
                    console.warn("Status desconhecido:", status);
                    container.classList.add('unknown');
                    badge.classList.add('unknown');
                    badge.textContent = 'Indefinido';
                    description.textContent = 'O status não pôde ser identificado.';
            }

        }

        // 🔥 Ao carregar, busca o status atual
        document.addEventListener('DOMContentLoaded', () => {
            fetch(`/getStatus/${UUID}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        updateCardVisual(data.status);
                    }
                })
                .catch(err => console.error(err));
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById("toggleMensagem");
            const mensagemElemento = document.getElementById("mensagem");

            if (toggleButton && mensagemElemento) {
                toggleButton.addEventListener("click", function() {
                    if (toggleButton.innerText === "Mensagem completa") {
                        mensagemElemento.innerText = @json($MensagemErroCompleta ?? '');
                        toggleButton.innerText = "Encurtar mensagem";
                    } else {
                        mensagemElemento.innerText = @json($mensagemErro ?? '');
                        toggleButton.innerText = "Mensagem completa";
                    }
                });
            }
        });
    </script>
@endsection