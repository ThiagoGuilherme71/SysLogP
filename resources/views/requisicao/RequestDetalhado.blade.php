@extends('layouts.app')

@section('content')
    <div class="portlet light bordered">
        <!-- Card de Status -->
        <div class="status-card">
            <div id="statusDisplay" class="status-container">
                <span id="statusBadge" class="badge">Status</span>
                <div class="status-info">
                    <p id="statusDescription">Descrição</p>
                </div>
            </div>
        </div>

        <!-- Notificações -->
        <div class="notifications-container">
            <div class="error">
                <svg class="error-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-3-9h6a1 1 0 010 2H7a1 1 0 010-2z"
                          clip-rule="evenodd"></path>
                </svg>
                <div class="flex">
                    <div class="error-prompt-wrap">
                        <div class="error-details">
                            <ul>
                                <li><strong class="bold uppercase">Controller Action:</strong> {{ $controller_action }}</li>
                                <li><strong class="bold uppercase">response status:</strong> {{ $response_status }}</li>
                                <li><strong class="bold uppercase">ip address:</strong> {{ $ip_address }}</li>
                                <li><strong class="bold uppercase">Memory Usage:</strong> {{ $memory }}</li>
                            </ul>
                        </div>
                        <div class="error-details">
                            <ul>
                                <li><strong class="bold uppercase">ID do Usuário:</strong> {{ $usuarioId }}</li>
                                <li><strong class="bold uppercase">Email do Usuário:</strong> {{ $usuarioEmail }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botões de Status -->
            <div class="d-flex align-items-center mt-4">
                <a href="{{ route('welcome') }}" class="btn me-2 btn-default">Voltar</a>
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
    </div>
    {{--    <div class="notifications-container"> --}}
    {{--           --}}
    {{--        </div> --}}
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
    <style>
        .styled-button {
            padding: 9px 9px;
            font-size: 1.4rem;
            color: white;
            background-color: rgb(185, 28, 28);
            border: none;
            border-radius: 20%;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin: 10px;
        }

        .styled-button:hover {
            background-color: rgb(153, 27, 27);
            transform: scale(1.05);
            font-weight: inherit;

        }

        .styled-button:active {
            transform: scale(0.95);
        }

        .notifications-container {
            min-width: 100%;
            font-size: 1.5rem;
            line-height: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin: auto;
        }

        .flex {
            display: flex;
            align-items: center;
        }


        .error-svg {
            color: rgb(185, 28, 28);
            width: 1.9rem;
            height: 1.9rem;
            margin: 5px;
        }

        .error-prompt-wrap {
            margin-left: 1rem;
        }

        .error-title {
            font-weight: bold;
            color: #3a3a3a;
        }

        .error-level {
            color: rgb(185, 28, 28);
        }

        .error-prompt-message {
            margin-top: 0.5rem;
            font-size: 1rem;
        }

        .error-details ul {
            list-style: none;
            padding: 0;
        }

        .error-details li {
            margin: 15px 0;
            font-size: 1.8rem;
            font-weight: bold;
            color: #3a3a3a;
        }

        .error-details li strong {
            color: rgb(185, 28, 28);

        }

        .error-btn {
            margin-top: 3%;
        }
    </style>
@endsection

@section('js')
    <script>
        const UUID = @json($uuid);

        // Função para buscar status inicial
        fetch(`/getStatus/${UUID}`)
            .then(response => response.text())
            .then(text => {
                console.log("Resposta do servidor:", text);
                return JSON.parse(text);
            })
            .then(data => {
                if (data.success) {
                    updateCardVisual(data.status);
                } else {
                    console.error("Erro ao obter status:", data.message);
                }
            })
            .catch(error => console.error("Erro na requisição de status:", error));

        // Função para mudar status
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
                        }, 800)
                    } else {
                        alert(`Erro ao atualizar: ${data.message}`);
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert(`Erro: ${error}`);
                });
        }

        // Função para atualizar visual do card de status
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
                    container.classList.add('monitoring');
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

        // Buscar status ao carregar a página
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
@endsection