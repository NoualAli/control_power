<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <title>Synthèse {{ $controlCampaign->reference }}</title>
</head>

<body>
    <table>

        <thead>
            {{-- Liste des DRE --}}
            <tr>
                <th>Familles</th>
                <th>Domaines</th>
                <th>Processus</th>
                <th>Points de contrôle</th>
                @foreach ($dres as $dre)
                    <th colspan="{{ $dre->total_agencies * 3 + 1 }}">{{ $dre->dre }}</th>
                @endforeach
            </tr>

            {{-- Liste des agences pour chaque DRE --}}
            <tr>
                <td colspan="4"></td>
                @foreach ($dres as $dre)
                    @foreach ($dre->agencies as $agency)
                        <td colspan="3">{{ $agency->agency }}</td>
                    @endforeach
                    <td colspan="1">Moyenne</td>
                @endforeach
                <td>Moyenne du point de contrôle</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                @foreach ($dres as $dre)
                    @foreach ($dre->agencies as $agency)
                        <td>Notation</td>
                        <td>Constat</td>
                        <td>Plan de redressement</td>
                    @endforeach
                    <td colspan="1"></td>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @php
                $dreAvgs = [];
            @endphp
            {{-- Liste des points de contrôle --}}
            @foreach ($controlPoints as $controlPoint)
                <tr>
                    @php
                        $controlPointScore = 0;
                        $totalScored = 0;
                    @endphp
                    <td>{{ $controlPoint->family }}</td>
                    <td>{{ $controlPoint->domain }}</td>
                    <td>{{ $controlPoint->process }}</td>
                    <td>{{ $controlPoint->control_point }}</td>

                    {{-- Liste des notations pour chaque points de contrôle dans chaque agence --}}
                    @foreach ($dres as $dre)
                        @php
                            $scoreSum = 0;
                            $totalAnomalies = 0;
                            $totalAgencies = $dre->agencies->count();
                        @endphp
                        @foreach ($dre->agencies as $agency)
                            @php
                                $data = $agency->data->filter(fn($item) => $item->family == $controlPoint->family && $item->domain == $controlPoint->domain && $item->process == $controlPoint->process && $item->control_point == $controlPoint->control_point)->first();
                            @endphp
                            @if ($data && $data->agency == $agency->agency)
                                @php
                                    $scoreSum += $data->score;
                                    $controlPointScore += $data->score;
                                    $totalScored += 1;
                                @endphp
                                <td>{{ $data->score }}</td>
                                <td>{{ sanitizeString($data?->report) }}</td>
                                <td>{{ sanitizeString($data?->recovery_plan) }}</td>
                            @else
                                <td></td>
                            @endif
                        @endforeach
                        @php
                            $avgScore = $scoreSum > 0 ? sprintf('%.2f', $scoreSum / $totalAgencies) : $scoreSum;
                            $dreAvgs[$dre->dre] = isset($dreAvgs[$dre->dre]) ? $dreAvgs[$dre->dre] + $avgScore : $avgScore;
                        @endphp
                        <td>{{ $avgScore }}</td>
                    @endforeach
                    @php
                        $controlPointAvgScore = $controlPointScore >= 0 ? sprintf('%.2f', $controlPointScore / $totalScored) : $totalScored;
                    @endphp
                    <td>
                        {{ $controlPointAvgScore }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                @foreach ($dres as $dre)
                    @php
                        $avg = $dreAvgs[$dre->dre] > 0 ? sprintf('%.2f', $dreAvgs[$dre->dre] / $controlPoints->count()) : $dreAvgs[$dre->dre];
                    @endphp
                    <td colspan="{{ $dre->agencies->count() * 3 }}"></td>
                    <td>{{ $avg }}</td>
                @endforeach
                @php
                    $avg = array_sum(array_values($dreAvgs)) > 0 ? sprintf('%.2f', array_sum(array_values($dreAvgs)) / ($dres->count() * $controlPoints->count())) : array_sum(array_values($dreAvgs));
                @endphp
                <td>{{ $avg }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
