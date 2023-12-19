<!DOCTYPE html>
<html lang="en">
@php
    // dd($missions);
@endphp

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
                <th>Référence</th>
                <th>Campagne de contrôle</th>
                <th>DRE</th>
                <th>Agence</th>
                <th>Créateur</th>
                <th>Validateur (CI)</th>
                <th>Validateur (CDC)</th>
                <th>Temps de validation (CI - CDC)</th>
                <th>Validateur (CC)</th>
                <th>Validateur (CDCR)</th>
                <th>Temps de validation (CDC - CDCR)</th>
                <th>Validateur (DCP)</th>
                <th>Temps de validation (CDCR - DCP)</th>
                <th>Validateur (DA)</th>
                <th>Temps de validation (DCP - DA)</th>
                <th>Moyenne</th>
                <th>Total points de contrôle</th>
                <th>Total points de contrôle (contrôlés)</th>
                <th>Taux de progressions</th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($missions as $mission)
                <tr>
                    <td>{{ $mission?->reference }}</td>
                    <td>{{ $mission?->campaign }}</td>
                    <td>{{ $mission?->dre }}</td>
                    <td>{{ $mission?->agency }}</td>
                    <td>{{ $mission?->creator_full_name }}</td>
                    <td>{{ $mission?->ci_validator_full_name }}</td>
                    <td>{{ $mission?->cdc_validator_full_name }}</td>
                    @if (!empty($mission?->time_left_ci_cdc))
                        <td>
                            {{ $mission?->time_left_ci_cdc > 1 ? $mission?->time_left_ci_cdc . ' jours' : $mission?->time_left_ci_cdc . ' jour' }}
                        </td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{ $mission?->cc_validator_full_name }}</td>
                    <td>{{ $mission?->cdcr_validator_full_name }}</td>
                    @if (!empty($mission?->time_left_cdc_cdcr))
                        <td>
                            {{ $mission?->time_left_cdc_cdcr > 1 ? $mission?->time_left_cdc_cdcr . ' jours' : $mission?->time_left_cdc_cdcr . ' jour' }}
                        </td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{ $mission?->dcp_validator_full_name }}</td>
                    @if (!empty($mission?->time_left_cdcr_dcp))
                        <td>
                            {{ $mission?->time_left_cdcr_dcp > 1 ? $mission?->time_left_cdcr_dcp . ' jours' : $mission?->time_left_cdcr_dcp . ' jour' }}
                        </td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{ $mission?->da_validator_full_name }}</td>
                    @if (!empty($mission?->time_left_dcp_da))
                        <td>
                            {{ $mission?->time_left_dcp_da > 1 ? $mission?->time_left_dcp_da . ' jours' : $mission?->time_left_dcp_da . ' jour' }}
                        </td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{ $mission?->avg_score }}</td>
                    <td>{{ $mission?->total_md }}</td>
                    <td>{{ $mission?->total_controlled_md }}</td>
                    <td>{{ $mission?->progress_rate }}%</td>
                    <td>{{ translateMissionState($mission?->current_state) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
