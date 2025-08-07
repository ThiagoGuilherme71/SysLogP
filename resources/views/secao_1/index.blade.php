@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> lista de objetos  </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <button onclick="novo()" id="novo" class="btn sbold green"> Novo
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sistema-table">
                        <thead>
                            <tr>
                                <th> Código </th>
                                <th width="70%"> Nome </th>
                                <th class="width_acoes"> Ações </th>
                            </tr>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td> 1 </td>
                                    <td> Fulano de Tal </td>
                                    <td>
                                      <div>
                                        <a href="{{ route('secao_1.formulario') }}" id="servico" <button type="button" class="btn btn-warning"> Editar </button></a>
                                        <a onclick="confirmacaoExcluir('$sistema->id')" class="btn btn-danger" role="button">Excluir</a>
                                       </div>
                                    </td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td> 2 </td>
                                    <td> Beltrano da Li </td>
                                    <td>
                                      <div>
                                        <a href="{{ route('secao_1.formulario') }}" id="servico" <button type="button" class="btn btn-warning"> Editar </button></a>
                                        <a onclick="confirmacaoExcluir('$sistema->id')" class="btn btn-danger" role="button">Excluir</a>
                                       </div>
                                    </td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td> 3 </td>
                                    <td> Ciclano de Lá </td>
                                    <td>
                                      <div>
                                        <a href="{{ route('secao_1.formulario') }}" id="servico" <button type="button" class="btn btn-warning"> Editar </button></a>
                                        <a onclick="confirmacaoExcluir('$sistema->id')" class="btn btn-danger" role="button">Excluir</a>
                                       </div>
                                    </td>
                                </tr>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function novo(){
            var rota = "{{ route('secao_1.formulario') }}";
            window.location.href = rota;
        }

        function confirmacaoExcluir(id){
            var id = id;
            Swal.fire({
                title: "Tem certeza?",
                text: "Você não poderá reverter isso!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim",
                cancelButtonText: 'Não'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    window.location.href = url;
                }
            });
        }

    </script>
@endsection