@extends('layouts.app')

@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="portlet light bordered">

                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-bar-chart"></i>
                        <span class="caption-subject bold uppercase"> Dashboard 1  </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat blue">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="1349">0</span>
                                </div>
                                <div class="desc"> New Feedbacks </div>
                            </div>
                            <a class="more" href="javascript:;"> View more
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat red">
                            <div class="visual">
                                <i class="fa fa-bar-chart-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="12,5">12,5</span>M$ </div>
                                <div class="desc"> Total Profit </div>
                            </div>
                            <a class="more" href="javascript:;"> View more
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat green">
                            <div class="visual">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="549">549</span>
                                </div>
                                <div class="desc"> New Orders </div>
                            </div>
                            <a class="more" href="javascript:;"> View more
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat purple">
                            <div class="visual">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="details">
                                <div class="number"> +
                                    <span data-counter="counterup" data-value="89"></span>89% </div>
                                <div class="desc"> Brand Popularity </div>
                            </div>
                            <a class="more" href="javascript:;"> View more
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection