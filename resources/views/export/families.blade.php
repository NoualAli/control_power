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
                <th>Ordre d'affichage</th>
                <th>Nom</th>
                <th>Nombre des domaines</th>
                <th>Nombre des processus</th>
                <th>Nombre des points de contrôle</th>
                <th>Nombre des campagnes de contrôle</th>
                <th>Nombre des missions</th>
                <th>Nombre des anomalies</th>
                <th>Créateur</th>
                <th>Date de création</th>
                <th>Modifier par</th>
                <th>Date de modification</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($families as $family)
                <tr>
                    <td>{{ $family->display_priority }}</td>
                    <td>{{ ucfirst(strtolower($family->name)) }}</td>
                    <td>{{ $family->domains_count }}</td>
                    <td>{{ $family->processes_count }}</td>
                    <td>{{ $family->control_points_count }}</td>
                    <td>{{ $family->control_campaigns_count }}</td>
                    <td>{{ $family->missions_count }}</td>
                    <td>{{ $family->anomalies_count }}</td>
                    <td>{{ $family->creator_full_name ?: '-' }}</td>
                    <td>
                        {{ $family->created_at ? Carbon\Carbon::parse($family->created_at)->format('d-m-Y H:i') : '-' }}
                    </td>
                    <td>{{ $family->updater_full_name ?: '-' }}</td>
                    <td>
                        {{ $family->updated_at ? Carbon\Carbon::parse($family->updated_at)->format('d-m-Y H:i') : '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
