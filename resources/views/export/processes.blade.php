<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des processus</title>
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
            @foreach ($processes as $process)
                <tr>
                    <td>{{ $process->display_priority }}</td>
                    <td>{{ ucfirst(strtolower($process->family_name)) }}</td>
                    <td>{{ ucfirst(strtolower($process->domain_name)) }}</td>
                    <td>{{ $process->name }}</td>
                    <td>{{ $process->control_points_count }}</td>
                    <td>{{ $process->control_campaigns_count }}</td>
                    <td>{{ $process->missions_count }}</td>
                    <td>{{ $process->anomalies_count }}</td>
                    <td>{{ $process->creator_full_name ?: '-' }}</td>
                    <td>
                        {{ $process->created_at ? Carbon\Carbon::parse($process->created_at)->format('d-m-Y H:i') : '-' }}
                    </td>
                    <td>{{ $process->updater_full_name ?: '-' }}</td>
                    <td>
                        {{ $process->updated_at ? Carbon\Carbon::parse($process->updated_at)->format('d-m-Y H:i') : '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
