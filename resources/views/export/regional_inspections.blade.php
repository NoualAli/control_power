<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des IR</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Nombre de DRE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($regional_inspections as $regional_inspection)
                <tr>
                    <td>{{ $regional_inspection->code }}</td>
                    <td>{{ $regional_inspection->name }}</td>
                    <td>{{ $regional_inspection->dres_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
