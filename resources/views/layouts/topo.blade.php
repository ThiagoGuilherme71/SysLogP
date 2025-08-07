<div class="page-header navbar navbar-fixed-top" style="background-color: rgb(56,116,188);">

    <div class="page-header-inner " style="height: 100%">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a target="_blank" href="https://semge.salvador.ba.gov.br/"></a>
            <div id="nome_secretaria">SEMGE</div>
            <div id="desc_secretaria">Secretaria de Gestão</div>
        </div>
        <!-- END LOGO -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
            data-target=".navbar-collapse"> </a>

        <div class="page-top">
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"> </li>
                    <li class="dropdown dropdown-extended dropdown-notification dropdown-dark"
                        id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                            data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-success" id="contNot"> {{ isset($msg) ? $contNotificacoes : 0 }}
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    <span class="bold"
                                        id="pendencias">{{ isset($contNotificacoes) ? $contNotificacoes . 'pendente' : '0 pendente(s)' }}</span>
                                    notificação(s)
                                </h3>
                                <a href="page_user_profile_1.html">view all</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;"
                                    data-handle-color="#637283">
                                    <li>
                                        <a href="javascript:;">
                                            <span
                                                class="time">{{ isset($dataNotificacao) ? $dataNotificacao : '' }}</span>
                                            <span class="details" onclick="timelineVersions()">
                                                <span class="label label-sm label-icon label-success">
                                                    <i class="fa fa-plus"></i>
                                                </span> {{ isset($msg) ? $msg : '' }} </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <li class="dropdown dropdown-extended quick-sidebar-toggler" onclick="TOPO.logout();">
                        <span class="bold label label-blue">{{ Auth::user()->nome }}</span>
                        <span class=" label label-blue">Sair</span>
                        <i class="icon-logout"></i>
                    </li>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div style="background-color: gold;text-align: center; margin-top: -1%" id="barra-informativa">

        @switch(getenv('APP_ENV'))
            @case('local')
                <h4 style="font-weight: 600">
                    Ambiente de Desenvolvimento Local
                </h4>
            @break

            @case('develop')
                <h4 style="font-weight: 600">
                    Ambiente de Pré-Homologação
                </h4>
            @break

            @case('homologa')
                <h4 style="font-weight: 600">
                    Ambiente de Homologação
                </h4>
            @break
        @endswitch
    </div>
</div>


<script>
    var TOPO = {
        logout: function() {
            var baseUrl = window.location.origin;
            window.location.href = baseUrl + '/sair';
        }
    }
</script>
