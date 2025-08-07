<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper" >
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse" style="margin-top: 1.7%">
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start ">
                <a
                    href="{{ route('welcome') }}"
                    class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Logs</span>
                </a>
            </li>
            <li>
                <a href="{{route('exceptions.index')}}" class="nav-link nav-toggle">
                    <i class="icon-fire"></i>
                    <span class="title">Exceptions</span>
                </a>
            </li>
            <li>
                <a href="{{route('detail.request')}}" class="nav-link nav-toggle">
                    <i class="icon-eye"></i>
                    <span class="title">Request</span>
                </a>
            </li>

            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-bar-chart"></i>
                    <span class="title">Dashboard</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="{{ route('dashboard.dashboard1') }}" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">Dashboard 1</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="{{ route('dashboard.dashboard2') }}" class="nav-link ">
                            <i class="icon-bulb"></i>
                            <span class="title">Dashboard 2</span>
                            <span class="badge badge-success">1</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="{{ route('dashboard.dashboard3') }}" class="nav-link ">
                            <i class="icon-graph"></i>
                            <span class="title">Dashboard 3</span>
                            <span class="badge badge-danger">5</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Relatórios</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="fa fa-file-pdf-o"></i>
                            <span class="title">PDF</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <i class="fa fa-file-excel-o"></i>
                            <span class="title">CSV</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="heading">
                <h3 class="uppercase">Outras</h3>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">SEÇÃO 1</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <span class="title">CADASTRO 1</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link">
                            <span class="title">CADASTRO 2</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link">
                            <span class="title">CADASTRO 3</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
