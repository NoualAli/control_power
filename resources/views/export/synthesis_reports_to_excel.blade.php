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
                            $totalAgencies = 0;
                        @endphp
                        @foreach ($dre->agencies as $agency)
                            @php
                                $data = $agency->data
                                    ->filter(
                                        fn($item) => $item->family == $controlPoint->family &&
                                            $item->domain == $controlPoint->domain &&
                                            $item->process == $controlPoint->process &&
                                            $item->control_point == $controlPoint->control_point,
                                    )
                                    ->first();
                            @endphp
                            @if ($data && $data->agency == $agency->agency)
                                @php
                                    if (!$data->is_disabled) {
                                        $controlPointScore += $data->score;
                                        $scoreSum += $data->score;
                                        $totalScored += 1;
                                        $totalAgencies += 1;
                                    }
                                @endphp
                                <td>{{ $data->is_disabled ? '-' : $data->score }}</td>
                                <td>
                                    {{ !empty(sanitizeString($data?->observation)) ? sanitizeString($data?->observation) : '-' }}
                                </td>
                                <td>
                                    {{ !empty(sanitizeString($data?->recovery_plan)) ? sanitizeString($data?->recovery_plan) : '-' }}
                                </td>
                            @else
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            @endif
                        @endforeach
                        @php
                            $avgScore =
                                $scoreSum && $totalAgencies ? sprintf('%.2f', $scoreSum / $totalAgencies) : $scoreSum;
                            $dreAvgs[$dre->dre] = isset($dreAvgs[$dre->dre])
                                ? $dreAvgs[$dre->dre] + $avgScore
                                : $avgScore;
                        @endphp
                        @if ($avgScore)
                            <td>{{ $avgScore }}</td>
                        @else
                            <td>-</td>
                        @endif
                    @endforeach
                    @php
                        $controlPointAvgScore =
                            $controlPointScore && $totalScored
                                ? sprintf('%.2f', $controlPointScore / $totalScored)
                                : $totalScored;
                    @endphp
                    @if ($controlPointAvgScore)
                        <td>{{ $controlPointAvgScore }}</td>
                    @else
                        <td>-</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                @foreach ($dres as $dre)
                    @php
                        $agenciesCount = $dre->agencies->count();
                        $avg = sprintf('%.2f', $dreAvgs[$dre->dre] / $controlCampaign->total_control_points);
                        $dreAvgs[$dre->dre] = $avg;
                    @endphp
                    <td colspan="{{ $agenciesCount * 3 }}"></td>
                    @if ($avg)
                        <td>{{ $avg }}</td>
                    @else
                        <td>-</td>
                    @endif
                @endforeach
                @php
                    $totalDre = count($dreAvgs);
                    $dreAvgs = array_sum(array_values($dreAvgs));
                    $avg = $dreAvgs > 0 && $totalDre > 0 ? sprintf('%.2f', $dreAvgs / $totalDre) : $dreAvgs;
                @endphp
                @if ($avg)
                    <td>{{ $avg }}</td>
                @else
                    <td>-</td>
                @endif
            </tr>
        </tfoot>
    </table>
</body>

</html>
