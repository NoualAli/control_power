<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des familles</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nombre des domaines</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($families as $family)
                <tr>
                    <td>{{ ucfirst(strtolower($family->name)) }}</td>
                    <td>{{ $family->domains_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
