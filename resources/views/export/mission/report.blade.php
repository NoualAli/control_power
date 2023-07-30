@extends('export.layout')
@section('report')
    {{-- @include('export.mission.main-page') --}}
    {{-- @include('export.mission.header') --}}
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
                        <td>{{ $mission->agency_controllers_str }}</td>
                    </tr>
                    <tr>
                        <td>Validé par</td>
                        <td>{{ $mission?->cdc_report?->creator?->full_name }}</td>
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
                                                {{-- {!! $item->major_fact ? '❌ Oui' : '✔️ Non' !!} --}}
                                                {{ $item->major_fact ? 'Oui' : 'Non' }}
                                            </td>
                                            <th class="margin-cell"></th>
                                        </tr>
                                        <tr>
                                            <th class="margin-cell"></th>
                                            <th>Constat</th>
                                            <td>{{ $item->report ?? '-' }}</td>
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
                <div class="page-break-after-always"></div>
            @endforeach
            <h2>Rapport du chef de département</h2>
            {!! $mission->dre_report->content !!}
        </div>
    </main>
    {{-- @include('export.mission.footer') --}}
@endsection
