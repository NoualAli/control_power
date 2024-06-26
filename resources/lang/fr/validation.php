<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Le champ :attribute doit être accepté.',
    'accepted_if'          => 'Le champ :attribute doit être accepté quand :other a la valeur :value.',
    'active_url'           => 'Le champ :attribute n\'est pas une URL valide.',
    'after'                => 'Le champ :attribute doit être une date postérieure au :date.',
    'after_or_equal'       => 'Le champ :attribute doit être une date postérieure ou égale au :date.',
    'alpha'                => 'Le champ :attribute doit contenir uniquement des lettres.',
    'alpha_dash'           => 'Le champ :attribute doit contenir uniquement des lettres, des chiffres et des tirets.',
    'alpha_num'            => 'Le champ :attribute doit contenir uniquement des chiffres et des lettres.',
    'array'                => 'Le champ :attribute doit être un tableau.',
    'before'               => 'Le champ :attribute doit être une date antérieure au :date.',
    'before_or_equal'      => 'Le champ :attribute doit être une date antérieure ou égale au :date.',
    'between'              => [
        'array'   => 'Le tableau :attribute doit contenir entre :min et :max éléments.',
        'file'    => 'La taille du fichier de :attribute doit être comprise entre :min et :max kilo-octets.',
        'numeric' => 'La valeur de :attribute doit être comprise entre :min et :max.',
        'string'  => 'Le texte :attribute doit contenir entre :min et :max caractères.',
    ],
    'boolean'              => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed'            => 'Le champ de confirmation :attribute ne correspond pas.',
    'current_password'     => 'Le mot de passe est incorrect.',
    'date'                 => 'Le champ :attribute n\'est pas une date valide.',
    'date_equals'          => 'Le champ :attribute doit être une date égale à :date.',
    'date_format'          => 'Le champ :attribute ne correspond pas au format :format.',
    'declined'             => 'Le champ :attribute doit être décliné.',
    'declined_if'          => 'Le champ :attribute doit être décliné quand :other a la valeur :value.',
    'different'            => 'Les champs :attribute et :other doivent être différents.',
    'digits'               => 'Le champ :attribute doit contenir :digits chiffres.',
    'digits_between'       => 'Le champ :attribute doit contenir entre :min et :max chiffres.',
    'dimensions'           => 'La taille de l\'image :attribute n\'est pas conforme.',
    'distinct'             => 'Le champ :attribute a une valeur en double.',
    'email'                => 'Le champ :attribute doit être une adresse e-mail valide.',
    'ends_with'            => 'Le champ :attribute doit se terminer par une des valeurs suivantes : :values',
    'enum'                 => 'The selected :attribute is invalid.',
    'exists'               => 'Le champ :attribute sélectionné est invalide.',
    'file'                 => 'Le champ :attribute doit être un fichier.',
    'filled'               => 'Le champ :attribute doit avoir une valeur.',
    'gt'                   => [
        'array'   => 'Le tableau :attribute doit contenir plus de :value éléments.',
        'file'    => 'La taille du fichier de :attribute doit être supérieure à :value kilo-octets.',
        'numeric' => 'La valeur de :attribute doit être supérieure à :value.',
        'string'  => 'Le texte :attribute doit contenir plus de :value caractères.',
    ],
    'gte'                  => [
        'array'   => 'Le tableau :attribute doit contenir au moins :value éléments.',
        'file'    => 'La taille du fichier de :attribute doit être supérieure ou égale à :value kilo-octets.',
        'numeric' => 'La valeur de :attribute doit être supérieure ou égale à :value.',
        'string'  => 'Le texte :attribute doit contenir au moins :value caractères.',
    ],
    'image'                => 'Le champ :attribute doit être une image.',
    'in'                   => 'Le champ :attribute est invalide.',
    'in_array'             => 'Le champ :attribute n\'existe pas dans :other.',
    'integer'              => 'Le champ :attribute doit être un entier.',
    'ip'                   => 'Le champ :attribute doit être une adresse IP valide.',
    'ipv4'                 => 'Le champ :attribute doit être une adresse IPv4 valide.',
    'ipv6'                 => 'Le champ :attribute doit être une adresse IPv6 valide.',
    'json'                 => 'Le champ :attribute doit être un document JSON valide.',
    'lt'                   => [
        'array'   => 'Le tableau :attribute doit contenir moins de :value éléments.',
        'file'    => 'La taille du fichier de :attribute doit être inférieure à :value kilo-octets.',
        'numeric' => 'La valeur de :attribute doit être inférieure à :value.',
        'string'  => 'Le texte :attribute doit contenir moins de :value caractères.',
    ],
    'lte'                  => [
        'array'   => 'Le tableau :attribute doit contenir au plus :value éléments.',
        'file'    => 'La taille du fichier de :attribute doit être inférieure ou égale à :value kilo-octets.',
        'numeric' => 'La valeur de :attribute doit être inférieure ou égale à :value.',
        'string'  => 'Le texte :attribute doit contenir au plus :value caractères.',
    ],
    'mac_address'          => 'The :attribute must be a valid MAC address.',
    'max'                  => [
        'array'   => 'Le tableau :attribute ne peut contenir plus de :max éléments.',
        'file'    => 'La taille du fichier de :attribute ne peut pas dépasser :max kilo-octets.',
        'numeric' => 'La valeur de :attribute ne peut être supérieure à :max.',
        'string'  => 'Le texte de :attribute ne peut contenir plus de :max caractères.',
    ],
    'mimes'                => 'Le champ :attribute doit être un fichier de type : :values.',
    'mimetypes'            => 'Le champ :attribute doit être un fichier de type : :values.',
    'min'                  => [
        'array'   => 'Le tableau :attribute doit contenir au moins :min éléments.',
        'file'    => 'La taille du fichier de :attribute doit être supérieure à :min kilo-octets.',
        'numeric' => 'La valeur de :attribute doit être supérieure ou égale à :min.',
        'string'  => 'Le texte :attribute doit contenir au moins :min caractères.',
    ],
    'multiple_of'          => 'La valeur de :attribute doit être un multiple de :value',
    'not_in'               => 'Le champ :attribute sélectionné n\'est pas valide.',
    'not_regex'            => 'Le format du champ :attribute n\'est pas valide.',
    'numeric'              => 'Le champ :attribute doit contenir un nombre.',
    'password'             => 'Le mot de passe est incorrect',
    'present'              => 'Le champ :attribute doit être présent.',
    'prohibited'           => 'Le champ :attribute est interdit.',
    'prohibited_if'        => 'Le champ :attribute est interdit quand :other a la valeur :value.',
    'prohibited_unless'    => 'Le champ :attribute est interdit à moins que :other est l\'une des valeurs :values.',
    'prohibits'            => 'Le champ :attribute interdit :other d\'être présent.',
    'regex'                => 'Le format du champ :attribute est invalide.',
    'required'             => 'Le champ :attribute est obligatoire.',
    'required_if'          => 'Le champ :attribute est obligatoire quand la valeur de :other est :value.',
    'required_unless'      => 'Le champ :attribute est obligatoire sauf si :other est :values.',
    'required_with'        => 'Le champ :attribute est obligatoire quand :values est présent.',
    'required_with_all'    => 'Le champ :attribute est obligatoire quand :values sont présents.',
    'required_without'     => 'Le champ :attribute est obligatoire quand :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis quand aucun de :values n\'est présent.',
    'same'                 => 'Les champs :attribute et :other doivent être identiques.',
    'size'                 => [
        'array'   => 'Le tableau :attribute doit contenir :size éléments.',
        'file'    => 'La taille du fichier de :attribute doit être de :size kilo-octets.',
        'numeric' => 'La valeur de :attribute doit être :size.',
        'string'  => 'Le texte de :attribute doit contenir :size caractères.',
    ],
    'starts_with'          => 'Le champ :attribute doit commencer avec une des valeurs suivantes : :values',
    'string'               => 'Le champ :attribute doit être une chaîne de caractères.',
    'timezone'             => 'Le champ :attribute doit être un fuseau horaire valide.',
    'unique'               => 'La valeur du champ :attribute est déjà utilisée.',
    'uploaded'             => 'Le fichier du champ :attribute n\'a pu être téléversé.',
    'url'                  => 'Le format de l\'URL de :attribute n\'est pas valide.',
    'uuid'                 => 'Le champ :attribute doit être un UUID valide',
    'isAlgerianPhoneNumber' => 'Le N° de téléphone doit être un numéro de téléphone algérien valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'authLogin' => 'identifiant',
        "last_name" => "nom de famille",
        "first_name" => "prénom",
        "lastname" => "nom de famille",
        "firstname" => "prénom",
        "full_name" => "nom complet",
        "email" => "adresse e-mail",
        "phone" => "n° de téléphone",
        "password" => "Mot de passe",
        "current_password" => "Mot de passe actuel",
        "password_confirmation" => "Confirmation mot de passe",
        "username" => "nom d'utilisateur",
        "name" => "nom",
        "role_id" => "rôle",
        'start' => 'date début',
        'end' => 'date fin',
        'major_fact' => 'fait majeur',
        'control_points.*.score' => 'notation',
        'control_points.*.recovery_plan' => 'plan de redressement',
        'control_points.*.report' => 'constat',
        'control_points.*.major_fact' => 'fait majeur',
        'agency_id' => 'agence',
        'total_folders' => 'nombre total des dossiers',
        'total_samples' => 'nombre total des échantillons',
        'dre_id' => 'dre',
        'family_id' => 'famille',
        'domain_id' => 'domaine',
        'process_id' => 'processus',
        'scores.*.0.score' => 'note',
        'scores.*.1.label' => 'label',
        'major_fact_types.*.0.type' =>   'type',
        'fields.*.0.type' => 'type',
        'fields.*.1.label' => 'label',
        'fields.*.2.name' => 'nom',
        'fields.*.3.length' => 'taille',
        'fields.*.4.style' => 'nombre de colonnes',
        'fields.*.5.id' => 'identifiant',
        'fields.*.6.placeholder' => 'placeholder',
        'fields.*.7.help_text' => 'texte d\'aide',
        'fields.*.8.rules' => 'règles de validation',
        'reference' => 'référence',
        'families' => 'familles',
        'domains' => 'domaines',
        'processes' => 'processus',
        'control_points' => 'points de contrôles',
        'family' => 'famille',
        'domaine' => 'domaine',
        'process' => 'processus',
        'control_point' => 'point de contrôle',
        'family_id' => 'famille',
        'domaine_id' => 'domaine',
        'process_id' => 'processus',
        'control_point_id' => 'point de contrôle',
        'agencies' => 'agences',
        'controllers' => 'contrôleurs',
        'control_campaign_id' => 'campagne de contrôle',

        'opinion' => 'avis du contrôleur',
        'report' => 'constat',
        'major_fact_types' => 'types des faits majeur',
        'has_major_fact' => 'faits majeur',
        'regularized_at' => 'date de régularization',
        'committed_action' => 'action engagée',
        'action_to_be_taken' => 'action à engagée',
        'reason' => 'cause',
        'pcf_usable' => 'pcf utilisable',
        'pcf_unusable' => 'pcf inutilisable',
        'recovery_plan' => 'plan de redressement',
        'report' => 'constat',
        'priority' => 'priorité',
        'score' => 'notation',
        'metadata' => 'information supplémentaires',
        'major_fact' => 'fait majeur',
        'programmed_end' => 'date fin',
        'programmed_start' => 'date début',
        'category_id' => "catégorie",
        'registration_number' => 'matricule',
        'closing_report' => 'PV de clôture',
        'mission_order' => 'ordre de mission',
        'closing_report.*' => 'PV de clôture',
        'controller' => 'contrôleur',
        'start_date' => 'date de début',
        'end_date' => 'date de fin',
        'agency' => 'agence'
    ],

];
