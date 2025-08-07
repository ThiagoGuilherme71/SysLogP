@extends('layouts.app')

@section('content')
    <div class="row" >

        <div class="col-md-12" >


            <div class="portlet light bordered container-geral">
                @include('componentes.dashboard_home')
            </div>

            <div class="portlet light bordered container-geral">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark bold uppercase">SISTEMAS</span>
                    </div>
                </div>
                @include('componentes.lista_sistemas')
            </div>
            <div class="portlet light bordered container-geral">
                <div class="portlet-title">

                    <div class="caption">
                        <span id="nome-sistema" class="caption-subject font-dark bold uppercase">Sistema: TODOS</span>
                    </div>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="nav-tabs-container">
                        <ul class="nav-tabs">
                            <li class="nav-item active" onclick="alterarTipo('log', this)">Logs</li>
                            <li class="nav-item" onclick="alterarTipo('request', this)">Requests</li>
                            <li class="nav-item" onclick="alterarTipo('exception', this)">Exceptions</li>
                        </ul>
                    </div>
                </nav>

                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="logs-table">
                        <thead>
                        <tr>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        const dadosErros = @json($dadosErros);
        function renderErrosPorTipoChart() {
            const ctx = document.getElementById('errosPorTipoChart').getContext('2d');

            // Mapeando dados reais
            const labels = dadosErros.errosPorTipo.map(erro => erro.type);
            const dataValues = dadosErros.errosPorTipo.map(erro => erro.total);

            // Criando o gráfico
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Erros',
                        data: dataValues,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#fd7e14', '#20c997', '#6f42c1', '#e83e8c'],
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function renderErrosPorStatusChart() {
            const ctx = document.getElementById('errosPorStatusChart').getContext('2d');

            const labels = dadosErros.errosPorStatus.map(status => status.descricao);
            const dataValues = dadosErros.errosPorStatus.map(status => status.total);

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Erros por Status',
                        data: dataValues,
                        backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e', '#e74a3b']
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function renderErrosPorPeriodoChart() {
            const ctx = document.getElementById('errosPorPeriodoChart').getContext('2d');

            // Mapeando os dados reais do período
            const labels = ['Hoje', 'Semana', 'Mês'];
            const dataValues = [dadosErros.errosHoje, dadosErros.errosSemana, dadosErros.errosMes];

            // Criando o gráfico de barras
            new Chart(ctx, {
                type: 'bar', // Pode mudar para 'line' se preferir
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Quantidade de Erros',
                        data: dataValues,
                        backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e'],
                        borderColor: ['#3656d4', '#198754', '#d48c00'],
                        borderWidth: 2
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }


        window.addEventListener('DOMContentLoaded', () => {
            renderErrosPorTipoChart();
            renderErrosPorStatusChart();
            renderErrosPorPeriodoChart();

        });


        let errosPorTipoChartInstance = null; // Variável global para guardar a instância

    </script>
    <script>
        $(document).ready(function() {
            if ($('#logs-table').length) {
                atualizarTabelaLogs();
            }
        });

        let nomeSistemaSelecionado = null; // Nome do sistema (null no carregamento inicial)
        let tipo = 'log'; // Tipo padrão

        // Alterar o tipo via navbar
        function alterarTipo(novoTipo, elemento) {
            tipo = novoTipo;

            document.querySelectorAll('.nav-item').forEach(tab => tab.classList.remove('active'));
            elemento.classList.add('active');

            atualizarTabelaLogs();
        }

        // Alterar o nome do sistema ao clicar no card
        function clickCard(nomeSistema) {
            const cardClicado = document.getElementById(nomeSistema);

            // Verifica se o card clicado já está selecionado
            if (cardClicado.classList.contains('selected')) {
                // Se já está selecionado, remove a seleção
                cardClicado.classList.remove('selected');
                nomeSistemaSelecionado = null;
                document.getElementById('nome-sistema').innerText = 'Sistema: Nenhum selecionado';
            } else {
                // Remove seleção de todos os cards
                document.querySelectorAll('.card').forEach(card => {
                    card.classList.remove('selected');
                });

                // Seleciona o card clicado
                cardClicado.classList.add('selected');
                nomeSistemaSelecionado = nomeSistema;
                document.getElementById('nome-sistema').innerText = `Sistema: ${nomeSistema}`;
            }

            atualizarTabelaLogs();
        }

        // Atualiza a tabela com os filtros atuais
        function atualizarTabelaLogs() {
            if ($.fn.DataTable.isDataTable('#logs-table')) {
                $('#logs-table').DataTable().destroy();
            }

            $('#logs-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                order: [[2, 'desc']],
                ajax: {
                    url: `/logs/datatable/${tipo}/${nomeSistemaSelecionado ?? 'null'}`,
                    type: 'GET'
                },
                columns: [
                    { data: 'descricao', title: 'Status', class: 'text-center', name: 'descricao' },
                    { data: 'content', title: 'Mensagem', name: 'content',
                        render: function (data, type, row) {
                            if (type === 'display') {
                                return data.length > 100
                                    ? data.substr(0, 100) + '... <a href="#" class="view-more" data-full="' +
                                    encodeURIComponent(data) + '">[mais]</a>'
                                    : data;
                            }
                            return data;
                        }
                    },
                    { data: 'created_at', title: 'Ocorrido', name: 'ocorrido',
                        render: function(data) { return moment(data).fromNow(); }
                    },
                    { data: 'created_at', title: 'Data', name: 'created_at',
                        render: function(data) { return moment(data).format('DD/MM/YYYY HH:mm'); }
                    },
                    { data: 'responsavel', title: 'Responsável', name: 'responsavel'},
                    {
                        data: 'uuid',
                        title: 'Ações',
                        name: 'action',
                        orderable: false,
                        class: 'text-center',
                        searchable: false,
                        render: function(data, type, row) {
                            let funcaoClick = '';

                            switch (tipo) { // ou window.tipo se for uma variável global
                                case 'log':
                                    funcaoClick = `visualizarLog('${data}')`;
                                    break;
                                case 'request':
                                    funcaoClick = `visualizarRequest('${data}')`;
                                    break;
                                case 'exception':
                                    funcaoClick = `visualizarException('${data}')`;
                                    break;
                                default:
                                    funcaoClick = `visualizarLog('${data}')`;
                                    break;
                            }

                            return `<button class="btn btn-warning" onclick="${funcaoClick}">Mais Detalhes
                <i class="fa fa-eye"></i>
            </button>`;
                        }
                    }
                ],
                columnDefs: [{ targets: -1, width: "5%" }],
                language: {
                    url: "{{ asset('assets/pt/datatables.json') }}"
                },
                responsive: true
            });
        }

        // Inicialização dos eventos
        $(document).on('click', '.view-more', function(e) {
            e.preventDefault(); // Previne comportamento padrão do link

            var fullContent = $(this).data('full'); // Pegando o atributo correto
            fullContent = decodeURIComponent(fullContent); // Decodificando corretamente

            Swal.fire({
                title: 'MENSAGEM DETALHADA',
                html: `<div class="content-scroll">${fullContent}</div>`,
                width: '60%',
            });


        });


        function visualizarLog(uuid) {
            window.location.href = '{{ route('logs.visualizar', ':idLog') }}'.replace(':idLog', uuid);
        }

        function visualizarRequest(uuid) {
            window.location.href = '{{ route('detail.show', ':idLog') }}'.replace(':idLog', uuid);
        }

        function visualizarException(uuid) {
            window.location.href = '{{ route('exceptions.visualizar', ':uuid') }}'.replace(':uuid', uuid);
        }
    </script>

@endsection
