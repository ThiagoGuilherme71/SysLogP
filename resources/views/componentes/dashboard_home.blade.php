<div class="portlet-title">
    <div class="caption">
        <span class="caption-subject font-dark bold uppercase">DASHBOARD</span>
    </div>
</div>

<div class="dashboard-container">
    <div class="dashboard-card">
        <div class="dashboard-icon"><i class="fa fa-users"></i></div>
        <div class="dashboard-info">
            <span class="dashboard-title">Responsáveis Ativos</span>
            <span class="dashboard-value">{{number_format($dadosErros['Responsaveis'])}}</span> <!-- Mocado -->
        </div>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-icon"><i class="fa fa-server"></i></div>
        <div class="dashboard-info">
            <span class="dashboard-title">Sistemas Online</span>
            <span class="dashboard-value">12</span> <!-- Mantém mocado -->
        </div>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-icon"><i class="fa fa-exclamation-circle"></i></div>
        <div class="dashboard-info">
            <span class="dashboard-title">Erros Registrados</span>
            <span class="dashboard-value highlight">{{ number_format($dadosErros['totalErros']) }}</span>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-icon"><i class="fa fa-clock-o"></i></div>
        <div class="dashboard-info">
            <span class="dashboard-title">Erros Hoje</span>
            <span class="dashboard-value highlight">{{ number_format($dadosErros['errosHoje']) }}</span>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-icon"><i class="fa fa-calendar"></i></div>
        <div class="dashboard-info">
            <span class="dashboard-title">Erros na Semana</span>
            <span class="dashboard-value highlight">{{ number_format($dadosErros['errosSemana']) }}</span>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-icon"><i class="fa fa-calendar-check-o"></i></div>
        <div class="dashboard-info">
            <span class="dashboard-title">Erros no Mês</span>
            <span class="dashboard-value highlight">{{ number_format($dadosErros['errosMes']) }}</span>
        </div>
    </div>

    <div class="dashboard-card list-card" id="card-erros-tipo">
        <div class="dashboard-icon"><i class="fa fa-list"></i></div>
        <div class="dashboard-info">
            <span class="dashboard-title">Erros por Tipo</span>
            <ul class="dashboard-list">
                @foreach ($dadosErros['errosPorTipo'] as $erro)
                    <li><strong>{{ ucfirst($erro->type) }}</strong>: {{ number_format($erro->total) }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="dashboard-card list-card">
        <div class="dashboard-icon"><i class="fa fa-check-circle"></i></div>
        <div class="dashboard-info">
            <span class="dashboard-title">Erros por Status</span>
            <ul class="dashboard-list">
                @foreach ($dadosErros['errosPorStatus'] as $status)
                    <li><strong>{{ ucfirst($status->descricao) }}</strong>: {{ number_format($status->total) }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="dashboard-card" id="card-erros-grafico">
        <div class="dashboard-info">
            <span class="dashboard-title">Distribuição dos Erros</span>
            <div class="grafico-container">
                <canvas id="errosPorTipoChart"></canvas>
            </div>
        </div>
    </div>
    <div class="dashboard-card" id="card-erros-periodo">
        <div class="dashboard-info">
            <span class="dashboard-title">Erros por Período</span>
            <div class="grafico-container">
                <canvas id="errosPorPeriodoChart"></canvas>
            </div>
        </div>
    </div>

    <div class="dashboard-card" id="card-erros-status">
        <div class="dashboard-info">
            <span class="dashboard-title">Erros por Status</span>
            <div class="grafico-container">
                <canvas id="errosPorStatusChart"></canvas>
            </div>
        </div>
    </div>




</div>