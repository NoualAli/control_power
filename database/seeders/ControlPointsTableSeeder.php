<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ControlPointsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('control_points')->delete();

        \DB::table('control_points')->insert(array(
            0 =>
            array(
                'fields' => NULL,
                'id' => 1,
                'name' => 'S\'assurer que la convention d\'adhésion aux services de la banque en ligne est dûment renseigné et signé par le client précédé par la mention lu et approuvé et par le responsable habilité de l\'agence avec apposition du cachet',
                'process_id' => 1,
                'scores' => NULL,
            ),
            1 =>
            array(
                'fields' => NULL,
                'id' => 2,
                'name' => 'S’assurer que la demande d’abonnement, par type de client, est dûment renseignée, signée par le client précédé de la mention « lu et approuvé » et par le responsable habilité de l\'agence',
                'process_id' => 1,
                'scores' => NULL,
            ),
            2 =>
            array(
                'fields' => NULL,
                'id' => 3,
                'name' => 'S’assurer que les commissions sont perçus au débit du compte du client chaque fin du mois selon les conditions de banque en vigueur',
                'process_id' => 1,
                'scores' => NULL,
            ),
            3 =>
            array(
                'fields' => NULL,
                'id' => 4,
                'name' => 'S\'assurer que seul le responsable hierarchique est habilité à réinitiliser, suspendre, annuler l\'abonnement',
                'process_id' => 1,
                'scores' => NULL,
            ),
            4 =>
            array(
                'fields' => NULL,
                'id' => 5,
                'name' => 'S\'assurer que les réclamations de la clientèles sont prises en charge',
                'process_id' => 2,
                'scores' => NULL,
            ),
            5 =>
            array(
                'fields' => NULL,
                'id' => 6,
                'name' => 'S’assurer que les commissions sont perçus au débit du compte  client selon les conditions de banque en vigueur',
                'process_id' => 3,
                'scores' => NULL,
            ),
            6 =>
            array(
                'fields' => NULL,
                'id' => 7,
                'name' => 'S’assurer que la convention d’échange de données informatisées est signée par le directeur de la DRE, directeur d’agence, le donneur d’ordre',
                'process_id' => 4,
                'scores' => NULL,
            ),
            7 =>
            array(
                'fields' => NULL,
                'id' => 9,
                'name' => 'Vérifier que le registre tenu à cet effet est bien rensigné et mis à jour',
                'process_id' => 5,
                'scores' => NULL,
            ),
            8 =>
            array(
                'fields' => NULL,
                'id' => 10,
                'name' => 'S\'assurer que l\'attestation de change est signé par le responsable habilité',
                'process_id' => 5,
                'scores' => NULL,
            ),
            9 =>
            array(
                'fields' => NULL,
                'id' => 11,
                'name' => 'S\'assurer que le bordereau de vente de devises est signé par le guichetier, le caissier,  acquitté par le bénéficiaire et qu\'il est visé par le responsable habilité',
                'process_id' => 5,
                'scores' => NULL,
            ),
            10 =>
            array(
                'fields' => NULL,
                'id' => 12,
                'name' => 'S\'assurer que le client a bénéficié une fois le droit de change /an',
                'process_id' => 5,
                'scores' => NULL,
            ),
            11 =>
            array(
                'fields' => NULL,
                'id' => 13,
                'name' => 'S\'assurer de l\'éligibilité du client aux frais de missions',
                'process_id' => 6,
                'scores' => NULL,
            ),
            12 =>
            array(
                'fields' => NULL,
                'id' => 14,
                'name' => 'S\'assurer que le dossier de frais de mission comporte tous les documents exigés par la règlementation',
                'process_id' => 6,
                'scores' => NULL,
            ),
            13 =>
            array(
                'fields' => NULL,
                'id' => 15,
                'name' => 'S\'assurer que les frais de mission accordés aux client sont conformes aux barèmes (montant, durée, catégorie des pays)',
                'process_id' => 6,
                'scores' => NULL,
            ),
            14 =>
            array(
                'fields' => NULL,
                'id' => 16,
                'name' => 'S\'assurer que le dossier d\'apurement comprend une copie de l\'ordre de mission visée par les services de police algérienne des frontières durant les 15 jours qui suivent la date de retour prévue dans l\'ordre de mission',
                'process_id' => 6,
                'scores' => NULL,
            ),
            15 =>
            array(
                'fields' => NULL,
                'id' => 17,
                'name' => 'S\'assurer que le dossier de frais de scolarités comporte tous les documents exigés par la règlementation',
                'process_id' => 7,
                'scores' => NULL,
            ),
            16 =>
            array(
                'fields' => NULL,
                'id' => 18,
                'name' => 'S\'assurer que le client n\'a pas dépassé l\'autorisation mensuelle (9000,00 DA/mois) et la durée(maximum 10 mois)',
                'process_id' => 7,
                'scores' => NULL,
            ),
            17 =>
            array(
                'fields' => NULL,
                'id' => 19,
                'name' => 'Vérifier que l\'ordre de virement CT 18 est bien renseigné, signé par le client et visé par le reponsable habilité',
                'process_id' => 7,
                'scores' => NULL,
            ),
            18 =>
            array(
                'fields' => NULL,
                'id' => 20,
                'name' => 'S\'assurer que le dossier comporte tous les documents exigés par la règlementation',
                'process_id' => 8,
                'scores' => NULL,
            ),
            19 =>
            array(
                'fields' => NULL,
                'id' => 21,
                'name' => 'S\'assurer que le dossier d\'apurement comprend la facture définitive attestant le montant des préstations rendues par l\'établissement hospitalier étranger',
                'process_id' => 8,
                'scores' => NULL,
            ),
            20 =>
            array(
                'fields' => NULL,
                'id' => 22,
                'name' => 'S\'assurer que le montant et la durée autorisés pour les soins à l\'étranger ne sont pas  dépassé (120 000,00 DA/année civil)',
                'process_id' => 8,
                'scores' => NULL,
            ),
            21 =>
            array(
                'fields' => NULL,
                'id' => 23,
                'name' => 'S\'assurer de l\'éligibilité du client à la cession de devises ',
                'process_id' => 9,
                'scores' => NULL,
            ),
            22 =>
            array(
                'fields' => NULL,
                'id' => 24,
                'name' => 'S\'assurer que les documents présentés sont conformes à la règlementation',
                'process_id' => 9,
                'scores' => NULL,
            ),
            23 =>
            array(
                'fields' => NULL,
                'id' => 25,
                'name' => 'Vérifier que le formulaire de versement CA1112 est bien renseigné',
                'process_id' => 9,
                'scores' => NULL,
            ),
            24 =>
            array(
                'fields' => NULL,
                'id' => 26,
                'name' => 'Vérifier la complétude et la conformité du dossier d\'ouverture de compte (0200,0300,0260…)',
                'process_id' => 10,
                'scores' => NULL,
            ),
            25 =>
            array(
                'fields' => NULL,
                'id' => 27,
                'name' => 'S\'assurer que les interrogations des centrales de surveillance (Interdit bancaire, interdit de chéquier…) ont été effectuées',
                'process_id' => 10,
                'scores' => NULL,
            ),
            26 =>
            array(
                'fields' => NULL,
                'id' => 28,
                'name' => 'S\'assurer de la bonne saisie des informations relatives au client sur le suystème d\'information ',
                'process_id' => 10,
                'scores' => NULL,
            ),
            27 =>
            array(
                'fields' => NULL,
                'id' => 29,
                'name' => 'S\'assurer de la scannarisation et la bonne conservation des CA10',
                'process_id' => 10,
                'scores' => NULL,
            ),
            28 =>
            array(
                'fields' => NULL,
                'id' => 30,
                'name' => 'Vérifier la demande de clôture de compte du client (nom et prénom, numéro de compte, signature, date...)   ',
                'process_id' => 11,
                'scores' => NULL,
            ),
            29 =>
            array(
                'fields' => NULL,
                'id' => 31,
                'name' => 'S\'assurer que toutes les conditions de clôture ont été respectées (solde suffisant, moyens de paiements restitués, etc)',
                'process_id' => 11,
                'scores' => NULL,
            ),
            30 =>
            array(
                'fields' => NULL,
                'id' => 32,
                'name' => 'S\'assurer de l\'exploitation de l\'etat des comptes sans mouvements  ',
                'process_id' => 12,
                'scores' => NULL,
            ),
            31 =>
            array(
                'fields' => NULL,
                'id' => 33,
                'name' => 'S\'assurer que les clients dont les comptes sont bloqués ou clôturés ont été informés de la situation de leur compte selon la procédure en vigueur.',
                'process_id' => 12,
                'scores' => NULL,
            ),
            32 =>
            array(
                'fields' => NULL,
                'id' => 35,
                'name' => 'S\'assurer que la levée de blocage du compte se fait sur la base d\'une demande écrite du client',
                'process_id' => 12,
                'scores' => NULL,
            ),
            33 =>
            array(
                'fields' => '[[{"type": "text", "value": "Type"}, {"label": "Nom et prénom", "value": "Label"}, {"name": "relation", "value": "Nom"}, {"value": "Taille", "length": 255}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": null, "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le nom et le prénom du client"}, {"value": "Texte d\'aide", "help_text": "Entrez le nom et le prénom du client correctement, sans fautes d\'orthographe, pour une meilleure identification."},  {"rules": ["required", "distinct"], "value": "Règles de validation"}]]',
                'id' => 61,
                'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                'process_id' => 21,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Mal renseignée / Non traitée dans les délais", "value": "Label"}]]',
            ),
            34 =>
            array(
                'fields' => NULL,
                'id' => 62,
                'name' => 'S\'assurer des conditions de conservation des cartes et codes confidentiels',
                'process_id' => 21,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "4", "value": "Note"}, {"label": "Non conservé dans un coffre", "value": "Label"}]]',
            ),
            35 =>
            array(
                'fields' => '[[{"type": "text", "value": "Type"}, {"label": "Nom et prénom", "value": "Label"}, {"name": "relation", "value": "Nom"}, {"value": "Taille", "length": 255}, {"style": "col-12 col-lg-12", "value": "Nombre de colonnes"}, {"id": null, "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le nom et le prénom du client"}, {"value": "Texte d\'aide", "help_text": "Entrez le nom et le prénom du client correctement, sans fautes d\'orthographe, pour une meilleure identification."},  {"rules": ["required", "distinct"], "value": "Règles de validation"}]]',
                'id' => 63,
                'name' => 'S\'assurer que les clients n\'ayant pas retirés leurs cartes ont été relancés',
                'process_id' => 21,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Client non relancés", "value": "Label"}]]',
            ),
            36 =>
            array(
                'fields' => NULL,
                'id' => 64,
                'name' => 'S\'assurer du respect de la procédure d\'oblitération des cartes (délai, PV)',
                'process_id' => 21,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Procédure non respectée", "value": "Label"}]]',
            ),
            37 =>
            array(
                'fields' => NULL,
                'id' => 65,
                'name' => 'S\'assurer que le registre est bien renseigné, signé par le client',
                'process_id' => 21,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Mal renseigné / Non signé par le client", "value": "Label"}]]',
            ),
            38 =>
            array(
                'fields' => NULL,
                'id' => 66,
                'name' => 'S\'assurer que les codes confidentiels ainsi que les cartes sont conservées séparément dans un coffre',
                'process_id' => 21,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "4", "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            39 =>
            array(
                'fields' => NULL,
                'id' => 67,
                'name' => 'S\'assurer de la mise à jours du fichier de stock des cartes',
                'process_id' => 21,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Non mis à jours", "value": "Label"}]]',
            ),
            40 =>
            array(
                'fields' => '[[{"type": "text", "value": "Type"}, {"label": "Nom et prénom", "value": "Label"}, {"name": "relation", "value": "Nom"}, {"value": "Taille", "length": 255}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "first_name_and_last_name_field", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le nom et le prénom du client"}, {"value": "Texte d\'aide", "help_text": "Entrez le nom et le prénom du client correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required", "distinct"], "value": "Règles de validation"}], [{"type": "number", "value": "Type"}, {"label": "N° de la carte bancaire", "value": "Label"}, {"name": "credit_card_number", "value": "Nom"}, {"value": "Taille", "length": "20"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "credit_card_number_field", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "XXXX XXXX XXXX XXXX"}, {"value": "Texte d\'aide", "help_text": "Saisissez les 16 chiffres de la carte bancaire du client avec précision, en évitant les erreurs d\'orthographe et les caractères spéciaux pour une identification fiable."},  {"rules": ["required", "distinct"], "value": "Règles de validation"}]]',
                'id' => 68,
                'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                'process_id' => 22,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
            ),
            41 =>
            array(
                'fields' => NULL,
                'id' => 69,
                'name' => 'S\'assurer que les commissions ont été prélevés selon les conditions de banque',
                'process_id' => 22,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "commissions non prélevées/Non respect des conditions de banque", "value": "Label"}]]',
            ),
            42 =>
            array(
                'fields' => '[[{"type": "text", "value": "Type"}, {"label": "Nom et prénom", "value": "Label"}, {"name": "relation", "value": "Nom"}, {"value": "Taille", "length": "255"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "first_name_and_last_name_field", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le nom et le prénom du client"}, {"value": "Texte d\'aide", "help_text": "Entrez le nom et le prénom du client correctement, sans fautes d\'orthographe, pour une meilleure identification."}], [{"type": "number", "value": "Type"}, {"label": "N° de la carte bancaire", "value": "Label"}, {"name": "credit_card_number", "value": "Nom"}, {"value": "Taille", "length": "16"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "credit_card_number_field", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "XXXX XXXX XXXX XXXX"}, {"value": "Texte d\'aide", "help_text": "Saisissez les 16 chiffres de la carte bancaire du client avec précision, en évitant les erreurs d\'orthographe et les caractères spéciaux pour une identification fiable."},  {"rules": ["required", "distinct"], "value": "Règles de validation"}]]',
                'id' => 70,
                'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                'process_id' => 23,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
            ),
            43 =>
            array(
                'fields' => '[[{"type": "text", "value": "Type"}, {"label": "Nom et prénom", "value": "Label"}, {"name": "relation", "value": "Nom"}, {"value": "Taille", "length": "255"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "first_name_and_last_name_field", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le nom et le prénom du client"}, {"value": "Texte d\'aide", "help_text": "Entrez le nom et le prénom du client correctement, sans fautes d\'orthographe, pour une meilleure identification."},  {"rules": ["required", "distinct"], "value": "Règles de validation"}]]',
                'id' => 71,
                'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                'process_id' => 24,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
            ),
            44 =>
            array(
                'fields' => NULL,
                'id' => 72,
                'name' => 'S\'assurer que les commissions ont été prélevés selon les conditions de banque',
                'process_id' => 24,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "commissions non prélevées/Non respect des conditions de banque", "value": "Label"}]]',
            ),
            45 =>
            array(
                'fields' => '[[{"type": "text", "value": "Type"}, {"label": "Nom et prénom", "value": "Label"}, {"name": "relation", "value": "Nom"}, {"value": "Taille", "length": "255"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "first_name_and_last_name_field", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le nom et le prénom du client"}, {"value": "Texte d\'aide", "help_text": "Entrez le nom et le prénom du client correctement, sans fautes d\'orthographe, pour une meilleure identification."},  {"rules": ["required", "distinct"], "value": "Règles de validation"}]]',
                'id' => 73,
                'name' => 'Vérifier les renseignements de la demande et le traitement dans les délais',
                'process_id' => 25,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
            ),
            46 =>
            array(
                'fields' => '[[{"type": "text", "value": "Type"}, {"label": "Nom et prénom", "value": "Label"}, {"name": "relation", "value": "Nom"}, {"value": "Taille", "length": "255"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "first_name_and_last_name_field", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le nom et le prénom du client"}, {"value": "Texte d\'aide", "help_text": "Entrez le nom et le prénom du client correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required", "distinct"], "value": "Règles de validation"}], [{"type": "number", "value": "Type"}, {"label": "N° de la carte bancaire", "value": "Label"}, {"name": "credit_card_number", "value": "Nom"}, {"value": "Taille", "length": "16"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "credit_card_number_field", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "XXXX XXXX XXXX XXXX"}, {"value": "Texte d\'aide", "help_text": "Saisissez les 16 chiffres de la carte bancaire du client avec précision, en évitant les erreurs d\'orthographe et les caractères spéciaux pour une identification fiable."},  {"rules": ["required", "distinct"], "value": "Règles de validation"}]]',
                'id' => 74,
                'name' => 'Vérifier les renseignements de la demande et le traitement dans les délais',
                'process_id' => 26,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
            ),
            47 =>
            array(
                'fields' => NULL,
                'id' => 75,
                'name' => 'S\'assurer de l\'établissement des formulaires de la mise et levée en exception signés par le directeur d\'agence et qu\'ils sont transmis à la DM au temps opportun',
                'process_id' => 26,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Formulaires non établies", "value": "Label"}]]',
            ),
            48 =>
            array(
                'fields' => '[[{"type": "text", "value": "Type"}, {"label": "relation", "value": "Label"}, {"name": "relation", "value": "Nom"}, {"value": "Taille", "length": "255"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "relation_id", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le nom de la relation"}, {"value": "Texte d\'aide", "help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}], [{"type": "number", "value": "Type"}, {"label": "N° de compte bancaire", "value": "Label"}, {"name": "bank_account_number", "value": "Nom"}, {"value": "Taille", "length": "30"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "bank_account_number_id", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le numéro de compte bancaire du client"}, {"value": "Texte d\'aide", "help_text": "Veuillez entrer le numéro de compte bancaire du client à 20 chiffres sans espaces ni tirets."},  {"rules": ["required", "distinct"], "value": "Règles de validation"}]]',
                'id' => 76,
                'name' => 'S\'assurer que le contrat d\'adhésion est signé par les deux (02) parties (client et agence)',
                'process_id' => 27,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "2", "value": "Note"}, {"label": "Contrat non signé", "value": "Label"}]]',
            ),
            49 =>
            array(
                'fields' => '[[{"type": "text", "value": "Type"}, {"label": "Relation", "value": "Label"}, {"name": "relation", "value": "Nom"}, {"value": "Taille", "length": "255"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "relation_id", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le nom de la relation"}, {"value": "Texte d\'aide", "help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required", "distinct"], "value": "Règles de validation"}], [{"type": "text", "value": "Type"}, {"label": "N° de compte bancaire", "value": "Label"}, {"name": "bank_account_number", "value": "Nom"}, {"value": "Taille", "length": "30"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "bank_account_number_id", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le numéro de compte bancaire du client"}, {"value": "Texte d\'aide", "help_text": "Veuillez entrer le numéro de compte bancaire du client à 20 chiffres sans espaces ni tirets."},  {"rules": ["required", "distinct"], "value": "Règles de validation"}]]',
                'id' => 77,
                'name' => 'S\'assurer que l\'installation du TPE est matérialisé par un PV signé par l\'ingénieur et le commerçant et un PV de formation',
                'process_id' => 27,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "PV non établis", "value": "Label"}]]',
            ),
            50 =>
            array(
                'fields' => '[[{"type": "text", "value": "Type"}, {"label": "Nom et prénom", "value": "Label"}, {"name": "relation", "value": "Nom"}, {"value": "Taille", "length": "255"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "first_name_and_last_name_field", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le nom et le prénom du client"}, {"value": "Texte d\'aide", "help_text": "Entrez le nom et le prénom du client correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required", "distinct"], "value": "Règles de validation"}], [{"type": "number", "value": "Type"}, {"label": "N° de la carte bancaire", "value": "Label"}, {"name": "credit_card_number", "value": "Nom"}, {"value": "Taille", "length": "16"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "credit_card_number_field", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "XXXX XXXX XXXX XXXX"}, {"value": "Texte d\'aide", "help_text": "Saisissez les 16 chiffres de la carte bancaire du client avec précision, en évitant les erreurs d\'orthographe et les caractères spéciaux pour une identification fiable."},  {"rules": ["required", "distinct"], "value": "Règles de validation"}]]',
                'id' => 78,
                'name' => 'S\'assurer que les réclamations de la clientèles sont prises en charge au temps opportun',
                'process_id' => 28,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Réclamation non prise en charge", "value": "Label"}]]',
            ),
            51 =>
            array(
                'fields' => '[[{"type": "text", "value": "Type"}, {"label": "Nom et prénom", "value": "Label"}, {"name": "relation", "value": "Nom"}, {"value": "Taille", "length": "255"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "first_name_and_last_name_field", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le nom et le prénom du client"}, {"value": "Texte d\'aide", "help_text": "Entrez le nom et le prénom du client correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required", "distinct"], "value": "Règles de validation"}], [{"type": "number", "value": "Type"}, {"label": "N° de compte bancaire", "value": "Label"}, {"name": "bank_account_number", "value": "Nom"}, {"value": "Taille", "length": "30"}, {"style": "col-12 col-lg-4", "value": "Nombre de colonnes"}, {"id": "bank_account_number_id", "value": "Identifiant"}, {"value": "Placeholder", "placeholder": "Entrez le numéro de compte bancaire du client"}, {"value": "Texte d\'aide", "help_text": "Veuillez entrer le numéro de compte bancaire du client à 20 chiffres sans espaces ni tirets."},  {"rules": ["required", "distinct"], "value": "Règles de validation"}]]',
                'id' => 79,
                'name' => 'S\'assurer que le formulaire de contestation est visé par un responsable habilité et envoyé à la DM',
                'process_id' => 29,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "2", "value": "Note"}, {"label": "Non visé", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Non envoyé", "value": "Label"}]]',
            ),
            52 =>
            array(
                'fields' => NULL,
                'id' => 80,
                'name' => 'S\'assurer que le contrat d\'adhésion est renseigné, signé par le client et l\'agence',
                'process_id' => 30,
                'scores' => '[[{"score": "1", "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": "3", "value": "Note"}, {"label": "Non renseigné/non signé", "value": "Label"}]]',
            ),
            53 =>
            array(
                'fields' => NULL,
                'id' => 81,
                'name' => 'Vérifier l\'enregistrement des BDC  en stock sur le système d\'information DELTA ',
                'process_id' => 31,
                'scores' => NULL,
            ),
            54 =>
            array(
                'fields' => NULL,
                'id' => 82,
                'name' => 'Vérifier la conservation du stock des  BDC ainsi que la bonne tenue du registre CA 55',
                'process_id' => 31,
                'scores' => NULL,
            ),
            55 =>
            array(
                'fields' => NULL,
                'id' => 83,
                'name' => 'Vérifier qu\'un état des BDC non utilisés est envoyé trimestriellement aux structures concernées',
                'process_id' => 31,
                'scores' => NULL,
            ),
            56 =>
            array(
                'fields' => NULL,
                'id' => 84,
                'name' => 'Vérifier la demande de souscription des bons caisse TI 34 ( montant, durée, signature, le détail des bons émis " nombre, quotité, numéro), cachet, visa….)',
                'process_id' => 32,
                'scores' => NULL,
            ),
            57 =>
            array(
                'fields' => NULL,
                'id' => 85,
                'name' => 'Vérifier le bordereau de saisie du bon caisse (nom prénom, montant, durée, taux appliqué, signatures …)  et sa conformité avec le feuillet N°1 du TI34',
                'process_id' => 32,
                'scores' => NULL,
            ),
            58 =>
            array(
                'fields' => NULL,
                'id' => 86,
                'name' => 'Vérifier l\'existence d\'un registre confidentiel détenue par le directeur d\'agence, sous clé, pour les souscriptions des BDC anonymes',
                'process_id' => 32,
                'scores' => NULL,
            ),
            59 =>
            array(
                'fields' => NULL,
                'id' => 87,
                'name' => 'Dans le cas d\'un taux dérogatoire est aperçue il y a lieu de vérifier que le montant du BDC est supérieur à vingt (20) millions de dinars et un accord a été pris par la structure habilitée ',
                'process_id' => 32,
                'scores' => NULL,
            ),
            60 =>
            array(
                'fields' => NULL,
                'id' => 88,
                'name' => 'Vérifier que les souches des bons émis, BDC nantis ou placés en dépôt libre ont été transmis au DRE',
                'process_id' => 32,
                'scores' => NULL,
            ),
            61 =>
            array(
                'fields' => NULL,
                'id' => 89,
                'name' => 'Vérifier que le BDC présenté pour remboursement n\'a pas fait objet d\'opposition ',
                'process_id' => 33,
                'scores' => NULL,
            ),
            62 =>
            array(
                'fields' => NULL,
                'id' => 90,
                'name' => 'Vérifier l\'existence de la demande du souscripteur en cas de remboursement par anticipation ',
                'process_id' => 33,
                'scores' => NULL,
            ),
            63 =>
            array(
                'fields' => NULL,
                'id' => 91,
                'name' => 'Vérifier la mention "Bon non acquitté souscripteur anonyme"  au verso du bon si le souscripteur refuse d\'acquitter, la date du remboursement, la signature du directeur d\'agence ou son intérimaire. ',
                'process_id' => 33,
                'scores' => NULL,
            ),
            64 =>
            array(
                'fields' => NULL,
                'id' => 92,
                'name' => 'Vérifier que le BDC remboursé (nominatif et anonymes) est revêtu de la mention "Annulé"',
                'process_id' => 33,
                'scores' => NULL,
            ),
            65 =>
            array(
                'fields' => NULL,
                'id' => 93,
                'name' => 'S\'assurer que le bordereau de remboursement est classé dans le dossier et que la mention  échue est portée dans le dossier  ',
                'process_id' => 33,
                'scores' => NULL,
            ),
            66 =>
            array(
                'fields' => NULL,
                'id' => 94,
                'name' => 'S\'assurer que le feuillet N°1 du TI34 a été réclamé à l\'agence ou le BDC a été souscrit (dans le cas d\'un remboursement à échéances auprés d\'une agence autre que celle de la souscription ',
                'process_id' => 33,
                'scores' => NULL,
            ),
            67 =>
            array(
                'fields' => NULL,
                'id' => 95,
                'name' => 'Vérifier la demande de souscription du dépôt à terme  (formulaire ST325, ST326) Nom et prénom, montant, durée, signature,.',
                'process_id' => 34,
                'scores' => NULL,
            ),
            68 =>
            array(
                'fields' => NULL,
                'id' => 96,
                'name' => 'Vérifier le bordereau de saisie du dépôt à terme  (nom prénom, montant, durée, taux appliqué, signatures …)  et sa conformité avec la demande de soucription ',
                'process_id' => 34,
                'scores' => NULL,
            ),
            69 =>
            array(
                'fields' => NULL,
                'id' => 97,
                'name' => 'S\'assurer que les DAT remboursés ne sont pas bloqués ou affectés à la couverture de crédits bancaires ',
                'process_id' => 35,
                'scores' => NULL,
            ),
            70 =>
            array(
                'fields' => NULL,
                'id' => 98,
                'name' => 'S\'assurer de l\'existence d\'une demande de remboursement par anticipation   ',
                'process_id' => 35,
                'scores' => NULL,
            ),
            71 =>
            array(
                'fields' => NULL,
                'id' => 99,
                'name' => 'S\'assurer que les carnets de chèques clientèle sont conservés dans un lieu sécurisé conformément au dispositif de sécurité des coffres forts',
                'process_id' => 36,
                'scores' => NULL,
            ),
            72 =>
            array(
                'fields' => NULL,
                'id' => 100,
                'name' => 'S\'assurer de la délivrance permanente des chéquiers en stock via des invitations adréssées à la clientèle ',
                'process_id' => 36,
                'scores' => NULL,
            ),
            73 =>
            array(
                'fields' => NULL,
                'id' => 101,
                'name' => 'S\'assurer de la bonne tenue et de la mise à jours du registre dédié à cet effet ',
                'process_id' => 37,
                'scores' => NULL,
            ),
            74 =>
            array(
                'fields' => NULL,
                'id' => 102,
                'name' => 'S\'assurer que toutes les entrées et sorties de stock sont effectuées selon un ordre chronologique ',
                'process_id' => 37,
                'scores' => NULL,
            ),
            75 =>
            array(
                'fields' => NULL,
                'id' => 103,
                'name' => 'S\'assurer que les carnets de chèques de banque sont conservés dans un lieu sécurisé conformément au dispositif de sécurité des coffres forts',
                'process_id' => 37,
                'scores' => NULL,
            ),
            76 =>
            array(
                'fields' => NULL,
                'id' => 104,
                'name' => 'Faire un état de rapprochement entre le stock des BDC et le registre  ',
                'process_id' => 38,
                'scores' => NULL,
            ),
            77 =>
            array(
                'fields' => NULL,
                'id' => 105,
                'name' => 'Vérifier l\'enregistrement des BDC  en stock sur le système d\'information DELTA ',
                'process_id' => 38,
                'scores' => NULL,
            ),
            78 =>
            array(
                'fields' => NULL,
                'id' => 106,
                'name' => 'Vérifier la conservation du stock des  BDC ainsi que la bonne tenue du registre CA 55',
                'process_id' => 38,
                'scores' => NULL,
            ),
            79 =>
            array(
                'fields' => NULL,
                'id' => 107,
                'name' => 'Vérifier qu\'un état des BDC non utilisés est envoyé trimestriellement aux structures concernées',
                'process_id' => 38,
                'scores' => NULL,
            ),
            80 =>
            array(
                'fields' => NULL,
                'id' => 108,
                'name' => 'Vérifier que les conditions de conservation sont respectées ',
                'process_id' => 39,
                'scores' => NULL,
            ),
            81 =>
            array(
                'fields' => NULL,
                'id' => 109,
                'name' => 'S\'assurer que toutes les entrées et sorties de stock sont enregistrées correctement selon l\'ordre chronologique avec le visas de la personne habilité ',
                'process_id' => 39,
                'scores' => NULL,
            ),
            82 =>
            array(
                'fields' => NULL,
                'id' => 110,
                'name' => 'S\'assurer pour les mandataires de l\'établissement de la formule timbrée N°354 (procuration pour coffre fort) ',
                'process_id' => 40,
                'scores' => NULL,
            ),
            83 =>
            array(
                'fields' => NULL,
                'id' => 111,
                'name' => 'S\'assurer que le montant de la location est prélevé conformément aux conditions de banque (selon le modèle)',
                'process_id' => 40,
                'scores' => NULL,
            ),
            84 =>
            array(
                'fields' => NULL,
                'id' => 112,
                'name' => 'S\'assurer que le montant du cautionnement est prélevé conformément aux conditions de banque et logé au compte d\'ordre approprié "64/35"',
                'process_id' => 40,
                'scores' => NULL,
            ),
            85 =>
            array(
                'fields' => NULL,
                'id' => 113,
                'name' => 'S\'assurer qu\'un plan des compartiments est établi et tenu à jour (nom du locataire, la date de location)',
                'process_id' => 40,
                'scores' => NULL,
            ),
            86 =>
            array(
                'fields' => NULL,
                'id' => 114,
                'name' => 'S\'assurer de la tenue des cartes de location TI51 (classer par ordre alphabétique) établies au nom des locataires revêtue de leurs signatures et eventuellement des mandataires',
                'process_id' => 40,
                'scores' => NULL,
            ),
            87 =>
            array(
                'fields' => NULL,
                'id' => 115,
                'name' => 'S\'assurer de l\'établissement du carnet de visite modèle TI159 avec signature du visiteur et visé par le reponsable habilité  ',
                'process_id' => 40,
                'scores' => NULL,
            ),
            88 =>
            array(
                'fields' => NULL,
                'id' => 116,
                'name' => 'S\'assurer que la clé de contrôle ainsi que la clé de la salle des coffres sont conservées par un responsable habilité  ',
                'process_id' => 40,
                'scores' => NULL,
            ),
            89 =>
            array(
                'fields' => NULL,
                'id' => 117,
                'name' => 'S\'assurer de l\'existence du registre y relatif et sa bonne tenue ',
                'process_id' => 41,
                'scores' => NULL,
            ),
            90 =>
            array(
                'fields' => NULL,
                'id' => 118,
                'name' => 'S\'assurer que les clients frappés d\'ATD/oppositions ont été saisis, dans les délais, par lettres recommandées ainsi que le créancier ',
                'process_id' => 41,
                'scores' => NULL,
            ),
            91 =>
            array(
                'fields' => NULL,
                'id' => 119,
                'name' => 'S\'assurer du blocage du compte et ou provision ',
                'process_id' => 41,
                'scores' => NULL,
            ),
            92 =>
            array(
                'fields' => NULL,
                'id' => 120,
                'name' => 'S\'assurer qu\'aucun mouvement débit n\'a été opéré durant la validité de l\'ATD qui est une année (01) pour les personnes physiques, quatre (04) ans pour les personnes morales et quatre (04) ans pour les oppositions des organismes sociaux  ',
                'process_id' => 41,
                'scores' => NULL,
            ),
            93 =>
            array(
                'fields' => NULL,
                'id' => 121,
                'name' => 'S\'assurer que les frais ont été prélevés selon le barème en vigueur (ATD/Oppositions)',
                'process_id' => 41,
                'scores' => NULL,
            ),
            94 =>
            array(
                'fields' => NULL,
                'id' => 122,
                'name' => 'Vérifier la bonne fin de l\'ATD/oppositions  (mainlevée, expiration délai de validité, exécution du virement)',
                'process_id' => 41,
                'scores' => NULL,
            ),
            95 =>
            array(
                'fields' => NULL,
                'id' => 123,
                'name' => 'S\'assurer de L\'existence du registre y afférent et sa bonne tenue ',
                'process_id' => 42,
                'scores' => NULL,
            ),
            96 =>
            array(
                'fields' => NULL,
                'id' => 124,
                'name' => 'S\'assurer du blocage des avoirs/cantonnement ',
                'process_id' => 42,
                'scores' => NULL,
            ),
            97 =>
            array(
                'fields' => NULL,
                'id' => 125,
                'name' => 'S\'assurer des prélèvements des frais selon les conditions de banque en vigueur ',
                'process_id' => 42,
                'scores' => NULL,
            ),
            98 =>
            array(
                'fields' => NULL,
                'id' => 126,
                'name' => 'S\'assurer que le client est avisé à temps au moyen d\'une lettre recommandée avec accusé de réception ',
                'process_id' => 42,
                'scores' => NULL,
            ),
            99 =>
            array(
                'fields' => NULL,
                'id' => 127,
                'name' => 'S\'assurer que les avoirs bloqués le demeurent jusqu\'à délivrance d\'une main levée, ou une ordonnance de la juridiction compétente prononçant après validation la sommation de payer au créancier les sommes saisies ',
                'process_id' => 42,
                'scores' => NULL,
            ),
            100 =>
            array(
                'fields' => NULL,
                'id' => 128,
                'name' => 'S\'assurer que la saisie arrêt judiciaire est signifiée par un huissier ',
                'process_id' => 42,
                'scores' => NULL,
            ),
            101 =>
            array(
                'fields' => NULL,
                'id' => 129,
                'name' => 'S\'assurer de L\'existence du registre y afférent et sa bonne tenue ',
                'process_id' => 43,
                'scores' => NULL,
            ),
            102 =>
            array(
                'fields' => NULL,
                'id' => 130,
                'name' => 'Vérifier les demandes d\'oppositions ( date d\'émission, n°chèque, n°de cpte de l\'émetteur, nom bénéficiaire, N°du BDC, motif, authentification de la signature…)     ',
                'process_id' => 43,
                'scores' => NULL,
            ),
            103 =>
            array(
                'fields' => NULL,
                'id' => 131,
                'name' => 'S\'assurer que l\'opposition est saisie sur système',
                'process_id' => 43,
                'scores' => NULL,
            ),
            104 =>
            array(
                'fields' => NULL,
                'id' => 132,
                'name' => 'S\'assurer des prélèvements des frais selon les conditions de banque en vigueur ',
                'process_id' => 43,
                'scores' => NULL,
            ),
            105 =>
            array(
                'fields' => NULL,
                'id' => 133,
                'name' => 'S\'assurer de la diffusion des oppositions via DRE et DEJC',
                'process_id' => 43,
                'scores' => NULL,
            ),
            106 =>
            array(
                'fields' => NULL,
                'id' => 134,
                'name' => 'S\'assurer que la restitution de la provision est intervenue suite à une main levée, lettre de garantie ou une décision de justice notifiée par un huissier (cas d\'un litige)',
                'process_id' => 43,
                'scores' => NULL,
            ),
            107 =>
            array(
                'fields' => NULL,
                'id' => 135,
                'name' => 'S\'assurer du respect de délai de l\'opposition (03 ans et 20 jours pour les chèques, 03 ans pour les BDC) ',
                'process_id' => 43,
                'scores' => NULL,
            ),
            108 =>
            array(
                'fields' => NULL,
                'id' => 136,
                'name' => 'Vérifier si l\'opposition du BDC est porté sur le feuillet n°1 du formulaire TI 34',
                'process_id' => 43,
                'scores' => NULL,
            ),
            109 =>
            array(
                'fields' => NULL,
                'id' => 137,
                'name' => 'Vérifier que les déclarations des incidents sont effectuées durant 02 jours ouvrables suivant la date de présentation du chèque ',
                'process_id' => 44,
                'scores' => NULL,
            ),
            110 =>
            array(
                'fields' => NULL,
                'id' => 138,
                'name' => 'Vérifier que les déclarations des régularisations des incidents sont effectuées (sans délais)',
                'process_id' => 44,
                'scores' => NULL,
            ),
            111 =>
            array(
                'fields' => NULL,
                'id' => 139,
                'name' => 'Vérifier que la première injonction a été transmise aux clients par lettre recommandée avec accusé de réception au plus tard J+4 ouvrable à compter de la date de présentation du chèque dans un délai de 10 jours  ',
                'process_id' => 44,
                'scores' => NULL,
            ),
            112 =>
            array(
                'fields' => NULL,
                'id' => 140,
                'name' => 'Vérifier que les clients interdits de chéquiers sont déclarés ',
                'process_id' => 44,
                'scores' => NULL,
            ),
            113 =>
            array(
                'fields' => NULL,
                'id' => 141,
                'name' => 'Vérifier que la deuxième lettre d\'injonction a été transmise au client pour régularisation de l\'incident de paiement dans un délai de 20 jours à compter de l\'expiration du premier délai légal   ',
                'process_id' => 44,
                'scores' => NULL,
            ),
            114 =>
            array(
                'fields' => NULL,
                'id' => 142,
                'name' => 'Vérifier que la déclaration d\'interdit de chéquier a été établie en cas de récidive "12 mois"',
                'process_id' => 44,
                'scores' => NULL,
            ),
            115 =>
            array(
                'fields' => NULL,
                'id' => 143,
                'name' => 'Vérifier l\'acquitement d\'une pénalité libératoire au profit du trésor (timbres fiscaux, quittances de paiement) pour les cas de régularisations durant le deuxième délai légal de 20 jours ',
                'process_id' => 44,
                'scores' => NULL,
            ),
            116 =>
            array(
                'fields' => NULL,
                'id' => 144,
                'name' => 'S\'assurer de l\'existence du registre y relatif et sa bonne tenue ',
                'process_id' => 45,
                'scores' => NULL,
            ),
            117 =>
            array(
                'fields' => NULL,
                'id' => 145,
                'name' => 'Vérifier la conformité entre le registre et les dossiers remis',
                'process_id' => 45,
                'scores' => NULL,
            ),
            118 =>
            array(
                'fields' => NULL,
                'id' => 146,
                'name' => 'Vérifier la constitution des dossiers ainsi que leur classement et leur conservation ',
                'process_id' => 45,
                'scores' => NULL,
            ),
            119 =>
            array(
                'fields' => NULL,
                'id' => 147,
                'name' => 'Vérifier que l\'agence a bloqué immediatement les avoirs du client décédé ',
                'process_id' => 45,
                'scores' => NULL,
            ),
            120 =>
            array(
                'fields' => NULL,
                'id' => 148,
                'name' => 'S\'assurer que la diffusion de la succession a été établie ',
                'process_id' => 45,
                'scores' => NULL,
            ),
            121 =>
            array(
                'fields' => NULL,
                'id' => 149,
                'name' => 'Sassurer de l\'arrêté comptable des comptes en capital et intérêt à la date du décés  ',
                'process_id' => 45,
                'scores' => NULL,
            ),
            122 =>
            array(
                'fields' => NULL,
                'id' => 150,
                'name' => 'la Transmission des CA2 et CA50 à la DRE en cas de liquidation de la succession ',
                'process_id' => 45,
                'scores' => NULL,
            ),
            123 =>
            array(
                'fields' => NULL,
                'id' => 151,
                'name' => 'S\'assurer du respect du délai de règlement de la succession (20 jours Max) ',
                'process_id' => 45,
                'scores' => NULL,
            ),
            124 =>
            array(
                'fields' => NULL,
                'id' => 152,
                'name' => 'Vérifier les mouvements du ou des comptes (les chèques et effets réglés doivent être émis avant la date du décés) ',
                'process_id' => 45,
                'scores' => NULL,
            ),
            125 =>
            array(
                'fields' => NULL,
                'id' => 153,
                'name' => 'S\'assurer qu\'à l\'issue du décompte les actifs détenus sont déclarés à la sous direction de wilaya des impôts directs au bureau de l\'enregistrement et du timbre ',
                'process_id' => 45,
                'scores' => NULL,
            ),
            126 =>
            array(
                'fields' => NULL,
                'id' => 154,
                'name' => 'Confronter le solde comptable avec les existances',
                'process_id' => 46,
                'scores' => NULL,
            ),
            127 =>
            array(
                'fields' => NULL,
                'id' => 155,
                'name' => 'Vérifier l\'existence d\'un planning de contrôle confidentiel  établie par le Directeur d\'Agence ',
                'process_id' => 46,
                'scores' => NULL,
            ),
            128 =>
            array(
                'fields' => NULL,
                'id' => 156,
                'name' => 'Vérifier la bonne tenue des registres des encaisses',
                'process_id' => 46,
                'scores' => NULL,
            ),
            129 =>
            array(
                'fields' => NULL,
                'id' => 157,
                'name' => 'Vérifier le respect du plafond d\'encaisse',
                'process_id' => 46,
                'scores' => NULL,
            ),
            130 =>
            array(
                'fields' => NULL,
                'id' => 158,
                'name' => 'Vérifier le respect des consignes de sécurités et de conservation des fonds',
                'process_id' => 46,
                'scores' => NULL,
            ),
            131 =>
            array(
                'fields' => NULL,
                'id' => 159,
                'name' => 'S\'assurer de l\'arrêté quotidien de DAB et GAB',
                'process_id' => 47,
                'scores' => NULL,
            ),
            132 =>
            array(
                'fields' => NULL,
                'id' => 160,
                'name' => 'Confronter le solde comptable avec les existences et le ticket papier',
                'process_id' => 47,
                'scores' => NULL,
            ),
            133 =>
            array(
                'fields' => NULL,
                'id' => 161,
                'name' => 'Vérifier la bonne tenue  des registres',
                'process_id' => 47,
                'scores' => NULL,
            ),
            134 =>
            array(
                'fields' => NULL,
                'id' => 162,
                'name' => 'Vérifier la bonne tennue des registres "envoi et réception des fonds"',
                'process_id' => 48,
                'scores' => NULL,
            ),
            135 =>
            array(
                'fields' => NULL,
                'id' => 163,
                'name' => 'Vérifier les dates de comptabilisation des envois et reception de fonds ',
                'process_id' => 48,
                'scores' => NULL,
            ),
            136 =>
            array(
                'fields' => NULL,
                'id' => 164,
                'name' => 'Vérifier l\'affichage de la liste des convoyeurs de fonds ',
                'process_id' => 48,
                'scores' => NULL,
            ),
            137 =>
            array(
                'fields' => NULL,
                'id' => 165,
                'name' => 'S\'assurer de l\'édition du journal de caisse CT1148',
                'process_id' => 49,
                'scores' => NULL,
            ),
            138 =>
            array(
                'fields' => NULL,
                'id' => 166,
                'name' => 'S\'assurer que le contrôle des journées comptables est effectué dans les délais ',
                'process_id' => 49,
                'scores' => NULL,
            ),
            139 =>
            array(
                'fields' => NULL,
                'id' => 168,
                'name' => 'Vérifier que les opérations annulées  ou abondonnées sont validées par la hiérarchie',
                'process_id' => 49,
                'scores' => NULL,
            ),
            140 =>
            array(
                'fields' => NULL,
                'id' => 169,
                'name' => 'Vérifier que les contrôles relatifs à l’identification,la conformité des mentions obligatoires et de la signature de la clientèle sont effectuées et matérialisés ',
                'process_id' => 50,
                'scores' => NULL,
            ),
            141 =>
            array(
                'fields' => NULL,
                'id' => 170,
                'name' => 'Vérifier que la demande d\'accord de paiement à distance via un E-mail ou fax a été établie pour les retraits déplacés',
                'process_id' => 50,
                'scores' => NULL,
            ),
            142 =>
            array(
                'fields' => NULL,
                'id' => 171,
                'name' => 'Vérifier que les formulaires de retrait CA 263 sur compte livret sont dûment renseignés et signés',
                'process_id' => 50,
                'scores' => NULL,
            ),
            143 =>
            array(
                'fields' => NULL,
                'id' => 172,
                'name' => 'Vérifier que les contrôles hièrarchiques sont réalisés et matérialisés sur les retraits plafonnés',
                'process_id' => 50,
                'scores' => NULL,
            ),
            144 =>
            array(
                'fields' => NULL,
                'id' => 173,
                'name' => 'S\'assurer que la signature du responsable habilité est  apposée sur les formulaires de retrait concernant les comptes livrets épargne et chèque',
                'process_id' => 50,
                'scores' => NULL,
            ),
            145 =>
            array(
                'fields' => NULL,
                'id' => 174,
                'name' => 'Vérifier que les bordereaux de retrait sont signés par le guichetier et le client',
                'process_id' => 50,
                'scores' => NULL,
            ),
            146 =>
            array(
                'fields' => NULL,
                'id' => 175,
                'name' => 'Vérifier la conformité des opérations de retraits comptabilisés',
                'process_id' => 50,
                'scores' => NULL,
            ),
            147 =>
            array(
                'fields' => NULL,
                'id' => 176,
                'name' => 'Vérifier que les operations de retraits annulées sont validées par le résponsable hiérarchique',
                'process_id' => 50,
                'scores' => NULL,
            ),
            148 =>
            array(
                'fields' => NULL,
                'id' => 177,
                'name' => 'Vérifier que les formulaires de retrait CA 264 sur compte devise sont dûment renseignés et signés',
                'process_id' => 51,
                'scores' => NULL,
            ),
            149 =>
            array(
                'fields' => NULL,
                'id' => 178,
                'name' => 'Vérifier que les contrôles hièrarchiques sont réalisés et matérialisés sur les retraits plafonnés',
                'process_id' => 51,
                'scores' => NULL,
            ),
            150 =>
            array(
                'fields' => NULL,
                'id' => 179,
                'name' => 'Vérifier la conformité des opérations comptabilisés',
                'process_id' => 51,
                'scores' => NULL,
            ),
            151 =>
            array(
                'fields' => NULL,
                'id' => 180,
                'name' => 'Vérifier que les operations annulées sont validées par le résponsable hiérarchique',
                'process_id' => 51,
                'scores' => NULL,
            ),
            152 =>
            array(
                'fields' => NULL,
                'id' => 181,
                'name' => 'S\'assurer que le détail de monnaie CA30 est dûment renseigné et signé',
                'process_id' => 52,
                'scores' => NULL,
            ),
            153 =>
            array(
                'fields' => NULL,
                'id' => 182,
                'name' => 'Vérifier la conformité des opérations comptabilisés',
                'process_id' => 52,
                'scores' => NULL,
            ),
            154 =>
            array(
                'fields' => NULL,
                'id' => 183,
                'name' => 'Vérifier que les operations annulées sont validées par le résponsable hiérarchique',
                'process_id' => 52,
                'scores' => NULL,
            ),
            155 =>
            array(
                'fields' => NULL,
                'id' => 184,
                'name' => 'Vérifier que le registre de chèque de banque est bien tenu et mis à jours ',
                'process_id' => 53,
                'scores' => NULL,
            ),
            156 =>
            array(
                'fields' => NULL,
                'id' => 185,
                'name' => 'Vérifier que la demande de délivrance de chèque de banque est bien renseigné, signé, authentification de la signature et apposition du cachet accusé de reception',
                'process_id' => 53,
                'scores' => NULL,
            ),
            157 =>
            array(
                'fields' => NULL,
                'id' => 186,
                'name' => 'S\'assurer de la conformité de l\'opération "constitution de la provision, perception de la commission, respect chronologique de la numérotation des chèques de banque délivrés  ',
                'process_id' => 53,
                'scores' => NULL,
            ),
            158 =>
            array(
                'fields' => NULL,
                'id' => 187,
                'name' => 'S\'assurer que les souches de chèques de banque sont renseigné visé par un responsable et bien conservé   ',
                'process_id' => 53,
                'scores' => NULL,
            ),
            159 =>
            array(
                'fields' => NULL,
                'id' => 188,
                'name' => 'S\'assurer que les différents états sont transmis à la DRE et à la direction de la wilaya des impôt pour les clients de passage',
                'process_id' => 53,
                'scores' => NULL,
            ),
            160 =>
            array(
                'fields' => NULL,
                'id' => 189,
                'name' => 'S\'assurer que les chèques de banques ayant dépassés les 03 ans et 20 jours sont traités ',
                'process_id' => 53,
                'scores' => NULL,
            ),
            161 =>
            array(
                'fields' => NULL,
                'id' => 190,
                'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                'process_id' => 53,
                'scores' => NULL,
            ),
            162 =>
            array(
                'fields' => NULL,
                'id' => 191,
                'name' => 'S\'assurer que les différents états sont édités et exploités ',
                'process_id' => 53,
                'scores' => NULL,
            ),
            163 =>
            array(
                'fields' => NULL,
                'id' => 192,
                'name' => 'Vérifier la complétude du dossier de prélèvement ',
                'process_id' => 54,
                'scores' => NULL,
            ),
            164 =>
            array(
                'fields' => NULL,
                'id' => 193,
                'name' => 'Vérifier que l\'agence a notifié sa décision au client',
                'process_id' => 54,
                'scores' => NULL,
            ),
            165 =>
            array(
                'fields' => NULL,
                'id' => 194,
                'name' => 'Vérifier que les commissions de gestion de prélèvement ont été prélevés selon les conditions de banques en vigueur  ',
                'process_id' => 54,
                'scores' => NULL,
            ),
            166 =>
            array(
                'fields' => NULL,
                'id' => 195,
                'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                'process_id' => 54,
                'scores' => NULL,
            ),
            167 =>
            array(
                'fields' => NULL,
                'id' => 196,
                'name' => 'S\'assurer que les différents états sont édités et exploités ',
                'process_id' => 54,
                'scores' => NULL,
            ),
            168 =>
            array(
                'fields' => NULL,
                'id' => 197,
                'name' => 'Vérifier que les bordereaux PF37 ou PF 229 sont bien renseignés et signés par le client authentification de la signature et apposition du cachet accusé de reception',
                'process_id' => 55,
                'scores' => NULL,
            ),
            169 =>
            array(
                'fields' => NULL,
                'id' => 198,
                'name' => 'S\'assurer que les effets escomptés sont conformes à l\'autorisation de crédit ',
                'process_id' => 55,
                'scores' => NULL,
            ),
            170 =>
            array(
                'fields' => NULL,
                'id' => 199,
                'name' => 'Vérifier la bonne tenue et la mise à jour du regsirtre,',
                'process_id' => 55,
                'scores' => NULL,
            ),
            171 =>
            array(
                'fields' => NULL,
                'id' => 200,
                'name' => 'Vérifier les conditions de conservation des effets ',
                'process_id' => 55,
                'scores' => NULL,
            ),
            172 =>
            array(
                'fields' => NULL,
                'id' => 201,
                'name' => 'Vérifier que les différentes éditions sont exploitées notamment les rejets ',
                'process_id' => 55,
                'scores' => NULL,
            ),
            173 =>
            array(
                'fields' => NULL,
                'id' => 202,
                'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                'process_id' => 55,
                'scores' => NULL,
            ),
            174 =>
            array(
                'fields' => NULL,
                'id' => 203,
                'name' => 'S\'assurer que les différents états sont édités et exploités ',
                'process_id' => 55,
                'scores' => NULL,
            ),
            175 =>
            array(
                'fields' => NULL,
                'id' => 204,
                'name' => 'S\'assurer que les ordres de virements sont bien renseignés et signés ',
                'process_id' => 56,
                'scores' => NULL,
            ),
            176 =>
            array(
                'fields' => NULL,
                'id' => 205,
                'name' => 'S\'assurer du rapprochement entre les états SI, les ordres de virements, rejets sur compte interne 0064,000,170 se fait ',
                'process_id' => 56,
                'scores' => NULL,
            ),
            177 =>
            array(
                'fields' => NULL,
                'id' => 206,
                'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                'process_id' => 56,
                'scores' => NULL,
            ),
            178 =>
            array(
                'fields' => NULL,
                'id' => 207,
                'name' => 'S\'assurer que les différents états sont édités et exploités ',
                'process_id' => 56,
                'scores' => NULL,
            ),
            179 =>
            array(
                'fields' => NULL,
                'id' => 208,
                'name' => 'Vérifier que les ordres de virements sont bien renseignés et signés',
                'process_id' => 57,
                'scores' => NULL,
            ),
            180 =>
            array(
                'fields' => NULL,
                'id' => 209,
                'name' => 'Vérifier que les ordres de virements sont enregistrés ',
                'process_id' => 57,
                'scores' => NULL,
            ),
            181 =>
            array(
                'fields' => NULL,
                'id' => 210,
                'name' => 'S\'assurer de la prise en charge des états de rejets ',
                'process_id' => 57,
                'scores' => NULL,
            ),
            182 =>
            array(
                'fields' => NULL,
                'id' => 211,
                'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                'process_id' => 57,
                'scores' => NULL,
            ),
            183 =>
            array(
                'fields' => NULL,
                'id' => 212,
                'name' => 'S\'assurer que les différents états sont édités et exploités ',
                'process_id' => 57,
                'scores' => NULL,
            ),
            184 =>
            array(
                'fields' => NULL,
                'id' => 213,
                'name' => 'Vérifier que les états édités sont exploités',
                'process_id' => 58,
                'scores' => NULL,
            ),
            185 =>
            array(
                'fields' => NULL,
                'id' => 214,
                'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                'process_id' => 58,
                'scores' => NULL,
            ),
            186 =>
            array(
                'fields' => NULL,
                'id' => 215,
                'name' => 'S\'assurer que les différents états sont édités et exploités ',
                'process_id' => 58,
                'scores' => NULL,
            ),
            187 =>
            array(
                'fields' => NULL,
                'id' => 216,
                'name' => 'Vérifier le bon remplissage du formulaire PF34 ',
                'process_id' => 59,
                'scores' => NULL,
            ),
            188 =>
            array(
                'fields' => NULL,
                'id' => 217,
                'name' => 'Vérifier que les différentes états sont édités et exploitées ',
                'process_id' => 59,
                'scores' => NULL,
            ),
            189 =>
            array(
                'fields' => NULL,
                'id' => 218,
                'name' => 'S\'assurer que les vignettes physiques ont été transmis  ',
                'process_id' => 59,
                'scores' => NULL,
            ),
            190 =>
            array(
                'fields' => NULL,
                'id' => 219,
                'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                'process_id' => 59,
                'scores' => NULL,
            ),
            191 =>
            array(
                'fields' => NULL,
                'id' => 220,
                'name' => 'S\'assurer que les différents états sont édités et exploités ',
                'process_id' => 59,
                'scores' => NULL,
            ),
            192 =>
            array(
                'fields' => NULL,
                'id' => 221,
                'name' => 'Vérifier que les états édités sont exploités',
                'process_id' => 60,
                'scores' => NULL,
            ),
            193 =>
            array(
                'fields' => NULL,
                'id' => 222,
                'name' => 'S\'assurer que les vignettes physiques ont été réclamées ',
                'process_id' => 60,
                'scores' => NULL,
            ),
            194 =>
            array(
                'fields' => NULL,
                'id' => 223,
                'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                'process_id' => 60,
                'scores' => NULL,
            ),
            195 =>
            array(
                'fields' => NULL,
                'id' => 224,
                'name' => 'S\'assurer que les différents états sont édités et exploités ',
                'process_id' => 60,
                'scores' => NULL,
            ),
            196 =>
            array(
                'fields' => NULL,
                'id' => 225,
                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents éxigés par la banque ',
                'process_id' => 62,
                'scores' => NULL,
            ),
            197 =>
            array(
                'fields' => NULL,
                'id' => 226,
                'name' => 'Vérifier que le récépissé de dépôt de crédit est établi ',
                'process_id' => 62,
                'scores' => NULL,
            ),
            198 =>
            array(
                'fields' => NULL,
                'id' => 227,
                'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                'process_id' => 62,
                'scores' => NULL,
            ),
            199 =>
            array(
                'fields' => NULL,
                'id' => 228,
                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée ainsi que la réponse de cette dernière ',
                'process_id' => 62,
                'scores' => NULL,
            ),
            200 =>
            array(
                'fields' => NULL,
                'id' => 229,
                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                'process_id' => 62,
                'scores' => NULL,
            ),
            201 =>
            array(
                'fields' => NULL,
                'id' => 230,
                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées ',
                'process_id' => 62,
                'scores' => NULL,
            ),
            202 =>
            array(
                'fields' => NULL,
                'id' => 231,
                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                'process_id' => 63,
                'scores' => NULL,
            ),
            203 =>
            array(
                'fields' => NULL,
                'id' => 232,
                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                'process_id' => 63,
                'scores' => NULL,
            ),
            204 =>
            array(
                'fields' => NULL,
                'id' => 233,
                'name' => 'Vérifier que le ticket d\'autorisation est établi sur la base d\'un PV de comité ',
                'process_id' => 63,
                'scores' => NULL,
            ),
            205 =>
            array(
                'fields' => NULL,
                'id' => 234,
                'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                'process_id' => 63,
                'scores' => NULL,
            ),
            206 =>
            array(
                'fields' => NULL,
                'id' => 235,
                'name' => 'Vérifier que le registre de notification du crédit accordé ou rejeté est tenu, mis à jour et bien renseigné ',
                'process_id' => 63,
                'scores' => NULL,
            ),
            207 =>
            array(
                'fields' => NULL,
                'id' => 236,
                'name' => 'Vérifier que la convention de prêt est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                'process_id' => 64,
                'scores' => NULL,
            ),
            208 =>
            array(
                'fields' => NULL,
                'id' => 237,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevés conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                'process_id' => 64,
                'scores' => NULL,
            ),
            209 =>
            array(
                'fields' => NULL,
                'id' => 238,
                'name' => 'S\'assurer de la domiciliation préalable du salaire',
                'process_id' => 64,
                'scores' => NULL,
            ),
            210 =>
            array(
                'fields' => NULL,
                'id' => 239,
                'name' => 'S\'assurer du recueil de l\'attestation de disponibilité du véhicule',
                'process_id' => 64,
                'scores' => NULL,
            ),
            211 =>
            array(
                'fields' => NULL,
                'id' => 240,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                'process_id' => 65,
                'scores' => NULL,
            ),
            212 =>
            array(
                'fields' => NULL,
                'id' => 241,
                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties)   ',
                'process_id' => 65,
                'scores' => NULL,
            ),
            213 =>
            array(
                'fields' => NULL,
                'id' => 242,
                'name' => 'S\'assurer de la délivrance d\'un chèque de banque à l\'ordre du concessionaire, sous présentation des pièces justificatives (engagement du gage du véhicule au profit de la banque)',
                'process_id' => 65,
                'scores' => NULL,
            ),
            214 =>
            array(
                'fields' => NULL,
                'id' => 243,
                'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                'process_id' => 65,
                'scores' => NULL,
            ),
            215 =>
            array(
                'fields' => NULL,
                'id' => 244,
                'name' => 'Vérifier que l\'agence a effectué la déclaration à la centrale des risques',
                'process_id' => 65,
                'scores' => NULL,
            ),
            216 =>
            array(
                'fields' => NULL,
                'id' => 245,
                'name' => 'S\'assurer du recueil des garanties à postériori (gage, Assurance tous risques avec subrogation)',
                'process_id' => 66,
                'scores' => NULL,
            ),
            217 =>
            array(
                'fields' => NULL,
                'id' => 246,
                'name' => ' S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé.',
                'process_id' => 67,
                'scores' => NULL,
            ),
            218 =>
            array(
                'fields' => NULL,
                'id' => 247,
                'name' => 'S\'assurer que la procédure de succession est appliquée suivant la règlementation ',
                'process_id' => 68,
                'scores' => NULL,
            ),
            219 =>
            array(
                'fields' => NULL,
                'id' => 248,
                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque',
                'process_id' => 69,
                'scores' => NULL,
            ),
            220 =>
            array(
                'fields' => NULL,
                'id' => 249,
                'name' => 'Vérifier que le récépissé de dépôt de crédit est établi ',
                'process_id' => 69,
                'scores' => NULL,
            ),
            221 =>
            array(
                'fields' => NULL,
                'id' => 250,
                'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                'process_id' => 69,
                'scores' => NULL,
            ),
            222 =>
            array(
                'fields' => NULL,
                'id' => 251,
                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette dernière ',
                'process_id' => 69,
                'scores' => NULL,
            ),
            223 =>
            array(
                'fields' => NULL,
                'id' => 252,
                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                'process_id' => 69,
                'scores' => NULL,
            ),
            224 =>
            array(
                'fields' => NULL,
                'id' => 253,
                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées ',
                'process_id' => 69,
                'scores' => NULL,
            ),
            225 =>
            array(
                'fields' => NULL,
                'id' => 254,
                'name' => 'S\'assurer du respect des pouvoirs de délégation (Comité agence, DRE, central)',
                'process_id' => 70,
                'scores' => NULL,
            ),
            226 =>
            array(
                'fields' => NULL,
                'id' => 255,
                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                'process_id' => 70,
                'scores' => NULL,
            ),
            227 =>
            array(
                'fields' => NULL,
                'id' => 256,
                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                'process_id' => 70,
                'scores' => NULL,
            ),
            228 =>
            array(
                'fields' => NULL,
                'id' => 257,
                'name' => 'Vérifier que le ticket d\'autorisation est établi sur la base d\'un PV de comité ',
                'process_id' => 70,
                'scores' => NULL,
            ),
            229 =>
            array(
                'fields' => NULL,
                'id' => 258,
                'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                'process_id' => 70,
                'scores' => NULL,
            ),
            230 =>
            array(
                'fields' => NULL,
                'id' => 259,
                'name' => 'Vérifier que le registre de notification du crédit accordé ou rejeté est tenu, mis à jour et bien renseigné ',
                'process_id' => 70,
                'scores' => NULL,
            ),
            231 =>
            array(
                'fields' => NULL,
                'id' => 260,
                'name' => 'Vérifier que la convention de prêt est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                'process_id' => 71,
                'scores' => NULL,
            ),
            232 =>
            array(
                'fields' => NULL,
                'id' => 261,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevés conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                'process_id' => 71,
                'scores' => NULL,
            ),
            233 =>
            array(
                'fields' => NULL,
                'id' => 262,
                'name' => 's\'assurer de la domiciliation préalable du salaire',
                'process_id' => 71,
                'scores' => NULL,
            ),
            234 =>
            array(
                'fields' => NULL,
                'id' => 263,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                'process_id' => 72,
                'scores' => NULL,
            ),
            235 =>
            array(
                'fields' => NULL,
                'id' => 264,
                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                'process_id' => 72,
                'scores' => NULL,
            ),
            236 =>
            array(
                'fields' => NULL,
                'id' => 265,
                'name' => 'S\'assurer de la délivrance d\'un chèque de banque à l\'ordre du fournisseur, sous présentation des pièces justificatives.',
                'process_id' => 72,
                'scores' => NULL,
            ),
            237 =>
            array(
                'fields' => NULL,
                'id' => 266,
                'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                'process_id' => 72,
                'scores' => NULL,
            ),
            238 =>
            array(
                'fields' => NULL,
                'id' => 267,
                'name' => 'Vérifier que l\'agence a effectué la déclaration à la centrale des risques',
                'process_id' => 72,
                'scores' => NULL,
            ),
            239 =>
            array(
                'fields' => NULL,
                'id' => 268,
                'name' => ' S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé.',
                'process_id' => 73,
                'scores' => NULL,
            ),
            240 =>
            array(
                'fields' => NULL,
                'id' => 269,
                'name' => 'S\'assurer que la procédure de succession est appliquée suivant la règlementation ',
                'process_id' => 74,
                'scores' => NULL,
            ),
            241 =>
            array(
                'fields' => NULL,
                'id' => 270,
                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque ',
                'process_id' => 75,
                'scores' => NULL,
            ),
            242 =>
            array(
                'fields' => NULL,
                'id' => 271,
                'name' => 'Vérifier que le récépissé de dépôt (provisoire, définitif) de crédit est établi ',
                'process_id' => 75,
                'scores' => NULL,
            ),
            243 =>
            array(
                'fields' => NULL,
                'id' => 272,
                'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                'process_id' => 75,
                'scores' => NULL,
            ),
            244 =>
            array(
                'fields' => NULL,
                'id' => 273,
                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la reponse de cette dernière  ',
                'process_id' => 75,
                'scores' => NULL,
            ),
            245 =>
            array(
                'fields' => NULL,
                'id' => 274,
                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                'process_id' => 75,
                'scores' => NULL,
            ),
            246 =>
            array(
                'fields' => NULL,
                'id' => 275,
                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées ',
                'process_id' => 75,
                'scores' => NULL,
            ),
            247 =>
            array(
                'fields' => NULL,
                'id' => 276,
                'name' => 'S\'assurer du respect des pouvoirs de délégation (Comité agence, DRE, central)',
                'process_id' => 76,
                'scores' => NULL,
            ),
            248 =>
            array(
                'fields' => NULL,
                'id' => 277,
                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                'process_id' => 76,
                'scores' => NULL,
            ),
            249 =>
            array(
                'fields' => NULL,
                'id' => 278,
                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                'process_id' => 76,
                'scores' => NULL,
            ),
            250 =>
            array(
                'fields' => NULL,
                'id' => 279,
                'name' => 'Vérifier que le ticket d\'autorisation est établi sur la base d\'un PV de comité ',
                'process_id' => 76,
                'scores' => NULL,
            ),
            251 =>
            array(
                'fields' => NULL,
                'id' => 280,
                'name' => 's\'assurer que le taux d\'interêt est appliqué selon le niveau du revenu net mensuel',
                'process_id' => 76,
                'scores' => NULL,
            ),
            252 =>
            array(
                'fields' => NULL,
                'id' => 281,
                'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                'process_id' => 76,
                'scores' => NULL,
            ),
            253 =>
            array(
                'fields' => NULL,
                'id' => 282,
                'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                'process_id' => 77,
                'scores' => NULL,
            ),
            254 =>
            array(
                'fields' => NULL,
                'id' => 283,
                'name' => 'Vérifier que la convention de prêt est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                'process_id' => 77,
                'scores' => NULL,
            ),
            255 =>
            array(
                'fields' => NULL,
                'id' => 284,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevés conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                'process_id' => 77,
                'scores' => NULL,
            ),
            256 =>
            array(
                'fields' => NULL,
                'id' => 285,
                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                'process_id' => 77,
                'scores' => NULL,
            ),
            257 =>
            array(
                'fields' => NULL,
                'id' => 286,
                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                'process_id' => 77,
                'scores' => NULL,
            ),
            258 =>
            array(
                'fields' => NULL,
                'id' => 287,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                'process_id' => 78,
                'scores' => NULL,
            ),
            259 =>
            array(
                'fields' => NULL,
                'id' => 288,
                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                'process_id' => 78,
                'scores' => NULL,
            ),
            260 =>
            array(
                'fields' => NULL,
                'id' => 289,
                'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                'process_id' => 78,
                'scores' => NULL,
            ),
            261 =>
            array(
                'fields' => NULL,
                'id' => 290,
                'name' => 'Vérifier la mobilisation du crédit a été effectuée selon les modalités d\'acquisition et de paiement du logement ',
                'process_id' => 78,
                'scores' => NULL,
            ),
            262 =>
            array(
                'fields' => NULL,
                'id' => 291,
                'name' => 'Vérifier que l\'agence a effectué la déclaration à la centrale des risques',
                'process_id' => 78,
                'scores' => NULL,
            ),
            263 =>
            array(
                'fields' => NULL,
                'id' => 292,
                'name' => 'S\'assurer que le suivi des granties à postériori sont effectués et validées',
                'process_id' => 79,
                'scores' => NULL,
            ),
            264 =>
            array(
                'fields' => NULL,
                'id' => 293,
                'name' => 'S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé ',
                'process_id' => 80,
                'scores' => NULL,
            ),
            265 =>
            array(
                'fields' => NULL,
                'id' => 294,
                'name' => 'S\'assurer si l\'indemnité de 04% sur le solde restant a été payé en cas de remboursement par anticipation ',
                'process_id' => 80,
                'scores' => NULL,
            ),
            266 =>
            array(
                'fields' => NULL,
                'id' => 295,
                'name' => 'Vérifier que le capital restant a été viré au compte CCIR en cas du décés de l\'emprunteur ou du conjoint (co-emprunteur)',
                'process_id' => 81,
                'scores' => NULL,
            ),
            267 =>
            array(
                'fields' => NULL,
                'id' => 296,
                'name' => 'Vérifier que le délai global de la déclaration du sinistre n\'a pas dépassé les 90 jours après sa date de survenance ',
                'process_id' => 81,
                'scores' => NULL,
            ),
            268 =>
            array(
                'fields' => NULL,
                'id' => 297,
                'name' => 'S\'assurer que la demande a été établie par le client et validée par la DRE',
                'process_id' => 82,
                'scores' => NULL,
            ),
            269 =>
            array(
                'fields' => NULL,
                'id' => 298,
                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents fournis par le client ',
                'process_id' => 83,
                'scores' => NULL,
            ),
            270 =>
            array(
                'fields' => NULL,
                'id' => 299,
                'name' => 'Vérifier que le récépissé de dépôt de crédit est établi ',
                'process_id' => 83,
                'scores' => NULL,
            ),
            271 =>
            array(
                'fields' => NULL,
                'id' => 300,
                'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                'process_id' => 83,
                'scores' => NULL,
            ),
            272 =>
            array(
                'fields' => NULL,
                'id' => 301,
                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée ainsi que la réponse de cette dernière ',
                'process_id' => 83,
                'scores' => NULL,
            ),
            273 =>
            array(
                'fields' => NULL,
                'id' => 302,
                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                'process_id' => 83,
                'scores' => NULL,
            ),
            274 =>
            array(
                'fields' => NULL,
                'id' => 303,
                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées ',
                'process_id' => 83,
                'scores' => NULL,
            ),
            275 =>
            array(
                'fields' => NULL,
                'id' => 304,
                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                'process_id' => 84,
                'scores' => NULL,
            ),
            276 =>
            array(
                'fields' => NULL,
                'id' => 305,
                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                'process_id' => 84,
                'scores' => NULL,
            ),
            277 =>
            array(
                'fields' => NULL,
                'id' => 306,
                'name' => 'Vérifier que le ticket d\'autorisation est établi sur la base d\'un PV de comité ',
                'process_id' => 84,
                'scores' => NULL,
            ),
            278 =>
            array(
                'fields' => NULL,
                'id' => 307,
                'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                'process_id' => 84,
                'scores' => NULL,
            ),
            279 =>
            array(
                'fields' => NULL,
                'id' => 308,
                'name' => 'Vérifier que le registre de notification du crédit accordé ou rejeté est tenu, mis à jour et bien renseigné ',
                'process_id' => 84,
                'scores' => NULL,
            ),
            280 =>
            array(
                'fields' => NULL,
                'id' => 309,
                'name' => 'Vérifier que la convention de prêt est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                'process_id' => 85,
                'scores' => NULL,
            ),
            281 =>
            array(
                'fields' => NULL,
                'id' => 310,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevés conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                'process_id' => 85,
                'scores' => NULL,
            ),
            282 =>
            array(
                'fields' => NULL,
                'id' => 311,
                'name' => 'S\'assurer de la domiciliation préalable du salaire',
                'process_id' => 85,
                'scores' => NULL,
            ),
            283 =>
            array(
                'fields' => NULL,
                'id' => 312,
                'name' => 'S\'assurer de l\'existence de l\'engagement de location ',
                'process_id' => 85,
                'scores' => NULL,
            ),
            284 =>
            array(
                'fields' => NULL,
                'id' => 313,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                'process_id' => 86,
                'scores' => NULL,
            ),
            285 =>
            array(
                'fields' => NULL,
                'id' => 314,
                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                'process_id' => 86,
                'scores' => NULL,
            ),
            286 =>
            array(
                'fields' => NULL,
                'id' => 315,
                'name' => 'S\'assurer de la délivrance d\'un chèque de banque à l\'ordre du notaire, sous présentation des pièces justificatives.',
                'process_id' => 86,
                'scores' => NULL,
            ),
            287 =>
            array(
                'fields' => NULL,
                'id' => 316,
                'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                'process_id' => 86,
                'scores' => NULL,
            ),
            288 =>
            array(
                'fields' => NULL,
                'id' => 317,
                'name' => 'Vérifier que l\'agence a effectué la déclaration à la centrale des risques',
                'process_id' => 86,
                'scores' => NULL,
            ),
            289 =>
            array(
                'fields' => NULL,
                'id' => 318,
                'name' => 'S\'assurer de l\'enregistrement du contrat de location auprès de l\'administration habilitée',
                'process_id' => 87,
                'scores' => NULL,
            ),
            290 =>
            array(
                'fields' => NULL,
                'id' => 319,
                'name' => ' S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé.',
                'process_id' => 88,
                'scores' => NULL,
            ),
            291 =>
            array(
                'fields' => NULL,
                'id' => 320,
                'name' => 'S\'assurer que la procédure de succession est appliquée suivant la règlementation ',
                'process_id' => 89,
                'scores' => NULL,
            ),
            292 =>
            array(
                'fields' => NULL,
                'id' => 321,
                'name' => 'Vérifier que les activités financées rentre bien dans le cadre des activités finançables par la banque',
                'process_id' => 90,
                'scores' => NULL,
            ),
            293 =>
            array(
                'fields' => NULL,
                'id' => 322,
                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque',
                'process_id' => 90,
                'scores' => NULL,
            ),
            294 =>
            array(
                'fields' => NULL,
                'id' => 323,
                'name' => 'Vérifier que le récépissé de dépôt (provisoire, définitif) de crédit est établi et correspond au type de crédit ',
                'process_id' => 90,
                'scores' => NULL,
            ),
            295 =>
            array(
                'fields' => NULL,
                'id' => 324,
                'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                'process_id' => 90,
                'scores' => NULL,
            ),
            296 =>
            array(
                'fields' => NULL,
                'id' => 325,
                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette structure  ',
                'process_id' => 90,
                'scores' => NULL,
            ),
            297 =>
            array(
                'fields' => NULL,
                'id' => 326,
                'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122 ',
                'process_id' => 90,
                'scores' => NULL,
            ),
            298 =>
            array(
                'fields' => NULL,
                'id' => 327,
                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                'process_id' => 90,
                'scores' => NULL,
            ),
            299 =>
            array(
                'fields' => NULL,
                'id' => 328,
                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées',
                'process_id' => 90,
                'scores' => NULL,
            ),
            300 =>
            array(
                'fields' => NULL,
                'id' => 329,
                'name' => 'S\'assurer du respect des pouvoirs de délégation (Comité agence, DRE, central)',
                'process_id' => 91,
                'scores' => NULL,
            ),
            301 =>
            array(
                'fields' => NULL,
                'id' => 330,
                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                'process_id' => 91,
                'scores' => NULL,
            ),
            302 =>
            array(
                'fields' => NULL,
                'id' => 331,
                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                'process_id' => 91,
                'scores' => NULL,
            ),
            303 =>
            array(
                'fields' => NULL,
                'id' => 332,
                'name' => 'Vérifier que le ticket d\'autorisation est établi sur la base d\'un PV de comité ',
                'process_id' => 91,
                'scores' => NULL,
            ),
            304 =>
            array(
                'fields' => NULL,
                'id' => 333,
                'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                'process_id' => 91,
                'scores' => NULL,
            ),
            305 =>
            array(
                'fields' => NULL,
                'id' => 334,
                'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                'process_id' => 92,
                'scores' => NULL,
            ),
            306 =>
            array(
                'fields' => NULL,
                'id' => 335,
                'name' => 'Vérifier que la convention de prêt est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                'process_id' => 92,
                'scores' => NULL,
            ),
            307 =>
            array(
                'fields' => NULL,
                'id' => 336,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevés conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                'process_id' => 92,
                'scores' => NULL,
            ),
            308 =>
            array(
                'fields' => NULL,
                'id' => 337,
                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                'process_id' => 92,
                'scores' => NULL,
            ),
            309 =>
            array(
                'fields' => NULL,
                'id' => 338,
                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                'process_id' => 92,
                'scores' => NULL,
            ),
            310 =>
            array(
                'fields' => NULL,
                'id' => 339,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                'process_id' => 93,
                'scores' => NULL,
            ),
            311 =>
            array(
                'fields' => NULL,
                'id' => 340,
                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                'process_id' => 93,
                'scores' => NULL,
            ),
            312 =>
            array(
                'fields' => NULL,
                'id' => 341,
                'name' => 'Vérifier que le tableau d’amortissement  est établis, signé par le client, et le directeur d\'agence',
                'process_id' => 93,
                'scores' => NULL,
            ),
            313 =>
            array(
                'fields' => NULL,
                'id' => 342,
                'name' => 'Vérifier que l\'agence a effectué la déclaration à la centrale des risques',
                'process_id' => 93,
                'scores' => NULL,
            ),
            314 =>
            array(
                'fields' => NULL,
                'id' => 343,
                'name' => 'S\'assurer que les garanties mentionnées sur le ticket d\'autorisation sont recueillies ',
                'process_id' => 94,
                'scores' => NULL,
            ),
            315 =>
            array(
                'fields' => NULL,
                'id' => 344,
                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                'process_id' => 94,
                'scores' => NULL,
            ),
            316 =>
            array(
                'fields' => NULL,
                'id' => 345,
                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                'process_id' => 94,
                'scores' => NULL,
            ),
            317 =>
            array(
                'fields' => NULL,
                'id' => 346,
                'name' => 'S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé ',
                'process_id' => 95,
                'scores' => NULL,
            ),
            318 =>
            array(
                'fields' => NULL,
                'id' => 347,
                'name' => 'S\'assurer que la visite sur site après réalisation du projet est effectuée ',
                'process_id' => 95,
                'scores' => NULL,
            ),
            319 =>
            array(
                'fields' => NULL,
                'id' => 348,
                'name' => 'S\'assurer que la procédure de succession est appliquée suivant la règlementation ',
                'process_id' => 96,
                'scores' => NULL,
            ),
            320 =>
            array(
                'fields' => NULL,
                'id' => 349,
                'name' => 'S\'assurer que la demande a été établie par le client et validée par la DRE',
                'process_id' => 97,
                'scores' => NULL,
            ),
            321 =>
            array(
                'fields' => NULL,
                'id' => 350,
                'name' => 'Vérifier que les activités financées rentre bien dans le cadre des activités finançables par la banque',
                'process_id' => 98,
                'scores' => NULL,
            ),
            322 =>
            array(
                'fields' => NULL,
                'id' => 351,
                'name' => 'S\'assurer des conditions d\'éligibilité des professionnels à l\'octroi du crédit',
                'process_id' => 98,
                'scores' => NULL,
            ),
            323 =>
            array(
                'fields' => NULL,
                'id' => 352,
                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque',
                'process_id' => 98,
                'scores' => NULL,
            ),
            324 =>
            array(
                'fields' => NULL,
                'id' => 353,
                'name' => 'Vérifier que le récépissé de dépôt de crédit est établi ',
                'process_id' => 98,
                'scores' => NULL,
            ),
            325 =>
            array(
                'fields' => NULL,
                'id' => 354,
                'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                'process_id' => 98,
                'scores' => NULL,
            ),
            326 =>
            array(
                'fields' => NULL,
                'id' => 355,
                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée ainsi que la réponse de cette dernière',
                'process_id' => 98,
                'scores' => NULL,
            ),
            327 =>
            array(
                'fields' => NULL,
                'id' => 356,
                'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122 et/ou un rapport d\'expertise',
                'process_id' => 98,
                'scores' => NULL,
            ),
            328 =>
            array(
                'fields' => NULL,
                'id' => 357,
                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                'process_id' => 98,
                'scores' => NULL,
            ),
            329 =>
            array(
                'fields' => NULL,
                'id' => 358,
                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées ',
                'process_id' => 98,
                'scores' => NULL,
            ),
            330 =>
            array(
                'fields' => NULL,
                'id' => 359,
                'name' => 'S\'assurer du respect des pouvoirs de délégation (Comité agence, DRE, central)',
                'process_id' => 99,
                'scores' => NULL,
            ),
            331 =>
            array(
                'fields' => NULL,
                'id' => 360,
                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                'process_id' => 99,
                'scores' => NULL,
            ),
            332 =>
            array(
                'fields' => NULL,
                'id' => 361,
                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                'process_id' => 99,
                'scores' => NULL,
            ),
            333 =>
            array(
                'fields' => NULL,
                'id' => 362,
                'name' => 'Vérifier que le ticket d\'autorisation est établi sur la base d\'un PV de comité ',
                'process_id' => 99,
                'scores' => NULL,
            ),
            334 =>
            array(
                'fields' => NULL,
                'id' => 363,
                'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                'process_id' => 99,
                'scores' => NULL,
            ),
            335 =>
            array(
                'fields' => NULL,
                'id' => 364,
                'name' => 'Vérifier que le registre de notification du crédit accordé ou rejeté est tenu, mis à jour et bien renseigné ',
                'process_id' => 99,
                'scores' => NULL,
            ),
            336 =>
            array(
                'fields' => NULL,
                'id' => 365,
                'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                'process_id' => 100,
                'scores' => NULL,
            ),
            337 =>
            array(
                'fields' => NULL,
                'id' => 366,
                'name' => 'Vérifier que la convention de prêt est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                'process_id' => 100,
                'scores' => NULL,
            ),
            338 =>
            array(
                'fields' => NULL,
                'id' => 367,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevés conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                'process_id' => 100,
                'scores' => NULL,
            ),
            339 =>
            array(
                'fields' => NULL,
                'id' => 368,
                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernées ',
                'process_id' => 100,
                'scores' => NULL,
            ),
            340 =>
            array(
                'fields' => NULL,
                'id' => 369,
                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                'process_id' => 100,
                'scores' => NULL,
            ),
            341 =>
            array(
                'fields' => NULL,
                'id' => 370,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                'process_id' => 101,
                'scores' => NULL,
            ),
            342 =>
            array(
                'fields' => NULL,
                'id' => 371,
                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                'process_id' => 101,
                'scores' => NULL,
            ),
            343 =>
            array(
                'fields' => NULL,
                'id' => 372,
                'name' => 'S\'assurer de la délivrance d\'un chèque de banque , sous présentation des pièces justificatives (sauf financement d\'aménagement d\'un local)',
                'process_id' => 101,
                'scores' => NULL,
            ),
            344 =>
            array(
                'fields' => NULL,
                'id' => 373,
                'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                'process_id' => 101,
                'scores' => NULL,
            ),
            345 =>
            array(
                'fields' => NULL,
                'id' => 374,
                'name' => 'Vérifier que l\'agence a effectué la déclaration à la centrale des risques',
                'process_id' => 101,
                'scores' => NULL,
            ),
            346 =>
            array(
                'fields' => NULL,
                'id' => 375,
                'name' => 'S\'assurer du recueil des garanties à postériori (achat d\'un local professionnel)',
                'process_id' => 102,
                'scores' => NULL,
            ),
            347 =>
            array(
                'fields' => NULL,
                'id' => 376,
                'name' => 'S\'assurer du suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé ',
                'process_id' => 103,
                'scores' => NULL,
            ),
            348 =>
            array(
                'fields' => NULL,
                'id' => 377,
                'name' => 'S\'assurer que la visite sur site après réalisation du projet est effectuée ',
                'process_id' => 103,
                'scores' => NULL,
            ),
            349 =>
            array(
                'fields' => NULL,
                'id' => 378,
                'name' => 'S\'assurer que la procédure de succession est appliquée suivant la règlementation ',
                'process_id' => 104,
                'scores' => NULL,
            ),
            350 =>
            array(
                'fields' => NULL,
                'id' => 379,
                'name' => 'S\'assurer que la demande a été établie par le client et validée par la DRE',
                'process_id' => 105,
                'scores' => NULL,
            ),
            351 =>
            array(
                'fields' => NULL,
                'id' => 380,
                'name' => 'Vérifier que les activités financées rentre bien dans le cadre des activités finançables par la banque',
                'process_id' => 106,
                'scores' => NULL,
            ),
            352 =>
            array(
                'fields' => NULL,
                'id' => 381,
                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents fournis par le client ',
                'process_id' => 106,
                'scores' => NULL,
            ),
            353 =>
            array(
                'fields' => NULL,
                'id' => 382,
                'name' => 'Vérifier que le récépissé de dépôt (provisoire, définitif) de crédit est établi ',
                'process_id' => 106,
                'scores' => NULL,
            ),
            354 =>
            array(
                'fields' => NULL,
                'id' => 383,
                'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                'process_id' => 106,
                'scores' => NULL,
            ),
            355 =>
            array(
                'fields' => NULL,
                'id' => 384,
                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette dernière ',
                'process_id' => 106,
                'scores' => NULL,
            ),
            356 =>
            array(
                'fields' => NULL,
                'id' => 385,
                'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122 (pour les crédits concernés par la visite)',
                'process_id' => 106,
                'scores' => NULL,
            ),
            357 =>
            array(
                'fields' => NULL,
                'id' => 386,
                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                'process_id' => 106,
                'scores' => NULL,
            ),
            358 =>
            array(
                'fields' => NULL,
                'id' => 387,
                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées',
                'process_id' => 106,
                'scores' => NULL,
            ),
            359 =>
            array(
                'fields' => NULL,
                'id' => 388,
                'name' => 'S\'assurer du respect des pouvoirs de délégation (Comité agence, DRE,Central)',
                'process_id' => 107,
                'scores' => NULL,
            ),
            360 =>
            array(
                'fields' => NULL,
                'id' => 389,
                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                'process_id' => 107,
                'scores' => NULL,
            ),
            361 =>
            array(
                'fields' => NULL,
                'id' => 390,
                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                'process_id' => 107,
                'scores' => NULL,
            ),
            362 =>
            array(
                'fields' => NULL,
                'id' => 391,
                'name' => 'Vérifier que le ticket d\'autorisation est établi sur la base d\'un PV de comité ',
                'process_id' => 107,
                'scores' => NULL,
            ),
            363 =>
            array(
                'fields' => NULL,
                'id' => 392,
                'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                'process_id' => 107,
                'scores' => NULL,
            ),
            364 =>
            array(
                'fields' => NULL,
                'id' => 393,
                'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                'process_id' => 108,
                'scores' => NULL,
            ),
            365 =>
            array(
                'fields' => NULL,
                'id' => 394,
                'name' => 'Vérifier que la convention de prêt est signée par le client et par le directeur d\'agence revêtue de la mention "LU ET APPOUVE", timbrée et enregistrée auprés de l\'administartion fiscale ',
                'process_id' => 108,
                'scores' => NULL,
            ),
            366 =>
            array(
                'fields' => NULL,
                'id' => 395,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevés conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                'process_id' => 108,
                'scores' => NULL,
            ),
            367 =>
            array(
                'fields' => NULL,
                'id' => 396,
                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                'process_id' => 108,
                'scores' => NULL,
            ),
            368 =>
            array(
                'fields' => NULL,
                'id' => 397,
                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                'process_id' => 108,
                'scores' => NULL,
            ),
            369 =>
            array(
                'fields' => NULL,
                'id' => 398,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                'process_id' => 109,
                'scores' => NULL,
            ),
            370 =>
            array(
                'fields' => NULL,
                'id' => 399,
                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                'process_id' => 109,
                'scores' => NULL,
            ),
            371 =>
            array(
                'fields' => NULL,
                'id' => 400,
                'name' => 'Vérifier que l\'agence a effectué la déclaration à la centrale des risques',
                'process_id' => 109,
                'scores' => NULL,
            ),
            372 =>
            array(
                'fields' => NULL,
                'id' => 401,
                'name' => 'S\'assurer du renouvelement des lignes de crédit',
                'process_id' => 110,
                'scores' => NULL,
            ),
            373 =>
            array(
                'fields' => NULL,
                'id' => 402,
                'name' => 'S\'assurer du mode de paiement (retrait d\'espèce à bannir) ',
                'process_id' => 110,
                'scores' => NULL,
            ),
            374 =>
            array(
                'fields' => NULL,
                'id' => 403,
                'name' => 'S\'assurer que la procédure de succession est appliquée suivant la règlementation ',
                'process_id' => 111,
                'scores' => NULL,
            ),
            375 =>
            array(
                'fields' => NULL,
                'id' => 404,
                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque  ',
                'process_id' => 112,
                'scores' => NULL,
            ),
            376 =>
            array(
                'fields' => NULL,
                'id' => 405,
                'name' => 'Vérifier que le registre des dossiers de crédit est tenu par ordre chronologique, mis à jour et bien renseigné ',
                'process_id' => 112,
                'scores' => NULL,
            ),
            377 =>
            array(
                'fields' => NULL,
                'id' => 406,
                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette structure',
                'process_id' => 112,
                'scores' => NULL,
            ),
            378 =>
            array(
                'fields' => NULL,
                'id' => 407,
                'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122 (pour les crédits concernés par la visite)',
                'process_id' => 112,
                'scores' => NULL,
            ),
            379 =>
            array(
                'fields' => NULL,
                'id' => 408,
                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                'process_id' => 112,
                'scores' => NULL,
            ),
            380 =>
            array(
                'fields' => NULL,
                'id' => 409,
                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées',
                'process_id' => 112,
                'scores' => NULL,
            ),
            381 =>
            array(
                'fields' => NULL,
                'id' => 410,
                'name' => 's\'assurer du classement ou bien la restitution des dossiers ayant fait l\'objet d\'un refus motivé dans un délai ne dépassant pas 15 jours',
                'process_id' => 112,
                'scores' => NULL,
            ),
            382 =>
            array(
                'fields' => NULL,
                'id' => 411,
                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                'process_id' => 113,
                'scores' => NULL,
            ),
            383 =>
            array(
                'fields' => NULL,
                'id' => 412,
                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                'process_id' => 113,
                'scores' => NULL,
            ),
            384 =>
            array(
                'fields' => NULL,
                'id' => 413,
                'name' => 'Vérifier que le ticket d\'autorisation est établi sur la base d\'un PV de comité ',
                'process_id' => 113,
                'scores' => NULL,
            ),
            385 =>
            array(
                'fields' => NULL,
                'id' => 414,
                'name' => 'Vérifier que le registre de notification du crédit accordé ou rejeté est tenu, mis à jour et bien renseigné ',
                'process_id' => 113,
                'scores' => NULL,
            ),
            386 =>
            array(
                'fields' => NULL,
                'id' => 415,
                'name' => 'Vérifier que la convention de prêt est signée par le client et par le directeur d\'agence revêtue de la mention "LU ET APPOUVE", timbrée et enregistrée auprés de l\'administartion fiscale ',
                'process_id' => 114,
                'scores' => NULL,
            ),
            387 =>
            array(
                'fields' => NULL,
                'id' => 416,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevés conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                'process_id' => 114,
                'scores' => NULL,
            ),
            388 =>
            array(
                'fields' => NULL,
                'id' => 417,
                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                'process_id' => 114,
                'scores' => NULL,
            ),
            389 =>
            array(
                'fields' => NULL,
                'id' => 418,
                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                'process_id' => 114,
                'scores' => NULL,
            ),
            390 =>
            array(
                'fields' => NULL,
                'id' => 419,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                'process_id' => 115,
                'scores' => NULL,
            ),
            391 =>
            array(
                'fields' => NULL,
                'id' => 420,
                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                'process_id' => 115,
                'scores' => NULL,
            ),
            392 =>
            array(
                'fields' => NULL,
                'id' => 421,
                'name' => 'Vérifier que le tableau d’amortissement semestriel est établi, signé par le client, et le directeur d\'agence',
                'process_id' => 115,
                'scores' => NULL,
            ),
            393 =>
            array(
                'fields' => NULL,
                'id' => 422,
                'name' => 's\'assurer de la signature d\'une chaîne de billets à ordre par le client',
                'process_id' => 115,
                'scores' => NULL,
            ),
            394 =>
            array(
                'fields' => NULL,
                'id' => 423,
                'name' => 'Vérifier que l\'agence a effectué la déclaration à la centrale des risques',
                'process_id' => 115,
                'scores' => NULL,
            ),
            395 =>
            array(
                'fields' => NULL,
                'id' => 424,
                'name' => 's\'assurer du paiement de la cotisation au fonds de garantie',
                'process_id' => 115,
                'scores' => NULL,
            ),
            396 =>
            array(
                'fields' => NULL,
                'id' => 425,
                'name' => 'S\'assurer que les garanties mentionnées sur le ticket d\'autorisation sont recueillies ',
                'process_id' => 116,
                'scores' => NULL,
            ),
            397 =>
            array(
                'fields' => NULL,
                'id' => 426,
                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                'process_id' => 116,
                'scores' => NULL,
            ),
            398 =>
            array(
                'fields' => NULL,
                'id' => 427,
                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                'process_id' => 116,
                'scores' => NULL,
            ),
            399 =>
            array(
                'fields' => NULL,
                'id' => 428,
                'name' => 'S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé ',
                'process_id' => 117,
                'scores' => NULL,
            ),
            400 =>
            array(
                'fields' => NULL,
                'id' => 429,
                'name' => 'S\'assurer que la visite sur site après réalisation du projet est effectuée ',
                'process_id' => 117,
                'scores' => NULL,
            ),
            401 =>
            array(
                'fields' => NULL,
                'id' => 430,
                'name' => 'S\'assurer que la procédure de succession est appliquée suivant la règlementation ',
                'process_id' => 118,
                'scores' => NULL,
            ),
            402 =>
            array(
                'fields' => NULL,
                'id' => 431,
                'name' => 'S\'assurer que la demande a été établie par le client et validée par la DRE',
                'process_id' => 119,
                'scores' => NULL,
            ),
            403 =>
            array(
                'fields' => NULL,
                'id' => 432,
                'name' => 'S\'assurer que le débiteur est saisi par lettre recommandée avec accusé de réception dés survenance de l\'incident de paiement ',
                'process_id' => 120,
                'scores' => NULL,
            ),
            404 =>
            array(
                'fields' => NULL,
                'id' => 433,
                'name' => 'S\'assurer qu\'une visite sur site est effectuée au domicile et/ou lieu d\'activité du débiteur  ',
                'process_id' => 120,
                'scores' => NULL,
            ),
            405 =>
            array(
                'fields' => NULL,
                'id' => 434,
                'name' => 'S\'assurer de l\'établissement d\'une chaine de billet à ordre (cas d\'avis favorable), signature d\'une lettre de déchéance à terme,',
                'process_id' => 120,
                'scores' => NULL,
            ),
            406 =>
            array(
                'fields' => NULL,
                'id' => 435,
                'name' => 'S\'assurer qu\'une mise en demeure a été adressée au client dans le cas d’apparition d’impayé ',
                'process_id' => 120,
                'scores' => NULL,
            ),
            407 =>
            array(
                'fields' => NULL,
                'id' => 436,
                'name' => 'S\'assurer de la transmission du protêt des billets à ordre non honorés à l\'huissier de justice dans un délai de 20 jours suivant l\'échéance non réglée  ',
                'process_id' => 120,
                'scores' => NULL,
            ),
            408 =>
            array(
                'fields' => NULL,
                'id' => 437,
                'name' => 'S\'assurer du lancement d\'une saisie arrêt ',
                'process_id' => 120,
                'scores' => NULL,
            ),
            409 =>
            array(
                'fields' => NULL,
                'id' => 438,
                'name' => 'S\'assurer qu\'une injonction auprès de la justice a été adressée',
                'process_id' => 120,
                'scores' => NULL,
            ),
            410 =>
            array(
                'fields' => NULL,
                'id' => 439,
                'name' => 'Vérifier que le ST217 a été établi et transmis à la DRE de rattachement ',
                'process_id' => 121,
                'scores' => NULL,
            ),
            411 =>
            array(
                'fields' => NULL,
                'id' => 440,
                'name' => 'Vérifier l\'exécution des recommandations de la commission d\'Ad\'hoc (virement de cpte CCIR vers CES ) ',
                'process_id' => 121,
                'scores' => NULL,
            ),
            412 =>
            array(
                'fields' => NULL,
                'id' => 441,
                'name' => 'S\'assurer que les actions de recouvrements ont été réellement effectuées ',
                'process_id' => 121,
                'scores' => NULL,
            ),
            413 =>
            array(
                'fields' => NULL,
                'id' => 442,
                'name' => 'S’assurer que toutes les dispositions ont été prises pour que le bénéficiaire honore ses engagements (Invitations, visite sur site ..)',
                'process_id' => 122,
                'scores' => NULL,
            ),
            414 =>
            array(
                'fields' => NULL,
                'id' => 443,
                'name' => 'S\'assurer que l\'avis d\'impayé a été transmis au fond de garantie (Après un mois d\'échéance impayé)',
                'process_id' => 122,
                'scores' => NULL,
            ),
            415 =>
            array(
                'fields' => NULL,
                'id' => 444,
                'name' => 'S\'assurer que le dossier d\'indemnisation a été transmis à la DRE pour l\'acheminer au fond de garantie ',
                'process_id' => 122,
                'scores' => NULL,
            ),
            416 =>
            array(
                'fields' => NULL,
                'id' => 445,
                'name' => 'S\'assurer de la restitution des montants indemnisés au fond de garantie une fois que le client ayant remboursé la créance ',
                'process_id' => 122,
                'scores' => NULL,
            ),
            417 =>
            array(
                'fields' => NULL,
                'id' => 446,
                'name' => 'S\'assurer de l\'exhaustivité et la régularité des documents exigés par la banque',
                'process_id' => 123,
                'scores' => NULL,
            ),
            418 =>
            array(
                'fields' => NULL,
                'id' => 447,
                'name' => 'S\'assurer de l\'existence du registre de commerce et du NIF (numéro d\'identifiant fiscal)',
                'process_id' => 123,
                'scores' => NULL,
            ),
            419 =>
            array(
                'fields' => NULL,
                'id' => 448,
                'name' => 'S\'assurer que le client n\'est pas sous l\'effet d\'une mesure de suspension de domiciliation au titre de toute opération de commerce extérieur',
                'process_id' => 123,
                'scores' => NULL,
            ),
            420 =>
            array(
                'fields' => NULL,
                'id' => 449,
                'name' => 'S\'assurer que le produit n\'est pas frappé par des mesures restrictives ou de prohibition',
                'process_id' => 123,
                'scores' => NULL,
            ),
            421 =>
            array(
                'fields' => NULL,
                'id' => 450,
                'name' => 'S’assurer de la validation de l’opération de pré domiciliation ',
                'process_id' => 123,
                'scores' => NULL,
            ),
            422 =>
            array(
                'fields' => NULL,
                'id' => 451,
                'name' => 'S\'assurer que les conditions légales et règlementaires liées à l\'exportation des biens et services sont réunis',
                'process_id' => 123,
                'scores' => NULL,
            ),
            423 =>
            array(
                'fields' => NULL,
                'id' => 452,
                'name' => 'S\'assurer que la facture proformat est dûment domicilier revêtue du cachet de domiciliation ',
                'process_id' => 123,
                'scores' => NULL,
            ),
            424 =>
            array(
                'fields' => NULL,
                'id' => 453,
                'name' => 'S’assurer du prélèvement de la taxe de domiciliation',
                'process_id' => 123,
                'scores' => NULL,
            ),
            425 =>
            array(
                'fields' => NULL,
                'id' => 454,
                'name' => 'S\'assurer de l\'existence du formulaire SEMAR 205 ter dûment cacheté et signé par le client  ',
                'process_id' => 124,
                'scores' => NULL,
            ),
            426 =>
            array(
                'fields' => NULL,
                'id' => 455,
                'name' => 'S\'assurer du respect des clauses de la demande d\'ouverture CREDOC (19 clauses)',
                'process_id' => 124,
                'scores' => NULL,
            ),
            427 =>
            array(
                'fields' => NULL,
                'id' => 456,
                'name' => 'S\'assurer de la conformité du crédoc aux règles et usages (RUU600) et à la règlementation de change ',
                'process_id' => 124,
                'scores' => NULL,
            ),
            428 =>
            array(
                'fields' => NULL,
                'id' => 457,
                'name' => 's\'assurer de l\'existence des documents règlementaire',
                'process_id' => 124,
                'scores' => NULL,
            ),
            429 =>
            array(
                'fields' => NULL,
                'id' => 458,
                'name' => 'S\'assurer de la constitution de la PREG ',
                'process_id' => 124,
                'scores' => NULL,
            ),
            430 =>
            array(
                'fields' => NULL,
                'id' => 459,
                'name' => 'S’assurer de la perception des commissions',
                'process_id' => 124,
                'scores' => NULL,
            ),
            431 =>
            array(
                'fields' => NULL,
                'id' => 460,
                'name' => 'S\'assurer du dégagement de la banque par le client du risque de change ',
                'process_id' => 124,
                'scores' => NULL,
            ),
            432 =>
            array(
                'fields' => NULL,
                'id' => 461,
                'name' => 'S\'assurer de la conformité des documents reçus',
                'process_id' => 124,
                'scores' => NULL,
            ),
            433 =>
            array(
                'fields' => NULL,
                'id' => 462,
                'name' => 'S\'assurer au cas de non-conformité du renvoie des documents à la DOD avec des réserves',
                'process_id' => 124,
                'scores' => NULL,
            ),
            434 =>
            array(
                'fields' => NULL,
                'id' => 463,
                'name' => 'S\'assurer de l\'exhaustivité et la régularité des documents exigés par la banque',
                'process_id' => 125,
                'scores' => NULL,
            ),
            435 =>
            array(
                'fields' => NULL,
                'id' => 464,
                'name' => 'S\'assurer de l\'existence du registre de commerce et du NIF (numéro d\'identifiant fiscal)',
                'process_id' => 125,
                'scores' => NULL,
            ),
            436 =>
            array(
                'fields' => NULL,
                'id' => 465,
                'name' => 'S\'assurer que le client n\'est pas sous l\'effet d\'une mesure de suspension de domiciliation au titre de toute opération de commerce extérieur',
                'process_id' => 125,
                'scores' => NULL,
            ),
            437 =>
            array(
                'fields' => NULL,
                'id' => 466,
                'name' => 'S\'assurer que le produit n\'est pas frappé par des mesures restrictives ou de prohibition',
                'process_id' => 125,
                'scores' => NULL,
            ),
            438 =>
            array(
                'fields' => NULL,
                'id' => 467,
                'name' => 'S’assurer de la validation de l’opération de pré domiciliation ',
                'process_id' => 125,
                'scores' => NULL,
            ),
            439 =>
            array(
                'fields' => NULL,
                'id' => 468,
                'name' => 'S\'assurer que les conditions légales et règlementaires liées à l\'exportation des biens et services sont réunis',
                'process_id' => 125,
                'scores' => NULL,
            ),
            440 =>
            array(
                'fields' => NULL,
                'id' => 469,
                'name' => 'S\'assurer que la facture proformat est dûment domicilier revêtue du cachet de domiciliation ',
                'process_id' => 125,
                'scores' => NULL,
            ),
            441 =>
            array(
                'fields' => NULL,
                'id' => 470,
                'name' => 'S’assurer du prélèvement de la taxe de domiciliation',
                'process_id' => 125,
                'scores' => NULL,
            ),
            442 =>
            array(
                'fields' => NULL,
                'id' => 471,
                'name' => 's\'assurer que l’importateur est une personne morale parfaitement identifiée et présentant toutes garanties de bonne conduite des opérations de commerce extérieur ',
                'process_id' => 126,
                'scores' => NULL,
            ),
            443 =>
            array(
                'fields' => NULL,
                'id' => 472,
                'name' => 'S\'assurer que la PREG couvrant le montant y compris les commissions de transfert ',
                'process_id' => 126,
                'scores' => NULL,
            ),
            444 =>
            array(
                'fields' => NULL,
                'id' => 473,
                'name' => 'S’assurer de la perception des commissions',
                'process_id' => 126,
                'scores' => NULL,
            ),
            445 =>
            array(
                'fields' => NULL,
                'id' => 474,
                'name' => 'S\'assurer de la vérification des documents',
                'process_id' => 126,
                'scores' => NULL,
            ),
            446 =>
            array(
                'fields' => NULL,
                'id' => 475,
                'name' => 'S\'assurer que l\'opération de remise documentaire a bien été saisie sur Delta (les montants, les dates..)',
                'process_id' => 126,
                'scores' => NULL,
            ),
            447 =>
            array(
                'fields' => NULL,
                'id' => 476,
                'name' => 'S\'assurer du respect des délais des échéances',
                'process_id' => 126,
                'scores' => NULL,
            ),
            448 =>
            array(
                'fields' => NULL,
                'id' => 477,
                'name' => 'S\'assurer de l\'existence des documents règlementaire',
                'process_id' => 126,
                'scores' => NULL,
            ),
            449 =>
            array(
                'fields' => NULL,
                'id' => 478,
                'name' => 'S\'assurer de la conservation de la remise documentaire',
                'process_id' => 126,
                'scores' => NULL,
            ),
            450 =>
            array(
                'fields' => NULL,
                'id' => 479,
                'name' => 'S\'assurer de la transmission de la copie du justificatifs d\'expédition à la DRE',
                'process_id' => 126,
                'scores' => NULL,
            ),
            451 =>
            array(
                'fields' => NULL,
                'id' => 480,
                'name' => 'S\'assurer que l’importateur est une personne morale parfaitement identifiée et présentant toutes garanties de bonne conduite des opérations de commerce extérieur ',
                'process_id' => 127,
                'scores' => NULL,
            ),
            452 =>
            array(
                'fields' => NULL,
                'id' => 481,
                'name' => 'S\'assurer de l\'absence de mesure particulière prise à l\'encontre du client ',
                'process_id' => 127,
                'scores' => NULL,
            ),
            453 =>
            array(
                'fields' => NULL,
                'id' => 482,
                'name' => 'S\'assurer de l\'existence de la provision et le prélèvement des commissions y relatives',
                'process_id' => 127,
                'scores' => NULL,
            ),
            454 =>
            array(
                'fields' => NULL,
                'id' => 483,
                'name' => 'S\'assurer de l\'existence les documents justificatifs du transfert plus particulièrement la déclaration douanière (D10) ',
                'process_id' => 127,
                'scores' => NULL,
            ),
            455 =>
            array(
                'fields' => NULL,
                'id' => 484,
                'name' => 'S\'assurer que l\'ordre de virement est dûment renseigné, signé par le client ',
                'process_id' => 127,
                'scores' => NULL,
            ),
            456 =>
            array(
                'fields' => NULL,
                'id' => 485,
                'name' => 'S\'assurer que le dossier ne présente pas des irrégularités (insuffisance ou excédents de règlement)',
                'process_id' => 127,
                'scores' => NULL,
            ),
            457 =>
            array(
                'fields' => NULL,
                'id' => 486,
                'name' => 'S\'assurer du respect des délais de déclaration pour la Banque d\'Algerie (dossier non apuré et dossier annulé ou inutilisés)',
                'process_id' => 128,
                'scores' => NULL,
            ),
            458 =>
            array(
                'fields' => NULL,
                'id' => 487,
                'name' => 'S’assurer de la déclaration des dossiers de domiciliation, dossiers apurés, non apurés, dossiers en excédent ou en insuffisance de règlement.  ',
                'process_id' => 128,
                'scores' => NULL,
            ),
            459 =>
            array(
                'fields' => NULL,
                'id' => 488,
                'name' => 'S\'assurer du respect des délais d\'apurement pour tout type de paiements',
                'process_id' => 129,
                'scores' => NULL,
            ),
            460 =>
            array(
                'fields' => NULL,
                'id' => 489,
                'name' => 'S\'assurer de l\'assemblement de tout le dossier nécessaire pour l\'apurement',
                'process_id' => 129,
                'scores' => NULL,
            ),
            461 =>
            array(
                'fields' => NULL,
                'id' => 490,
                'name' => 'S\'assurer que les dossiers sont conservés dans un endroit sécurisé au niveau de l\'Agence pour une période de cinq (05) ans ',
                'process_id' => 129,
                'scores' => NULL,
            ),
        ));
    }
}
