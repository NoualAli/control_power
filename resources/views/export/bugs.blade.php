<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des bugs</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Référence</th>
                <th>Initiateur</th>
                <th>Type</th>
                <th>Priorité</th>
                <th>Signalé le</th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bugs as $bug)
                <tr>
                    <td>{{ $bug->reference }}</td>
                    <td>{{ $bug->creator->full_name }}</td>
                    <td>{{ $bug->type }}</td>
                    <td>{{ $bug->priority_str }}</td>
                    <td>{{ $bug->created_at }}</td>
                    <td>{{ $bug->is_fixed ? 'Fixé' : 'En attente' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
