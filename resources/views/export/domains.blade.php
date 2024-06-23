<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des domaines</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Ordre d'affichage</th>
                <th>Famille</th>
                <th>Domaine</th>
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
            @foreach ($domains as $domain)
                <tr>
                    <td>{{ $domain->display_priority }}</td>
                    <td>{{ ucfirst(strtolower($domain->family_name)) }}</td>
                    <td>{{ ucfirst(strtolower($domain->name)) }}</td>
                    <td>{{ $domain->processes_count }}</td>
                    <td>{{ $domain->control_points_count }}</td>
                    <td>{{ $domain->control_campaigns_count }}</td>
                    <td>{{ $domain->missions_count }}</td>
                    <td>{{ $domain->anomalies_count }}</td>
                    <td>{{ $domain->creator_full_name ?: '-' }}</td>
                    <td>
                        {{ $domain->created_at ? Carbon\Carbon::parse($domain->created_at)->format('d-m-Y H:i') : '-' }}
                    </td>
                    <td>{{ $domain->updater_full_name ?: '-' }}</td>
                    <td>
                        {{ $domain->updated_at ? Carbon\Carbon::parse($domain->updated_at)->format('d-m-Y H:i') : '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
