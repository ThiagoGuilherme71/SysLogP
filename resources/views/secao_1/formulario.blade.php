@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i> Formulário Base 1 </div>
                    <div class="tools">
                        <a href="" class="collapse"> </a>
                        <a href="" class="reload"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('secao_1.index') }}" class="form-horizontal" role="form">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Input grande</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input-lg" placeholder="Input grande"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Input padrão</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Input padrão"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Input pequeno</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input-sm" placeholder="Input pequeno"> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Select grande</label>
                                <div class="col-md-9">
                                    <select class="form-control input-lg">
                                        <option>Opção 1</option>
                                        <option>Opção 2</option>
                                        <option>Opção 3</option>
                                        <option>Opção 4</option>
                                        <option>Opção 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Select padrão</label>
                                <div class="col-md-9">
                                    <select class="form-control">
                                        <option>Opção 1</option>
                                        <option>Opção 2</option>
                                        <option>Opção 3</option>
                                        <option>Opção 4</option>
                                        <option>Opção 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Select pequeno</label>
                                <div class="col-md-9">
                                    <select class="form-control input-sm">
                                        <option>Opção 1</option>
                                        <option>Opção 2</option>
                                        <option>Opção 3</option>
                                        <option>Opção 4</option>
                                        <option>Opção 5</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label class="col-md-3 control-label">Textarea</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile" class="col-md-3 control-label">Entrada de arquivo</label>
                                <div class="col-md-9">
                                    <input type="file" id="exampleInputFile">
                                    <p class="help-block"> algum texto de ajuda aqui. </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Checkboxes</label>
                                <div class="col-md-9">
                                    <div class="checkbox-list">
                                        <label>
                                            <input type="checkbox"> Checkbox 1 </label>
                                        <label>
                                            <input type="checkbox"> Checkbox 1 </label>
                                        <label>
                                            <input type="checkbox" disabled> Desabilitado </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Inline Checkboxes</label>
                                <div class="col-md-9">
                                    <div class="checkbox-list">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox21" value="option1"> Checkbox 1 </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox22" value="option2"> Checkbox 2 </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox23" value="option3" disabled> Desabilitado </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Radio</label>
                                <div class="col-md-9">
                                    <div class="radio-list">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios22" value="option1" checked> Opção 1 </label>
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios23" value="option2" checked> Opção 2 </label>
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios24" value="option2" disabled> Desabilitado </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Inline Radio</label>
                                <div class="col-md-9">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked> Option 1 </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios26" value="option2" checked> Option 2 </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios27" value="option3" disabled> Desabilitado </label>
                                    </div>
                                </div>
                            </div>
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
    </div>
@endsection
