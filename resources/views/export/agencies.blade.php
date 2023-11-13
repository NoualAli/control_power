<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des agences</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>DRE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agencies as $agency)
                <tr>
                    <td>{{ $agency->code }}</td>
                    <td>{{ $agency->name }}</td>
                    <td>{{ $agency->category->name }}</td>
                    <td>{{ $agency->dre->full_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
