<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des DRE</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Nombre d'agences</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dres as $dre)
                <tr>
                    <td>{{ $dre->code }}</td>
                    <td>{{ $dre->name }}</td>
                    <td>{{ $dre->agencies_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
