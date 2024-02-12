<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                    @if (hasRole('cdc') && hasDre($dre->dre))
                        <th colspan="{{ $dre->total_agencies + 1 }}">{{ $dre->dre }}</th>
                    @elseif(hasRole('cdc') && !hasDre($dre->dre))
                    @else
                        <th colspan="{{ $dre->total_agencies + 1 }}">{{ $dre->dre }}</th>
                    @endif
                @endforeach
            </tr>

            {{-- Liste des agences pour chaque DRE --}}
            <tr>
                <td colspan="4"></td>
                @foreach ($dres as $dre)
                    @if (hasRole('cdc') && hasDre($dre->dre))
                        @foreach ($dre->agencies as $agency)
                            <td>{{ $agency->agency }}</td>
                        @endforeach
                        <td colspan="1">Moyenne</td>
                    @elseif (hasRole('cdc') && !hasDre($dre->dre))
                    @else
                        @foreach ($dre->agencies as $agency)
                            <td>{{ $agency->agency }}</td>
                        @endforeach
                        <td colspan="1">Moyenne</td>
                    @endif
                @endforeach
                @if (!hasRole('cdc'))
                    <td>Moyenne du point de contrôle</td>
                @endif
            </tr>
        </thead>

        <tbody>
            @php
                $dreAvgs = [];
                $totalDreControlPoints = [];
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
                        @if (hasRole('cdc') && hasDre($dre->dre))
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
                                        if (!$data->is_disabled) {
                                            $controlPointScore += $data->score;
                                            $scoreSum += $data->score;
                                            $totalScored += 1;
                                            $totalDreControlPoints[$dre->dre] = isset($totalDreControlPoints[$dre->dre]) ? $totalDreControlPoints[$dre->dre] + 1 : 1;
                                        }
                                    @endphp
                                    <td>{{ $data->is_disabled ? '-' : $data->score }}</td>
                                @else
                                    <td></td>
                                @endif
                            @endforeach
                            @php
                                if (hasRole('cdc') && hasDre($dre->dre)) {
                                    $avgScore = $scoreSum > 0 ? sprintf('%.2f', $scoreSum / $totalAgencies) : $scoreSum;
                                    $dreAvgs[$dre->dre] = isset($dreAvgs[$dre->dre]) ? $dreAvgs[$dre->dre] + $avgScore : $avgScore;
                                } elseif (hasRole('cdc') && !hasDre($dre->dre)) {
                                    $avgScore = 0;
                                    $dreAvgs[$dre->dre] = 0;
                                } else {
                                    $avgScore = $scoreSum > 0 ? sprintf('%.2f', $scoreSum / $totalAgencies) : $scoreSum;
                                    $dreAvgs[$dre->dre] = isset($dreAvgs[$dre->dre]) ? $dreAvgs[$dre->dre] + $avgScore : $avgScore;
                                }
                            @endphp
                            <td>{{ $avgScore }}</td>
                        @elseif (hasRole('cdc') && !hasDre($dre->dre))
                        @else
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
                                        if (!$data->is_disabled) {
                                            $controlPointScore += $data->score;
                                            $scoreSum += $data->score;
                                            $totalScored += 1;
                                            $totalDreControlPoints[$dre->dre] = isset($totalDreControlPoints[$dre->dre]) ? $totalDreControlPoints[$dre->dre] + 1 : 1;
                                        }
                                    @endphp
                                    <td>{{ $data->is_disabled ? '-' : $data->score }}</td>
                                @else
                                    <td></td>
                                @endif
                            @endforeach
                            @php
                                $avgScore = $scoreSum > 0 ? sprintf('%.2f', $scoreSum / $totalAgencies) : $scoreSum;
                                $dreAvgs[$dre->dre] = isset($dreAvgs[$dre->dre]) ? $dreAvgs[$dre->dre] + $avgScore : $avgScore;
                            @endphp
                            <td>{{ $avgScore }}</td>
                        @endif
                    @endforeach
                    @php
                        $controlPointAvgScore = $controlPointScore > 0 ? sprintf('%.2f', $controlPointScore / $totalScored) : $totalScored;
                    @endphp
                    @if (!hasRole('cdc'))
                        <td>
                            {{ $controlPointAvgScore }}
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                @foreach ($dres as $dre)
                    @if (hasRole('cdc') && hasDre($dre->dre))
                        @php
                            $avg = isset($dreAvgs[$dre->dre]) && $dreAvgs[$dre->dre] > 0 ? sprintf('%.2f', $dreAvgs[$dre->dre] / $totalDreControlPoints[$dre->dre]) : $dreAvgs[$dre->dre];
                        @endphp
                        <td colspan="{{ $dre->agencies->count() }}"></td>
                        <td>{{ $avg }}</td>
                    @elseif(hasRole('cdc') && !hasDre($dre->dre))
                    @else
                        @php
                            $avg = isset($dreAvgs[$dre->dre]) && $dreAvgs[$dre->dre] > 0 ? sprintf('%.2f', $dreAvgs[$dre->dre] / $totalDreControlPoints[$dre->dre]) : $dreAvgs[$dre->dre];
                        @endphp
                        <td colspan="{{ $dre->agencies->count() }}"></td>
                        <td>{{ $avg }}</td>
                    @endif
                @endforeach
                @php
                    if (hasRole('cdc')) {
                        $avg = 0;
                    } else {
                        $avg = array_sum(array_values($dreAvgs)) > 0 ? sprintf('%.2f', array_sum(array_values($dreAvgs)) / ($dres->count() * array_sum(array_values($totalDreControlPoints)))) : array_sum(array_values($dreAvgs));
                    }
                @endphp
                @if (!hasRole('cdc'))
                    <td>{{ $avg }}</td>
                @endif
            </tr>
        </tfoot>
    </table>
</body>

</html>
