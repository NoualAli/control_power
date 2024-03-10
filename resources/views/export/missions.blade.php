<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des missions</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Campagne de contrôle</th>
                <th>Référence</th>
                <th>DRE</th>
                <th>Agence</th>
                <th>Créateur</th>
                <th>Chef de mission</th>
                <th>Contrôleur(s)</th>
                <th>CDC</th>
                @if (hasRole(['cdrcp', 'dcp', 'cdcr', 'cc', 'root', 'admin']))
                    <th>Temps de validation (CI - CDC)</th>
                @endif
                <th>Chef de secteur</th>
                <th>CDCR</th>
                @if (hasRole(['cdrcp', 'dcp', 'cdcr', 'cc', 'root', 'admin']))
                    <th>Temps de validation (CDC - CDCR)</th>
                @endif
                <th>DCP</th>
                @if (hasRole(['cdrcp', 'dcp', 'cdcr', 'cc', 'root', 'admin']))
                    <th>Temps de validation (CDCR - DCP)</th>
                @endif
                @if (hasRole(['der', 'root', 'admin']))
                    <th>Contrôleur DER</th>
                @endif
                <th>Moyenne</th>
                <th>Total points de contrôle</th>
                <th>Total points contrôlés</th>
                <th>Taux de progressions</th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            @if ($missions)
                @foreach ($missions as $mission)
                    <tr>
                        <td>{{ $mission?->campaign }}</td>
                        <td>{{ $mission?->reference }}</td>
                        <td>{{ $mission?->dre }}</td>
                        <td>{{ $mission?->agency }}</td>
                        <td>{{ normalizeFullName(getUserFullNameWithRole($mission?->created_by_id)) }}</td>
                        <td>
                            {{ $mission?->assigned_to_ci_id ? normalizeFullName(getUserFullNameWithRole($mission?->assigned_to_ci_id)) : '-' }}
                        </td>
                        <td>
                            {{ $mission->assistants_id ? implode(', ', array_map(fn($item) => normalizeFullName(getUserFullNameWithRole(intval($item))), explode(', ', $mission->assistants_id))) : '-' }}
                        </td>
                        <td>{{ !empty($mission?->cdc_validator_full_name) ? normalizeFullName($mission?->cdc_validator_full_name) : '-' }}
                        </td>
                        @if (hasRole(['cdrcp', 'dcp', 'cdcr', 'cc', 'root', 'admin']))
                            @if (!empty($mission?->time_left_ci_cdc))
                                <td>
                                    {{ $mission?->time_left_ci_cdc > 1 ? $mission?->time_left_ci_cdc . ' jours' : $mission?->time_left_ci_cdc . ' jour' }}
                                </td>
                            @else
                                <td>-</td>
                            @endif
                        @endif
                        <td>
                            {{ !empty($mission?->assigned_to_cc_id) ? normalizeFullName(getUserFullNameWithRole($mission?->assigned_to_cc_id)) : '-' }}
                        </td>
                        <td>
                            {{ !empty($mission?->cdcr_validator_full_name) ? normalizeFullName($mission?->cdcr_validator_full_name) : '-' }}
                        </td>
                        @if (hasRole(['cdrcp', 'dcp', 'cdcr', 'cc', 'root', 'admin']))
                            @if (!empty($mission?->time_left_cdc_cdcr))
                                <td>
                                    {{ $mission?->time_left_cdc_cdcr > 1 ? $mission?->time_left_cdc_cdcr . ' jours' : $mission?->time_left_cdc_cdcr . ' jour' }}
                                </td>
                            @else
                                <td>-</td>
                            @endif
                        @endif
                        <td>
                            {{ !empty($mission?->dcp_validator_full_name) ? normalizeFullName($mission?->dcp_validator_full_name) : '-' }}
                        </td>
                        @if (hasRole(['cdrcp', 'dcp', 'cdcr', 'cc', 'root', 'admin']))
                            @if (!empty($mission?->time_left_cdcr_dcp))
                                <td>
                                    {{ $mission?->time_left_cdcr_dcp > 1 ? $mission?->time_left_cdcr_dcp . ' jours' : $mission?->time_left_cdcr_dcp . ' jour' }}
                                </td>
                            @else
                                <td>-</td>
                            @endif
                        @endif
                        @if (hasRole(['der', 'root', 'admin']))
                            <td>
                                {{ $mission?->assigned_to_cder_id ? normalizeFullName(getUserFullNameWithRole($mission?->assigned_to_cder_id)) : '-' }}
                            </td>
                        @endif
                        <td>{{ $mission?->avg_score }}</td>
                        <td>{{ $mission?->total_md }}</td>
                        <td>{{ $mission?->total_controlled_md }}</td>
                        <td>{{ $mission?->progress_rate }}%</td>
                        <td>{{ translateMissionState($mission?->current_state) }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>
