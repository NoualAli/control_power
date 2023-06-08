@php
    $bnaLogo = public_path('app\images\bna_logo.svg');
    $coverPageImg = public_path('app\images\report_cover_page.png');
    $appBrandMonochrome = public_path('app\images\brand_monochrome.png');
@endphp
<section>
    <div class="page no-padding">
        <main class="page-body no-padding">
            <img src="{{ $coverPageImg }}" class="cover-page-img">
            <img src="{{ $bnaLogo }}" class="no-padding cover-page-logo">
            <div class="first-section-text">
                <p>Division Risques et Contrôle Permanant - <b>DRCP</b></p>
                <p>Direction du Contrôle Permanant - <b>DCP</b></p>
                <p>Département Contrôle - <b>{{ $mission->dre->name }}</b></p>
            </div>

            <span class="campaign-informations">
                <p>CAMPAGNE DE CONTRÔLE</p>
                <p>
                    2<sup>e</sup> NIVEAU <b>"{{ str_replace('cdc', '', $campaign->reference) }}"</b>
                </p>
            </span>
            <p class="year">{{ Carbon\Carbon::parse($campaign->start)->format('Y') }}</p>
            <p class="report-title">
                <b>RAPPORT</b><br>
                DE MISSION
            </p>
            <div class="box agency">
                {{ $mission->agency->name }} - {{ $mission->agency->code }}
                <div class="mission">
                    <span class="reference">
                        Réf: {{ $mission->reference }}
                    </span>
                    <span class="date">
                        Du {{ Carbon\Carbon::parse($mission->start)->format('d') }} au
                        {{ Carbon\Carbon::parse($mission->end)->format('d.m.Y') }}
                    </span>
                </div>
            </div>

            <div class="controlled_by">
                <b>Contrôlé par</b> {{ $mission->controllers[0]->full_name }}
                {{-- <div class="controller">

            </div> --}}
            </div>

            <div class="validated_by">
                <b>Validé par</b> {{ $mission->creator->full_name }}
                {{-- <div class="validator">

            </div> --}}
            </div>

            <img src="{{ $appBrandMonochrome }}" alt="PowerControlMonochrome" class="power-control-monochrome">
        </main>
    </div>
</section>
