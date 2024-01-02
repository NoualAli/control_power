<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des points de contrôle</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Familles</th>
                <th>Domaines</th>
                <th>Processus</th>
                <th>Nom</th>
                <th>Fait majeur</th>
                <th>Notations</th>
                <th>Metadata</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($controlPoints as $controlPoint)
                <tr>
                    <td>{{ ucfirst(strtolower($controlPoint->family->name)) }}</td>
                    <td>{{ ucfirst(strtolower($controlPoint->domain->name)) }}</td>
                    <td>{{ ucfirst(strtolower($controlPoint->process->name)) }}</td>
                    <td>{{ ucfirst(strtolower($controlPoint->name)) }}</td>
                    <td>{{ $controlPoint->major_fact_str }}</td>
                    <td>{{ implode(',', $controlPoint->scores_arr) }}</td>
                    @php
                        $fields = $controlPoint->fields ? $controlPoint->fields->pluck('label')->join(', ') : null;
                    @endphp
                    <td>{{ $fields ? $fields : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
