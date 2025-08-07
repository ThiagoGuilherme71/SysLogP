<div class = "footer-content">
    <div class = "footer-description">
        <img
            class="footer-logo"
            src = "{{ asset('assets/images/logo_pms.png') }}"
            alt = "logotipo prefeitura municipal de salvador"
        />
        <p class="footer-title">
            &copy; 2024 NTI (NÚCLEO DE TECNOLOGIA DA INFORMAÇÃO - SECRETARIA MUNICIPAL DE GESTÃO)
        </p>
        @if(\Illuminate\Support\Facades\Auth::check())
            @php
                $lastSystemVersion = \App\Models\VersaoSistema::getLastSystemVersion();
            @endphp

            @if(is_array($lastSystemVersion) && isset($lastSystemVersion['numero_versao']))
                <a
                    class="footer-version"
                    href="{{ route('timeline.index') }}">VERSÃO
                    {{ $lastSystemVersion['numero_versao'] }}
                </a>
            @endif
        @endif
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
