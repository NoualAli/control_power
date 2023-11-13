<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Processus du domaine {{ $domain->id }}</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Familles</th>
                <th>Domaines</th>
                <th>Nom</th>
                <th>Nombre des points de contrôle</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($processes as $process)
                <tr>
                    <td>{{ ucfirst(strtolower($process->family->name)) }}</td>
                    <td>{{ ucfirst(strtolower($process->domain->name)) }}</td>
                    <td>{{ ucfirst(strtolower($process->name)) }}</td>
                    <td>{{ $process->control_points_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
