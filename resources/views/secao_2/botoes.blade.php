@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="portlet light tasks-widget bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-green-haze bold uppercase">Botões</span>
                    </div>
    
                </div>
                <div class="portlet-body util-btn-margin-bottom-5">
                    <div class="clearfix">
                        <h4 class="block">Botões</h4>
                        <!-- Standard gray button with gradient -->
                        <button type="button" class="btn btn-default">Padrão</button>
                        <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                        <button type="button" class="btn btn-primary">Atualizar</button>
                        <!-- Indicates a successful or positive action -->
                        <button type="button" class="btn btn-success">Salvar</button>
                        <!-- Contextual button for informational alert messages -->
                        <button type="button" class="btn btn-info">Ações</button>
                        <!-- Indicates caution should be taken with this action -->
                        <button type="button" class="btn btn-warning">Atenção</button>
                        <!-- Indicates a dangerous or potentially negative action -->
                        <button type="button" class="btn btn-danger">Deletar</button>
                        <!-- Deemphasize a button by making it look like a link while maintaining button behavior -->
                        <button type="button" class="btn btn-link">Link</button>
                    </div>
                  
            </div>
        </div>
    </div>
@endsection