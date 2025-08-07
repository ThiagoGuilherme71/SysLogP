
@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-pin font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">SELETORES DE DATA</span>
                    </div>
                   
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="#" class="form-horizontal form-bordered">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Default Datepicker</label>
                                <div class="col-md-3">
                                    <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" />
                                    <span class="help-block"> Selecione a data </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Desativar datas anteriores</label>
                                <div class="col-md-3">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                        <input type="text" class="form-control" readonly>
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                    <span class="help-block"> Selecione a data </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Comece com anos</label>
                                <div class="col-md-3">
                                    <div class="input-group input-medium date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input type="text" class="form-control" readonly>
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                    <span class="help-block"> Selecione a data </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Apenas meses</label>
                                <div class="col-md-3">
                                    <div class="input-group input-medium date date-picker" data-date="10/2012" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">
                                        <input type="text" class="form-control" readonly>
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                    <span class="help-block"> Selecione apenas o mês </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Período</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control" name="from">
                                        <span class="input-group-addon"> para </span>
                                        <input type="text" class="form-control" name="to"> </div>
                                    <!-- /input-group -->
                                    <span class="help-block"> Selecione o período </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Em linha</label>
                                <div class="col-md-3">
                                    <div class="date-picker" data-date-format="mm/dd/yyyy"> </div>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="control-label col-md-3"></label>
                                <div class="col-md-3">
                                    <a class="btn green btn-outline sbold uppercase" href="#form_modal2" data-toggle="modal"> Ver Datepicker em modal
                                        <i class="fa fa-share"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id="form_modal2" class="modal fade" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Selecionadores de data em Modal</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="#" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Padrão Datepicker</label>
                                            <div class="col-md-8">
                                                <input class="form-control input-medium date-picker" size="16" type="text" value="" /> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Desativar datas anteriores</label>
                                            <div class="col-md-8">
                                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                                    <input type="text" class="form-control" readonly>
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <!-- /input-group -->
                                                <span class="help-block"> Selecione a data </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Comece com anos</label>
                                            <div class="col-md-8">
                                                <div class="input-group input-medium date date-picker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                    <input type="text" class="form-control" readonly>
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Apenas meses</label>
                                            <div class="col-md-8">
                                                <div class="input-group input-medium date date-picker" data-date="10/2012" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">
                                                    <input type="text" class="form-control" readonly>
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Período</label>
                                            <div class="col-md-8">
                                                <div class="input-group input-medium date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                    <input type="text" class="form-control" name="from">
                                                    <span class="input-group-addon"> para </span>
                                                    <input type="text" class="form-control" name="to"> </div>
                                                <!-- /input-group -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Fecha</button>
                                    <button class="btn green" data-dismiss="modal">Salvar alterações</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
@endsection