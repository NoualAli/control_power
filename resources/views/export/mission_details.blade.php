<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Détails de la mission</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Référence (CDC)</th>
                <th>Référence (Mission)</th>
                <th>Famille</th>
                <th>Domaine</th>
                <th>Processus</th>
                <th>Point de contrôle</th>
                <th>Appréciation</th>
                @if (!hasRole(['ci', 'cdc', 'da']))
                    <th>Notation</th>
                @endif
                <th>Régularisation</th>
                <th>Constat</th>
                <th>Plan de redressement</th>
                <th>Fait majeur</th>
                <th>Déclencheur (FM)</th>
                <th>Date de déclenchement (FM)</th>
                <th>Etat (FM)</th>
                <th>Validateur FM (vers DCP)</th>
                @if (!hasRole(['ci', 'cdc', 'da']))
                    <th>Validateur FM (depuis DCP)</th>
                @endif
                <th>Contrôler par (CI)</th>
                <th>Date de contrôle (CI)</th>
                <th>Contrôler par (CDC)</th>
                <th>Date de contrôle (CDC)</th>
                @if (!hasRole(['ci', 'cdc', 'da']))
                    <th>Contrôler par (CC)</th>
                    <th>Date de contrôle (CC)</th>
                    <th>Contrôler par (CDCR)</th>
                    <th>Date de contrôle (CDCR)</th>
                    <th>Contrôler par (DCP)</th>
                    <th>Date de contrôle (DCP)</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->campaign }}</td>
                    <td>{{ $detail->mission }}</td>
                    <td>{{ $detail->family }}</td>
                    <td>{{ $detail->domain }}</td>
                    <td>{{ $detail->process }}</td>
                    <td>{{ $detail->control_point }}</td>
                    <td>{{ $detail->appreciation }}</td>
                    @if (!hasRole(['ci', 'cdc', 'da']))
                        <td>{{ $detail->score }}</td>
                    @endif
                    <td>{{ boolVal(intVal($detail->reg_is_regularized)) ? 'Levée' : 'En attente de traitement' }}</td>
                    @if (!empty(sanitizeString($detail->observation)))
                        <td>
                            {{ sanitizeString($detail->observation) }}
                        </td>
                    @else
                        <td>-</td>
                    @endif
                    <td>
                        {{ !empty(sanitizeString($detail->recovery_plan)) ? sanitizeString($detail->recovery_plan) : '-' }}
                    </td>
                    <td>{{ boolVal(intVal($detail->major_fact)) ? 'Oui' : 'Non' }}</td>
                    <td>
                        {{ !empty($detail->major_fact_is_detected_by_full_name) ? $detail->major_fact_is_detected_by_full_name : '-' }}
                    </td>
                    <td>
                        {{ !empty($detail->major_fact_is_detected_at) ? Carbon\Carbon::parse($detail->major_fact_is_detected_at)->format('d-m-Y') : '-' }}
                    </td>
                    <td>
                        @if (
                            (boolVal(intVal($detail->major_fact_is_rejected_at_dcp)) ||
                                boolVal(intVal($detail->major_fact_is_rejected_at_dre))) &&
                                boolVal(intVal($detail->major_fact)))
                            Réjéter
                        @elseif(
                            !(boolVal(intVal($detail->major_fact_is_rejected_at_dcp)) ||
                                boolVal(intVal($detail->major_fact_is_rejected_at_dre))
                            ) && boolVal(intVal($detail->major_fact)))
                            En attente
                        @elseif(
                            (boolVal(intVal($detail->major_fact_is_dispatched_to_dcp)) ||
                                boolVal(intVal($detail->major_fact_is_dispatched_by_dcp))) &&
                                boolVal(intVal($detail->major_fact)))
                            Valider
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{ !empty($detail->major_fact_is_dispatched_to_dcp_by_full_name) ? $detail->major_fact_is_dispatched_to_dcp_by_full_name : '-' }}
                    </td>
                    @if (!hasRole(['ci', 'cdc', 'da']))
                        <td>
                            {{ !empty($detail->major_fact_is_dispatched_by_full_name) ? $detail->major_fact_is_dispatched_by_full_name : '-' }}
                        </td>
                    @endif
                    @if (boolVal(intVal($detail->is_controlled_by_ci)))
                        <td>
                            {{ !empty($detail->ci_full_name) ? $detail->ci_full_name : '-' }}
                        </td>
                        <td>
                            {{ !empty($detail->controlled_by_ci_at) ? Carbon\Carbon::parse($detail->controlled_by_ci_at)->format('d-m-Y') : '-' }}
                        </td>
                    @else
                        <td>-</td>
                        <td>-</td>
                    @endif
                    @if (boolVal(intVal($detail->is_controlled_by_cdc)))
                        <td>
                            {{ !empty($detail->cdc_full_name) ? $detail->cdc_full_name : '-' }}
                        </td>
                        <td>
                            {{ !empty($detail->controlled_by_cdc_at) ? Carbon\Carbon::parse($detail->controlled_by_cdc_at)->format('d-m-Y') : '-' }}
                        </td>
                    @else
                        <td>-</td>
                        <td>-</td>
                    @endif
                    @if (!hasRole(['ci', 'cdc', 'da']))
                        @if (boolVal(intVal($detail->is_controlled_by_cc)))
                            <td>
                                {{ !empty($detail->cc_full_name) ? $detail->cc_full_name : '-' }}
                            </td>
                            <td>
                                {{ !empty($detail->controlled_by_cc_at) ? Carbon\Carbon::parse($detail->controlled_by_cc_at)->format('d-m-Y') : '-' }}
                            </td>
                        @else
                            <td>-</td>
                            <td>-</td>
                        @endif
                        @if (boolVal(intVal($detail->is_controlled_by_cdcr)))
                            <td>
                                {{ !empty($detail->cdcr_full_name) ? $detail->cdcr_full_name : '-' }}
                            </td>
                            <td>
                                {{ !empty($detail->controlled_by_cdcr_at) ? Carbon\Carbon::parse($detail->controlled_by_cdcr_at)->format('d-m-Y') : '-' }}
                            </td>
                        @else
                            <td>-</td>
                            <td>-</td>
                        @endif
                        @if (boolVal(intVal($detail->is_controlled_by_dcp)))
                            <td>
                                {{ !empty($detail->dcp_full_name) ? $detail->dcp_full_name : '-' }}
                            </td>
                            <td>
                                {{ !empty($detail->controlled_by_dcp_at) ? Carbon\Carbon::parse($detail->controlled_by_dcp_at)->format('d-m-Y') : '-' }}
                            </td>
                        @else
                            <td>-</td>
                            <td>-</td>
                        @endif
                    @endif
                </tr>
                @if ($detail->metadata)
                    @php
                        $metadata = json_decode($detail->metadata);
                        if (is_string($metadata)) {
                            $metadata = json_decode($metadata);
                        }
                        $headings = collect(\Arr::flatten($metadata))->map(fn($item) => $item->label)->unique();
                        $maxspan = hasRole(['ci', 'cdc', 'da']) ? 19 : 27;
                        $totalColumns = count($headings);
                        $colspan = $maxspan - $totalColumns;
                    @endphp
                    <tr>
                        <th colspan="{{ $maxspan }}">
                            <b>Constats liés à l'échantillonage</b>
                        </th>
                    </tr>
                    <tr>
                        @foreach ($headings as $item)
                            <th><b>{{ $item }}</b></th>
                        @endforeach
                        @if ($colspan)
                            <th colspan="{{ $colspan }}"></th>
                        @endif
                    </tr>
                    @foreach ($metadata as $row)
                        <tr>
                            @foreach ($row as $column)
                                <td>{{ $column->value }}</td>
                            @endforeach
                            @if ($colspan)
                                <td colspan="{{ $colspan }}"></td>
                            @endif
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="{{ $maxspan }}"></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>

</html>
