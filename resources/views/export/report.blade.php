@php
    $appCss = env('APP_URL') . '/special_styles/report.css';
    // $appCss = mixUrl('dist/css/app.css', '', env('APP_URL'));
    // $appCss = mixUrl('dist/css/app.css');
    $appBrand = public_path('images\brand.png');
    $bnaLogo = public_path('images\logo.svg');
    $coverPageImg = public_path('images\cover_page.png');
    $appBrandMonochrome = public_path('images\brand_monochrome.png');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ $appBrand }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ $appCss }}">
    <title>Rapport de la mission {{ $mission->reference }}</title>
</head>

<body>
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
                AP Didouche Mourade - {{ $mission->agency->code }}
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

    <header class="page-header">
        <div class="container">
            <img src="{{ $bnaLogo }}" class="bna-logo" alt="Banque National D'Algérie">

            <div class="text-content">
                <p>Direction du Contrôle Permanent</p>
                <p>Division Risques et Contrôle Permanent</p>
            </div>
        </div>
    </header>
    <footer class="page-footer">
        <div class="container">
            <img src="{{ $appBrand }}" class="app-brand" alt="Control Power">
            <span class="pagenum"></span>
        </div>
    </footer>
    <main class="page-body report-area">
        <div class="container">
            <h1>Introduction</h1>
            <br>
            <div class="campaign-introduction">
                <p>
                    L’objectif de cette campagne est d’identifier les faiblesses et les défaillances entachant la bonne
                    application des procédures et les contrôles 1er niveau en vue de les bannir et/ou les améliorer,
                    l’intervention du contrôleur doit obéir à la démarche suivante :
                </p>
                <br>
                <ul>
                    <li>
                        Préparation de la mission de contrôle en prenant connaissance des processus à traiter et des
                        procédures
                        y afférentes ;
                    </li>
                    <li>
                        Sélectionner un échantillon représentatif de dossier ou de compte et entamer les vérifications
                        en
                        procédant par examen et analyse ;
                    </li>
                    <li>
                        Respect des délais accordés.
                    </li>
                </ul>
                <br>
                <p>
                    Ci-après les familles, domaines et processus à contrôler:
                </p>
                <br>
            </div>
            <ul>
                @foreach ($details as $family => $familyData)
                    <li>Famille: {!! $family !!}</li>
                    <ul>
                        @php
                            $domains = $familyData->groupBy('domain');
                        @endphp
                        @foreach ($domains as $domain => $domainData)
                            @php
                                $domain = json_decode($domain);
                            @endphp
                            <li>Domaine: {{ $domain->name }}</li>
                            <ul>
                                @php
                                    $processes = $domainData->groupBy('process');
                                @endphp
                                @foreach ($processes as $process => $processData)
                                    @php
                                        $process = json_decode($process);
                                    @endphp
                                    <li>Processus: {{ $process->name }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>
                    <br>
                @endforeach
            </ul>
            <div class="page-break-after-always"></div>
            <div class="page-break-before-always"></div>
            @foreach ($details as $family => $familyData)
                <h2>Famille: {!! $family !!}</h2>
                @php
                    $domains = $familyData->groupBy('domain');
                @endphp
                @foreach ($domains as $domain => $domainData)
                    @php
                        $domain = json_decode($domain);
                    @endphp
                    <h3>Domaine: {{ $domain->name }}</h3>
                    @php
                        $processes = $domainData->groupBy('process');
                    @endphp
                    @foreach ($processes as $process => $processData)
                        @php
                            $process = json_decode($process);
                        @endphp
                        <h4>Processus: {{ $process->name }}</h4>
                        @foreach ($processData as $controlPoint => $item)
                            @php
                                if (in_array($item->score, [2, 3, 4]) && !$item->major_fact) {
                                    $captionClass = 'is-anomaly';
                                } elseif ($item->major_fact) {
                                    $captionClass = 'is-danger';
                                } else {
                                    $captionClass = 'is-success';
                                }
                            @endphp
                            <div class="table-container">
                                <table>
                                    <caption class="{{ $captionClass }}">{{ $item->controlPoint->name }}</caption>
                                    <tbody>
                                        <tr>
                                            <th class="margin-cell"></th>
                                            <th>Notation</th>
                                            <td>{{ $item->appreciation }}</td>
                                            <th class="margin-cell"></th>
                                        </tr>
                                        <tr>
                                            <th class="margin-cell"></th>
                                            <th>Fait majeur</th>
                                            <td class="{{ $item->major_fact ? 'text-danger' : null }}">
                                                {{ $item->major_fact ? 'Oui' : 'Non' }}
                                            </td>
                                            <th class="margin-cell"></th>
                                        </tr>
                                        <tr>
                                            <th class="margin-cell"></th>
                                            <th>Constat</th>
                                            <td>{{ $item->report }}</td>
                                            <th class="margin-cell"></th>
                                        </tr>
                                        @if ($item->score != 1)
                                            <tr>
                                                <th class="margin-cell"></th>
                                                <th>Plan de redressement</th>
                                                <td>{{ $item->recovery_plan }}</td>
                                                <th class="margin-cell"></th>
                                            </tr>
                                        @endif
                                        @if ($item->metadata)
                                            <tr>
                                                <td colspan="4" class="text-center bg-gray">
                                                    <b>Constats liés à l'échantillonage</b>
                                                </td>
                                            </tr>
                                            @foreach ($item->metadata as $metadata)
                                                @php
                                                    $currentIndex = 1;
                                                @endphp
                                                @foreach ($metadata as $parsed)
                                                    @php
                                                        $parsed = json_decode(json_encode($parsed), true);
                                                        $keys = array_keys($parsed);
                                                        $count = count($metadata);
                                                    @endphp
                                                    <tr
                                                        class="metadata-row {{ $currentIndex == $count ? 'border-bottom' : null }}">
                                                        <th class="margin-cell"></th>
                                                        <th>
                                                            {{ $parsed[$keys[1]] }}
                                                        </th>
                                                        <td>
                                                            {{ $parsed[$keys[0]] }}
                                                        </td>
                                                        <th class="margin-cell"></th>
                                                    </tr>
                                                    @php
                                                        $currentIndex += 1;
                                                    @endphp
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @foreach ($item->media as $file)
                                @if (in_array($file->extension, ['jpg', 'jpeg', 'png', 'svg']))
                                    <img src="{{ $file->link }}" alt="{{ $file->original_name }}" class="media">
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
                {{-- @php
                    $familyCurrentIndex += 1;
                @endphp --}}
                <div class="page-break-after-always"></div>
            @endforeach
        </div>
    </main>
</body>

</html>
