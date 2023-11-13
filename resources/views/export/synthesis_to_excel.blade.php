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

        {{-- Liste des DRE --}}
        <tr>
            <th>Familles</th>
            <th>Domaines</th>
            <th>Processus</th>
            <th>Points de contrôle</th>
            @foreach ($dres as $dre)
                <th colspan="{{ $dre->total_agencies }}">{{ $dre->dre }}</th>
                {{-- <th colspan="1">Total</th> --}}
            @endforeach
        </tr>

        {{-- Liste des agences pour chaque DRE --}}
        <tr>
            <td colspan="4"></td>
            @foreach ($dres as $dre)
                @foreach ($dre->agencies as $agency)
                    <td>{{ $agency->agency }}</td>
                @endforeach
                {{-- <td colspan="1"></td> --}}
            @endforeach
        </tr>
        {{-- Liste des points de contrôle --}}
        @foreach ($controlPoints as $controlPoint)
            <tr>
                <td>{{ $controlPoint->family }}</td>
                <td>{{ $controlPoint->domain }}</td>
                <td>{{ $controlPoint->process }}</td>
                <td>{{ $controlPoint->control_point }}</td>

                {{-- Liste des notations pour chaque points de contrôle dans chaque agence --}}
                @foreach ($dres as $dre)
                    @foreach ($dre->agencies as $agency)
                        @php
                            $data = $agency->data->filter(fn($item) => $item->family == $controlPoint->family && $item->domain == $controlPoint->domain && $item->process == $controlPoint->process && $item->control_point == $controlPoint->control_point)->first();
                        @endphp
                        @if ($data && $data->agency == $agency->agency)
                            <td>{{ $data->score }}</td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                    {{-- <td>TOTAL</td> --}}
                @endforeach
            </tr>
        @endforeach
    </table>
</body>

</html>
