@php
    $appCss = env('APP_URL') . '/special_styles/report.css';
    $qlCss = env('APP_URL') . '/special_styles/ql.css';
    $appBrand = public_path('app\images\brand.svg');
    $bnaLogo = public_path('app\images\bna_logo.svg');
    $coverPageImg = public_path('app\images\report_cover_page.png');
    $appBrandMonochrome = public_path('app\images\brand_monochrome.png');
    // $appBrand = '';
    // $bnaLogo = '';
    // $coverPageImg = '';
    // $appBrandMonochrome = '';
    // dd('test');
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
    <link rel="stylesheet" href="{{ $qlCss }}">
    <title>Rapport de la mission {{ $mission->reference }}</title>
</head>

<body>
    <section>
        <div class="page no-padding">
            <main class="page-body no-padding">
                <img src="{{ $coverPageImg }}" class="cover-page-img" />
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
                </div>

                <div class="validated_by">
                    <b>Validé par</b> {{ $mission->cdc_report?->creator->full_name }}
                </div>

                <img src="{{ $appBrandMonochrome }}" alt="PowerControlMonochrome" class="power-control-monochrome">
            </main>
        </div>
    </section>

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
        </div>
    </footer>
    <main class="page-body report-area">
        <div class="container">
            <h1>Introduction</h1>
            <br>
            <div class="campaign-introduction">
                {!! $campaign->description !!}
            </div>
            <p>
                Ci-après les familles, domaines et processus à contrôler:
            </p>
            <br>

            <ul class="table-of-content">
                @foreach ($details as $family => $familyData)
                    <li><a href="#{{ $family }}">Famille: {!! ucfirst(strtolower($family)) !!}</a></li>
                    <ul>
                        @php
                            $domains = $familyData->groupBy('domain');
                        @endphp
                        @foreach ($domains as $domain => $domainData)
                            @php
                                $domain = json_decode($domain);
                            @endphp
                            <li><a href="#{{ $family . '-' . $domain->id }}">Domaine: {{ $domain->name }}</a></li>
                            <ul>
                                @php
                                    $processes = $domainData->groupBy('process');
                                @endphp
                                @foreach ($processes as $process => $processData)
                                    @php
                                        $process = json_decode($process);
                                    @endphp
                                    <li><a href="#{{ $family . '-' . $domain->id . '-' . $process->id }}">Processus:
                                            {{ $process->name }}</a></li>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>
                    <br>
                @endforeach
            </ul>

            <div class="page-break-after-always"></div>

            <h2>Fiche technique</h2>
            <br>
            <div class="table-container">
                <table>
                    <tr>
                        <td>Référence de la campagne</td>
                        <td>{{ $campaign->reference }}</td>
                    </tr>
                    <tr>
                        <td>Département contrôle</td>
                        <td>{{ $mission->dre->name }} - {{ $mission->dre->code }}</td>
                    </tr>
                    <tr>
                        <td>Agence contrôler</td>
                        <td>{{ $mission->agency->name }} - {{ $mission->agency->code }}</td>
                    </tr>
                    <tr>
                        <td>Référence du rapport</td>
                        <td>{{ $mission->reference }}</td>
                    </tr>
                    <tr>
                        <td>Date début</td>
                        <td>{{ $mission->start }}</td>
                    </tr>
                    <tr>
                        <td>Date fin</td>
                        <td>{{ $mission->end }}</td>
                    </tr>
                    <tr>
                        <td>Contrôle sur place</td>
                        <td>{{ $mission->dre_controllers_str }}</td>
                    </tr>
                    <tr>
                        <td>Validé par</td>
                        <td>{{ $mission->cdc_report?->creator->full_name }}</td>
                    </tr>
                </table>
            </div>
            <br>
            <h2>Chiffres clés</h2>
            <br>

            <div class="table-container">
                <table>
                    <tr>
                        <td>Note moyenne du rapport</td>
                        <td>{{ $stats['avg_score'] }}</td>
                    </tr>
                    <tr>
                        <td>Nombre de processus contrôlés</td>
                        <td>{{ $stats['total_processes'] }} processus</td>
                    </tr>
                    <tr>
                        <td>Nombres des anomalies</td>
                        <td>{{ $stats['total_anomalies'] }}
                            {{ $stats['total_anomalies'] > 1 ? 'anomalies' : 'anomalie' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Nombres des faits majeurs</td>
                        <td>
                            {{ $stats['total_major_facts'] }}
                            {{ $stats['total_major_facts'] > 1 ? 'faits majeurs' : 'fait majeur' }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="page-break-before-always"></div>

            @foreach ($details as $family => $familyData)
                <h2 id="{{ $family }}">Famille: {!! $family !!}</h2>
                @php
                    $domains = $familyData->groupBy('domain');
                @endphp
                @foreach ($domains as $domain => $domainData)
                    @php
                        $domain = json_decode($domain);
                    @endphp
                    <h3 id="{{ $family . '-' . $domain->id }}">Domaine: {{ $domain->name }}</h3>
                    @php
                        $processes = $domainData->groupBy('process');
                    @endphp
                    @foreach ($processes as $process => $processData)
                        @php
                            $process = json_decode($process);
                        @endphp
                        <h4 id="{{ $family . '-' . $domain->id . '-' . $process->id }}">Processus:
                            {{ $process->name }}
                        </h4>
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
                                            <td
                                                class="{{ $item->major_fact ? 'text-danger' : null }} {{ $item->major_fact ? 'has-major_fact' : 'no-major_fact' }}">
                                                {{ $item->major_fact ? 'Oui' : 'Non' }}
                                            </td>
                                            <th class="margin-cell"></th>
                                        </tr>
                                        <tr>
                                            <th class="margin-cell"></th>
                                            <th>Constat</th>
                                            <td>{!! $item->report ?? '-' !!}</td>
                                            <th class="margin-cell"></th>
                                        </tr>
                                        @if ($item->score != 1)
                                            <tr>
                                                <th class="margin-cell"></th>
                                                <th>Plan de redressement</th>
                                                <td>{!! $item->recovery_plan !!}</td>
                                                <th class="margin-cell"></th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="page-break-after-always"></div>
                                <table>
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
                                </table>
                            </div>
                            <div class="container">
                                @foreach ($item->media as $file)
                                    @if (in_array($file->extension, ['jpg', 'jpeg', 'png', 'svg']))
                                        <img src="{{ $file->link }}" alt="{{ $file->original_name }}"
                                            class="img">
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    @endforeach
                @endforeach
                <div class="page-break-after-always"></div>
            @endforeach

            <h2>Rapport du chef de département</h2>
            {!! $mission->cdc_report->content !!}
        </div>
    </main>
</body>

</html>
