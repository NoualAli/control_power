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
        
        \DB::table('control_points')->insert(array (
            0 => 
            array (
                'id' => 2386,
                'name' => 'S\'assurer de l\'exhaustivité et la régularité des documents exigés par la banque',
                'process_id' => 462,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            1 => 
            array (
                'id' => 2387,
            'name' => 'S\'assurer de l\'existence du registre de commerce et du NIF (numéro d\'identifiant fiscal)',
                'process_id' => 462,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            2 => 
            array (
                'id' => 2388,
                'name' => 'S\'assurer que le client n\'est pas sous l\'effet d\'une mesure de suspension de domiciliation au titre de toute opération de commerce extérieur',
                'process_id' => 462,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            3 => 
            array (
                'id' => 2389,
                'name' => 'S\'assurer que le produit n\'est pas frappé par des mesures restrictives ou de prohibition',
                'process_id' => 462,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            4 => 
            array (
                'id' => 2390,
                'name' => 'S’assurer de la validation de l’opération de pré domiciliation ',
                'process_id' => 462,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            5 => 
            array (
                'id' => 2391,
                'name' => 'S\'assurer que les conditions légales et règlementaires liées à l\'exportation des biens et services sont réunis',
                'process_id' => 462,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            6 => 
            array (
                'id' => 2392,
                'name' => 'S\'assurer que la facture proformat est dûment domicilier revêtue du cachet de domiciliation ',
                'process_id' => 462,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            7 => 
            array (
                'id' => 2393,
                'name' => 'S’assurer du prélèvement de la taxe de domiciliation',
                'process_id' => 462,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            8 => 
            array (
                'id' => 2394,
                'name' => 'S\'assurer de l\'existence du formulaire SEMAR 205 ter dûment cacheté et signé par le client  ',
                'process_id' => 463,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            9 => 
            array (
                'id' => 2395,
            'name' => 'S\'assurer du respect des clauses de la demande d\'ouverture CREDOC (19 clauses)',
                'process_id' => 463,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            10 => 
            array (
                'id' => 2396,
            'name' => 'S\'assurer de la conformité du crédoc aux règles et usages (RUU600) et à la règlementation de change ',
                'process_id' => 463,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            11 => 
            array (
                'id' => 2397,
                'name' => 's\'assurer de l\'existence des documents règlementaire',
                'process_id' => 463,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            12 => 
            array (
                'id' => 2398,
                'name' => 'S\'assurer de la constitution de la PREG ',
                'process_id' => 463,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            13 => 
            array (
                'id' => 2399,
                'name' => 'S’assurer de la perception des commissions',
                'process_id' => 463,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            14 => 
            array (
                'id' => 2400,
                'name' => 'S\'assurer du dégagement de la banque par le client du risque de change ',
                'process_id' => 463,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            15 => 
            array (
                'id' => 2401,
                'name' => 'S\'assurer de la conformité des documents reçus',
                'process_id' => 463,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            16 => 
            array (
                'id' => 2402,
                'name' => 'S\'assurer au cas de non-conformité du renvoie des documents à la DOD avec des réserves',
                'process_id' => 463,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            17 => 
            array (
                'id' => 2403,
                'name' => 'S\'assurer que l’importateur est une personne morale parfaitement identifiée et présentant toutes garanties de bonne conduite des opérations de commerce extérieur ',
                'process_id' => 464,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            18 => 
            array (
                'id' => 2404,
                'name' => 'S\'assurer que la PREG couvrant le montant y compris les commissions de transfert ',
                'process_id' => 464,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            19 => 
            array (
                'id' => 2405,
                'name' => 'S’assurer de la perception des commissions',
                'process_id' => 464,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            20 => 
            array (
                'id' => 2406,
                'name' => 'S\'assurer de la vérification des documents',
                'process_id' => 464,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            21 => 
            array (
                'id' => 2407,
            'name' => 'S\'assurer que l\'opération de remise documentaire a bien été saisie sur Delta (les montants, les dates..)',
                'process_id' => 464,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            22 => 
            array (
                'id' => 2408,
                'name' => 'S\'assurer du respect des délais des échéances',
                'process_id' => 464,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            23 => 
            array (
                'id' => 2409,
                'name' => 'S\'assurer de l\'existence des documents règlementaire',
                'process_id' => 464,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            24 => 
            array (
                'id' => 2410,
                'name' => 'S\'assurer de la conservation de la remise documentaire',
                'process_id' => 464,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            25 => 
            array (
                'id' => 2411,
                'name' => 'S\'assurer de la transmission de la copie du justificatif d\'expédition à la DRE',
                'process_id' => 464,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            26 => 
            array (
                'id' => 2412,
                'name' => 'S\'assurer que l’importateur est une personne morale parfaitement identifiée et présentant toutes garanties de bonne conduite des opérations de commerce extérieur ',
                'process_id' => 465,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            27 => 
            array (
                'id' => 2413,
                'name' => 'S\'assurer de l\'absence de mesure particulière prise à l\'encontre du client ',
                'process_id' => 465,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            28 => 
            array (
                'id' => 2414,
                'name' => 'S\'assurer de l\'existence de la provision et le prélèvement des commissions y relatives',
                'process_id' => 465,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            29 => 
            array (
                'id' => 2415,
            'name' => 'S\'assurer de l\'existence des documents justificatifs du transfert plus particulièrement la déclaration douanière (D10) ',
                'process_id' => 465,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            30 => 
            array (
                'id' => 2416,
                'name' => 'S\'assurer que l\'ordre de virement est dûment renseigné, signé par le client ',
                'process_id' => 465,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            31 => 
            array (
                'id' => 2417,
            'name' => 'S\'assurer que le dossier ne présente pas des irrégularités (insuffisance ou excédents de règlement)',
                'process_id' => 465,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            32 => 
            array (
                'id' => 2418,
            'name' => 'S\'assurer du respect des délais de déclaration pour la Banque d\'Algerie (dossier non apuré et dossier annulé ou inutilisé)',
                'process_id' => 466,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            33 => 
            array (
                'id' => 2419,
                'name' => 'S’assurer de la déclaration des dossiers de domiciliation, dossiers apurés, non apurés, dossiers en excédent ou en insuffisance de règlement.  ',
                'process_id' => 466,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            34 => 
            array (
                'id' => 2420,
                'name' => 'S\'assurer du respect des délais d\'apurement pour tout type de paiements',
                'process_id' => 467,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            35 => 
            array (
                'id' => 2421,
                'name' => 'S\'assurer de l\'assemblement de tout le dossier nécessaire pour l\'apurement',
                'process_id' => 467,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            36 => 
            array (
                'id' => 2422,
            'name' => 'S\'assurer que les dossiers sont conservés dans un endroit sécurisé au niveau de l\'Agence pour une période de cinq (05) ans ',
                'process_id' => 467,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => '[[{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            37 => 
            array (
                'id' => 2423,
                'name' => 'Confronter le solde comptable avec les existances',
                'process_id' => 468,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Excédent et/ou déficit enregistré ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            38 => 
            array (
                'id' => 2424,
                'name' => 'Vérifier l\'existence d\'un planning de contrôle confidentiel  établie par le Directeur d\'Agence ',
                'process_id' => 468,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "planning établie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "planning non établie ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            39 => 
            array (
                'id' => 2425,
                'name' => 'Vérifier la bonne tenue des registres des encaisses',
                'process_id' => 468,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "registre bien renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "mal renseigné ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            40 => 
            array (
                'id' => 2426,
                'name' => 'Vérifier le respect du plafond d\'encaisse',
                'process_id' => 468,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Respect du plafond d\'encaisse", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect du plafond ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            41 => 
            array (
                'id' => 2427,
                'name' => 'Vérifier le respect des consignes de sécurités et de conservation des fonds',
                'process_id' => 468,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Consignes de sécurité respecter ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des consignes de sécurités ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            42 => 
            array (
                'id' => 2428,
                'name' => 'S\'assurer de l\'arrêté quotidienn de DAB et GAB',
                'process_id' => 469,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "GAB et DAB arrêté quotidiennement ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non arrêté quotidiennement", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            43 => 
            array (
                'id' => 2429,
                'name' => 'Confronter le solde comptable avec les existences et le ticket papier DAB',
                'process_id' => 469,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Excédent et/ou déficit enregistré ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            44 => 
            array (
                'id' => 2430,
                'name' => 'Confronter le solde comptable avec les existences et le ticket papier GAB',
                'process_id' => 469,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Excédent et/ou déficit enregistré ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            45 => 
            array (
                'id' => 2431,
                'name' => 'Vérifier la bonne tenue  des registres',
                'process_id' => 469,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "registre bien renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "mal renseigné ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            46 => 
            array (
                'id' => 2432,
                'name' => 'Vérifier la bonne tennue des registres "envoi et réception des fonds"',
                'process_id' => 470,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "registre bien renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "mal renseigné ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            47 => 
            array (
                'id' => 2433,
                'name' => 'Vérifier les dates de comptabilisation des envois et reception de fonds ',
                'process_id' => 470,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "comptabilisé le jour même ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "comptabilisation tardive ", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            48 => 
            array (
                'id' => 2434,
                'name' => 'Vérifier l\'affichage de la liste des convoyeurs de fonds ',
                'process_id' => 470,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Liste affichée ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Liste non affichée ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            49 => 
            array (
                'id' => 2435,
                'name' => 'S\'assurer de l\'édition du journal de caisse ',
                'process_id' => 471,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Journal caisse édité ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Journal Caisse non édité ", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            50 => 
            array (
                'id' => 2436,
                'name' => 'S\'assurer que le contrôle des journées comptables est effectué dans les délais ',
                'process_id' => 471,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Contrôle effectué dans les délais", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des délais ", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            51 => 
            array (
                'id' => 2437,
                'name' => 'Vérifier que les opérations annulées  ou abondonnées sont validées par la hiérarchie',
                'process_id' => 471,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "validé ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non validé ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            52 => 
            array (
                'id' => 2438,
                'name' => 'Vérifier que les contrôles relatifs à l’identification,la conformité des mentions obligatoires et de la signature de la clientèle sont effectués et matérialisés ',
                'process_id' => 472,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Des anomalies constatées", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            53 => 
            array (
                'id' => 2439,
                'name' => 'Vérifier que la demande d\'accord de paiement à distance via E-mail ou fax a été établie ',
                'process_id' => 472,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Fax non établi ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            54 => 
            array (
                'id' => 2440,
                'name' => 'Vérifier que les formulaires de retrait CA 263 sur compte livret sont dûment renseignés et signés',
                'process_id' => 472,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "  Non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence du formulaire ", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            55 => 
            array (
                'id' => 2441,
                'name' => 'Vérifier que les bordereaux de retrait sur compte chèque sont signés par le guichetier et le client ',
                'process_id' => 472,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de signature ", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            56 => 
            array (
                'id' => 2442,
                'name' => 'Vérifier que les bordereaux de retrait sur livret sont signés par le guichetier et le client',
                'process_id' => 472,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de signature ", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            57 => 
            array (
                'id' => 2443,
                'name' => 'Vérifier la conformité des opérations comptabilisés',
                'process_id' => 472,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie relevée", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Des anomalies mineures ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Des écarts majeurs relevés lors du contrôle", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            58 => 
            array (
                'id' => 2444,
                'name' => 'Vérifié que les opérations annulées sont validées par le résponsable hièrarchique',
                'process_id' => 472,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Opération annulée non validée par le responsable", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            59 => 
            array (
                'id' => 2445,
                'name' => 'Vérifier que les formulaires de retrait CA 264 sur compte devise sont dûment renseignés et signés',
                'process_id' => 473,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "  Non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence du formulaire ", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            60 => 
            array (
                'id' => 2446,
                'name' => 'Vérifier que les bordereaux de retrait sur compte devises  sont signés par le guichetier et le client',
                'process_id' => 473,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de signature ", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            61 => 
            array (
                'id' => 2447,
                'name' => 'Vérifier la conformité des opérations comptabilisés',
                'process_id' => 473,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie relevée", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Des anomalies mineures ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Des écarts majeurs relevés lors du contrôle", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            62 => 
            array (
                'id' => 2448,
                'name' => 'Vérifié que les opérations annulées sont validées par le résponsable hièrarchique',
                'process_id' => 473,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Opération annulée non validée par le responsable", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            63 => 
            array (
                'id' => 2449,
                'name' => 'S\'assurer que le bordereau CA30 est dûment renseigné et signé Dinars',
                'process_id' => 474,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "  Non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence du formulaire ", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            64 => 
            array (
                'id' => 2450,
                'name' => 'S\'assurer que le bordereau CA30 est dûment renseigné et signé',
                'process_id' => 474,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "  Non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence du formulaire ", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            65 => 
            array (
                'id' => 2451,
                'name' => 'Vérifier que les bordereaux de versement sont signés par le guichetier et le client',
                'process_id' => 474,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de signature ", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            66 => 
            array (
                'id' => 2452,
                'name' => 'Vérifier la conformité des opérations comptabilisés',
                'process_id' => 474,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie relevée", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Des anomalies mineures ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Des écarts majeurs relevés lors du contrôle", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            67 => 
            array (
                'id' => 2453,
                'name' => 'Vérifié que les opérations annulées sont validées par le résponsable hièrarchique',
                'process_id' => 474,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Opération annulée non validée par le responsable", "value": "Label"}]]',
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            68 => 
            array (
                'id' => 2454,
                'name' => 'S\'assurer que la convention d\'adhésion aux services de la banque en ligne est dûment renseignée et signée par le client précédé par la mention lu et approuvé et signée par le responsable habilité de l\'agence avec apposition du cachet    ',
                'process_id' => 475,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné et/ ou non signé", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            69 => 
            array (
                'id' => 2455,
                'name' => 'S’assurer que la demande d’abonnement, par type de client, est dûment renseignée, signée par le client précédé de la mention « lu et approuvé » et signée par le responsable habilité de l\'agence ',
                'process_id' => 475,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné et/ ou non signé", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            70 => 
            array (
                'id' => 2456,
                'name' => 'S’assurer que les commissions sont perçus au débit du compte client chaque fin du mois selon les conditions de banque en vigueur ;',
                'process_id' => 475,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            71 => 
            array (
                'id' => 2457,
                'name' => 'S\'assurer que les réclamations de la clientèles sont prises en charge',
                'process_id' => 476,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Réclamations non traitées ", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            72 => 
            array (
                'id' => 2458,
                'name' => 'S’assurer que les commissions sont perçues au débit du compte  client selon les conditions de banque en vigueur ;',
                'process_id' => 477,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Commissions non perçues", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            73 => 
            array (
                'id' => 2459,
                'name' => 'S’assurer que la convention d’échange de données informatisées est signée par le directeur de la DRE, directeur d’agence, le donneur d’ordre ',
                'process_id' => 478,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Convention non signée", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            74 => 
            array (
                'id' => 2460,
                'name' => 'S’assurer que les commissions sont perçues au débit du compte  client selon les conditions de banque en vigueur ;',
                'process_id' => 478,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Commissions non perçues", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            75 => 
            array (
                'id' => 2461,
            'name' => 'Vérifier la complétude et la conformité du dossier d\'ouverture de compte (0200, 0300, 0266…)',
                'process_id' => 479,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Quelques anomalies relevées sur les dossiers d\'ouverture de compte ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Des anomlies majeurs ", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            76 => 
            array (
                'id' => 2462,
                'name' => 'S\'assurer que l\'ouverture du compte est soumise  préalablement à l\'accord d\'un responsable habilité ',
                'process_id' => 479,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Aucun accord", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            77 => 
            array (
                'id' => 2463,
            'name' => 'S\'assurer que les interrogations des centrales de surveillance (Interdit bancaire, interdit de chéquier…) ont été effectuées',
                'process_id' => 479,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "consultation effectuée ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "consultation non effectuée ", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            78 => 
            array (
                'id' => 2464,
                'name' => 'S\'assurer de la bonne saisie des informations relatives au client sur le système d\'information ',
                'process_id' => 479,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            79 => 
            array (
                'id' => 2465,
                'name' => 'S\'assurer de la scannarisation et la bonne conservation des CA10',
                'process_id' => 479,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non scanner/Mal conservé ", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            80 => 
            array (
                'id' => 2466,
                'name' => 'Vérifier que les registres des ouvertures des comptes sont bien tenus et mis à jour',
                'process_id' => 479,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registres non tenus ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            81 => 
            array (
                'id' => 2467,
                'name' => 'Vérifier que les conditions d\'archivages des dossiers d\'ouvertures sont bien réalisées',
                'process_id' => 479,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            82 => 
            array (
                'id' => 2468,
            'name' => 'Vériffier la demande de clôture de compte du client (nom et prénom, numéro de compte, signature, date… )   ',
                'process_id' => 480,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie constatée", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            83 => 
            array (
                'id' => 2469,
            'name' => 'S\'assurer que toutes les conditions de clôture ont été respectées (solde suffisant, moyens de paiements restitués, etc)',
                'process_id' => 480,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Conditions de clôture respectées", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Conditions de clôture non respectées", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            84 => 
            array (
                'id' => 2470,
                'name' => 'Vérifier que le registre de clôture des comptes est bien tenu et mis à jour',
                'process_id' => 480,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registres non tenus ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            85 => 
            array (
                'id' => 2471,
                'name' => 'Vérifier que les conditions d\'archivages des dossiers de clôture sont bien réalisées',
                'process_id' => 480,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            86 => 
            array (
                'id' => 2472,
                'name' => 'S\'assurer de l\'exploitation de l\'etat des comptes sans mouvements',
                'process_id' => 481,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Etat exploité ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Etat non exploité ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            87 => 
            array (
                'id' => 2473,
                'name' => 'S\'assurer que les clients dont les comptes sont bloqués ou clôturés ont été informés de la situation de leur compte selon la procédure en vigueur.',
                'process_id' => 481,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "clients informés ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "clients non informés", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            88 => 
            array (
                'id' => 2474,
                'name' => 'S\'assurer que la levée de blocage du compte se fait sur la base d\'une demande écrite du client',
                'process_id' => 481,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Demande existe ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de la demande ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            89 => 
            array (
                'id' => 2475,
                'name' => 'Vérifier l\'enregistrement des BDC  en stock sur le système d\'information DELTA ',
                'process_id' => 482,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Bons de caisse saisis", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Bons de caisse non saisis", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            90 => 
            array (
                'id' => 2476,
                'name' => 'Vérifier la conservation du stock des  BDC ainsi que la bonne tenue du registre CA 55',
                'process_id' => 482,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre mal tenu", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Bons de caisse mal conservé ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            91 => 
            array (
                'id' => 2477,
                'name' => 'Vérifier qu\'un état des BDC non utilisés est envoyé trimestriellement aux structures concernées',
                'process_id' => 482,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Etat non transmis ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            92 => 
            array (
                'id' => 2478,
            'name' => 'Vérifier la demande de souscription des bons caisse TI 34 ( montant, durée, signature, le détail des bons émis " nombre, quotité, numéro), cachet, visa….)',
                'process_id' => 483,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné ", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            93 => 
            array (
                'id' => 2479,
            'name' => 'Vérifier le bordereau de saisie du bon caisse (nom prénom, montant, durée, taux appliqué, signatures …)  et sa conformité avec le feuillet N°1 du TI34',
                'process_id' => 483,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            94 => 
            array (
                'id' => 2480,
                'name' => 'Vérifier l\'existence d\'un registre confidentiel détenue par le directeur d\'agence, sous clé, pour les souscriptions des BDC anonymes',
                'process_id' => 483,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Registre existent ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre inexistent ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            95 => 
            array (
                'id' => 2481,
            'name' => 'Dans le cas d\'un taux dérogatoire est aperçue il y a lieu de vérifier que le montant du BDC est supérieur à vingt (20) millions de dinars et un accord a été pris par la structure habilitée ',
                'process_id' => 483,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Accord pris", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Abscence d\'accord ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            96 => 
            array (
                'id' => 2482,
                'name' => 'Vérifier que les souches des bons émis, BDC nantis ou placés en dépôt libre ont été transmis à la DRE',
                'process_id' => 483,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Souche transmise", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Souche non transmise ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            97 => 
            array (
                'id' => 2483,
                'name' => 'Vérifier que le BDC présenté pour remboursement n\'a pas fait objet d\'opposition ',
                'process_id' => 484,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Vérification efféctuée", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Opposition sur BDC Constatée ", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            98 => 
            array (
                'id' => 2484,
                'name' => 'Vérifier l\'existence de la demande du souscripteur en cas de remboursement par anticipation ',
                'process_id' => 484,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Demande apperçue", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Demande non apperçue", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            99 => 
            array (
                'id' => 2485,
                'name' => 'Vérifier la mention "Bon non acquitté souscripteur anonyme"  au verso du bon si le souscripteur refuse d\'acquitter, la date du remboursement, la signature du directeur d\'agence ou son intérimaire. ',
                'process_id' => 484,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal reseigné ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            100 => 
            array (
                'id' => 2486,
            'name' => 'Vérifier que le BDC remboursé (nominatif et anonymes) est revêtu de la mention "Annulé"',
                'process_id' => 484,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Mention portée", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non portée", "value": "Label"}]]',
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'major_fact_types' => NULL,
                'has_major_fact' => 1,
            ),
            101 => 
            array (
                'id' => 2487,
                'name' => 'S\'assurer que le bordereau de remboursement est classé dans le dossier et que la mention  échue est portée dans le dossier  ',
                'process_id' => 484,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "La mention non portée ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Bordereau non classé- ", "value": "Label"}]]',
                'fields' => NULL,
                'major_fact_types' => NULL,
                'has_major_fact' => 0,
            ),
            102 => 
            array (
                'id' => 2488,
                'name' => 'S\'assurer que le feuillet N°1 du TI34 a été réclamé à l\'agence ou le BDC a été souscrit (dans le cas d\'un remboursement à échéances auprés d\'une agence autre que celle de la souscription ',
                    'process_id' => 484,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Réclamé ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non réclamé ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                103 => 
                array (
                    'id' => 2489,
                    'name' => 'Vérifier la demande de souscription du dépôt à terme formulaire ST325 Nom et prénom, montant, durée, signature,.',
                    'process_id' => 485,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                104 => 
                array (
                    'id' => 2490,
                    'name' => 'Vérifier la demande de souscription du dépôt à terme ST326 Nom et prénom, montant, durée, signature,.',
                    'process_id' => 485,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                105 => 
                array (
                    'id' => 2491,
                'name' => 'Vérifier le bordereau de saisie du dépôt à terme  (nom prénom, montant, durée, taux appliqué, signatures …)  et sa conformité avec la demande de soucription ',
                    'process_id' => 485,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                106 => 
                array (
                    'id' => 2492,
                    'name' => 'S\'assurer que les DAT remboursés ne sont pas bloqués ou affectés à la couverture de crédits bancaires ',
                    'process_id' => 486,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "DAT remboursés ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                107 => 
                array (
                    'id' => 2493,
                    'name' => 'S\'assurer de l\'existence d\'une demande de remboursement par anticipation   ',
                    'process_id' => 486,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Demande non apperçue ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                108 => 
                array (
                    'id' => 2494,
                    'name' => 'S\'assurer que les carnets de chèques clientèle sont conservés dans un lieu sécurisé conformément au dispositif de sécurité des coffres forts',
                    'process_id' => 487,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des conditions de conservations ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                109 => 
                array (
                    'id' => 2495,
                    'name' => 'S\'assurer de la délivrance permanente des chéquiers en stock via des invitations adréssées à la clientèle ',
                    'process_id' => 487,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Absence de suivi ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                110 => 
                array (
                    'id' => 2496,
                    'name' => 'S\'assurer de la bonne tenue et de la mise à jours du registre dédié à cet effet ',
                    'process_id' => 488,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non mis à jour ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non tenu ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                111 => 
                array (
                    'id' => 2497,
                    'name' => 'S\'assurer que toutes les entrées et sorties de stock sont effectuées selon un ordre chronologique ',
                    'process_id' => 488,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect de l\'ordre chronologique ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                112 => 
                array (
                    'id' => 2498,
                    'name' => 'S\'assurer que les carnets de chèques de banque sont conservés dans un lieu sécurisé conformément au dispositif de sécurité des coffres forts',
                    'process_id' => 488,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des conditions de conservations ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                113 => 
                array (
                    'id' => 2499,
                    'name' => 'Faire un état de rapprochement entre le stock des BDC et le registre  ',
                    'process_id' => 489,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Discordance constatée ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                114 => 
                array (
                    'id' => 2500,
                    'name' => 'Vérifier l\'enregistrement des BDC  en stock sur le système d\'information DELTA ',
                    'process_id' => 489,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Stock non saisi sur SI ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                115 => 
                array (
                    'id' => 2501,
                    'name' => 'Vérifier la conservation du stock des  BDC ainsi que la bonne tenue du registre CA 55',
                    'process_id' => 489,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre non mis à jour ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu/ Non respect des conditions de conservations ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                116 => 
                array (
                    'id' => 2502,
                    'name' => 'Vérifier qu\'un état des BDC non utilisés est envoyé trimestriellement aux structures concernées',
                    'process_id' => 489,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Etat non transmis", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                117 => 
                array (
                    'id' => 2503,
                    'name' => 'Vérifier que les conditions de conservation sont respectées ',
                    'process_id' => 490,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des conditions de conservations ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                118 => 
                array (
                    'id' => 2504,
                    'name' => 'S\'assurer que toutes les entrées et sorties de stock sont enregistrées correctement selon l\'ordre chronologique avec le visas de la personne habilité ',
                    'process_id' => 490,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                119 => 
                array (
                    'id' => 2505,
                'name' => 'S\'assurer pour les mandataires de l\'établissement de la formule timbrée N°354 (procuration pour coffre fort) ',
                    'process_id' => 491,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de formule timbrée N°354", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                120 => 
                array (
                    'id' => 2506,
                'name' => 'S\'assurer que le montant de la location est prélevé conformément aux conditions de banque (selon le modèle)',
                    'process_id' => 491,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Frais non prélevè ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                121 => 
                array (
                    'id' => 2507,
                    'name' => 'S\'assurer que le montant du cautionnement est prélevé conformément aux conditions de banque et logé au compte d\'ordre approprié "64/35"',
                    'process_id' => 491,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Frais non prélevè ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                122 => 
                array (
                    'id' => 2508,
                'name' => 'S\'assurer qu\'un plan des compartiments est établi et tenu à jour (nom du locataire, la date de location)',
                    'process_id' => 491,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Plan de compartiment non mis à jour", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                123 => 
                array (
                    'id' => 2509,
                'name' => 'S\'assurer de la tenue des cartes de location TI51 (classer par ordre alphabétique) établies au nom des locataires revêtue de leurs signatures et eventuellement des mandataires',
                    'process_id' => 491,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Carte non tenue ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                124 => 
                array (
                    'id' => 2510,
                    'name' => 'S\'assurer de l\'établissement du carnet de visite modèle TI159 avec signature du visiteur et visé par le reponsable habilité  ',
                    'process_id' => 491,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre mal tenu ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                125 => 
                array (
                    'id' => 2511,
                    'name' => 'S\'assurer que la clé de contrôle ainsi que la clé de la salle des coffres sont conservées par un responsable habilité  ',
                    'process_id' => 491,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect de concept séparation des tâches", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                126 => 
                array (
                    'id' => 2512,
                    'name' => 'Vérifier que le registre de chèque de banque est bien tenu et mis à jours ',
                    'process_id' => 492,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non mis à jour ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenue ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                127 => 
                array (
                    'id' => 2513,
                    'name' => 'Vérifier que la demande de délivrance de chèque de banque est bien renseigné, signé, authentification de la signature et apposition du cachet accusé de reception',
                    'process_id' => 492,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                128 => 
                array (
                    'id' => 2514,
                    'name' => 'S\'assurer de la conformité de l\'opération "constitution de la provision, perception de la commission, respect chronologique de la numérotation des chèques de banque délivrés  ',
                    'process_id' => 492,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Provision non constituée", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                129 => 
                array (
                    'id' => 2515,
                    'name' => 'S\'assurer que les souches de chèques de banque sont renseignées, visé par un responsable et bien conservées',
                    'process_id' => 492,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                130 => 
                array (
                    'id' => 2516,
                    'name' => 'S\'assurer que les différents états sont transmis à la DRE et à la direction de la wilaya des impôt pour les clients de passage',
                    'process_id' => 492,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Etats non trasmis ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                131 => 
                array (
                    'id' => 2517,
                    'name' => 'S\'assurer que les chèques de banques ayant dépassés les 03 ans et 20 jours sont traités ',
                    'process_id' => 492,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non triaté ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                132 => 
                array (
                    'id' => 2518,
                    'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                    'process_id' => 492,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                133 => 
                array (
                    'id' => 2519,
                    'name' => 'Vérifier la complétude du dossier de prélèvement ',
                    'process_id' => 493,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Dossier incomplet ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                134 => 
                array (
                    'id' => 2520,
                    'name' => 'Vérifier que l\'agence a notifié sa décision au client',
                    'process_id' => 493,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                135 => 
                array (
                    'id' => 2521,
                    'name' => 'Vérifier que les commissions de gestion de prélèvement ont été prélevées selon les conditions de banques en vigueur  ',
                    'process_id' => 493,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "commissions non prélevées ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                136 => 
                array (
                    'id' => 2522,
                    'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                    'process_id' => 493,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                137 => 
                array (
                    'id' => 2523,
                    'name' => 'Vérifier que les bordereaux PF37 ou PF 229 sont bien renseignés et signés par le client authentification de la signature et apposition du cachet accusé de reception',
                    'process_id' => 494,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                138 => 
                array (
                    'id' => 2524,
                    'name' => 'S\'assurer que les effets escomptés sont conformes à l\'autorisation de crédit ',
                    'process_id' => 494,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non conforme à l\'autorisation ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                139 => 
                array (
                    'id' => 2525,
                    'name' => 'Vérifier la bonne tenue et la mise à jour du regsirtre,',
                    'process_id' => 494,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non tenu", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                140 => 
                array (
                    'id' => 2526,
                    'name' => 'Vérifier les conditions de conservation des effets ',
                    'process_id' => 494,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des conditions de conservation ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                141 => 
                array (
                    'id' => 2527,
                    'name' => 'Vérifier que les différents états édités sont exploités',
                    'process_id' => 494,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Etats non édités/non exploités ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                142 => 
                array (
                    'id' => 2528,
                    'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                    'process_id' => 494,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                143 => 
                array (
                    'id' => 2529,
                    'name' => 'S\'assurer que les ordres de virements sont bien renseignés et signés ',
                    'process_id' => 495,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/ non signé", "value": "Label"}]]',
                    'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                144 => 
                array (
                    'id' => 2530,
                    'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                    'process_id' => 495,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                145 => 
                array (
                    'id' => 2531,
                    'name' => 'S\'assurer que les différents états sont édités et exploités ',
                    'process_id' => 495,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Etats non éditer/non exploiter ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                146 => 
                array (
                    'id' => 2532,
                    'name' => 'Vérifier que les ordres de virements sont bien renseignés et signés',
                    'process_id' => 496,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/ non signé", "value": "Label"}]]',
                    'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                147 => 
                array (
                    'id' => 2533,
                    'name' => 'Vérifier que les ordres de virements sont enregistrés ',
                    'process_id' => 496,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non enregistrés ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                148 => 
                array (
                    'id' => 2534,
                    'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                    'process_id' => 496,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                149 => 
                array (
                    'id' => 2535,
                    'name' => 'S\'assurer que les différents états sont édités et exploités ',
                    'process_id' => 496,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Etats non éditer/non exploiter ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                150 => 
                array (
                    'id' => 2536,
                    'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                    'process_id' => 497,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                151 => 
                array (
                    'id' => 2537,
                    'name' => 'S\'assurer des conditions de conservation des cartes et codes confidentiels ',
                    'process_id' => 497,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non conservé dans un coffre ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                152 => 
                array (
                    'id' => 2538,
                    'name' => 'S\'assurer que les clients n\'ayant pas retirés leurs cartes ont été relancés',
                    'process_id' => 497,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "client non relancés ", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                153 => 
                array (
                    'id' => 2539,
                'name' => 'S\'assurer du respect de la procédure d\'oblitération des cartes (délai, PV)  ',
                    'process_id' => 497,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Procédure non respectée ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                154 => 
                array (
                    'id' => 2540,
                    'name' => 'Sassurer que le registre est bien renseingé, signé par le client',
                    'process_id' => 497,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/Non signé par le client ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                155 => 
                array (
                    'id' => 2541,
                    'name' => 'S\'assurer que les codes confidentiels ainsi que les cartes sont conservées séparément dans un coffre ',
                    'process_id' => 497,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                156 => 
                array (
                    'id' => 2542,
                    'name' => 'S\'assurer de la mise à jours du fichier de stock des cartes ',
                    'process_id' => 497,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non mis à jours", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                157 => 
                array (
                    'id' => 2543,
                    'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                    'process_id' => 498,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                158 => 
                array (
                    'id' => 2544,
                    'name' => 'S\'assurer que les commissions ont été prélevés selon les conditions de banque',
                    'process_id' => 498,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "commissions non prélevées/Non respect des conditions de banque", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                159 => 
                array (
                    'id' => 2545,
                    'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                    'process_id' => 499,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                160 => 
                array (
                    'id' => 2546,
                    'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                    'process_id' => 500,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                161 => 
                array (
                    'id' => 2547,
                    'name' => 'S\'assurer que les commissions ont été prélevés selon les conditions de banque',
                    'process_id' => 500,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "commissions non prélevées/Non respect des conditions de banque", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                162 => 
                array (
                    'id' => 2548,
                    'name' => 'Vérifier les renseignements de la demande et le traitement dans les délais',
                    'process_id' => 501,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                163 => 
                array (
                    'id' => 2549,
                    'name' => 'Vérifier les renseignements de la demande et le traitement dans les délais',
                    'process_id' => 502,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                164 => 
                array (
                    'id' => 2550,
                    'name' => 'S\'assurer de l\'établissement des formulaires de la mise et levée en exception signés par le directeur d\'agence et qu\'ils sont transmis à la DM au temps opportun ',
                    'process_id' => 502,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Formulaires non établies", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                165 => 
                array (
                    'id' => 2551,
                'name' => 'S\'assurer que le contrat d\'adhésion est signé par les deux (02) parties (client et agence)',
                    'process_id' => 503,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Contrat non signé ", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                166 => 
                array (
                    'id' => 2552,
                    'name' => 'S\'assurer que l\'installation du TPE est matérialisé par un PV signé par l\'ingénieur et le commerçant et un PV de formation ',
                    'process_id' => 503,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "PV non établis", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                167 => 
                array (
                    'id' => 2553,
                    'name' => 'S\'assurer que les réclamations de la clientèles sont prises en charge au temps opportun ',
                    'process_id' => 504,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Réclamation non prise en charge ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                168 => 
                array (
                    'id' => 2554,
                    'name' => 'S\'assurer que le formulaire de contestation est visé par un responsble habilité et envoyé à la DM',
                    'process_id' => 505,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Non visé ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non envoyé ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                169 => 
                array (
                    'id' => 2555,
                    'name' => 'S\'assurer que le contrat d\'adhésion est renseigné, signé par le client et l\'agence ',
                    'process_id' => 506,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non renseigné/non signé ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                170 => 
                array (
                    'id' => 2556,
                    'name' => 'Vérifier que le registre tenu à cet effet est bien rensigné et mis à jour',
                    'process_id' => 507,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné et /ou non mis à jours", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                171 => 
                array (
                    'id' => 2557,
                'name' => 'S\'assurer que l\'attestation de change (CV1) est signé par le responsable habilité ',
                    'process_id' => 507,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Attestation non signé ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                172 => 
                array (
                    'id' => 2558,
                    'name' => 'S\'assurer que le bordereau de vente de devises est signé par le guichetier et le client',
                    'process_id' => 507,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                    'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "N° Bordereau de vente de devises"}, {"name": "currency_sale_bordereau_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "currency_sale_bordereau_number_field"}, {"placeholder": "Entrez le numéro de bordereau de vente de devises"}, {"help_text": "Saisissez le numéro de bordereau de vente de devises tel qu\'il apparaît sur le document correspondant. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                173 => 
                array (
                    'id' => 2559,
                    'name' => 'S\'assurer de l\'éligibilité du client aux frais de missions',
                    'process_id' => 508,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Client non éligible ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                174 => 
                array (
                    'id' => 2560,
                    'name' => 'S\'assurer que le dossier de frais de mission comporte tous les documents exigés par la règlementation ',
                    'process_id' => 508,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier complet ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Dossier incomplet ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                175 => 
                array (
                    'id' => 2561,
                'name' => 'S\'assurer que les frais de mission accordés aux client sont conformes aux barèmes (montant, duré, catégorie des pays)',
                    'process_id' => 508,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Respect du barème", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect du barèmes ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                176 => 
                array (
                    'id' => 2562,
                    'name' => 'S\'assurer que le dossier d\'apurement comprend copie de l\'ordre de mission visée par les services de police algérienne des frontières durant les 15 jours qui suivent la date de retour prévue dans l\'ordre de mission ',
                    'process_id' => 508,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier appuré", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Dossier non appuré ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                177 => 
                array (
                    'id' => 2563,
                    'name' => 'S\'assurer que le dossier de frais de scolarités comporte tous les documents exigés par la règlementation',
                    'process_id' => 509,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier complet ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Dossier incomplet ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                178 => 
                array (
                    'id' => 2564,
                'name' => 'S\'assurer que le client n\'a pas dépassé l\'autorisation mensuelle (9000,00 DA/mois) et la durée(maximum 10 mois)  ',
                    'process_id' => 509,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Respect de l\'autorisation", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Dépassement de l\'autorisation ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                179 => 
                array (
                    'id' => 2565,
                    'name' => 'Vérifier que l\'ordre de virement CT 18 est bien renseigné, signé par le client et visé par le reponsable habilité ',
                    'process_id' => 509,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non signé et ou non visé ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                180 => 
                array (
                    'id' => 2566,
                    'name' => 'S\'assurer que le dossier comporte tous les documents exigés par la règlementation ',
                    'process_id' => 510,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier complet ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Dossier incomplet ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                181 => 
                array (
                    'id' => 2567,
                    'name' => 'S\'assurer que le dossier d\'apurement comprend la facture définitive attestant le montant des préstations rendues par l\'établissement hospitalier étranger',
                    'process_id' => 510,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier appuré", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Dossier non appuré ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                182 => 
                array (
                    'id' => 2568,
                'name' => 'S\'assurer que le montant et la durée autorisés pour les soins à l\'étranger ne soient pas  dépassé (120 000,00 DA/année civil)',
                    'process_id' => 510,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Respect de l\'autorisation", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Dépassement de l\'autorisation ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                183 => 
                array (
                    'id' => 2569,
                    'name' => 'S\'assurer de l\'éligibilité du client à la cession de devises ',
                    'process_id' => 511,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Client éligible", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Client non éligible ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                184 => 
                array (
                    'id' => 2570,
                    'name' => 'S\'assurer que les documents présentés sont conformes à la règlementation ',
                    'process_id' => 511,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier complet ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Dossier incomplet ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                185 => 
                array (
                    'id' => 2571,
                    'name' => 'Vérifier que le formulaire de versement CA1112 est bien renseigné',
                    'process_id' => 511,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                186 => 
                array (
                    'id' => 2572,
                    'name' => 'S\'assurer de l\'existence du registre y relatif et sa bonne tenue ',
                    'process_id' => 512,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/ Non mis à jour ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre inexistant ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                187 => 
                array (
                    'id' => 2573,
                    'name' => 'S\'assurer que les clients frappés d\'ATD/oppositions ont été saisis, dans les délais, par lettres recommandées ainsi que le créancier ',
                    'process_id' => 512,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Client non saisi / créancier non avisé ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                188 => 
                array (
                    'id' => 2574,
                    'name' => 'S\'assurer du blocage du compte et ou provision ',
                    'process_id' => 512,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Compte non bloqué ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                189 => 
                array (
                    'id' => 2575,
                'name' => 'S\'assurer qu\'aucun mouvement débit n\'a été opéré durant la validité de l\'ATD qui est une année (01) pour les personnes physiques, quatre (04) ans pour les personnes morales et quatre (04) ans pour les oppositions des organismes sociaux  ',
                    'process_id' => 512,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Mouvement opéré sur le compte ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                190 => 
                array (
                    'id' => 2576,
                'name' => 'S\'assurer que les frais ont été prélevés selon le barème en vigueur (ATD/Oppositions)',
                    'process_id' => 512,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Frais non prélevé ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                191 => 
                array (
                    'id' => 2577,
                'name' => 'Vérifier la bonne fin de l\'ATD/oppositions  (mainlevée, expiration délai de validité, exécution du virement)',
                    'process_id' => 512,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Délai expiré ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Déblocage de la provision sans la main levée ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                192 => 
                array (
                    'id' => 2578,
                    'name' => 'S\'assurer de L\'existence du registre y afférent et sa bonne tenue ',
                    'process_id' => 513,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/ Non mis à jour ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre inexistant ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                193 => 
                array (
                    'id' => 2579,
                    'name' => 'S\'assurer du blocage des avoirs/cantonnement ',
                    'process_id' => 513,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Avoirs/cantonnement  non bloqués  ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                194 => 
                array (
                    'id' => 2580,
                    'name' => 'S\'assurer des prélèvements des frais selon les conditions de banque en vigueur ',
                    'process_id' => 513,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Frais non prélevé  ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                195 => 
                array (
                    'id' => 2581,
                    'name' => 'S\'assurer que le client est avisé à temps au moyen d\'une lettre recommandée avec accusé de réception ',
                    'process_id' => 513,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Client non avisé ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                196 => 
                array (
                    'id' => 2582,
                    'name' => 'S\'assurer que les avoirs bloqués demeurent jusqu\'à délivrance d\'une main levée, ou une ordonnance de la juridiction compétente prononçant après validation la sommation de payer au créancier les sommes saisies ',
                    'process_id' => 513,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Avoirs débloqués sans main levée ou ordonnance", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                197 => 
                array (
                    'id' => 2583,
                    'name' => 'S\'assurer que la saisie arrêt judiciaire est signifiée par un huissier ',
                    'process_id' => 513,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "PV non signifié ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                198 => 
                array (
                    'id' => 2584,
                    'name' => 'S\'assurer de L\'existence du registre y afférent et sa bonne tenue ',
                    'process_id' => 514,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/ Non mis à jour ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre inexistant ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                199 => 
                array (
                    'id' => 2585,
                'name' => 'Vérifier les demandes d\'oppositions ( date d\'émission, n°chèque, n°de cpte de l\'émetteur, nom bénéficiaire, N°du BDC, motif, authentification de la signature…)     ',
                    'process_id' => 514,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Demande non remise par le client ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                200 => 
                array (
                    'id' => 2586,
                    'name' => 'S\'assurer que l\'opposition est saisie sur système',
                    'process_id' => 514,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Opposition non saisie sur SI ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                201 => 
                array (
                    'id' => 2587,
                    'name' => 'S\'assurer des prélèvements des frais selon les conditions de banque en vigueur ',
                    'process_id' => 514,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Frais non prélevé ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                202 => 
                array (
                    'id' => 2588,
                    'name' => 'S\'assurer de la diffusion des oppositions via DRE et DEJC',
                    'process_id' => 514,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Opposition non diffusé ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                203 => 
                array (
                    'id' => 2589,
                'name' => 'S\'assurer que la restitution de la provision est intervenue suite à une main levée, lettre de garantie ou une décision de justice notifiée par un huissier (cas d\'un litige)',
                    'process_id' => 514,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Provion restitué sans main levée/ lettre de garantie/décision de justice    ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                204 => 
                array (
                    'id' => 2590,
                'name' => 'S\'assurer du respect de délai de l\'opposition (03 ans et 20 jours pour les chèques, 03 ans pour les BDC) ',
                    'process_id' => 514,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Délai expiré ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                205 => 
                array (
                    'id' => 2591,
                    'name' => 'Vérifier si l\'opposition du BDC est porté sur le feuillet n°1 du formulaire TI 34',
                    'process_id' => 514,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Opposition non porté sur TI34", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                206 => 
                array (
                    'id' => 2592,
                    'name' => 'Vérifier que les déclarations des incidents sont effectuées durant les 02 jours ouvrables suivant la date de présentation du chèque ',
                    'process_id' => 515,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Déclarations non établies ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                207 => 
                array (
                    'id' => 2593,
                    'name' => 'Vérifier que les déclarations des régularisations des incidents sont effectuées',
                    'process_id' => 515,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Déclarations de régules non établies ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                208 => 
                array (
                    'id' => 2594,
                    'name' => 'Vérifier que la première injonction a été transmise aux clients par lettre recommandée avec accusé de réception au plus tard J+4 ouvrable à compter de la date de présentation du chèque dans un délai n\'excédent pas les 10 jours  ',
                    'process_id' => 515,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Première injonction non transmise ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                209 => 
                array (
                    'id' => 2595,
                    'name' => 'Vérifier que les clients interdits de chéquiers sont déclarés ',
                    'process_id' => 515,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Client interdit de chéquier non déclaré ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                210 => 
                array (
                    'id' => 2596,
                    'name' => 'Vérifier que la deuxième lettre d\'injonction a été transmise au client pour régularisation de l\'incident de paiement dans un délai de 20 jours à compter de l\'expiration du premier délai légal   ',
                    'process_id' => 515,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Deuxième injonction non transmise ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                211 => 
                array (
                    'id' => 2597,
                    'name' => 'Vérifier que la déclaration d\'interdit de chéquier a été établie en cas de récidive dont les 12 mois',
                    'process_id' => 515,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Faculté de régularisation  accordée au client ayant un incident de paiement durant 12 mois ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                212 => 
                array (
                    'id' => 2598,
                'name' => 'Vérifier l\'acquitement d\'une pénalité libératoire au profit du trésor (timbres fiscaux, quittances de paiement) pour les cas de régularisations durant le deuxième délai légal de 20 jours ',
                    'process_id' => 515,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Pénalité libératoire au profit du trésor nn acquitté ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                213 => 
                array (
                    'id' => 2599,
                    'name' => 'S\'assurer de l\'existence du registre y relatif et sa bonne tenue et mise à jour',
                    'process_id' => 516,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/ Non mis à jour ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre inexistant ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                214 => 
                array (
                    'id' => 2600,
                    'name' => 'Vérifier la constitution des dossiers ainsi que leur classement et leur conservation ',
                    'process_id' => 516,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Dossier mal classé ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Dossier mal conservé ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                215 => 
                array (
                    'id' => 2601,
                    'name' => 'Vérifier que l\'agence a bloqué immediatement les avoirs du client décédé ',
                    'process_id' => 516,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Les avoirs non bloqués ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                216 => 
                array (
                    'id' => 2602,
                    'name' => 'S\'assurer que la diffusion de la succession a été établie ',
                    'process_id' => 516,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Diffusion non établie ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                217 => 
                array (
                    'id' => 2603,
                    'name' => 'Sassurer de l\'arrêté comptable des comptes en capital et intérêt à la date du décés  ',
                    'process_id' => 516,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Arrêté comptable non établie", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                218 => 
                array (
                    'id' => 2604,
                    'name' => 'S\'assurer de la Transmission des CA2 et CA50 à la DRE en cas de liquidation de la succession ',
                    'process_id' => 516,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Les CA2 et CA50 non transmis à la DRE", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                219 => 
                array (
                    'id' => 2605,
                'name' => 'S\'assurer du respect du délai de règlement de la succession (20 jours Max) ',
                    'process_id' => 516,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect du délai ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                220 => 
                array (
                    'id' => 2606,
                    'name' => 'S\'assurer qu\'aucune émission de chèque n\'a été émis après la date du décès',
                    'process_id' => 516,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Chèque rejeté ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                221 => 
                array (
                    'id' => 2607,
                    'name' => 'S\'assurer qu\'à l\'issue du décompte les actifs détenus sont déclarés à la sous direction de wilaya des impôts directs au bureau de l\'enregistrement et du timbre ',
                    'process_id' => 516,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Non déclaré ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence du quitus ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                222 => 
                array (
                    'id' => 2608,
                    'name' => 'S’assurer que les formulaires sont dûment renseignés ',
                    'process_id' => 517,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Formulaires inexistant ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                223 => 
                array (
                    'id' => 2609,
                    'name' => 'S’assurer que tous les US person identifiés ont été déclarés y compris les récalcitrants ',
                    'process_id' => 517,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non déclaré ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                224 => 
                array (
                    'id' => 2610,
                    'name' => 'S’assurer que le formulaire KYC est dûment renseigné',
                    'process_id' => 518,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Formulaire inéxistant ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                225 => 
                array (
                    'id' => 2611,
                    'name' => 'S\'assurer de la mise à jour du dossier d\'ouverture de compte et de la fiche client ',
                    'process_id' => 518,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Dossier non mis à jour ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                226 => 
                array (
                    'id' => 2612,
                    'name' => 'S’assurer qu’une lettre de courtoisie ou d’avis d’ouverture de compte ont été envoyée au client',
                    'process_id' => 518,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Lettre non transmise ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                227 => 
                array (
                    'id' => 2613,
                    'name' => 'S’assurer que toute alerte SMART AML a fait l’objet d’analyse, et établissement d’un rapport confidentiel dans le cas échéant',
                    'process_id' => 518,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                228 => 
                array (
                    'id' => 2614,
                    'name' => 'S’assurer que le registre des alertes est bien tenu et mis à jour',
                    'process_id' => 518,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registe non tenu/non mis à jour ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                229 => 
                array (
                    'id' => 2615,
                    'name' => 'S’assurer que le flux d\'opérations enregistré est cohérent avec la nature de fonctionnement du compte',
                    'process_id' => 518,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Opérations non conformes avec la nature du compte ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                230 => 
                array (
                    'id' => 2616,
                    'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents éxigés par la banque ',
                    'process_id' => 519,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "manque certain document", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                231 => 
                array (
                    'id' => 2617,
                    'name' => 'Vérifier que le récépissé de dépôt de crédit est établi ',
                    'process_id' => 519,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                232 => 
                array (
                    'id' => 2618,
                    'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                    'process_id' => 519,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                233 => 
                array (
                    'id' => 2619,
                    'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée ainsi que la réponse de cette dernière ',
                    'process_id' => 519,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                234 => 
                array (
                    'id' => 2620,
                    'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                    'process_id' => 519,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                235 => 
                array (
                    'id' => 2621,
                    'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées ',
                    'process_id' => 519,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Délais non respecter", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                236 => 
                array (
                    'id' => 2622,
                    'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                    'process_id' => 520,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                237 => 
                array (
                    'id' => 2623,
                    'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                    'process_id' => 520,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                238 => 
                array (
                    'id' => 2624,
                    'name' => 'Vérifier que le ticket d\'autorisation est établi selon la réglementation en vigueur ',
                    'process_id' => 520,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "discordonce entre le PV et le ticket d\'autorisation ", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                239 => 
                array (
                    'id' => 2625,
                'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                    'process_id' => 520,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                240 => 
                array (
                    'id' => 2626,
                    'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                    'process_id' => 521,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constées ", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                241 => 
                array (
                    'id' => 2627,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevés conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                    'process_id' => 521,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                242 => 
                array (
                    'id' => 2628,
                    'name' => 'S\'assurer de la domiciliation préalable du salaire',
                    'process_id' => 521,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Salaire non domicilié", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                243 => 
                array (
                    'id' => 2629,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                    'process_id' => 522,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "autorisation mal saisie ", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                244 => 
                array (
                    'id' => 2630,
                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties)   ',
                    'process_id' => 522,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                245 => 
                array (
                    'id' => 2631,
                'name' => 'S\'assurer de la délivrance d\'un chèque de banque à l\'ordre du concessionaire, sous présentation des pièces justificatives (engagement du gage du véhicule au profit de la banque)',
                    'process_id' => 522,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Absence d\'accusé de réception ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Utlisation d\'un autre moyen de paiement ", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                246 => 
                array (
                    'id' => 2632,
                    'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                    'process_id' => 522,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                247 => 
                array (
                    'id' => 2633,
                'name' => 'S\'assurer du recueil des garanties à postériori (gage, Assurance tous risques avec subrogation)',
                    'process_id' => 523,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garantie non recueilli/Absence de suivi", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                248 => 
                array (
                    'id' => 2634,
                    'name' => ' S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé.',
                    'process_id' => 524,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                249 => 
                array (
                    'id' => 2635,
                    'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque',
                    'process_id' => 525,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "manque certain document", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                250 => 
                array (
                    'id' => 2636,
                    'name' => 'Vérifier que le récépissé de dépôt de crédit est établi ',
                    'process_id' => 525,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                251 => 
                array (
                    'id' => 2637,
                    'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                    'process_id' => 525,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                252 => 
                array (
                    'id' => 2638,
                    'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette dernière ',
                    'process_id' => 525,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                253 => 
                array (
                    'id' => 2639,
                    'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                    'process_id' => 525,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                254 => 
                array (
                    'id' => 2640,
                    'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées ',
                    'process_id' => 525,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Délais non respecté", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                255 => 
                array (
                    'id' => 2641,
                    'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                    'process_id' => 526,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                256 => 
                array (
                    'id' => 2642,
                    'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                    'process_id' => 526,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                    'fields' => NULL,
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                257 => 
                array (
                    'id' => 2643,
                    'name' => 'Vérifier que le ticket d\'autorisation est établi selon la règlementation en vigueur ',
                    'process_id' => 526,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "discordonce entre le PV et le ticket d\'autorisation ", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                258 => 
                array (
                    'id' => 2644,
                'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                    'process_id' => 526,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                259 => 
                array (
                    'id' => 2645,
                    'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                    'process_id' => 527,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 1,
                ),
                260 => 
                array (
                    'id' => 2646,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                    'process_id' => 527,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                261 => 
                array (
                    'id' => 2647,
                    'name' => 's\'assurer de la domiciliation préalable du salaire',
                    'process_id' => 527,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Salaire non domicilié", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                262 => 
                array (
                    'id' => 2648,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                    'process_id' => 528,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "autorisation mal saisie ", "value": "Label"}]]',
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'major_fact_types' => NULL,
                    'has_major_fact' => 0,
                ),
                263 => 
                array (
                    'id' => 2649,
                    'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                        'process_id' => 528,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    264 => 
                    array (
                        'id' => 2650,
                        'name' => 'S\'assurer de la délivrance d\'un chèque de banque à l\'ordre du fournisseur, sous présentation des pièces justificatives.',
                        'process_id' => 528,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Utlisation d\'un autre moyen de paiement ", "value": "Label"}]]',
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 1,
                    ),
                    265 => 
                    array (
                        'id' => 2651,
                        'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                        'process_id' => 528,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 1,
                    ),
                    266 => 
                    array (
                        'id' => 2652,
                        'name' => ' S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé.',
                        'process_id' => 529,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 1,
                    ),
                    267 => 
                    array (
                        'id' => 2653,
                        'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque ',
                        'process_id' => 530,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "manque certain document", "value": "Label"}]]',
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 1,
                    ),
                    268 => 
                    array (
                        'id' => 2654,
                    'name' => 'Vérifier que le récépissé de dépôt (provisoire, définitif) de crédit est établi ',
                        'process_id' => 530,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    269 => 
                    array (
                        'id' => 2655,
                        'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                        'process_id' => 530,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                        'fields' => NULL,
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    270 => 
                    array (
                        'id' => 2656,
                        'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la reponse de cette dernière  ',
                        'process_id' => 530,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    271 => 
                    array (
                        'id' => 2657,
                        'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                        'process_id' => 530,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    272 => 
                    array (
                        'id' => 2658,
                        'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées ',
                        'process_id' => 530,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Délais non respecter", "value": "Label"}]]',
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    273 => 
                    array (
                        'id' => 2659,
                    'name' => 'S\'assurer du respect des pouvoirs de délégation (Comité agence, DRE, central)',
                        'process_id' => 531,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect des pouvoirs de sanction ", "value": "Label"}]]',
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    274 => 
                    array (
                        'id' => 2660,
                        'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                        'process_id' => 531,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    275 => 
                    array (
                        'id' => 2661,
                        'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                        'process_id' => 531,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    276 => 
                    array (
                        'id' => 2662,
                        'name' => 'Vérifier que le ticket d\'autorisation est établi selon la réglementation en vigueur ',
                        'process_id' => 531,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "discordonce entre le PV et le ticket d\'autorisation ", "value": "Label"}]]',
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 1,
                    ),
                    277 => 
                    array (
                        'id' => 2663,
                    'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                        'process_id' => 531,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    278 => 
                    array (
                        'id' => 2664,
                    'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                        'process_id' => 532,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des délégations de pouvoirs", "value": "Label"}]]',
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    279 => 
                    array (
                        'id' => 2665,
                        'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                        'process_id' => 532,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 1,
                    ),
                    280 => 
                    array (
                        'id' => 2666,
                    'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                        'process_id' => 532,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    281 => 
                    array (
                        'id' => 2667,
                        'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                        'process_id' => 532,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non enregistrées", "value": "Label"}]]',
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 1,
                    ),
                    282 => 
                    array (
                        'id' => 2668,
                        'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                        'process_id' => 532,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 1,
                    ),
                    283 => 
                    array (
                        'id' => 2669,
                    'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, taux d\'intérêt, la validité de l\'autorisation) ',
                        'process_id' => 533,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "autorisation mal saisie ", "value": "Label"}]]',
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'major_fact_types' => NULL,
                        'has_major_fact' => 0,
                    ),
                    284 => 
                    array (
                        'id' => 2670,
                        'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                            'process_id' => 533,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 1,
                        ),
                        285 => 
                        array (
                            'id' => 2671,
                            'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                            'process_id' => 533,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 1,
                        ),
                        286 => 
                        array (
                            'id' => 2672,
                            'name' => 'Vérifier que la mobilisation du crédit a été effectuée selon les modalités d\'acquisition et de paiement du logement ',
                            'process_id' => 533,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des mobilisations ", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 1,
                        ),
                        287 => 
                        array (
                            'id' => 2673,
                            'name' => 'S\'assurer que le suivi des granties à postériori est effectué',
                            'process_id' => 534,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi/non validé", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 1,
                        ),
                        288 => 
                        array (
                            'id' => 2674,
                            'name' => 'S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé ',
                            'process_id' => 535,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 1,
                        ),
                        289 => 
                        array (
                            'id' => 2675,
                            'name' => 'S\'assurer si l\'indemnité de 04% sur le solde restant a été payé en cas de remboursement par anticipation ',
                            'process_id' => 535,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Indemnité non prélevée", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        290 => 
                        array (
                            'id' => 2676,
                        'name' => 'Vérifier que le capital restant a été viré au compte CCIR en cas du décés de l\'emprunteur ou du conjoint (co-emprunteur)',
                            'process_id' => 535,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "capital non viré au CCIR", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 1,
                        ),
                        291 => 
                        array (
                            'id' => 2677,
                            'name' => 'Vérifier que le délai global de la déclaration du sinistre n\'a pas dépassé les 90 jours après sa date de survenance ',
                            'process_id' => 535,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "dépassement de délai", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        292 => 
                        array (
                            'id' => 2678,
                            'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents fournis par le client ',
                            'process_id' => 536,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "manque certain document", "value": "Label"}]]',
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 1,
                        ),
                        293 => 
                        array (
                            'id' => 2679,
                            'name' => 'Vérifier que le récépissé de dépôt de crédit est établi ',
                            'process_id' => 536,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        294 => 
                        array (
                            'id' => 2680,
                            'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                            'process_id' => 536,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                            'fields' => NULL,
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        295 => 
                        array (
                            'id' => 2681,
                            'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée ainsi que la réponse de cette dernière ',
                            'process_id' => 536,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 1,
                        ),
                        296 => 
                        array (
                            'id' => 2682,
                            'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                            'process_id' => 536,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        297 => 
                        array (
                            'id' => 2683,
                            'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées ',
                            'process_id' => 536,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Délais non respecter", "value": "Label"}]]',
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        298 => 
                        array (
                            'id' => 2684,
                            'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                            'process_id' => 537,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        299 => 
                        array (
                            'id' => 2685,
                            'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                            'process_id' => 537,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        300 => 
                        array (
                            'id' => 2686,
                            'name' => 'Vérifier que le ticket d\'autorisation est établi sur la base d\'un selon la réglementation en vigueur',
                            'process_id' => 537,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "discordonce entre le PV et le ticket d\'autorisation ", "value": "Label"}]]',
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 1,
                        ),
                        301 => 
                        array (
                            'id' => 2687,
                        'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                            'process_id' => 537,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        302 => 
                        array (
                            'id' => 2688,
                            'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                            'process_id' => 538,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 1,
                        ),
                        303 => 
                        array (
                            'id' => 2689,
                        'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                            'process_id' => 538,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        304 => 
                        array (
                            'id' => 2690,
                            'name' => 'S\'assurer de la domiciliation préalable du salaire',
                            'process_id' => 538,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "salaire non domicilié", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        305 => 
                        array (
                            'id' => 2691,
                            'name' => 'S\'assurer de l\'existence de l\'engagement de location ',
                            'process_id' => 538,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Inexistence de l\'engagement", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 1,
                        ),
                        306 => 
                        array (
                            'id' => 2692,
                        'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                            'process_id' => 538,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "autorisation mal saisie ", "value": "Label"}]]',
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                            'major_fact_types' => NULL,
                            'has_major_fact' => 0,
                        ),
                        307 => 
                        array (
                            'id' => 2693,
                            'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                                'process_id' => 538,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            308 => 
                            array (
                                'id' => 2694,
                                'name' => 'S\'assurer de la délivrance d\'un chèque de banque à l\'ordre du notaire, sous présentation des pièces justificatives.',
                                'process_id' => 538,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Utlisation d\'un autre moyen de paiement ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            309 => 
                            array (
                                'id' => 2695,
                                'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                                'process_id' => 538,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            310 => 
                            array (
                                'id' => 2696,
                                'name' => 'S\'assurer de l\'enregistrement du contrat de location auprès de l\'administration habilitée',
                                'process_id' => 539,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non enregistré ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            311 => 
                            array (
                                'id' => 2697,
                                'name' => ' S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué',
                                'process_id' => 540,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            312 => 
                            array (
                                'id' => 2698,
                                'name' => 'Vérifier que les activités financées rentre bien dans le cadre des activités finançables par la banque',
                                'process_id' => 541,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Acitivité non finaçable par la banque", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            313 => 
                            array (
                                'id' => 2699,
                                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque',
                                'process_id' => 541,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "manque certain document", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            314 => 
                            array (
                                'id' => 2700,
                            'name' => 'Vérifier que le récépissé de dépôt (provisoire, définitif) de crédit est établi et correspond au type de crédit ',
                                'process_id' => 541,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            315 => 
                            array (
                                'id' => 2701,
                                'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                                'process_id' => 541,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                                'fields' => NULL,
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            316 => 
                            array (
                                'id' => 2702,
                                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette structure  ',
                                'process_id' => 541,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            317 => 
                            array (
                                'id' => 2703,
                                'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122 ',
                                'process_id' => 541,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Visite non effectuée ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            318 => 
                            array (
                                'id' => 2704,
                                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                                'process_id' => 541,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            319 => 
                            array (
                                'id' => 2705,
                                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées',
                                'process_id' => 541,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Délais non respecter", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            320 => 
                            array (
                                'id' => 2706,
                            'name' => 'S\'assurer du traitement des dossiers suivant les pouvoirs de délégation (Comité agence, DRE, central)',
                                'process_id' => 542,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect des pouvoirs de sanction ", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            321 => 
                            array (
                                'id' => 2707,
                                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                                'process_id' => 542,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            322 => 
                            array (
                                'id' => 2708,
                                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                                'process_id' => 542,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            323 => 
                            array (
                                'id' => 2709,
                                'name' => 'Vérifier que le ticket d\'autorisation est établi selon la règlementation en vigueur ',
                                'process_id' => 542,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "discordonce entre le PV et le ticket d\'autorisation ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            324 => 
                            array (
                                'id' => 2710,
                            'name' => 'S\'assurer que la décision du comité (accord ou rejet ) est notifiée au client ',
                                'process_id' => 542,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            325 => 
                            array (
                                'id' => 2711,
                            'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                                'process_id' => 543,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des délégations de pouvoirs", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            326 => 
                            array (
                                'id' => 2712,
                                'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                                'process_id' => 543,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            327 => 
                            array (
                                'id' => 2713,
                            'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                                'process_id' => 543,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            328 => 
                            array (
                                'id' => 2714,
                                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernées ',
                                'process_id' => 543,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non enregistrées", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            329 => 
                            array (
                                'id' => 2715,
                                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                'process_id' => 543,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            330 => 
                            array (
                                'id' => 2716,
                            'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                                'process_id' => 544,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "autorisation mal saisie ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            331 => 
                            array (
                                'id' => 2717,
                                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies',
                                'process_id' => 544,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            332 => 
                            array (
                                'id' => 2718,
                                'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                                'process_id' => 544,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            333 => 
                            array (
                                'id' => 2719,
                                'name' => 'S\'assurer que les garanties à postériori mentionnées sur le ticket d\'autorisation sont recueillies ',
                                'process_id' => 545,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non réalisées", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            334 => 
                            array (
                                'id' => 2720,
                                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernées ',
                                'process_id' => 545,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non enregistrées", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            335 => 
                            array (
                                'id' => 2721,
                                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                'process_id' => 545,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            336 => 
                            array (
                                'id' => 2722,
                                'name' => 'S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé ',
                                'process_id' => 546,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            337 => 
                            array (
                                'id' => 2723,
                                'name' => 'S\'assurer que les visites sur site sont efféctuées après réalisation du projet',
                                'process_id' => 546,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "visite sur site non effectuée", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            338 => 
                            array (
                                'id' => 2724,
                                'name' => 'Vérifier que les activités financées rentre bien dans le cadre des activités finançables par la banque',
                                'process_id' => 547,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Acitivité non finaçable par la banque", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            339 => 
                            array (
                                'id' => 2725,
                                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque',
                                'process_id' => 547,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "manque certain document", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            340 => 
                            array (
                                'id' => 2726,
                                'name' => 'Vérifier que le récépissé de dépôt de dossier de crédit est établi ',
                                'process_id' => 547,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            341 => 
                            array (
                                'id' => 2727,
                                'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                                'process_id' => 547,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                                'fields' => NULL,
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            342 => 
                            array (
                                'id' => 2728,
                                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée ainsi que la réponse de cette dernière',
                                'process_id' => 547,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "La demande de consultation non transmise", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            343 => 
                            array (
                                'id' => 2729,
                                'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122 et/ou un rapport d\'expertise',
                                'process_id' => 547,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Visite non effectuée ", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            344 => 
                            array (
                                'id' => 2730,
                                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                                'process_id' => 547,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            345 => 
                            array (
                                'id' => 2731,
                                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées ',
                                'process_id' => 547,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Délais non respecter", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            346 => 
                            array (
                                'id' => 2732,
                            'name' => 'S\'assurer du traitement des dossiers suivant les pouvoirs de délégation (Comité agence, DRE, central)',
                                'process_id' => 548,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect des pouvoirs de sanction ", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            347 => 
                            array (
                                'id' => 2733,
                                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                                'process_id' => 548,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            348 => 
                            array (
                                'id' => 2734,
                                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                                'process_id' => 548,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            349 => 
                            array (
                                'id' => 2735,
                                'name' => 'Vérifier que le ticket d\'autorisation est établi selon la règlementation en vigueur ',
                                'process_id' => 548,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "discordonce entre le PV et le ticket d\'autorisation ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            350 => 
                            array (
                                'id' => 2736,
                            'name' => 'S\'assurer que la décision du comité (accord ou rejet ) est notifiée au client ',
                                'process_id' => 548,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            351 => 
                            array (
                                'id' => 2737,
                            'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                                'process_id' => 549,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des délégations de pouvoirs", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            352 => 
                            array (
                                'id' => 2738,
                                'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprés de l\'administration fiscale',
                                'process_id' => 549,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constées ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            353 => 
                            array (
                                'id' => 2739,
                            'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                                'process_id' => 549,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            354 => 
                            array (
                                'id' => 2740,
                                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernées ',
                                'process_id' => 549,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non enregistrées", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            355 => 
                            array (
                                'id' => 2741,
                                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                'process_id' => 549,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 1,
                            ),
                            356 => 
                            array (
                                'id' => 2742,
                            'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                                'process_id' => 550,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Autorisation mal saisie ", "value": "Label"}]]',
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'major_fact_types' => NULL,
                                'has_major_fact' => 0,
                            ),
                            357 => 
                            array (
                                'id' => 2743,
                                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                                    'process_id' => 550,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                358 => 
                                array (
                                    'id' => 2744,
                                'name' => 'S\'assurer de la délivrance d\'un chèque de banque , sous présentation des pièces justificatives (sauf financement d\'aménagement d\'un local)',
                                    'process_id' => 550,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Utilisation d\'un autre moyen de paiement", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                359 => 
                                array (
                                    'id' => 2745,
                                    'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                                    'process_id' => 550,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établi", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                360 => 
                                array (
                                    'id' => 2746,
                                    'name' => 'S\'assurer du recueil des garanties à postériori',
                                    'process_id' => 551,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garantie non recueillie/Absence de suivi du recueille des garanties", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                361 => 
                                array (
                                    'id' => 2747,
                                    'name' => 'S\'assurer du suivi des échéances jusqu\'à la tombée de l\'engagement est effectué',
                                    'process_id' => 552,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                362 => 
                                array (
                                    'id' => 2748,
                                    'name' => 'S\'assurer que les visites sur site sont efféctuées après réalisation du projet ',
                                    'process_id' => 552,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "visite sur site non effectuée", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                363 => 
                                array (
                                    'id' => 2749,
                                    'name' => 'Vérifier que les activités financées rentre bien dans le cadre des activités finançables par la banque',
                                    'process_id' => 553,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Acitivité non finaçable par la banque", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                364 => 
                                array (
                                    'id' => 2750,
                                    'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents fournis par le client ',
                                    'process_id' => 553,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "manque certain document", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                365 => 
                                array (
                                    'id' => 2751,
                                'name' => 'Vérifier que le récépissé de dépôt (provisoire, définitif) de crédit est établi ',
                                    'process_id' => 553,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                366 => 
                                array (
                                    'id' => 2752,
                                    'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                                    'process_id' => 553,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                                    'fields' => NULL,
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                367 => 
                                array (
                                    'id' => 2753,
                                    'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette dernière ',
                                    'process_id' => 553,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                368 => 
                                array (
                                    'id' => 2754,
                                'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122 (pour les crédits concernés par la visite)',
                                    'process_id' => 553,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Visite non effectuée ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                369 => 
                                array (
                                    'id' => 2755,
                                    'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                                    'process_id' => 553,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                370 => 
                                array (
                                    'id' => 2756,
                                    'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées',
                                    'process_id' => 553,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Délais non respecter", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                371 => 
                                array (
                                    'id' => 2757,
                                'name' => 'S\'assurer du traitement des dossiers suivant les pouvoirs de délégation (Comité agence, DRE, central)',
                                    'process_id' => 554,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect des pouvoirs de sanction ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                372 => 
                                array (
                                    'id' => 2758,
                                    'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                                    'process_id' => 554,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                373 => 
                                array (
                                    'id' => 2759,
                                    'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                                    'process_id' => 554,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                374 => 
                                array (
                                    'id' => 2760,
                                    'name' => 'Vérifier que le ticket d\'autorisation est établi selon la règlementation en vigueur ',
                                    'process_id' => 554,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "discordonce entre le PV et le ticket d\'autorisation ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                375 => 
                                array (
                                    'id' => 2761,
                                'name' => 'S\'assurer que la décision du comité (accord ou rejet ) est notifiée au client ',
                                    'process_id' => 554,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                376 => 
                                array (
                                    'id' => 2762,
                                'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                                    'process_id' => 555,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des délégations de pouvoirs", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                377 => 
                                array (
                                    'id' => 2763,
                                    'name' => 'Vérifier que la convention de crédit est signée par le client et par le directeur d\'agence revêtue de la mention "LU ET APPOUVE", timbrée et enregistrée auprés de l\'administartion fiscale ',
                                    'process_id' => 555,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                378 => 
                                array (
                                    'id' => 2764,
                                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                                    'process_id' => 555,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                379 => 
                                array (
                                    'id' => 2765,
                                    'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                                    'process_id' => 555,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non enregistrées", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                380 => 
                                array (
                                    'id' => 2766,
                                    'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                    'process_id' => 555,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                381 => 
                                array (
                                    'id' => 2767,
                                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                                    'process_id' => 556,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "autorisation mal saisie ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                382 => 
                                array (
                                    'id' => 2768,
                                    'name' => 'Vérifier que toutes les conditions de déblocage sont réunies',
                                    'process_id' => 556,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                383 => 
                                array (
                                    'id' => 2769,
                                'name' => 'S\'assurer du mode de paiement (retrait d\'espèce à bannir) ',
                                    'process_id' => 557,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Retrait en espèce", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                384 => 
                                array (
                                    'id' => 2770,
                                    'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque  ',
                                    'process_id' => 558,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "manque certain document", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                385 => 
                                array (
                                    'id' => 2771,
                                    'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                                    'process_id' => 558,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                386 => 
                                array (
                                    'id' => 2772,
                                    'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette structure',
                                    'process_id' => 558,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                387 => 
                                array (
                                    'id' => 2773,
                                    'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122',
                                    'process_id' => 558,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Visite non effectuée ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                388 => 
                                array (
                                    'id' => 2774,
                                    'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                                    'process_id' => 558,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                389 => 
                                array (
                                    'id' => 2775,
                                    'name' => 'S\'assurer que les délais de traitement des dossiers sont respectées',
                                    'process_id' => 558,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Délais non respecter", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                390 => 
                                array (
                                    'id' => 2776,
                                    'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                                    'process_id' => 559,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                391 => 
                                array (
                                    'id' => 2777,
                                    'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                                    'process_id' => 559,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                392 => 
                                array (
                                    'id' => 2778,
                                    'name' => 'Vérifier que le ticket d\'autorisation est établi selon la règlementation en vigueur ',
                                    'process_id' => 559,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "discordonce entre le PV et le ticket d\'autorisation ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                393 => 
                                array (
                                    'id' => 2779,
                                    'name' => 'Vérifier que la convention de crédit est signée par le client et par le directeur d\'agence revêtue de la mention "LU ET APPOUVE", timbrée et enregistrée auprés de l\'administartion fiscale ',
                                    'process_id' => 560,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                394 => 
                                array (
                                    'id' => 2780,
                                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                                    'process_id' => 560,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                395 => 
                                array (
                                    'id' => 2781,
                                    'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                                    'process_id' => 560,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non enregistrées", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                396 => 
                                array (
                                    'id' => 2782,
                                    'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                    'process_id' => 560,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 1,
                                ),
                                397 => 
                                array (
                                    'id' => 2783,
                                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisi (code du produit, le montant, la validité de l\'autorisation) ',
                                    'process_id' => 561,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "autorisation mal saisie ", "value": "Label"}]]',
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'major_fact_types' => NULL,
                                    'has_major_fact' => 0,
                                ),
                                398 => 
                                array (
                                    'id' => 2784,
                                    'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                                        'process_id' => 561,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    399 => 
                                    array (
                                        'id' => 2785,
                                        'name' => 'Vérifier que le tableau d’amortissement semestriel est établi, signé par le client, et le directeur d\'agence',
                                        'process_id' => 561,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    400 => 
                                    array (
                                        'id' => 2786,
                                        'name' => 's\'assurer de la signature d\'une chaîne de billets à ordre par le client',
                                        'process_id' => 561,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    401 => 
                                    array (
                                        'id' => 2787,
                                        'name' => 's\'assurer du paiement de la cotisation au fonds de garantie',
                                        'process_id' => 561,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "paiement non effectué ", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    402 => 
                                    array (
                                        'id' => 2788,
                                        'name' => 'S\'assurer que les garanties mentionnées sur le ticket d\'autorisation sont recueillies ',
                                        'process_id' => 562,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non réalisées", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    403 => 
                                    array (
                                        'id' => 2789,
                                        'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernées ',
                                        'process_id' => 562,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non enregistrées", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    404 => 
                                    array (
                                        'id' => 2790,
                                        'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                        'process_id' => 562,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    405 => 
                                    array (
                                        'id' => 2791,
                                        'name' => 'S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué',
                                        'process_id' => 563,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    406 => 
                                    array (
                                        'id' => 2792,
                                        'name' => 'S\'assurer que la visite sur site après réalisation du projet est effectuée ',
                                        'process_id' => 563,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "visite sur site non effectuée", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    407 => 
                                    array (
                                        'id' => 2793,
                                        'name' => 'S’assurer de l’établissement du CT100 chaque fin du mois ',
                                        'process_id' => 564,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "formulaire mal renseigné", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    408 => 
                                    array (
                                        'id' => 2794,
                                        'name' => 'S’assurer que les soldes anormaux sont justifiés ',
                                        'process_id' => 564,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "soldes anormaux non justifiés", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    409 => 
                                    array (
                                        'id' => 2795,
                                        'name' => 'S’assurer que les démarches de régularisation des suspens ont été effectuées par l\'agence',
                                        'process_id' => 564,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "démarches non effectuées", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    410 => 
                                    array (
                                        'id' => 2796,
                                        'name' => 'S’assurer que le CT189 est dûment renseigné ',
                                        'process_id' => 565,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "CT 189 mal renseigné", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    411 => 
                                    array (
                                        'id' => 2797,
                                    'name' => 'S’assurer que les montants affichés aux comptes d’ordre sensible sont justifiés (Valeur égarée, écriture en suspens, déficit de caisse…)',
                                        'process_id' => 565,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Montant non justifé", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    412 => 
                                    array (
                                        'id' => 2798,
                                        'name' => 'S’assurer que tous les comptes d’ordre affichant un solde important sont justifiés ',
                                        'process_id' => 565,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "compte non justifé", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    413 => 
                                    array (
                                        'id' => 2799,
                                        'name' => 'S’assurer que les démarches de régularisation des suspens ont été effectuées par l\'agence',
                                        'process_id' => 565,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "démarche non effectuée", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    414 => 
                                    array (
                                        'id' => 2800,
                                    'name' => 'S’assurer que les registres des L/S (émis et reçu) sont tenus et mis à jours',
                                        'process_id' => 566,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "anomalies constatées", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    415 => 
                                    array (
                                        'id' => 2801,
                                        'name' => 'S’assurer du respect chronologique des L/S',
                                        'process_id' => 566,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "ordre chronologique non respecté", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    416 => 
                                    array (
                                        'id' => 2802,
                                    'name' => 'S’assurer du respect de délais (48 h) de débouclement des L/S',
                                        'process_id' => 566,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "debouclement tardive", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de liaison siège"}, {"name": "liaison_siege _number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "liaison_siege _number _field"}, {"placeholder": "Entrez le numéro de de liaison siège"}, {"help_text": "Saisissez le numéro de liaison siège tel qu\'il apparaît sur le document correspondant. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    417 => 
                                    array (
                                        'id' => 2803,
                                        'name' => 'S’assurer de la bonne imputation des écritures comptables aux comptes appropriée ',
                                        'process_id' => 566,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "mauvaise imputation des écritures comptables", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    418 => 
                                    array (
                                        'id' => 2804,
                                        'name' => 'S’assurer que le budget de fonctionnement et/ou d’investissement à fait l’objet de notification',
                                        'process_id' => 567,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    419 => 
                                    array (
                                        'id' => 2805,
                                        'name' => 'S’assurer que les dépenses sont gérées de façon rigoureuse et imputées aux comptes charges appropriés',
                                        'process_id' => 567,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect du compte charge approprié", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    420 => 
                                    array (
                                        'id' => 2806,
                                    'name' => 'S’assurer que toute dépense engagée est justifiée (Pièces justificatives)',
                                        'process_id' => 567,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de pièces justificatves ", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    421 => 
                                    array (
                                        'id' => 2807,
                                        'name' => 'S’assurer de l’élaboration et de la transmission des états trimestriels à la DRE de rattachement dans les délais',
                                        'process_id' => 567,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Etat non transmis à la DRE ", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    422 => 
                                    array (
                                        'id' => 2808,
                                        'name' => 'S’assurer que les écarts sont justifiés par l’agence ',
                                        'process_id' => 567,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Ecarts non justifiés ", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    423 => 
                                    array (
                                        'id' => 2809,
                                        'name' => 'S\'assurer  que l\'état de rapprochement est réalisé minimum chaque fin du mois ',
                                        'process_id' => 568,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "état de rapprochement non réalisé", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    424 => 
                                    array (
                                        'id' => 2810,
                                        'name' => 'S\'assurer que les démarches de régularisation des suspens ont été effectuées par l\'agence ',
                                        'process_id' => 568,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Aucune démarche entreprise", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    425 => 
                                    array (
                                        'id' => 2811,
                                    'name' => 'S\'assurer du respect du plafond fixé (1000,00DA) ',
                                        'process_id' => 568,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non respect du plafond autorisé ", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    426 => 
                                    array (
                                        'id' => 2812,
                                        'name' => 'S\'assurer du respect des conditions de conservation et d\'utilisation des chèques CCP ',
                                        'process_id' => 568,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "condition de conservation non respectée", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    427 => 
                                    array (
                                        'id' => 2813,
                                        'name' => 'Vérifier si l\'agence procède régulièrement au virement du solde excédentaire à l\'effet d\'éviter le gel de trésorerie  ',
                                        'process_id' => 569,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Procédure non respectée ", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    428 => 
                                    array (
                                        'id' => 2814,
                                        'name' => 'Vérifier que l\'état de rapprochement est réalisé minimum chaque fin du mois  ',
                                        'process_id' => 569,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "état de rapprochement non réalisé", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    429 => 
                                    array (
                                        'id' => 2815,
                                        'name' => 'S\'assurer que les mesures appropriées ont été prises pour la régularisation des écritures en suspens  ',
                                        'process_id' => 569,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Aucune démarche entreprise", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    430 => 
                                    array (
                                        'id' => 2816,
                                        'name' => 'S\'assurer que les virements trésors déstinés au résau sont traités rapidement ',
                                        'process_id' => 569,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "retrard dans le traitement ", "value": "Label"}]]',
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    431 => 
                                    array (
                                        'id' => 2817,
                                        'name' => 'S\'assurer du respect des conditions de conservation et d\'utilisation des chèques Trésor  ',
                                        'process_id' => 569,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "condition de conservation non respectée", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    432 => 
                                    array (
                                        'id' => 2818,
                                        'name' => 'Vérifier que l\'état de rapprochement est établi chaque fin du mois  ',
                                        'process_id' => 570,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "état de rapprochement non réalisé", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    433 => 
                                    array (
                                        'id' => 2819,
                                        'name' => 'vérifier si l\'agence procède régulièrement au virement du solde excédentaire à l\'effet d\'éviter le gel de trésorerie',
                                        'process_id' => 570,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "l\'agence ne procède pas  au virement de l\'excédent", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    434 => 
                                    array (
                                        'id' => 2820,
                                        'name' => 'S\'assurer de la signature de la charte de sécurité pour l\'utilisateur du système DELTA',
                                        'process_id' => 571,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Charte non signée", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    435 => 
                                    array (
                                        'id' => 2821,
                                        'name' => 'S\'assurer du repect des conditions d\'octrois des avances sur appointement/salaire',
                                        'process_id' => 572,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "conditions non respectées", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte de l\'employé"}, {"name": "employee_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "employee_account_number_field"}, {"placeholder": "Entrez le numéro de compte de l\'employé"}, {"help_text": "Saisissez le numéro de compte de l\'employé tel qu\'il est attribué dans le système. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    436 => 
                                    array (
                                        'id' => 2822,
                                        'name' => 'S\'assurer que le compte d\'ordre 64/51 "avance sur appointement" est soldé chaque fin du mois ',
                                        'process_id' => 572,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "compte non soldé", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte de l\'employé"}, {"name": "employee_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "employee_account_number_field"}, {"placeholder": "Entrez le numéro de compte de l\'employé"}, {"help_text": "Saisissez le numéro de compte de l\'employé tel qu\'il est attribué dans le système. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    437 => 
                                    array (
                                        'id' => 2823,
                                        'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la règlementaion dans le cadre d\'une avance sur salaire ',
                                        'process_id' => 572,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "anomalies constatées", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte de l\'employé"}, {"name": "employee_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "employee_account_number_field"}, {"placeholder": "Entrez le numéro de compte de l\'employé"}, {"help_text": "Saisissez le numéro de compte de l\'employé tel qu\'il est attribué dans le système. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    438 => 
                                    array (
                                        'id' => 2824,
                                        'name' => 'S\'assurer du suivi des remboursements des avances sur salaires  ',
                                        'process_id' => 572,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Avances non remboursées", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte de l\'employé"}, {"name": "employee_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "employee_account_number_field"}, {"placeholder": "Entrez le numéro de compte de l\'employé"}, {"help_text": "Saisissez le numéro de compte de l\'employé tel qu\'il est attribué dans le système. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    439 => 
                                    array (
                                        'id' => 2825,
                                        'name' => 'S\'assurer que la DRH est saisie pour la désactivation du mot de passe ',
                                        'process_id' => 573,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "DRH non saisie", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    440 => 
                                    array (
                                        'id' => 2826,
                                        'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la règlementaion ',
                                        'process_id' => 574,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    441 => 
                                    array (
                                        'id' => 2827,
                                        'name' => 'S\'assurer que la DRH est saisie pour la désactivation du mot de passe ',
                                        'process_id' => 574,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "DRH non saisie", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Grade de l\'employé"}, {"name": "employee_grade"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_grade_field"}, {"placeholder": "Entrez le grade de l\'employé"}, {"help_text": "Saisissez le grade ou la fonction de l\'employé avec précision. Ce champ est important pour identifier l\'employé et déterminer son rôle. Si nécessaire, veuillez contacter le responsable des ressources humaines pour obtenir plus d\'informations sur le grade de l\'employé."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    442 => 
                                    array (
                                        'id' => 2828,
                                        'name' => 'S\'assurer du blocage de la paie ',
                                        'process_id' => 574,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Paie non bloquée", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte de l\'employé"}, {"name": "employee_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "employee_account_number_field"}, {"placeholder": "Entrez le numéro de compte de l\'employé"}, {"help_text": "Saisissez le numéro de compte de l\'employé tel qu\'il est attribué dans le système. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    443 => 
                                    array (
                                        'id' => 2829,
                                        'name' => 'S\'assurer que les registres légaux sont côtés, praphés, bien tenus et mis à jours ',
                                        'process_id' => 575,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "anomalies constatées", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    444 => 
                                    array (
                                        'id' => 2830,
                                        'name' => 'S\'assurer que l\'agent souscripteur est titulaire de la carte professionnelle délivrée par L\'union des sociétés d\'assurance et de réassurance UAR ',
                                        'process_id' => 576,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Agent souscripteur non détenteur de la carte professionnelle UAR", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    445 => 
                                    array (
                                        'id' => 2831,
                                        'name' => 'S\'assurer qu\'une chemise appropriée est ouverte contenant les informations relatives à l\'dentification du contrat et de l\'assuré ainsi que les documents de base ayant servi à l\'élaboration de la police d\'assurance  ',
                                        'process_id' => 576,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Des anomalies constatées", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    446 => 
                                    array (
                                        'id' => 2832,
                                        'name' => 'S\'assurer de l\'existence d\'une autorisation pour les adhésions qui dépassent le pouvoir agence ',
                                        'process_id' => 576,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence d\'autorisation", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    447 => 
                                    array (
                                        'id' => 2833,
                                        'name' => 'S\'assurer que la prime d\'assurance a été encaissée ',
                                        'process_id' => 576,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Prime non encaissée", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    448 => 
                                    array (
                                        'id' => 2834,
                                        'name' => 'S\'assurer que les bulletins d\'adhésion et les contrats d\'assurance ont été acheminés à la DMC avec copie DRE chaque fin du mois ',
                                        'process_id' => 576,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "bulletins d\'adhesion non acheminés", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    449 => 
                                    array (
                                        'id' => 2835,
                                        'name' => 'S\'assurer que le dossier de sinistre a été acheminé à la DMC dans les délais ',
                                        'process_id' => 576,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 0,
                                    ),
                                    450 => 
                                    array (
                                        'id' => 2836,
                                        'name' => 'S\'assurer que le client remplis les conditions de ristourne ',
                                        'process_id' => 576,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    451 => 
                                    array (
                                        'id' => 2837,
                                        'name' => 'S\'assurer que tout incident  a été déclaré dans les délais',
                                        'process_id' => 577,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Incidents non déclarés ", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    452 => 
                                    array (
                                        'id' => 2838,
                                        'name' => 'S\'assurer de la fonctionnalité des serrures et combinaisons des coffres forts, armoires, salles fortes ',
                                        'process_id' => 578,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Serrures et ou combinaisons déffectueuses", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    453 => 
                                    array (
                                        'id' => 2839,
                                    'name' => 'S\'assurer que le double des clés, code de la combinaison (armoires, coffres forts) sont transmis à la DRE ',
                                        'process_id' => 578,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Double des clés et ou code confidentiel non transmis à la DRE", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    454 => 
                                    array (
                                        'id' => 2840,
                                    'name' => 'S\'assurer de la séparation des taches dans la détention des clés et combinaisons (armoires, coffres forts)',
                                        'process_id' => 578,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect de la séparation de détention (Clés, combinaisons)", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    455 => 
                                    array (
                                        'id' => 2841,
                                        'name' => 'S\'assurer que les essais du système d\'alarme sont périodiques et que le système est fonctionnel avec le commissariat ainsi que l\'emplacement du déclencheur est adéquat',
                                        'process_id' => 578,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Essais non effectués ", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    456 => 
                                    array (
                                        'id' => 2842,
                                    'name' => 'S’assurer de la tenue du registre des essais et qu’il est annoté (visa) régulièrement par les services de sécurité avec lesquels l’agence est reliée.',
                                        'process_id' => 578,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non présenté aux services de sécurités ", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    457 => 
                                    array (
                                        'id' => 2843,
                                        'name' => 'S\'assurer que les systèmes de télésurveillance, d\'anti-intrusion, détection d\'incendie sont fonctionnels, bien entretenus, et que toutes les pannes éventuelles sont signalées et réparées avec célérité',
                                        'process_id' => 578,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "systèmes non fonctionnel ", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    458 => 
                                    array (
                                        'id' => 2844,
                                        'name' => 'S\'assurer de la relève des gardiens jour et nuit',
                                        'process_id' => 578,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Relève non assurée", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    459 => 
                                    array (
                                        'id' => 2845,
                                        'name' => 'Vérifier que les extincteurs sont situés dans des emplacements adéquats',
                                        'process_id' => 578,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "extincteur mal emplacé ", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                    460 => 
                                    array (
                                        'id' => 2846,
                                        'name' => 'S\'assurer que les extincteurs sont en nombre suffisant, bien entretenus et vérifiés périodiquement',
                                        'process_id' => 578,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                                        'fields' => NULL,
                                        'major_fact_types' => NULL,
                                        'has_major_fact' => 1,
                                    ),
                                ));
        
        
    }
}