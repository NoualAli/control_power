<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $family->name }} - Domaines</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nombre des processus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($domains as $domain)
                <tr>
                    <td>{{ ucfirst(strtolower($domain->name)) }}</td>
                    <td>{{ $domain->processes_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
