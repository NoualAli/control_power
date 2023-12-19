<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des champs</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Label</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Entier / Float</th>
                <th>Champs obligatoire</th>
                <th>Distinct</th>
                <th>Longueure (max)</th>
                <th>Longueure (min)</th>
                <th>Multiple</th>
                <th>Règles supplémentaires</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fields as $field)
                <tr>
                    <td>{{ $field->label }}</td>
                    <td>{{ $field->name }}</td>
                    <td>{{ $field->type }}</td>
                    @if ($field->type == 'number')
                        <td>{{ !$field->is_integer_or_float && $field->type == 'number' ? 'Entier' : 'Float' }}</td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{ $field->required ? 'Oui' : 'Non' }}</td>
                    <td>{{ $field->distinct ? 'Oui' : 'Non' }}</td>
                    <td>{{ $field->max_length }}</td>
                    <td>{{ $field->min_length }}</td>
                    <td>{{ $field->is_multiple ? 'Oui' : 'Non' }}</td>
                    <td>{{ $field->additional_rules ? collect($field->additional_rules)->join(', ') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
