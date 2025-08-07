@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Módulo de Auditoria </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                {{--
                                <div class="btn-group">
                                    <a href="{{ route('auditoria.create') }}">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Novo
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                                --}}
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <button class="btn green btn-outline dropdown-toggle" data-toggle="dropdown">Ações
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-print"></i> Imprimir </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-pdf-o"></i> Salvar como PDF </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-excel-o"></i> Exportar para Excel </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr>
                                <th> <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
                                <th> Ação </th>
                                <th> Usuário </th>
                                <th> Tabela </th>
                                <th> Campo </th>
                                <th> Valor Antigo </th>
                                <th> Valor Novo </th>
                                <th> Modificado Em </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($dados_auditoria as $dado_auditoria)
                                <tr class="odd gradeX">
                                    <td> <input type="checkbox" class="checkboxes" value="1" /> </td>
                                    <td> {{$dado_auditoria->acao}} </td>
                                    <td> {{$dado_auditoria->nome_usuario}} </td>
                                    <td> {{$dado_auditoria->tabela}} </td>
                                    <td> {{$dado_auditoria->atributo}} </td>
                                    <td> {{$dado_auditoria->valor_antigo}} </td>
                                    <td> {{$dado_auditoria->valor_novo}} </td>
                                    <td> {{$dado_auditoria->data_hora}} </td>
                                </tr>
                            @endforeach --}}
                            <tr class="odd gradeX">
                                <td> <input type="checkbox" class="checkboxes" value="1" /> </td>
                                <td> usuario.store </td>
                                <td> Renê Oliveira </td>
                                <td> usuario </td>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td> 31/10/2023 17:03:59 </td>
                            </tr>
                            <tr class="odd gradeX">
                                <td> <input type="checkbox" class="checkboxes" value="1" /> </td>
                                <td> usuario.update </td>
                                <td> Rodrigo Costa </td>
                                <td> usuario </td>
                                <td> nome </td>
                                <td> Rene Oliveira </td>
                                <td> Renê Oliveira </td>
                                <td> 01/11/2023 16:59:59 </td>
                            </tr>
                            <!-- <tr class="odd gradeX">
                                <td> <input type="checkbox" class="checkboxes" value="1" /> </td>
                                <td> shuxer </td>
                                <td>
                                    <a href="mailto:shuxer@gmail.com"> shuxer@gmail.com </a>
                                </td>
                                <td> 120 </td>
                                <td> 120 </td>
                                <td class="center"> 12 Jan 2012 </td>
                                <td>
                                    <span class="label label-sm label-success"> Approved </span>
                                </td>
                            </tr>
                            <tr class="odd gradeX">
                                <td>
                                    <input type="checkbox" class="checkboxes" value="1" /> </td>
                                <td> looper </td>
                                <td>
                                    <a href="mailto:looper90@gmail.com"> looper90@gmail.com </a>
                                </td>
                                <td> 120 </td>
                                <td> 120 </td>
                                <td class="center"> 12.12.2011 </td>
                                <td>
                                    <span class="label label-sm label-warning"> Suspended </span>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection