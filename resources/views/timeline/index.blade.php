@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-microphone font-green"></i>
                                            <span
                                                class="caption-subject bold font-green uppercase">Atualizações Importantes no Nosso Sistema! 🚀
                                            </span>
                                            <span
                                                class="caption-helper">Estamos animados em compartilhar as últimas novidades sobre as atualizações do nosso sistema!
                                            </span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="timeline">
                                            @foreach($versao as $item)
                                                <div class="timeline-item">
                                                    <div class="timeline-badge">
                                                        <img
                                                            class = "timeline-badge-userpic"
                                                            src = "/public/assets/images/luana-semge-nti.jpg"
                                                            alt = "logotipo da semge"
                                                        />
                                                    </div>
                                                    <div class="timeline-body">
                                                        <div class="timeline-body-head">
                                                            <div class="timeline-body-head-caption">
                                                                <span
                                                                    class="timeline-body-title font-blue-madison">
                                                                    Versão: {{$item['numero_versao']}}
                                                                </span>
                                                                <span
                                                                    class="timeline-body-time font-green-madison">
                                                                    <strong>
                                                                        Data:
                                                                    </strong>
                                                                    {{ \Carbon\Carbon::parse($item['data_versao']) -> format('d/m/Y') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="timeline-body-content">
                                                            <span class="font-green-cascade">
                                                                <p>
                                                                    Trabalhamos arduamente para tornar sua experiência ainda melhor, e estas mudanças
                                                                    trazem recursos emocionantes, melhorias de desempenho significativas e correções
                                                                    de bugs importantes. Aqui estão alguns destaques:
                                                                </p>
                                                                <p
                                                                    style="white-space: pre-line;">
                                                                    {{$item['descricao']}}
                                                                </p>
                                                                <p>
                                                                    Estamos ansiosos para receber seus comentários sobre essas atualizações.
                                                                    Sua opinião é fundamental para continuarmos aprimorando nosso sistema.
                                                                </p>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
