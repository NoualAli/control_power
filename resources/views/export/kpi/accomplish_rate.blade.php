<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AccomplishRate</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th align="center">#</th>
                <th align="left">Contrôleur</th>
                <th align="center">Missions assignées</th>
                <th align="center">
                    Missions <br> (Agence AP)
                </th>
                <th align="center">
                    Missions <br> (Agence A)
                </th>
                <th align="center">
                    Missions <br> (Agence B)
                </th>
                <th align="center">
                    Missions <br> (Agence C)
                </th>
                <th align="center">Missions validées</th>
                <th align="center">Taux %</th>
                <th align="center">État</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($data as $item)
                <tr>
                    <td align="center">{{ $i }}</td>
                    <td align="left">{{ $item->controller_full_name }}</td>
                    <td align="center">{{ $item->total_missions_assigned }}</td>
                    <td align="center">{{ $item->total_missions_validated_ag_ap }} /
                        {{ $item->total_missions_assigned_ag_ap }}</td>
                    <td align="center">{{ $item->total_missions_validated_ag_a }} /
                        {{ $item->total_missions_assigned_ag_a }}</td>
                    <td align="center">{{ $item->total_missions_validated_ag_b }} /
                        {{ $item->total_missions_assigned_ag_b }}</td>
                    <td align="center">{{ $item->total_missions_validated_ag_c }} /
                        {{ $item->total_missions_assigned_ag_c }}</td>
                    <td align="center">{{ $item->total_missions_validated }}</td>
                    <td align="center">{{ $item->accomplish_rate }}%</td>
                    <td align="center">
                        @if ($item->accomplish_rate > 75)
                            Top
                        @elseif($item->accomplish_rate == 75)
                            Atteint
                        @elseif($item->accomplish_rate > 50 && $item->accomplish_rate < 75)
                            Proche
                        @elseif($item->accomplish_rate < 50)
                            Redynamiser
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @php
                    $i += 1;
                @endphp
            @endforeach
        </tbody>
    </table>
</body>

</html>
