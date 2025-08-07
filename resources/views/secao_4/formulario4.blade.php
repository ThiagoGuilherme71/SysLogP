@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="portlet box blue ">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i> Formulário Base 4 Repete formulário </div>
                    <div class="tools">
                        <a href="" class="collapse"> </a>
                        <a href="" class="reload"> </a>
                    </div>
                </div>

                <div class="portlet-body form">
                    <form action="{{ route('secao_4.index') }}" class="repeater" enctype="multipart/form-data" class="form-horizontal" role="form">
                            <div class="form-body">
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label class="control-label">Nome</label>
                                                <input type="text" class="form-control" placeholder="Nome">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Sobrenome</label>
                                                <input type="text" class="form-control" placeholder="Sobrenome">
                                            </div>
                                                <button type="button" data-repeater-delete class="btn red" style="display:inline-block;height: 33px;margin-top: 28px;">Excluir</button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                    <input data-repeater-create type="button" class="btn blue" value="+ Adicionar"/>
                            </div>
                            <div class="form-actions right1">
                                <button type="button" class="btn default">Cancelar</button>
                                <button type="submit" class="btn green">Salvar</button>
                            </div> 

                        </form>
                    </div>
                </div>
        </div>
    </div>
    
@endsection

@section('js')
    <script>
        $('.repeater').repeater({
        // options and callbacks here
        });

    </script>
@endsection