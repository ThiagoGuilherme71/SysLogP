@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark bold uppercase">SISTEMAS</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-medkit"></i>
                        <div> SISMED-ADM </div>
                        <span class="badge badge-danger"> <i class="fa fa-exclamation-triangle"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-user-md"></i>
                        <div> SISMED-PERITO </div>
                        <span class="badge badge-success"> <i class="fa fa-eye"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-calendar"></i>
                        <div> SISMED-AGENDAMENTO </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-sitemap"></i>
                        <div> SISMED-RECEPÇÃO </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-calendar"></i>
                        <div> SISMED-DISPLAY </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-envelope"></i>
                        <div> INTRANET-ADM </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-bullhorn"></i>
                        <div> INTRANET-CLIENTE </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-map-marker"></i>
                        <div> SIGA </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-money"></i>
                        <div> SIGEO </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-plane"></i>
                        <div> SICI-ADM </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-thumbs-up"></i>
                        <div> SICI-CANDIDATO </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-cloud"></i>
                        <div> censo </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-globe"></i>
                        <div> CHRISTI </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                    <a href="javascript:;" class="icon-btn">
                        <i class="fa fa-heart-o"></i>
                        <div> KOSTOS </div>
                        <span class="badge badge-info"> <i class="fa fa-check-square"></i> </span>
                    </a>
                </div>
            </div>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-dark bold uppercase">EXCEPTIONS</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="exceptions-table">
                        <thead>
                            <tr>
                                <th style="width: 10%">Status</th>
                                <th>Seção na Inteface</th>
                                <th style="">Origem dos Dados</th>
                                <th style="">Localização no content</th>
                                <th style="">Data</th>
                                <th style="">Ocorrido</th>
                                <th style="">Ações</th>
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
        $(document).ready(function() {
            $('#exceptions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('exceptions.datatable') }}',
                    type: 'GET'
                },
                columns: [

                    {
                        data: 'descricao',
                        class: 'text-center',
                        name: 'descricao',
                        render: function(data) {
                            let colorClass = '';

                            switch (data.toLowerCase()) {
                                case 'em aberto':
                                    colorClass = 'text-danger';
                                    break;
                                case 'resolvido':
                                    colorClass = 'text-success';
                                    break;
                                case 'em andamento':
                                    colorClass = 'text-warning';
                                    break;
                                default:
                                    colorClass = 'text-body';
                            }

                            return `<span class="${colorClass}">${data}</span>`;
                        }
                    },
                    {
                        data: 'sequence_id',
                        name: 'sequence_id',
                        render: function(data, type, row) {
                            //lógica para limitar os caracteres em mensagem
                            if (type === 'display') {
                                return data.length > 100 ?
                                    data.substr(0, 100) +
                                    '... <a href="#" class="view-more" data-full="' +
                                    encodeURIComponent(data) + '">[mais]</a>' :
                                    data;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'uuid',
                        name: 'uuid',
                        render: function(data, type, row) {
                            //lógica para limitar os caracteres em mensagem
                            if (type === 'display') {
                                return data.length > 100 ?
                                    data.substr(0, 100) +
                                    '... <a href="#" class="view-more" data-full="' +
                                    encodeURIComponent(data) + '">[mais]</a>' :
                                    data;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'content',
                        name: 'content',
                        render: function(data, type, row) {
                            //lógica para limitar os caracteres em mensagem
                            if (type === 'display') {
                                return data.length > 100 ?
                                    data.substr(0, 100) +
                                    '... <a href="#" class="view-more" data-full="' +
                                    encodeURIComponent(data) + '">[mais]</a>' :
                                    data;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            return moment(data).format('DD/MM/YYYY');
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'ocorrido',
                        render: function(data, type, row) {
                            return moment(data).fromNow();
                        }
                    },
                    {
                        data: 'uuid',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full) {
                            return '<button class="btn btn-warning btn-sm font-weight-bold" onclick="visualizarException(\'' +
                                full.uuid + '\')">Mais Detalhes</button>';
                        }
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'
                },
                responsive: true
            });

            $(document).on('click', '.view-more', function(e) {
                e.preventDefault();
                var fullContent = decodeURIComponent($(this).data('full'));
                alert(fullContent);
            });
        });

        function visualizarException(uuid) {

            window.location.href = '{{ route('exceptions.visualizar', ':uuid') }}'.replace(':uuid', uuid);
        };
    </script>
@endsection
