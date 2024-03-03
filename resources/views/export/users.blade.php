<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des utilisateurs</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom d'utilisateur</th>
                <th>Genre</th>
                <th>Nom complet</th>
                <th>Adresse e-mail</th>
                <th>N° de téléphone</th>
                <th>DRE</th>
                <th>Rôle</th>
                <th>Actif</th>
                @if (hasRole(['root', 'admin']))
                    <th>Date de création</th>
                    <th>Dernière connexion</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->registration_number ?: '-' }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->gender_str }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?: '-' }}</td>
                    <td>{{ $user->dres_str }}</td>
                    <td>{{ strtoupper($user->code) . ' - ' . $user->role }}</td>
                    <td>{{ boolval($user->is_active) ? 'Oui' : 'Non' }}</td>
                    @if (hasRole(['root', 'admin']))
                        <td>{{ $user->created_at }}</td>
                        <td>
                            {{ $user->last_activity ? \Carbon\Carbon::parse($user->last_activity)->format('d-m-Y H:i:s') : '-' }}
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
