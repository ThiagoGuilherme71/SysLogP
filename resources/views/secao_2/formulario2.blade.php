@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Formulário Base 2</span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="{{ route('secao_2.index') }}" id="form_sample_3" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Nome
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" name="name" data-required="1" class="form-control" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Endereço de email
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <input type="email" name="email" class="form-control" placeholder="Endereço de email"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Ocupação&nbsp;&nbsp;</label>
                                <div class="col-md-4">
                                    <input name="occupation" type="text" class="form-control" /> </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Select2 Dropdown
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <select class="form-control select2me" name="options2">
                                        <option value="">Selecione...</option>
                                        <option value="Option 1">Opção 1</option>
                                        <option value="Option 2">Opção 2</option>
                                        <option value="Option 3">Opção 3</option>
                                        <option value="Option 4">Opção 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Seletor de data</label>
                                <div class="col-md-4">
                                    <div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                                        <input type="text" class="form-control" readonly name="datepicker">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                    <span class="help-block"> selecione uma data </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Filiação
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <div class="radio-list" data-error-container="#form_2_membership_error">
                                        <label>
                                            <input type="radio" name="membership" value="1" /> Taxa </label>
                                        <label>
                                            <input type="radio" name="membership" value="2" /> Profissional </label>
                                    </div>
                                    <div id="form_2_membership_error"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Serviços
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-4">
                                    <div class="checkbox-list" data-error-container="#form_2_services_error">
                                        <label>
                                            <input type="checkbox" value="1" name="service" /> Serviço 1 </label>
                                        <label>
                                            <input type="checkbox" value="2" name="service" /> Serviço 2 </label>
                                        <label>
                                            <input type="checkbox" value="3" name="service" /> Serviço 3 </label>
                                    </div>
                                    <span class="help-block"> (selecione pelo menos dois) </span>
                                    <div id="form_2_services_error"> </div>
                                </div>
                            </div>
        
                            <div class="form-group last">
                                <label class="control-label col-md-3">CKEditor
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <textarea class="ckeditor form-control" name="editor2" rows="6" data-error-container="#editor2_error"></textarea>
                                    <div id="editor2_error"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Salvar</button>
                                    <button type="button" class="btn default">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
                <!-- END VALIDATION STATES-->
            </div>
         </div>

        </div>
    </div>
@endsection
