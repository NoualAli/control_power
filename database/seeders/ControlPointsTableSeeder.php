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
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 1,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de l\'exhaustivité et la régularité des documents exigés par la banque',
                'process_id' => 1,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            1 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 2,
                'major_fact_types' => NULL,
            'name' => 'S\'assurer de l\'existence du registre de commerce et du NIF (numéro d\'identifiant fiscal)',
                'process_id' => 1,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            2 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 3,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que le client n\'est pas sous l\'effet d\'une mesure de suspension de domiciliation au titre de toute opération de commerce extérieur',
                'process_id' => 1,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            3 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 4,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que le produit n\'est pas frappé par des mesures restrictives ou de prohibition',
                'process_id' => 1,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            4 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 5,
                'major_fact_types' => NULL,
                'name' => 'S’assurer de la validation de l’opération de pré domiciliation ',
                'process_id' => 1,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            5 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 6,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que les conditions légales et règlementaires liées à l\'exportation des biens et services sont réunies',
                'process_id' => 1,
                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constatées"}]]',
            ),
            6 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 7,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que la facture proformat est dûment domiciliée revêtue du cachet de domiciliation',
                'process_id' => 1,
                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constatées"}]]',
            ),
            7 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 8,
                'major_fact_types' => NULL,
                'name' => 'S’assurer du prélèvement de la taxe de domiciliation',
                'process_id' => 1,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            8 => 
            array (
                'fields' => '[[{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 9,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de l\'existence du formulaire SEMAR 205 ter dûment cacheté et signé par le client  ',
                'process_id' => 2,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            9 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 10,
                'major_fact_types' => NULL,
            'name' => 'S\'assurer du respect des clauses de la demande d\'ouverture CREDOC (19 clauses)',
                'process_id' => 2,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            10 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 11,
                'major_fact_types' => NULL,
            'name' => 'S\'assurer de la conformité du crédoc aux règles et usages (RUU600) et à la règlementation de change ',
                'process_id' => 2,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            11 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 12,
                'major_fact_types' => NULL,
                'name' => 's\'assurer de l\'existence des documents règlementaires',
                'process_id' => 2,
                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constatées"}]]',
            ),
            12 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 13,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de la constitution de la PREG ',
                'process_id' => 2,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            13 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 14,
                'major_fact_types' => NULL,
                'name' => 'S’assurer de la perception des commissions',
                'process_id' => 2,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            14 => 
            array (
                'fields' => '[[{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 15,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer du dégagement de la banque par le client du risque de change ',
                'process_id' => 2,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            15 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 16,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de la conformité des documents reçus',
                'process_id' => 2,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            16 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 17,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer au cas de non-conformité du renvoie des documents à la DOD avec des réserves',
                'process_id' => 2,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            17 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 18,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que l’importateur est une personne morale parfaitement identifiée et présentant toutes garanties de bonne conduite des opérations de commerce extérieur ',
                'process_id' => 3,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            18 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 19,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que la PREG couvrant le montant y compris les commissions de transfert ',
                'process_id' => 3,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            19 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 20,
                'major_fact_types' => NULL,
                'name' => 'S’assurer de la perception des commissions',
                'process_id' => 3,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            20 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 21,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de la vérification des documents',
                'process_id' => 3,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            21 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 22,
                'major_fact_types' => NULL,
            'name' => 'S\'assurer que l\'opération de remise documentaire a bien été saisie sur Delta (les montants, les dates..)',
                'process_id' => 3,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            22 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 23,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer du respect des délais des échéances',
                'process_id' => 3,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            23 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 24,
                'major_fact_types' => NULL,
                'name' => 's\'assurer de l\'existence des documents règlementaires',
                'process_id' => 3,
                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constatées"}]]',
            ),
            24 => 
            array (
                'fields' => '[[{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 25,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de la conservation de la remise documentaire',
                'process_id' => 3,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            25 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 26,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de la transmission de la copie du justificatif d\'expédition à la DRE',
                'process_id' => 3,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            26 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 27,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que l’importateur est une personne morale parfaitement identifiée et présentant toutes garanties de bonne conduite des opérations de commerce extérieur ',
                'process_id' => 4,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            27 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 28,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de l\'absence de mesure particulière prise à l\'encontre du client ',
                'process_id' => 4,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            28 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 29,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de l\'existence de la provision et le prélèvement des commissions y relatives',
                'process_id' => 4,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            29 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 30,
                'major_fact_types' => NULL,
            'name' => 'S\'assurer de l\'existence des documents justificatifs du transfert plus particulièrement la déclaration douanière (D10) ',
                'process_id' => 4,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            30 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 31,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que l\'ordre de virement est dûment renseigné, signé par le client ',
                'process_id' => 4,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            31 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 32,
                'major_fact_types' => NULL,
            'name' => 'S\'assurer que le dossier ne présente pas des irrégularités (insuffisances ou excédents de règlement)',
                'process_id' => 4,
                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constatées"}]]',
            ),
            32 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 33,
                'major_fact_types' => NULL,
            'name' => 'S\'assurer du respect des délais de déclaration pour la Banque d\'Algerie (dossier non apuré et dossier annulé ou inutilisé)',
                'process_id' => 5,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            33 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 34,
                'major_fact_types' => NULL,
                'name' => 'S’assurer de la déclaration des dossiers de domiciliation, dossiers apurés, non apurés, dossiers en excédent ou en insuffisance de règlement.  ',
                'process_id' => 5,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            34 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 35,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer du respect des délais d\'apurement pour tout type de paiements',
                'process_id' => 6,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            35 => 
            array (
                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 36,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de l\'assemblement de tout le dossier nécessaire pour l\'apurement',
                'process_id' => 6,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            36 => 
            array (
                'fields' => '[[{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 37,
                'major_fact_types' => NULL,
            'name' => 'S\'assurer que les dossiers sont conservés dans un endroit sécurisé au niveau de l\'Agence pour une période de cinq (05) ans ',
                'process_id' => 6,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            37 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 1,
                'id' => 38,
                'major_fact_types' => NULL,
                'name' => 'Confronter le solde comptable avec les existances',
                'process_id' => 7,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Excédent et/ou déficit enregistré ", "value": "Label"}]]',
            ),
            38 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 39,
                'major_fact_types' => NULL,
                'name' => 'Vérifier l\'existence d\'un planning de contrôle confidentiel établi par le Directeur d\'Agence',
                'process_id' => 7,
                'scores' => '[[{"score": 1}, {"label": "planning établi"}], [{"score": 3}, {"label": "planning non établi"}]]',
            ),
            39 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 40,
                'major_fact_types' => NULL,
                'name' => 'Vérifier la bonne tenue des registres des encaisses',
                'process_id' => 7,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "registre bien renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "mal renseigné ", "value": "Label"}]]',
            ),
            40 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 41,
                'major_fact_types' => NULL,
                'name' => 'Vérifier le respect du plafond d\'encaisse',
                'process_id' => 7,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Respect du plafond d\'encaisse", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect du plafond ", "value": "Label"}]]',
            ),
            41 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 1,
                'id' => 42,
                'major_fact_types' => NULL,
                'name' => 'Vérifier le respect des consignes de sécurité et de conservation des fonds',
                'process_id' => 7,
                'scores' => '[[{"score": 1}, {"label": "Consignes de sécurité respectées"}], [{"score": 4}, {"label": "Non respect des consignes de sécurités"}]]',
            ),
            42 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 43,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de l\'arrêté quotidienn de DAB et GAB',
                'process_id' => 8,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "GAB et DAB arrêté quotidiennement ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non arrêté quotidiennement", "value": "Label"}]]',
            ),
            43 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 1,
                'id' => 44,
                'major_fact_types' => NULL,
                'name' => 'Confronter le solde comptable avec les existences et le ticket papier DAB',
                'process_id' => 8,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Excédent et/ou déficit enregistré ", "value": "Label"}]]',
            ),
            44 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 1,
                'id' => 45,
                'major_fact_types' => NULL,
                'name' => 'Confronter le solde comptable avec les existences et le ticket papier GAB',
                'process_id' => 8,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Excédent et/ou déficit enregistré ", "value": "Label"}]]',
            ),
            45 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 46,
                'major_fact_types' => NULL,
                'name' => 'Vérifier la bonne tenue  des registres',
                'process_id' => 8,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "registre bien renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "mal renseigné ", "value": "Label"}]]',
            ),
            46 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 47,
                'major_fact_types' => NULL,
                'name' => 'Vérifier la bonne tennue des registres "envoi et réception des fonds"',
                'process_id' => 9,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "registre bien renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "mal renseigné ", "value": "Label"}]]',
            ),
            47 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 48,
                'major_fact_types' => NULL,
                'name' => 'Vérifier les dates de comptabilisation des envois et reception de fonds ',
                'process_id' => 9,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "comptabilisé le jour même ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "comptabilisation tardive ", "value": "Label"}]]',
            ),
            48 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 1,
                'id' => 49,
                'major_fact_types' => NULL,
                'name' => 'Vérifier l\'affichage de la liste des convoyeurs de fonds ',
                'process_id' => 9,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Liste affichée ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Liste non affichée ", "value": "Label"}]]',
            ),
            49 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 50,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de l\'édition du journal de caisse ',
                'process_id' => 10,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Journal caisse édité ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Journal Caisse non édité ", "value": "Label"}]]',
            ),
            50 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 51,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que le contrôle des journées comptables est effectué dans les délais ',
                'process_id' => 10,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Contrôle effectué dans les délais", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des délais ", "value": "Label"}]]',
            ),
            51 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 1,
                'id' => 52,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les opérations annulées  ou abondonnées sont validées par la hiérarchie',
                'process_id' => 10,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "validé ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non validé ", "value": "Label"}]]',
            ),
            52 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 1,
                'id' => 53,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les contrôles relatifs à l’identification,la conformité des mentions obligatoires et de la signature de la clientèle sont effectués et matérialisés ',
                'process_id' => 11,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Des anomalies constatées", "value": "Label"}]]',
            ),
            53 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 54,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que la demande d\'accord de paiement à distance via E-mail ou fax a été établie ',
                'process_id' => 11,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Fax non établi ", "value": "Label"}]]',
            ),
            54 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 55,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les formulaires de retrait CA 263 sur compte livret sont dûment renseignés et signés',
                'process_id' => 11,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "  Non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence du formulaire ", "value": "Label"}]]',
            ),
            55 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 56,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les bordereaux de retrait sur compte chèque sont signés par le guichetier et le client ',
                'process_id' => 11,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de signature ", "value": "Label"}]]',
            ),
            56 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 57,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les bordereaux de retrait sur livret sont signés par le guichetier et le client',
                'process_id' => 11,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de signature ", "value": "Label"}]]',
            ),
            57 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 58,
                'major_fact_types' => NULL,
                'name' => 'Vérifier la conformité des opérations comptabilisées',
                'process_id' => 11,
                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie relevée"}], [{"score": 2}, {"label": "Des anomalies mineures"}], [{"score": 4}, {"label": "Des écarts majeurs relevés lors du contrôle"}]]',
            ),
            58 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 59,
                'major_fact_types' => NULL,
                'name' => 'Vérifié que les opérations annulées sont validées par le résponsable hièrarchique',
                'process_id' => 11,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Opération annulée non validée par le responsable", "value": "Label"}]]',
            ),
            59 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 60,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les formulaires de retrait CA 264 sur compte devise sont dûment renseignés et signés',
                'process_id' => 12,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "  Non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence du formulaire ", "value": "Label"}]]',
            ),
            60 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 61,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les bordereaux de retrait sur compte devises  sont signés par le guichetier et le client',
                'process_id' => 12,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de signature ", "value": "Label"}]]',
            ),
            61 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 62,
                'major_fact_types' => NULL,
                'name' => 'Vérifier la conformité des opérations comptabilisées',
                'process_id' => 12,
                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie relevée"}], [{"score": 2}, {"label": "Des anomalies mineures"}], [{"score": 4}, {"label": "Des écarts majeurs relevés lors du contrôle"}]]',
            ),
            62 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 63,
                'major_fact_types' => NULL,
                'name' => 'Vérifié que les opérations annulées sont validées par le résponsable hièrarchique',
                'process_id' => 12,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Opération annulée non validée par le responsable", "value": "Label"}]]',
            ),
            63 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 64,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que le bordereau CA30 est dûment renseigné et signé Dinars',
                'process_id' => 13,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "  Non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence du formulaire ", "value": "Label"}]]',
            ),
            64 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 65,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que le bordereau CA30 est dûment renseigné et signé',
                'process_id' => 13,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "  Non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence du formulaire ", "value": "Label"}]]',
            ),
            65 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 66,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les bordereaux de versement sont signés par le guichetier et le client',
                'process_id' => 13,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de signature ", "value": "Label"}]]',
            ),
            66 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 67,
                'major_fact_types' => NULL,
                'name' => 'Vérifier la conformité des opérations comptabilisées',
                'process_id' => 13,
                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie relevée"}], [{"score": 2}, {"label": "Des anomalies mineures"}], [{"score": 4}, {"label": "Des écarts majeurs relevés lors du contrôle"}]]',
            ),
            67 => 
            array (
                'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 68,
                'major_fact_types' => NULL,
                'name' => 'Vérifié que les opérations annulées sont validées par le résponsable hièrarchique',
                'process_id' => 13,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Opération annulée non validée par le responsable", "value": "Label"}]]',
            ),
            68 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 69,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que la convention d\'adhésion aux services de la banque en ligne est dûment renseignée et signée par le client et précédée par la mention lu et approuvé et signée par le responsable habilité de l\'agence avec apposition du cachet',
                'process_id' => 14,
                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Mal renseigné et/ ou non signé"}]]',
            ),
            69 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 70,
                'major_fact_types' => NULL,
                'name' => 'S’assurer que la demande d’abonnement, par type de client, est dûment renseignée, signée par le client précédé de la mention « lu et approuvé » et signée par le responsable habilité de l\'agence ',
                'process_id' => 14,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné et/ ou non signé", "value": "Label"}]]',
            ),
            70 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 71,
                'major_fact_types' => NULL,
                'name' => 'S’assurer que les commissions sont perçus au débit du compte client chaque fin du mois selon les conditions de banque en vigueur ;',
                'process_id' => 14,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}]]',
            ),
            71 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 72,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que les réclamations de la clientèles sont prises en charge',
                'process_id' => 15,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Réclamations non traitées ", "value": "Label"}]]',
            ),
            72 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 73,
                'major_fact_types' => NULL,
                'name' => 'S’assurer que les commissions sont perçues au débit du compte  client selon les conditions de banque en vigueur ;',
                'process_id' => 16,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Commissions non perçues", "value": "Label"}]]',
            ),
            73 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 74,
                'major_fact_types' => NULL,
                'name' => 'S’assurer que la convention d’échange de données informatisées est signée par le directeur de la DRE, directeur d’agence, le donneur d’ordre ',
                'process_id' => 17,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Convention non signée", "value": "Label"}]]',
            ),
            74 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 75,
                'major_fact_types' => NULL,
                'name' => 'S’assurer que les commissions sont perçues au débit du compte  client selon les conditions de banque en vigueur ;',
                'process_id' => 17,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Commissions non perçues", "value": "Label"}]]',
            ),
            75 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 76,
                'major_fact_types' => NULL,
            'name' => 'Vérifier la complétude et la conformité du dossier d\'ouverture de compte (0200, 0300, 0266…)',
                'process_id' => 18,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Quelques anomalies relevées sur les dossiers d\'ouverture de compte ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Des anomlies majeurs ", "value": "Label"}]]',
            ),
            76 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 77,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que l\'ouverture du compte est soumise  préalablement à l\'accord d\'un responsable habilité ',
                'process_id' => 18,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Aucun accord", "value": "Label"}]]',
            ),
            77 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 78,
                'major_fact_types' => NULL,
            'name' => 'S\'assurer que les interrogations des centrales de surveillance (Interdit bancaire, interdit de chéquier…) ont été effectuées',
                'process_id' => 18,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "consultation effectuée ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "consultation non effectuée ", "value": "Label"}]]',
            ),
            78 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 79,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de la bonne saisie des informations relatives au client sur le système d\'information ',
                'process_id' => 18,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
            ),
            79 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 80,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de la scannarisation et la bonne conservation des CA10',
                'process_id' => 18,
                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Non scanné/Mal conservé"}]]',
            ),
            80 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 81,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les registres des ouvertures des comptes sont bien tenus et mis à jour',
                'process_id' => 18,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registres non tenus ", "value": "Label"}]]',
            ),
            81 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 82,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les conditions d\'archivages des dossiers d\'ouvertures sont bien réalisées',
                'process_id' => 18,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            82 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 83,
                'major_fact_types' => NULL,
            'name' => 'Vériffier la demande de clôture de compte du client (nom et prénom, numéro de compte, signature, date… )   ',
                'process_id' => 19,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie constatée", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
            ),
            83 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 84,
                'major_fact_types' => NULL,
            'name' => 'S\'assurer que toutes les conditions de clôture ont été respectées (solde suffisant, moyens de paiements restitués, etc)',
                'process_id' => 19,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Conditions de clôture respectées", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Conditions de clôture non respectées", "value": "Label"}]]',
            ),
            84 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 85,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que le registre de clôture des comptes est bien tenu et mis à jour',
                'process_id' => 19,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registres non tenus ", "value": "Label"}]]',
            ),
            85 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 86,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les conditions d\'archivages des dossiers de clôture sont bien réalisées',
                'process_id' => 19,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
            ),
            86 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 87,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer de l\'exploitation de l\'état des comptes sans mouvements',
                'process_id' => 20,
                'scores' => '[[{"score": 1}, {"label": "Etat exploité"}], [{"score": 3}, {"label": "Etat non exploité"}]]',
            ),
            87 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 88,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que les clients dont les comptes sont bloqués ou clôturés ont été informés de la situation de leur compte selon la procédure en vigueur.',
                'process_id' => 20,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "clients informés ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "clients non informés", "value": "Label"}]]',
            ),
            88 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 1,
                'id' => 89,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que la levée de blocage du compte se fait sur la base d\'une demande écrite du client',
                'process_id' => 20,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Demande existe ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de la demande ", "value": "Label"}]]',
            ),
            89 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 1,
                'id' => 90,
                'major_fact_types' => NULL,
                'name' => 'Vérifier l\'enregistrement des BDC  en stock sur le système d\'information DELTA ',
                'process_id' => 21,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Bons de caisse saisis", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Bons de caisse non saisis", "value": "Label"}]]',
            ),
            90 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 1,
                'id' => 91,
                'major_fact_types' => NULL,
                'name' => 'Vérifier la conservation du stock des  BDC ainsi que la bonne tenue du registre CA 55',
                'process_id' => 21,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre mal tenu", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Bons de caisse mal conservé ", "value": "Label"}]]',
            ),
            91 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 92,
                'major_fact_types' => NULL,
                'name' => 'Vérifier qu\'un état des BDC non utilisés est envoyé trimestriellement aux structures concernées',
                'process_id' => 21,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Etat non transmis ", "value": "Label"}]]',
            ),
            92 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 93,
                'major_fact_types' => NULL,
            'name' => 'Vérifier la demande de souscription des bons caisse TI 34 ( montant, durée, signature, le détail des bons émis " nombre, quotité, numéro), cachet, visa….)',
                'process_id' => 22,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné ", "value": "Label"}]]',
            ),
            93 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 94,
                'major_fact_types' => NULL,
            'name' => 'Vérifier le bordereau de saisie du bon caisse (nom prénom, montant, durée, taux appliqué, signatures …)  et sa conformité avec le feuillet N°1 du TI34',
                'process_id' => 22,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
            ),
            94 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 95,
                'major_fact_types' => NULL,
                'name' => 'Vérifier l\'existence d\'un registre confidentiel détenu par le directeur d\'agence, sous clé, pour les souscriptions des BDC anonymes',
                'process_id' => 22,
                'scores' => '[[{"score": 1}, {"label": "Registre existent"}], [{"score": 4}, {"label": "Registre inexistent"}]]',
            ),
            95 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 1,
                'id' => 96,
                'major_fact_types' => NULL,
            'name' => 'Dans le cas d\'un taux dérogatoire est aperçu il y a lieu de vérifier que le montant du BDC est supérieur à vingt (20) millions de dinars et un accord a été pris par la structure habilitée',
                'process_id' => 22,
                'scores' => '[[{"score": 1}, {"label": "Accord pris"}], [{"score": 4}, {"label": "Abscence d\'accord"}]]',
            ),
            96 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 97,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que les souches des bons émis, BDC nantis ou placés en dépôt libre ont été transmis à la DRE',
                'process_id' => 22,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Souche transmise", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Souche non transmise ", "value": "Label"}]]',
            ),
            97 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 98,
                'major_fact_types' => NULL,
                'name' => 'Vérifier que le BDC présenté pour remboursement n\'a pas fait objet d\'opposition ',
                'process_id' => 23,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Vérification efféctuée", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Opposition sur BDC Constatée ", "value": "Label"}]]',
            ),
            98 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 0,
                'id' => 99,
                'major_fact_types' => NULL,
                'name' => 'Vérifier l\'existence de la demande du souscripteur en cas de remboursement par anticipation ',
                'process_id' => 23,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Demande apperçue", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Demande non apperçue", "value": "Label"}]]',
            ),
            99 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 100,
                'major_fact_types' => NULL,
                'name' => 'Vérifier la mention "Bon non acquitté souscripteur anonyme"  au verso du bon si le souscripteur refuse d\'acquitter, la date du remboursement, la signature du directeur d\'agence ou son intérimaire. ',
                'process_id' => 23,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal reseigné ", "value": "Label"}]]',
            ),
            100 => 
            array (
                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                'has_major_fact' => 1,
                'id' => 101,
                'major_fact_types' => NULL,
            'name' => 'Vérifier que le BDC remboursé (nominatif et anonymes) est revêtu de la mention "Annulé"',
                'process_id' => 23,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Mention portée", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non portée", "value": "Label"}]]',
            ),
            101 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 102,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que le bordereau de remboursement est classé dans le dossier et que la mention  échue est portée dans le dossier  ',
                'process_id' => 23,
                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "La mention non portée ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Bordereau non classé- ", "value": "Label"}]]',
            ),
            102 => 
            array (
                'fields' => NULL,
                'has_major_fact' => 0,
                'id' => 103,
                'major_fact_types' => NULL,
                'name' => 'S\'assurer que le feuillet N°1 du TI34 a été réclamé à l\'agence ou le BDC a été souscrit (dans le cas d\'un remboursement à échéances auprès d\'une agence autre que celle de la souscription',
                    'process_id' => 23,
                    'scores' => '[[{"score": 1}, {"label": "Réclamé"}], [{"score": 4}, {"label": "Non réclamé"}]]',
                ),
                103 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 104,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier la demande de souscription du dépôt à terme formulaire ST325 Nom et prénom, montant, durée, signature,.',
                    'process_id' => 24,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                ),
                104 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 105,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier la demande de souscription du dépôt à terme ST326 Nom et prénom, montant, durée, signature,.',
                    'process_id' => 24,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                ),
                105 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 106,
                    'major_fact_types' => NULL,
                'name' => 'Vérifier le bordereau de saisie du dépôt à terme  (nom prénom, montant, durée, taux appliqué, signatures …)  et sa conformité avec la demande de soucription ',
                    'process_id' => 24,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                ),
                106 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 107,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les DAT remboursés ne sont pas bloqués ou affectés à la couverture de crédits bancaires ',
                    'process_id' => 25,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "DAT remboursés ", "value": "Label"}]]',
                ),
                107 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 108,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de l\'existence d\'une demande de remboursement par anticipation   ',
                    'process_id' => 25,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Demande non apperçue ", "value": "Label"}]]',
                ),
                108 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 109,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les carnets de chèques clientèle sont conservés dans un lieu sécurisé conformément au dispositif de sécurité des coffres forts',
                    'process_id' => 26,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des conditions de conservations ", "value": "Label"}]]',
                ),
                109 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 110,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de la délivrance permanente des chéquiers en stock via des invitations adressées à la clientèle',
                    'process_id' => 26,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Absence de suivi"}]]',
                ),
                110 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 111,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de la bonne tenue et de la mise à jours du registre dédié à cet effet ',
                    'process_id' => 27,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non mis à jour ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non tenu ", "value": "Label"}]]',
                ),
                111 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 112,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que toutes les entrées et sorties de stock sont effectuées selon un ordre chronologique ',
                    'process_id' => 27,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect de l\'ordre chronologique ", "value": "Label"}]]',
                ),
                112 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 113,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les carnets de chèques de banque sont conservés dans un lieu sécurisé conformément au dispositif de sécurité des coffres forts',
                    'process_id' => 27,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Non respect des conditions de conservation"}]]',
                ),
                113 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 114,
                    'major_fact_types' => NULL,
                    'name' => 'Faire un état de rapprochement entre le stock des BDC et le registre  ',
                    'process_id' => 28,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Discordance constatée ", "value": "Label"}]]',
                ),
                114 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 115,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier l\'enregistrement des BDC  en stock sur le système d\'information DELTA ',
                    'process_id' => 28,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Stock non saisi sur SI ", "value": "Label"}]]',
                ),
                115 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 116,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier la conservation du stock des  BDC ainsi que la bonne tenue du registre CA 55',
                    'process_id' => 28,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Registre non mis à jour"}], [{"score": 4}, {"label": "Registre non tenu/ Non respect des conditions de conservation"}]]',
                ),
                116 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 117,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier qu\'un état des BDC non utilisés est envoyé trimestriellement aux structures concernées',
                    'process_id' => 28,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Etat non transmis", "value": "Label"}]]',
                ),
                117 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 118,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que les conditions de conservation sont respectées',
                    'process_id' => 29,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Non respect des conditions de conservation"}]]',
                ),
                118 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 119,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que toutes les entrées et sorties de stock sont enregistrées correctement selon l\'ordre chronologique avec le visa de la personne habilitée',
                    'process_id' => 29,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Anomalies constatées"}]]',
                ),
                119 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 120,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer pour les mandataires de l\'établissement de la formule timbrée N°354 (procuration pour coffre fort) ',
                    'process_id' => 30,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de formule timbrée N°354", "value": "Label"}]]',
                ),
                120 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 121,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que le montant de la location est prélevé conformément aux conditions de banque (selon le modèle)',
                    'process_id' => 30,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Frais non prélevés"}]]',
                ),
                121 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 122,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que le montant du cautionnement est prélevé conformément aux conditions de banque et logé au compte d\'ordre approprié "64/35"',
                    'process_id' => 30,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Frais non prélevés"}]]',
                ),
                122 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 123,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer qu\'un plan des compartiments est établi et tenu à jour (nom du locataire, la date de location)',
                    'process_id' => 30,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Plan de compartiment non mis à jour", "value": "Label"}]]',
                ),
                123 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 124,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer de la tenue des cartes de location TI51 (classer par ordre alphabétique) établies au nom des locataires revêtue de leurs signatures et éventuellement de leurs mandataires',
                    'process_id' => 30,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Carte non tenue"}]]',
                ),
                124 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 125,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de l\'établissement du carnet de visite modèle TI159 avec signature du visiteur et visé par le reponsable habilité  ',
                    'process_id' => 30,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre mal tenu ", "value": "Label"}]]',
                ),
                125 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 126,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que la clé de contrôle ainsi que la clé de la salle des coffres sont conservées par un responsable habilité  ',
                    'process_id' => 30,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect de concept séparation des tâches", "value": "Label"}]]',
                ),
                126 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 127,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que le registre de chèque de banque est bien tenu et mis à jour',
                    'process_id' => 31,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Non mis à jour"}], [{"score": 4}, {"label": "Registre non tenue"}]]',
                ),
                127 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 128,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que la demande de délivrance de chèque de banque est bien renseignée, signée, authentification de la signature et apposition du cachet accusé de réception',
                    'process_id' => 31,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Anomalies constatées"}]]',
                ),
                128 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 129,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de la conformité de l\'opération "constitution de la provision, perception de la commission, respect chronologique de la numérotation des chèques de banque délivrés  ',
                    'process_id' => 31,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Provision non constituée", "value": "Label"}]]',
                ),
                129 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 130,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les souches de chèques de banque sont renseignées, visées par un responsable et bien conservées',
                    'process_id' => 31,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Anomalies constatées"}]]',
                ),
                130 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 131,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les différents états sont transmis à la DRE et à la direction de la wilaya des impôt pour les clients de passage',
                    'process_id' => 31,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Etats non trasmis ", "value": "Label"}]]',
                ),
                131 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 132,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les chèques de banques ayant dépassés les 03 ans et 20 jours sont traités ',
                    'process_id' => 31,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non triaté ", "value": "Label"}]]',
                ),
                132 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 133,
                    'major_fact_types' => NULL,
                    'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                    'process_id' => 31,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}]]',
                ),
                133 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 134,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier la complétude du dossier de prélèvement ',
                    'process_id' => 32,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Dossier incomplet ", "value": "Label"}]]',
                ),
                134 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 135,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que l\'agence a notifié sa décision au client',
                    'process_id' => 32,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification", "value": "Label"}]]',
                ),
                135 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 136,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que les commissions de gestion de prélèvement ont été prélevées selon les conditions de banques en vigueur  ',
                    'process_id' => 32,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "commissions non prélevées ", "value": "Label"}]]',
                ),
                136 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 137,
                    'major_fact_types' => NULL,
                    'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                    'process_id' => 32,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                ),
                137 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 138,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que les bordereaux PF37 ou PF 229 sont bien renseignés et signés par le client authentification de la signature et apposition du cachet accusé de reception',
                    'process_id' => 33,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                ),
                138 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 139,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les effets escomptés sont conformes à l\'autorisation de crédit ',
                    'process_id' => 33,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non conforme à l\'autorisation ", "value": "Label"}]]',
                ),
                139 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 140,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier la bonne tenue et la mise à jour du regsirtre,',
                    'process_id' => 33,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non tenu", "value": "Label"}]]',
                ),
                140 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 141,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier les conditions de conservation des effets ',
                    'process_id' => 33,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des conditions de conservation ", "value": "Label"}]]',
                ),
                141 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 142,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que les différents états édités sont exploités',
                    'process_id' => 33,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Etats non édités/non exploités ", "value": "Label"}]]',
                ),
                142 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 143,
                    'major_fact_types' => NULL,
                    'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                    'process_id' => 33,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                ),
                143 => 
                array (
                    'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 144,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les ordres de virements sont bien renseignés et signés ',
                    'process_id' => 34,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/ non signé", "value": "Label"}]]',
                ),
                144 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 145,
                    'major_fact_types' => NULL,
                    'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                    'process_id' => 34,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}]]',
                ),
                145 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 146,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les différents états sont édités et exploités',
                    'process_id' => 34,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Etats non édités/non exploités"}]]',
                ),
                146 => 
                array (
                    'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 147,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que les ordres de virements sont bien renseignés et signés',
                    'process_id' => 35,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/ non signé", "value": "Label"}]]',
                ),
                147 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 148,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que les ordres de virements sont enregistrés ',
                    'process_id' => 35,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non enregistrés ", "value": "Label"}]]',
                ),
                148 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 149,
                    'major_fact_types' => NULL,
                    'name' => 'Vérfier le bon fonctionnement des comptes y relatifs ',
                    'process_id' => 35,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                ),
                149 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 150,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les différents états sont édités et exploités ',
                    'process_id' => 35,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Etats non éditer/non exploiter ", "value": "Label"}]]',
                ),
                150 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 151,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                    'process_id' => 36,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                ),
                151 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 152,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer des conditions de conservation des cartes et codes confidentiels ',
                    'process_id' => 36,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non conservé dans un coffre ", "value": "Label"}]]',
                ),
                152 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 153,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les clients n\'ayant pas retirés leurs cartes ont été relancés',
                    'process_id' => 36,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "client non relancés ", "value": "Label"}]]',
                ),
                153 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 154,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer du respect de la procédure d\'oblitération des cartes (délai, PV)  ',
                    'process_id' => 36,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Procédure non respectée ", "value": "Label"}]]',
                ),
                154 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 155,
                    'major_fact_types' => NULL,
                    'name' => 'Sassurer que le registre est bien renseingé, signé par le client',
                    'process_id' => 36,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/Non signé par le client ", "value": "Label"}]]',
                ),
                155 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 156,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les codes confidentiels ainsi que les cartes sont conservés séparément dans un coffre',
                    'process_id' => 36,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constatées"}]]',
                ),
                156 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 157,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de la mise à jours du fichier de stock des cartes ',
                    'process_id' => 36,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non mis à jours", "value": "Label"}]]',
                ),
                157 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 158,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                    'process_id' => 37,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                ),
                158 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 159,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les commissions ont été prélevées selon les conditions de banque',
                    'process_id' => 37,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "commissions non prélevées/Non respect des conditions de banque"}]]',
                ),
                159 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 160,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                    'process_id' => 38,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                ),
                160 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 161,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier les renseignements de la demande et son traitement dans les délais',
                    'process_id' => 39,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                ),
                161 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 162,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les commissions ont été prélevées selon les conditions de banque',
                    'process_id' => 39,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "commissions non prélevées/Non respect des conditions de banque"}]]',
                ),
                162 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 163,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier les renseignements de la demande et le traitement dans les délais',
                    'process_id' => 40,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                ),
                163 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 164,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier les renseignements de la demande et le traitement dans les délais',
                    'process_id' => 41,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseignée/Non traitée dans les délais", "value": "Label"}]]',
                ),
                164 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 165,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de l\'établissement des formulaires de la mise et levée en exception signés par le directeur d\'agence et qu\'ils sont transmis à la DM au temps opportun ',
                    'process_id' => 41,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Formulaires non établies", "value": "Label"}]]',
                ),
                165 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 166,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que le contrat d\'adhésion est signé par les deux (02) parties (client et agence)',
                    'process_id' => 42,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Contrat non signé ", "value": "Label"}]]',
                ),
                166 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 167,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que l\'installation du TPE est matérialisée par un PV signé par l\'ingénieur et le commerçant et un PV de formation',
                    'process_id' => 42,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "PV non établis"}]]',
                ),
                167 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 168,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les réclamations de la clientèles sont prises en charge en temps opportun',
                    'process_id' => 43,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Réclamation non prise en charge"}]]',
                ),
                168 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 169,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que le formulaire de contestation est visé par un responsble habilité et envoyé à la DM',
                    'process_id' => 44,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Non visé ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non envoyé ", "value": "Label"}]]',
                ),
                169 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 170,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que le contrat d\'adhésion est renseigné, signé par le client et l\'agence ',
                    'process_id' => 45,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non renseigné/non signé ", "value": "Label"}]]',
                ),
                170 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 171,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que le registre tenu à cet effet est bien renseigné et mis à jour',
                    'process_id' => 46,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Mal renseigné et /ou non mis à jours"}]]',
                ),
                171 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 172,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que l\'attestation de change (CV1) est signée par le responsable habilité',
                    'process_id' => 46,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Attestation non signée"}]]',
                ),
                172 => 
                array (
                    'fields' => '[[{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "text"}, {"label": "N° Bordereau de vente de devises"}, {"name": "currency_sale_bordereau_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "currency_sale_bordereau_number_field"}, {"placeholder": "Entrez le numéro de bordereau de vente de devises"}, {"help_text": "Saisissez le numéro de bordereau de vente de devises tel qu\'il apparaît sur le document correspondant. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 173,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que le bordereau de vente de devises est signé par le guichetier et le client',
                    'process_id' => 46,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                ),
                173 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 174,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de l\'éligibilité du client aux frais de missions',
                    'process_id' => 47,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Client non éligible ", "value": "Label"}]]',
                ),
                174 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 175,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que le dossier de frais de mission comporte tous les documents exigés par la règlementation ',
                    'process_id' => 47,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier complet ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Dossier incomplet ", "value": "Label"}]]',
                ),
                175 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 176,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que les frais de mission accordés aux clients sont conformes aux barèmes (montant, durée, catégorie des pays)',
                    'process_id' => 47,
                    'scores' => '[[{"score": 1}, {"label": "Respect du barème"}], [{"score": 4}, {"label": "Non respect du barèmes"}]]',
                ),
                176 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 177,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que le dossier d\'apurement comprend copie de l\'ordre de mission visée par les services de police algérienne des frontières durant les 15 jours qui suivent la date de retour prévue dans l\'ordre de mission ',
                    'process_id' => 47,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier appuré", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Dossier non appuré ", "value": "Label"}]]',
                ),
                177 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 178,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que le dossier de frais de scolarités comporte tous les documents exigés par la règlementation',
                    'process_id' => 48,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier complet ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Dossier incomplet ", "value": "Label"}]]',
                ),
                178 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 179,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que le client n\'a pas dépassé l\'autorisation mensuelle (9000,00 DA/mois) et la durée(maximum 10 mois)  ',
                    'process_id' => 48,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Respect de l\'autorisation", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Dépassement de l\'autorisation ", "value": "Label"}]]',
                ),
                179 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 180,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que l\'ordre de virement CT 18 est bien renseigné, signé par le client et visé par le reponsable habilité ',
                    'process_id' => 48,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non signé et ou non visé ", "value": "Label"}]]',
                ),
                180 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 181,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que le dossier comporte tous les documents exigés par la règlementation ',
                    'process_id' => 49,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier complet ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Dossier incomplet ", "value": "Label"}]]',
                ),
                181 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 182,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que le dossier d\'apurement comprend la facture définitive attestant le montant des préstations rendues par l\'établissement hospitalier étranger',
                    'process_id' => 49,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier appuré", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Dossier non appuré ", "value": "Label"}]]',
                ),
                182 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 183,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que le montant et la durée autorisés pour les soins à l\'étranger ne sont pas  dépassés (120 000,00 DA/année civil)',
                    'process_id' => 49,
                    'scores' => '[[{"score": 1}, {"label": "Respect de l\'autorisation"}], [{"score": 4}, {"label": "Dépassement de l\'autorisation"}]]',
                ),
                183 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 184,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de l\'éligibilité du client à la cession de devises ',
                    'process_id' => 50,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Client éligible", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Client non éligible ", "value": "Label"}]]',
                ),
                184 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 185,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les documents présentés sont conformes à la règlementation ',
                    'process_id' => 50,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Dossier complet ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Dossier incomplet ", "value": "Label"}]]',
                ),
                185 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 186,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que le formulaire de versement CA1112 est bien renseigné',
                    'process_id' => 50,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné ", "value": "Label"}]]',
                ),
                186 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 187,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de l\'existence du registre y relatif et sa bonne tenue ',
                    'process_id' => 51,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/ Non mis à jour ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre inexistant ", "value": "Label"}]]',
                ),
                187 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 188,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les clients frappés d\'ATD/oppositions ont été saisis, dans les délais, par lettres recommandées ainsi que le créancier ',
                    'process_id' => 51,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Client non saisi / créancier non avisé ", "value": "Label"}]]',
                ),
                188 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 189,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer du blocage du compte et ou provision ',
                    'process_id' => 51,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Compte non bloqué ", "value": "Label"}]]',
                ),
                189 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 190,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer qu\'aucun mouvement débit n\'a été opéré durant la validité de l\'ATD qui est une année (01) pour les personnes physiques, quatre (04) ans pour les personnes morales et quatre (04) ans pour les oppositions des organismes sociaux  ',
                    'process_id' => 51,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Mouvement opéré sur le compte ", "value": "Label"}]]',
                ),
                190 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 191,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que les frais ont été prélevés selon le barème en vigueur (ATD/Oppositions)',
                    'process_id' => 51,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Frais non prélevés"}]]',
                ),
                191 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 192,
                    'major_fact_types' => NULL,
                'name' => 'Vérifier la bonne fin de l\'ATD/oppositions  (mainlevée, expiration délai de validité, exécution du virement)',
                    'process_id' => 51,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Délai expiré"}], [{"score": 4}, {"label": "Déblocage de la provision sans la mainlevée"}]]',
                ),
                192 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 193,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de L\'existence du registre y afférent et sa bonne tenue ',
                    'process_id' => 52,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/ Non mis à jour ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre inexistant ", "value": "Label"}]]',
                ),
                193 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 194,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer du blocage des avoirs/cantonnement ',
                    'process_id' => 52,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Avoirs/cantonnement  non bloqués  ", "value": "Label"}]]',
                ),
                194 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 195,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer des prélèvements des frais selon les conditions de banque en vigueur',
                    'process_id' => 52,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Frais non prélevés"}]]',
                ),
                195 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 196,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que le client est avisé à temps au moyen d\'une lettre recommandée avec accusé de réception ',
                    'process_id' => 52,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Client non avisé ", "value": "Label"}]]',
                ),
                196 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 197,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les avoirs bloqués demeurent jusqu\'à délivrance d\'une mainlevée, ou une ordonnance de la juridiction compétente prononçant après validation la sommation de payer au créancier les sommes saisies',
                    'process_id' => 52,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Avoirs débloqués sans main levée ou ordonnance"}]]',
                ),
                197 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 198,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que la saisie arrêt judiciaire est signifiée par un huissier ',
                    'process_id' => 52,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "PV non signifié ", "value": "Label"}]]',
                ),
                198 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 199,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de L\'existence du registre y afférent et sa bonne tenue ',
                    'process_id' => 53,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/ Non mis à jour ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre inexistant ", "value": "Label"}]]',
                ),
                199 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 200,
                    'major_fact_types' => NULL,
                'name' => 'Vérifier les demandes d\'oppositions ( date d\'émission, n°chèque, n°de cpte de l\'émetteur, nom bénéficiaire, N°du BDC, motif, authentification de la signature…)     ',
                    'process_id' => 53,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Demande non remise par le client ", "value": "Label"}]]',
                ),
                200 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 201,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que l\'opposition est saisie sur système',
                    'process_id' => 53,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Opposition non saisie sur SI ", "value": "Label"}]]',
                ),
                201 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 202,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer des prélèvements des frais selon les conditions de banque en vigueur ',
                    'process_id' => 53,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Frais non prélevé ", "value": "Label"}]]',
                ),
                202 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 203,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de la diffusion des oppositions via DRE et DEJC',
                    'process_id' => 53,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Opposition non diffusée"}]]',
                ),
                203 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 204,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que la restitution de la provision est intervenue suite à une mainlevée, lettre de garantie ou une décision de justice notifiée par un huissier (cas d\'un litige)',
                    'process_id' => 53,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Provision restituée sans mainlevée/ lettre de garantie/décision de justice"}]]',
                ),
                204 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 205,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer du respect de délai de l\'opposition (03 ans et 20 jours pour les chèques, 03 ans pour les BDC) ',
                    'process_id' => 53,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Délai expiré ", "value": "Label"}]]',
                ),
                205 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 206,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier si l\'opposition du BDC est porté sur le feuillet n°1 du formulaire TI 34',
                    'process_id' => 53,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 2}, {"label": "Opposition non portée sur TI34"}]]',
                ),
                206 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 207,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que les déclarations des incidents sont effectuées durant les 02 jours ouvrables suivant la date de présentation du chèque ',
                    'process_id' => 54,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Déclarations non établies ", "value": "Label"}]]',
                ),
                207 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 208,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que les déclarations des régularisations des incidents sont effectuées',
                    'process_id' => 54,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Déclarations de régules non établies ", "value": "Label"}]]',
                ),
                208 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 209,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que la première injonction a été transmise aux clients par lettre recommandée avec accusé de réception au plus tard J+4 ouvrable à compter de la date de présentation du chèque dans un délai n\'excédant pas les 10 jours',
                    'process_id' => 54,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Première injonction non transmise"}]]',
                ),
                209 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 210,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que les clients interdits de chéquiers sont déclarés ',
                    'process_id' => 54,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Client interdit de chéquier non déclaré ", "value": "Label"}]]',
                ),
                210 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 211,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que la deuxième lettre d\'injonction a été transmise au client pour régularisation de l\'incident de paiement dans un délai de 20 jours à compter de l\'expiration du premier délai légal   ',
                    'process_id' => 54,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Deuxième injonction non transmise ", "value": "Label"}]]',
                ),
                211 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 212,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que la déclaration d\'interdit de chéquier a été établie en cas de récidive dans les 12 mois',
                    'process_id' => 54,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Faculté de régularisation  accordée au client ayant un incident de paiement durant 12 mois"}]]',
                ),
                212 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 213,
                    'major_fact_types' => NULL,
                'name' => 'Vérifier l\'acquitement d\'une pénalité libératoire au profit du trésor (timbres fiscaux, quittances de paiement) pour les cas de régularisations durant le deuxième délai légal de 20 jours ',
                    'process_id' => 54,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Pénalité libératoire au profit du trésor nn acquitté ", "value": "Label"}]]',
                ),
                213 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 214,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de l\'existence du registre y relatif et sa bonne tenue et mise à jour',
                    'process_id' => 55,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/ Non mis à jour ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Registre inexistant ", "value": "Label"}]]',
                ),
                214 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 215,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier la constitution des dossiers ainsi que leur classement et leur conservation ',
                    'process_id' => 55,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Dossier mal classé ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Dossier mal conservé ", "value": "Label"}]]',
                ),
                215 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 216,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que l\'agence a bloqué immediatement les avoirs du client décédé ',
                    'process_id' => 55,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Les avoirs non bloqués ", "value": "Label"}]]',
                ),
                216 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 217,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que la diffusion de la succession a été établie ',
                    'process_id' => 55,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Diffusion non établie ", "value": "Label"}]]',
                ),
                217 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 218,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de l\'arrêté comptable des comptes en capital et intérêt à la date du décès',
                    'process_id' => 55,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Arrêté comptable non établie"}]]',
                ),
                218 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 219,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de la Transmission des CA2 et CA50 à la DRE en cas de liquidation de la succession ',
                    'process_id' => 55,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Les CA2 et CA50 non transmis à la DRE", "value": "Label"}]]',
                ),
                219 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 220,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer du respect du délai de règlement de la succession (20 jours Max) ',
                    'process_id' => 55,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect du délai ", "value": "Label"}]]',
                ),
                220 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 221,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer qu\'aucune émission de chèque n\'a été émis après la date du décès',
                    'process_id' => 55,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Chèque rejeté ", "value": "Label"}]]',
                ),
                221 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 222,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer qu\'à l\'issue du décompte les actifs détenus sont déclarés à la sous direction de wilaya des impôts directs au bureau de l\'enregistrement et du timbre ',
                    'process_id' => 55,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Non déclaré ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence du quitus ", "value": "Label"}]]',
                ),
                222 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 223,
                    'major_fact_types' => NULL,
                    'name' => 'S’assurer que les formulaires sont dûment renseignés ',
                    'process_id' => 56,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Formulaires inexistant ", "value": "Label"}]]',
                ),
                223 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 224,
                    'major_fact_types' => NULL,
                    'name' => 'S’assurer que tous les US person identifiés ont été déclarés y compris les récalcitrants ',
                    'process_id' => 56,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non déclaré ", "value": "Label"}]]',
                ),
                224 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 225,
                    'major_fact_types' => NULL,
                    'name' => 'S’assurer que le formulaire KYC est dûment renseigné',
                    'process_id' => 57,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Formulaire inéxistant ", "value": "Label"}]]',
                ),
                225 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 226,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de la mise à jour du dossier d\'ouverture de compte et de la fiche client ',
                    'process_id' => 57,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Dossier non mis à jour ", "value": "Label"}]]',
                ),
                226 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 227,
                    'major_fact_types' => NULL,
                    'name' => 'S’assurer qu’une lettre de courtoisie ou d’avis d’ouverture de compte ont été envoyée au client',
                    'process_id' => 57,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Lettre non transmise ", "value": "Label"}]]',
                ),
                227 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 228,
                    'major_fact_types' => NULL,
                    'name' => 'S’assurer que toute alerte SMART AML a fait l’objet d’analyse, et établissement d’un rapport confidentiel dans le cas échéant',
                    'process_id' => 57,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                ),
                228 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 229,
                    'major_fact_types' => NULL,
                    'name' => 'S’assurer que le registre des alertes est bien tenu et mis à jour',
                    'process_id' => 57,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registe non tenu/non mis à jour ", "value": "Label"}]]',
                ),
                229 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 230,
                    'major_fact_types' => NULL,
                    'name' => 'S’assurer que le flux d\'opérations enregistrées est cohérent avec la nature de fonctionnement du compte',
                    'process_id' => 57,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Opérations non conformes avec la nature du compte"}]]',
                ),
                230 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 1,
                    'id' => 231,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents éxigés par la banque',
                    'process_id' => 58,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "manque certains documents"}]]',
                ),
                231 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 232,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que le récépissé de dépôt de crédit est établi ',
                    'process_id' => 58,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                ),
                232 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 233,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                    'process_id' => 58,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                ),
                233 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 234,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée ainsi que la réponse de cette dernière ',
                    'process_id' => 58,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                ),
                234 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 235,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                    'process_id' => 58,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                ),
                235 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 236,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les délais de traitement des dossiers sont respectés',
                    'process_id' => 58,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Délais non respecter"}]]',
                ),
                236 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 237,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                    'process_id' => 59,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                ),
                237 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 238,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                    'process_id' => 59,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                ),
                238 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 239,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que le ticket d\'autorisation est établi selon la réglementation en vigueur ',
                    'process_id' => 59,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "discordonce entre le PV et le ticket d\'autorisation ", "value": "Label"}]]',
                ),
                239 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 240,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                    'process_id' => 59,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                ),
                240 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 241,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprès de l\'administration fiscale',
                    'process_id' => 60,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constées"}]]',
                ),
                241 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 242,
                    'major_fact_types' => NULL,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevés conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                    'process_id' => 60,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                ),
                242 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 243,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de la domiciliation préalable du salaire',
                    'process_id' => 60,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Salaire non domicilié", "value": "Label"}]]',
                ),
                243 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 244,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisie (code du produit, le montant, la validité de l\'autorisation)',
                    'process_id' => 61,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "autorisation mal saisie"}]]',
                ),
                244 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 245,
                    'major_fact_types' => NULL,
                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties)   ',
                    'process_id' => 61,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                ),
                245 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 246,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer de la délivrance d\'un chèque de banque à l\'ordre du concessionaire, sous présentation des pièces justificatives (engagement du gage du véhicule au profit de la banque)',
                    'process_id' => 61,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Absence d\'accusé de réception ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Utlisation d\'un autre moyen de paiement ", "value": "Label"}]]',
                ),
                246 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 247,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                    'process_id' => 61,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                ),
                247 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 248,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer du recueil des garanties à postériori (gage, Assurance tous risques avec subrogation)',
                    'process_id' => 62,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garantie non recueilli/Absence de suivi", "value": "Label"}]]',
                ),
                248 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 249,
                    'major_fact_types' => NULL,
                    'name' => ' S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé.',
                    'process_id' => 63,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                ),
                249 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 250,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque',
                    'process_id' => 64,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "manque certains documents"}]]',
                ),
                250 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 251,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que le récépissé de dépôt de crédit est établi ',
                    'process_id' => 64,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                ),
                251 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 252,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                    'process_id' => 64,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                ),
                252 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 253,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette dernière ',
                    'process_id' => 64,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                ),
                253 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 254,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                    'process_id' => 64,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                ),
                254 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 255,
                    'major_fact_types' => NULL,
                    'name' => 'S\'assurer que les délais de traitement des dossiers sont respecté',
                    'process_id' => 64,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Délais non respecté"}]]',
                ),
                255 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 256,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                    'process_id' => 65,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                ),
                256 => 
                array (
                    'fields' => NULL,
                    'has_major_fact' => 0,
                    'id' => 257,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                    'process_id' => 65,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                ),
                257 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 258,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que le ticket d\'autorisation est établi selon la réglementation en vigueur',
                    'process_id' => 65,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "discordonce entre le PV et le ticket d\'autorisation"}]]',
                ),
                258 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 259,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                    'process_id' => 65,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                ),
                259 => 
                array (
                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 1,
                    'id' => 260,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprès de l\'administration fiscale',
                    'process_id' => 66,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constatées"}]]',
                ),
                260 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 261,
                    'major_fact_types' => NULL,
                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                    'process_id' => 66,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                ),
                261 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 262,
                    'major_fact_types' => NULL,
                    'name' => 's\'assurer de la domiciliation préalable du salaire',
                    'process_id' => 66,
                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Salaire non domicilié", "value": "Label"}]]',
                ),
                262 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 263,
                    'major_fact_types' => NULL,
                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisie (code du produit, le montant, la validité de l\'autorisation)',
                    'process_id' => 67,
                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "autorisation mal saisie"}]]',
                ),
                263 => 
                array (
                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                    'has_major_fact' => 0,
                    'id' => 264,
                    'major_fact_types' => NULL,
                    'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                        'process_id' => 67,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                    ),
                    264 => 
                    array (
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 1,
                        'id' => 265,
                        'major_fact_types' => NULL,
                        'name' => 'S\'assurer de la délivrance d\'un chèque de banque à l\'ordre du fournisseur, sous présentation des pièces justificatives.',
                        'process_id' => 67,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Utlisation d\'un autre moyen de paiement ", "value": "Label"}]]',
                    ),
                    265 => 
                    array (
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 1,
                        'id' => 266,
                        'major_fact_types' => NULL,
                        'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                        'process_id' => 67,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                    ),
                    266 => 
                    array (
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 1,
                        'id' => 267,
                        'major_fact_types' => NULL,
                        'name' => ' S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé.',
                        'process_id' => 68,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                    ),
                    267 => 
                    array (
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 1,
                        'id' => 268,
                        'major_fact_types' => NULL,
                        'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque',
                        'process_id' => 69,
                        'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "manque certains documents"}]]',
                    ),
                    268 => 
                    array (
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 0,
                        'id' => 269,
                        'major_fact_types' => NULL,
                    'name' => 'Vérifier que le récépissé de dépôt (provisoire, définitif) de crédit est établi ',
                        'process_id' => 69,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                    ),
                    269 => 
                    array (
                        'fields' => NULL,
                        'has_major_fact' => 0,
                        'id' => 270,
                        'major_fact_types' => NULL,
                        'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                        'process_id' => 69,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                    ),
                    270 => 
                    array (
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 0,
                        'id' => 271,
                        'major_fact_types' => NULL,
                        'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette dernière',
                        'process_id' => 69,
                        'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "la demande de consultation non transmise"}]]',
                    ),
                    271 => 
                    array (
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 0,
                        'id' => 272,
                        'major_fact_types' => NULL,
                        'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                        'process_id' => 69,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                    ),
                    272 => 
                    array (
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 0,
                        'id' => 273,
                        'major_fact_types' => NULL,
                        'name' => 'S\'assurer que les délais de traitement des dossiers sont respectés',
                        'process_id' => 69,
                        'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Délais non respecter"}]]',
                    ),
                    273 => 
                    array (
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 0,
                        'id' => 274,
                        'major_fact_types' => NULL,
                    'name' => 'S\'assurer du respect des pouvoirs de délégation (Comité agence, DRE, central)',
                        'process_id' => 70,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect des pouvoirs de sanction ", "value": "Label"}]]',
                    ),
                    274 => 
                    array (
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 0,
                        'id' => 275,
                        'major_fact_types' => NULL,
                        'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                        'process_id' => 70,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                    ),
                    275 => 
                    array (
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 0,
                        'id' => 276,
                        'major_fact_types' => NULL,
                        'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                        'process_id' => 70,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                    ),
                    276 => 
                    array (
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 1,
                        'id' => 277,
                        'major_fact_types' => NULL,
                        'name' => 'Vérifier que le ticket d\'autorisation est établi selon la réglementation en vigueur ',
                        'process_id' => 70,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "discordonce entre le PV et le ticket d\'autorisation ", "value": "Label"}]]',
                    ),
                    277 => 
                    array (
                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 0,
                        'id' => 278,
                        'major_fact_types' => NULL,
                    'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                        'process_id' => 70,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                    ),
                    278 => 
                    array (
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 0,
                        'id' => 279,
                        'major_fact_types' => NULL,
                    'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                        'process_id' => 71,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des délégations de pouvoirs", "value": "Label"}]]',
                    ),
                    279 => 
                    array (
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 1,
                        'id' => 280,
                        'major_fact_types' => NULL,
                        'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprès de l\'administration fiscale',
                        'process_id' => 71,
                        'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constatées"}]]',
                    ),
                    280 => 
                    array (
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 0,
                        'id' => 281,
                        'major_fact_types' => NULL,
                    'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                        'process_id' => 71,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                    ),
                    281 => 
                    array (
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 1,
                        'id' => 282,
                        'major_fact_types' => NULL,
                        'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                        'process_id' => 71,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non enregistrées", "value": "Label"}]]',
                    ),
                    282 => 
                    array (
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 1,
                        'id' => 283,
                        'major_fact_types' => NULL,
                        'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                        'process_id' => 71,
                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                    ),
                    283 => 
                    array (
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 0,
                        'id' => 284,
                        'major_fact_types' => NULL,
                    'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisie (code du produit, le montant, taux d\'intérêt, la validité de l\'autorisation)',
                        'process_id' => 72,
                        'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "autorisation mal saisie"}]]',
                    ),
                    284 => 
                    array (
                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                        'has_major_fact' => 1,
                        'id' => 285,
                        'major_fact_types' => NULL,
                        'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                            'process_id' => 72,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                        ),
                        285 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 1,
                            'id' => 286,
                            'major_fact_types' => NULL,
                            'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                            'process_id' => 72,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                        ),
                        286 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 1,
                            'id' => 287,
                            'major_fact_types' => NULL,
                            'name' => 'Vérifier que la mobilisation du crédit a été effectuée selon les modalités d\'acquisition et de paiement du logement ',
                            'process_id' => 72,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des mobilisations ", "value": "Label"}]]',
                        ),
                        287 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 1,
                            'id' => 288,
                            'major_fact_types' => NULL,
                            'name' => 'S\'assurer que le suivi des granties à postériori est effectué',
                            'process_id' => 73,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi/non validé", "value": "Label"}]]',
                        ),
                        288 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 1,
                            'id' => 289,
                            'major_fact_types' => NULL,
                            'name' => 'S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé ',
                            'process_id' => 74,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                        ),
                        289 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 0,
                            'id' => 290,
                            'major_fact_types' => NULL,
                            'name' => 'S\'assurer si l\'indemnité de 04% sur le solde restant a été payé en cas de remboursement par anticipation ',
                            'process_id' => 74,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Indemnité non prélevée", "value": "Label"}]]',
                        ),
                        290 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 1,
                            'id' => 291,
                            'major_fact_types' => NULL,
                        'name' => 'Vérifier que le capital restant a été viré au compte CCIR en cas du décés de l\'emprunteur ou du conjoint (co-emprunteur)',
                            'process_id' => 74,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "capital non viré au CCIR", "value": "Label"}]]',
                        ),
                        291 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 0,
                            'id' => 292,
                            'major_fact_types' => NULL,
                            'name' => 'Vérifier que le délai global de la déclaration du sinistre n\'a pas dépassé les 90 jours après sa date de survenance ',
                            'process_id' => 74,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "dépassement de délai", "value": "Label"}]]',
                        ),
                        292 => 
                        array (
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 1,
                            'id' => 293,
                            'major_fact_types' => NULL,
                            'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents fournis par le client ',
                            'process_id' => 75,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "manque certain document", "value": "Label"}]]',
                        ),
                        293 => 
                        array (
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 0,
                            'id' => 294,
                            'major_fact_types' => NULL,
                            'name' => 'Vérifier que le récépissé de dépôt de crédit est établi ',
                            'process_id' => 75,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                        ),
                        294 => 
                        array (
                            'fields' => NULL,
                            'has_major_fact' => 0,
                            'id' => 295,
                            'major_fact_types' => NULL,
                            'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                            'process_id' => 75,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                        ),
                        295 => 
                        array (
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 1,
                            'id' => 296,
                            'major_fact_types' => NULL,
                            'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée ainsi que la réponse de cette dernière ',
                            'process_id' => 75,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                        ),
                        296 => 
                        array (
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 0,
                            'id' => 297,
                            'major_fact_types' => NULL,
                            'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                            'process_id' => 75,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                        ),
                        297 => 
                        array (
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 0,
                            'id' => 298,
                            'major_fact_types' => NULL,
                            'name' => 'S\'assurer que les délais de traitement des dossiers sont respectés',
                            'process_id' => 75,
                            'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Délais non respecter"}]]',
                        ),
                        298 => 
                        array (
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 0,
                            'id' => 299,
                            'major_fact_types' => NULL,
                            'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                            'process_id' => 76,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                        ),
                        299 => 
                        array (
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 0,
                            'id' => 300,
                            'major_fact_types' => NULL,
                            'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                            'process_id' => 76,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                        ),
                        300 => 
                        array (
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 1,
                            'id' => 301,
                            'major_fact_types' => NULL,
                            'name' => 'Vérifier que le ticket d\'autorisation est établi sur la base d\'un selon la réglementation en vigueur',
                            'process_id' => 76,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "discordonce entre le PV et le ticket d\'autorisation ", "value": "Label"}]]',
                        ),
                        301 => 
                        array (
                            'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 0,
                            'id' => 302,
                            'major_fact_types' => NULL,
                        'name' => 'S\'assurer que la décision du comité (accord ou rejet )est notifiée au client ',
                            'process_id' => 76,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                        ),
                        302 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 1,
                            'id' => 303,
                            'major_fact_types' => NULL,
                            'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprès de l\'administration fiscale',
                            'process_id' => 77,
                            'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constatées"}]]',
                        ),
                        303 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 0,
                            'id' => 304,
                            'major_fact_types' => NULL,
                        'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                            'process_id' => 77,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                        ),
                        304 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 0,
                            'id' => 305,
                            'major_fact_types' => NULL,
                            'name' => 'S\'assurer de la domiciliation préalable du salaire',
                            'process_id' => 77,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "salaire non domicilié", "value": "Label"}]]',
                        ),
                        305 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 1,
                            'id' => 306,
                            'major_fact_types' => NULL,
                            'name' => 'S\'assurer de l\'existence de l\'engagement de location ',
                            'process_id' => 77,
                            'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Inexistence de l\'engagement", "value": "Label"}]]',
                        ),
                        306 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 0,
                            'id' => 307,
                            'major_fact_types' => NULL,
                        'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisie (code du produit, le montant, la validité de l\'autorisation)',
                            'process_id' => 77,
                            'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "autorisation mal saisie"}]]',
                        ),
                        307 => 
                        array (
                            'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                            'has_major_fact' => 1,
                            'id' => 308,
                            'major_fact_types' => NULL,
                            'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                                'process_id' => 77,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                            ),
                            308 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 309,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer de la délivrance d\'un chèque de banque à l\'ordre du notaire, sous présentation des pièces justificatives.',
                                'process_id' => 77,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Utlisation d\'un autre moyen de paiement ", "value": "Label"}]]',
                            ),
                            309 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 310,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                                'process_id' => 77,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                            ),
                            310 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 311,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer de l\'enregistrement du contrat de location auprès de l\'administration habilitée',
                                'process_id' => 78,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non enregistré ", "value": "Label"}]]',
                            ),
                            311 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 312,
                                'major_fact_types' => NULL,
                                'name' => ' S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué',
                                'process_id' => 79,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                            ),
                            312 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 313,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que les activités financées rentrent bien dans le cadre des activités finançables par la banque',
                                'process_id' => 80,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Acitivité non finaçable par la banque"}]]',
                            ),
                            313 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 314,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque',
                                'process_id' => 80,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "manque certains documents"}]]',
                            ),
                            314 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 315,
                                'major_fact_types' => NULL,
                            'name' => 'Vérifier que le récépissé de dépôt (provisoire, définitif) de crédit est établi et correspond au type de crédit ',
                                'process_id' => 80,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                            ),
                            315 => 
                            array (
                                'fields' => NULL,
                                'has_major_fact' => 0,
                                'id' => 316,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                                'process_id' => 80,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                            ),
                            316 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 317,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette structure  ',
                                'process_id' => 80,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                            ),
                            317 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 318,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122 ',
                                'process_id' => 80,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Visite non effectuée ", "value": "Label"}]]',
                            ),
                            318 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 319,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                                'process_id' => 80,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                            ),
                            319 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 320,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectés',
                                'process_id' => 80,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Délais non respecter"}]]',
                            ),
                            320 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 321,
                                'major_fact_types' => NULL,
                            'name' => 'S\'assurer du traitement des dossiers suivant les pouvoirs de délégation (Comité agence, DRE, central)',
                                'process_id' => 81,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect des pouvoirs de sanction ", "value": "Label"}]]',
                            ),
                            321 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 322,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                                'process_id' => 81,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                            ),
                            322 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 323,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                                'process_id' => 81,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                            ),
                            323 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 324,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que le ticket d\'autorisation est établi selon la réglementation en vigueur',
                                'process_id' => 81,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "discordonce entre le PV et le ticket d\'autorisation"}]]',
                            ),
                            324 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 325,
                                'major_fact_types' => NULL,
                            'name' => 'S\'assurer que la décision du comité (accord ou rejet ) est notifiée au client ',
                                'process_id' => 81,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                            ),
                            325 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 326,
                                'major_fact_types' => NULL,
                            'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                                'process_id' => 82,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des délégations de pouvoirs", "value": "Label"}]]',
                            ),
                            326 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 327,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprès de l\'administration fiscale',
                                'process_id' => 82,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constatées"}]]',
                            ),
                            327 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 328,
                                'major_fact_types' => NULL,
                            'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                                'process_id' => 82,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                            ),
                            328 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 329,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprès des institutions concernées',
                                'process_id' => 82,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Garanties non enregistrées"}]]',
                            ),
                            329 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 330,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                'process_id' => 82,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                            ),
                            330 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 331,
                                'major_fact_types' => NULL,
                            'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisie (code du produit, le montant, la validité de l\'autorisation)',
                                'process_id' => 83,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "autorisation mal saisie"}]]',
                            ),
                            331 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 332,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies',
                                'process_id' => 83,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                            ),
                            332 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 333,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                                'process_id' => 83,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                            ),
                            333 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 334,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer que les garanties à postériori mentionnées sur le ticket d\'autorisation sont recueillies ',
                                'process_id' => 84,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non réalisées", "value": "Label"}]]',
                            ),
                            334 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 335,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprès des institutions concernées',
                                'process_id' => 84,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Garanties non enregistrées"}]]',
                            ),
                            335 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 336,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                'process_id' => 84,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                            ),
                            336 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 337,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué et matérialisé ',
                                'process_id' => 85,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                            ),
                            337 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 338,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer que les visites sur site sont efféctuées après réalisation du projet',
                                'process_id' => 85,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "visite sur site non effectuée", "value": "Label"}]]',
                            ),
                            338 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 339,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que les activités financées rentrent bien dans le cadre des activités finançables par la banque',
                                'process_id' => 86,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Acitivité non finaçable par la banque"}]]',
                            ),
                            339 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 340,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque',
                                'process_id' => 86,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "manque certains documents"}]]',
                            ),
                            340 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 341,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que le récépissé de dépôt de dossier de crédit est établi ',
                                'process_id' => 86,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                            ),
                            341 => 
                            array (
                                'fields' => NULL,
                                'has_major_fact' => 0,
                                'id' => 342,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                                'process_id' => 86,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                            ),
                            342 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 343,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée ainsi que la réponse de cette dernière',
                                'process_id' => 86,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "La demande de consultation non transmise", "value": "Label"}]]',
                            ),
                            343 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 344,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122 et/ou un rapport d\'expertise',
                                'process_id' => 86,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Visite non effectuée ", "value": "Label"}]]',
                            ),
                            344 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 345,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                                'process_id' => 86,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                            ),
                            345 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 346,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer que les délais de traitement des dossiers sont respectés',
                                'process_id' => 86,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Délais non respecter"}]]',
                            ),
                            346 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 347,
                                'major_fact_types' => NULL,
                            'name' => 'S\'assurer du traitement des dossiers suivant les pouvoirs de délégation (Comité agence, DRE, central)',
                                'process_id' => 87,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect des pouvoirs de sanction ", "value": "Label"}]]',
                            ),
                            347 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 348,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                                'process_id' => 87,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                            ),
                            348 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 349,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                                'process_id' => 87,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                            ),
                            349 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 350,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que le ticket d\'autorisation est établi selon la réglementation en vigueur',
                                'process_id' => 87,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "discordonce entre le PV et le ticket d\'autorisation"}]]',
                            ),
                            350 => 
                            array (
                                'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 351,
                                'major_fact_types' => NULL,
                            'name' => 'S\'assurer que la décision du comité (accord ou rejet ) est notifiée au client ',
                                'process_id' => 87,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                            ),
                            351 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 352,
                                'major_fact_types' => NULL,
                            'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                                'process_id' => 88,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des délégations de pouvoirs", "value": "Label"}]]',
                            ),
                            352 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 353,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que la convention de crédit est signée par le client et par le Directeur d’Agence revêtue de la mention "LU ET APPROUVE", timbrée et enregistrée auprès de l\'administration fiscale',
                                'process_id' => 88,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Anomalies constées"}]]',
                            ),
                            353 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 354,
                                'major_fact_types' => NULL,
                            'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                                'process_id' => 88,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                            ),
                            354 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 355,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprès des institutions concernées',
                                'process_id' => 88,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Garanties non enregistrées"}]]',
                            ),
                            355 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 356,
                                'major_fact_types' => NULL,
                                'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                'process_id' => 88,
                                'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                            ),
                            356 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 0,
                                'id' => 357,
                                'major_fact_types' => NULL,
                            'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisie (code du produit, le montant, la validité de l\'autorisation)',
                                'process_id' => 89,
                                'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "Autorisation mal saisie"}]]',
                            ),
                            357 => 
                            array (
                                'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                'has_major_fact' => 1,
                                'id' => 358,
                                'major_fact_types' => NULL,
                                'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                                    'process_id' => 89,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                                ),
                                358 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 359,
                                    'major_fact_types' => NULL,
                                'name' => 'S\'assurer de la délivrance d\'un chèque de banque , sous présentation des pièces justificatives (sauf financement d\'aménagement d\'un local)',
                                    'process_id' => 89,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Utilisation d\'un autre moyen de paiement", "value": "Label"}]]',
                                ),
                                359 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 360,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que le tableau d’amortissement  est établi, signé par le client, et le directeur d\'agence',
                                    'process_id' => 89,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établi", "value": "Label"}]]',
                                ),
                                360 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 361,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer du recueil des garanties à postériori',
                                    'process_id' => 90,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garantie non recueillie/Absence de suivi du recueille des garanties", "value": "Label"}]]',
                                ),
                                361 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 362,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer du suivi des échéances jusqu\'à la tombée de l\'engagement est effectué',
                                    'process_id' => 91,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                                ),
                                362 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 363,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer que les visites sur site sont efféctuées après réalisation du projet ',
                                    'process_id' => 91,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "visite sur site non effectuée", "value": "Label"}]]',
                                ),
                                363 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 364,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que les activités financées rentrent bien dans le cadre des activités finançables par la banque',
                                    'process_id' => 92,
                                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Acitivité non finaçable par la banque"}]]',
                                ),
                                364 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 365,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents fournis par le client ',
                                    'process_id' => 92,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "manque certain document", "value": "Label"}]]',
                                ),
                                365 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 366,
                                    'major_fact_types' => NULL,
                                'name' => 'Vérifier que le récépissé de dépôt (provisoire, définitif) de crédit est établi ',
                                    'process_id' => 92,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Récépissé de dépôt non établi", "value": "Label"}]]',
                                ),
                                366 => 
                                array (
                                    'fields' => NULL,
                                    'has_major_fact' => 0,
                                    'id' => 367,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                                    'process_id' => 92,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                                ),
                                367 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 368,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette dernière ',
                                    'process_id' => 92,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                                ),
                                368 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 369,
                                    'major_fact_types' => NULL,
                                'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122 (pour les crédits concernés par la visite)',
                                    'process_id' => 92,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Visite non effectuée ", "value": "Label"}]]',
                                ),
                                369 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 370,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                                    'process_id' => 92,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                                ),
                                370 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 371,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer que les délais de traitement des dossiers sont respectés',
                                    'process_id' => 92,
                                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Délais non respecter"}]]',
                                ),
                                371 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 372,
                                    'major_fact_types' => NULL,
                                'name' => 'S\'assurer du traitement des dossiers suivant les pouvoirs de délégation (Comité agence, DRE, central)',
                                    'process_id' => 93,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non respect des pouvoirs de sanction ", "value": "Label"}]]',
                                ),
                                372 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 373,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                                    'process_id' => 93,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                                ),
                                373 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 374,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                                    'process_id' => 93,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                                ),
                                374 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 375,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que le ticket d\'autorisation est établi selon la réglementation en vigueur',
                                    'process_id' => 93,
                                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "discordonce entre le PV et le ticket d\'autorisation"}]]',
                                ),
                                375 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 376,
                                    'major_fact_types' => NULL,
                                'name' => 'S\'assurer que la décision du comité (accord ou rejet ) est notifiée au client ',
                                    'process_id' => 93,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                                ),
                                376 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 377,
                                    'major_fact_types' => NULL,
                                'name' => 'S\'assurer du respect de pouvoir de délégation en matière de validation des garanties (DRE/Central)',
                                    'process_id' => 94,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect des délégations de pouvoirs", "value": "Label"}]]',
                                ),
                                377 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 378,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que la convention de crédit est signée par le client et par le directeur d\'agence revêtue de la mention "LU ET APPOUVE", timbrée et enregistrée auprés de l\'administartion fiscale ',
                                    'process_id' => 94,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                                ),
                                378 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 379,
                                    'major_fact_types' => NULL,
                                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                                    'process_id' => 94,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                                ),
                                379 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 380,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                                    'process_id' => 94,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non enregistrées", "value": "Label"}]]',
                                ),
                                380 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 381,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                    'process_id' => 94,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                                ),
                                381 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 382,
                                    'major_fact_types' => NULL,
                                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisie (code du produit, le montant, la validité de l\'autorisation)',
                                    'process_id' => 95,
                                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "autorisation mal saisie"}]]',
                                ),
                                382 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 383,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que toutes les conditions de déblocage sont réunies',
                                    'process_id' => 95,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                                ),
                                383 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 384,
                                    'major_fact_types' => NULL,
                                'name' => 'S\'assurer du mode de paiement (retrait d\'espèce à bannir) ',
                                    'process_id' => 96,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Retrait en espèce", "value": "Label"}]]',
                                ),
                                384 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 385,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la banque',
                                    'process_id' => 97,
                                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "manque certains documents"}]]',
                                ),
                                385 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 386,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que le registre des dossiers de crédit est tenu, mis à jour et bien renseigné ',
                                    'process_id' => 97,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Mal renseigné/non mis à jour", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non tenu", "value": "Label"}]]',
                                ),
                                386 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 387,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que la demande de consultation de la centrale des risques et des impayés a bien été effectuée  ainsi que la réponse de cette structure',
                                    'process_id' => 97,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "la demande de consultation non transmise", "value": "Label"}]]',
                                ),
                                387 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 388,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que la visite sur site est réalisée matérialisée par un ST122',
                                    'process_id' => 97,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Visite non effectuée ", "value": "Label"}]]',
                                ),
                                388 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 389,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer que la "fiche d\'appréciation client" est établie, renseignée et signée par le chargé d\'etude et le directeur d\'agence  ',
                                    'process_id' => 97,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "Mal renseigné/non signé", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Fiche d\'appréciation non établie", "value": "Label"}]]',
                                ),
                                389 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 390,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer que les délais de traitement des dossiers sont respectés',
                                    'process_id' => 97,
                                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Délais non respecter"}]]',
                                ),
                                390 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 391,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier la signature d\'une déclaration sur l\'honneur, fiche de présence par les membres du comité ',
                                    'process_id' => 98,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 2, "value": "Note"}, {"label": "déclaration sur l\'honneur/Fiche de présence non signé", "value": "Label"}]]',
                                ),
                                391 => 
                                array (
                                    'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 392,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que la fiche de décision est établie, renseignée et signée par les membres du comité ',
                                    'process_id' => 98,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "fiche de décision non conforme", "value": "Label"}]]',
                                ),
                                392 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 393,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que le ticket d\'autorisation est établi selon la réglementation en vigueur',
                                    'process_id' => 98,
                                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "discordonce entre le PV et le ticket d\'autorisation"}]]',
                                ),
                                393 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 394,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que la convention de crédit est signée par le client et par le directeur d\'agence revêtue de la mention "LU ET APPOUVE", timbrée et enregistrée auprés de l\'administartion fiscale ',
                                    'process_id' => 99,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                                ),
                                394 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 395,
                                    'major_fact_types' => NULL,
                                'name' => 'Vérifier que les commissions de gestion, d’engagement et autres sont prélevées conformément aux conditions de banque en vigueur (copie de l’avis de débit  dans le dossier)',
                                    'process_id' => 99,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "non respect des conditions de banque", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "commissions non prélevés", "value": "Label"}]]',
                                ),
                                395 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 396,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprés des institutions concernés ',
                                    'process_id' => 99,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non enregistrées", "value": "Label"}]]',
                                ),
                                396 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 397,
                                    'major_fact_types' => NULL,
                                    'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                    'process_id' => 99,
                                    'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                                ),
                                397 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 0,
                                    'id' => 398,
                                    'major_fact_types' => NULL,
                                'name' => 'S\'assurer que l\'autorisation pouvoir agence est correctement saisie (code du produit, le montant, la validité de l\'autorisation)',
                                    'process_id' => 100,
                                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "autorisation mal saisie"}]]',
                                ),
                                398 => 
                                array (
                                    'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                    'has_major_fact' => 1,
                                    'id' => 399,
                                    'major_fact_types' => NULL,
                                    'name' => 'Vérifier que toutes les conditions de déblocage sont réunies notamment la validation des garanties (déblocage doit être effectué après validation des garanties   ',
                                        'process_id' => 100,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "déblocage avant validation des garanties ", "value": "Label"}]]',
                                    ),
                                    399 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 400,
                                        'major_fact_types' => NULL,
                                        'name' => 'Vérifier que le tableau d’amortissement semestriel est établi, signé par le client, et le directeur d\'agence',
                                        'process_id' => 100,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Non signé par le client ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non établis", "value": "Label"}]]',
                                    ),
                                    400 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 0,
                                        'id' => 401,
                                        'major_fact_types' => NULL,
                                        'name' => 's\'assurer de la signature d\'une chaîne de billets à ordre par le client',
                                        'process_id' => 100,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}]]',
                                    ),
                                    401 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 0,
                                        'id' => 402,
                                        'major_fact_types' => NULL,
                                        'name' => 's\'assurer du paiement de la cotisation au fonds de garantie',
                                        'process_id' => 100,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "paiement non effectué ", "value": "Label"}]]',
                                    ),
                                    402 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 403,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que les garanties mentionnées sur le ticket d\'autorisation sont recueillies ',
                                        'process_id' => 101,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Garanties non réalisées", "value": "Label"}]]',
                                    ),
                                    403 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 404,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer de l\'enregistrement des actes de garanties auprès des institutions concernées',
                                        'process_id' => 101,
                                        'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Garanties non enregistrées"}]]',
                                    ),
                                    404 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 405,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que les originaux des actes de garanties sont transmis à la DRE pour conservation ',
                                        'process_id' => 101,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Garanties non transmises à la hièrarchie ", "value": "Label"}]]',
                                    ),
                                    405 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 406,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que le suivi des échéances jusqu\'à la tombée de l\'engagement est effectué',
                                        'process_id' => 102,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de suivi", "value": "Label"}]]',
                                    ),
                                    406 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 407,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que la visite sur site après réalisation du projet est effectuée ',
                                        'process_id' => 102,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "visite sur site non effectuée", "value": "Label"}]]',
                                    ),
                                    407 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 0,
                                        'id' => 408,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer de l’établissement du CT100 chaque fin du mois ',
                                        'process_id' => 103,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "formulaire mal renseigné", "value": "Label"}]]',
                                    ),
                                    408 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 409,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer que les soldes anormaux sont justifiés ',
                                        'process_id' => 103,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "soldes anormaux non justifiés", "value": "Label"}]]',
                                    ),
                                    409 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 0,
                                        'id' => 410,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer que les démarches de régularisation des suspens ont été effectuées par l\'agence',
                                        'process_id' => 103,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "démarches non effectuées", "value": "Label"}]]',
                                    ),
                                    410 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 0,
                                        'id' => 411,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer que le CT189 est dûment renseigné ',
                                        'process_id' => 104,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "CT 189 mal renseigné", "value": "Label"}]]',
                                    ),
                                    411 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 412,
                                        'major_fact_types' => NULL,
                                    'name' => 'S’assurer que les montants affichés aux comptes d’ordre sensible sont justifiés (Valeur égarée, écriture en suspens, déficit de caisse…)',
                                        'process_id' => 104,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Montant non justifé", "value": "Label"}]]',
                                    ),
                                    412 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 413,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer que tous les comptes d’ordre affichant un solde important sont justifiés ',
                                        'process_id' => 104,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "compte non justifé", "value": "Label"}]]',
                                    ),
                                    413 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 0,
                                        'id' => 414,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer que les démarches de régularisation des suspens ont été effectuées par l\'agence',
                                        'process_id' => 104,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "démarche non effectuée", "value": "Label"}]]',
                                    ),
                                    414 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 0,
                                        'id' => 415,
                                        'major_fact_types' => NULL,
                                    'name' => 'S’assurer que les registres des L/S (émis et reçu) sont tenus et mis à jour',
                                        'process_id' => 105,
                                        'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 3}, {"label": "anomalies constatées"}]]',
                                    ),
                                    415 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 0,
                                        'id' => 416,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer du respect chronologique des L/S',
                                        'process_id' => 105,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "ordre chronologique non respecté", "value": "Label"}]]',
                                    ),
                                    416 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de liaison siège"}, {"name": "liaison_siege _number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "liaison_siege _number _field"}, {"placeholder": "Entrez le numéro de de liaison siège"}, {"help_text": "Saisissez le numéro de liaison siège tel qu\'il apparaît sur le document correspondant. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "Montant"}, {"name": "amount"}, {"length": "50"}, {"style": "col-12 col-lg-4"}, {"id": "amount_field"}, {"placeholder": "Entrez le montant"}, {"help_text": "Saisissez le montant avec précision en évitant les erreurs d\'orthographe et les caractères spéciaux. Veuillez vérifier que vous avez saisi le montant correctement et qu\'il est cohérent avec les autres informations relatives à la transaction ou à l\'opération."}, {"rules": ["required"]}], [{"type": "date"}, {"label": "Journée de comptabilisation"}, {"name": "accounting_day"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "accounting_day_field"}, {"placeholder": "Sélectionnez la date"}, {"help_text": "Sélectionnez la date à laquelle l’opération a été effectuée."}, {"rules": ["required", "date"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 417,
                                        'major_fact_types' => NULL,
                                    'name' => 'S’assurer du respect de délais (48 h) de débouclement des L/S',
                                        'process_id' => 105,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "debouclement tardive", "value": "Label"}]]',
                                    ),
                                    417 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 418,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer de la bonne imputation des écritures comptables aux comptes appropriés',
                                        'process_id' => 105,
                                        'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "mauvaise imputation des écritures comptables"}]]',
                                    ),
                                    418 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 419,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer que le budget de fonctionnement et/ou d’investissement à fait l’objet de notification',
                                        'process_id' => 106,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de notification ", "value": "Label"}]]',
                                    ),
                                    419 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 420,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer que les dépenses sont gérées de façon rigoureuse et imputées aux comptes charges appropriés',
                                        'process_id' => 106,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Non respect du compte charge approprié", "value": "Label"}]]',
                                    ),
                                    420 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 421,
                                        'major_fact_types' => NULL,
                                    'name' => 'S’assurer que toute dépense engagée est justifiée (Pièces justificatives)',
                                        'process_id' => 106,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence de pièces justificatves ", "value": "Label"}]]',
                                    ),
                                    421 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 0,
                                        'id' => 422,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer de l’élaboration et de la transmission des états trimestriels à la DRE de rattachement dans les délais',
                                        'process_id' => 106,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Etat non transmis à la DRE ", "value": "Label"}]]',
                                    ),
                                    422 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte interne"}, {"name": "internal_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "internal_account_number_field"}, {"placeholder": "Entrez le numéro de compte interne"}, {"help_text": "Saisissez le numéro de compte interne tel qu\'il est attribué dans le système de gestion de l\'entreprise. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 423,
                                        'major_fact_types' => NULL,
                                        'name' => 'S’assurer que les écarts sont justifiés par l’agence ',
                                        'process_id' => 106,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Ecarts non justifiés ", "value": "Label"}]]',
                                    ),
                                    423 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 0,
                                        'id' => 424,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer  que l\'état de rapprochement est réalisé minimum chaque fin du mois ',
                                        'process_id' => 107,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "état de rapprochement non réalisé", "value": "Label"}]]',
                                    ),
                                    424 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 425,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que les démarches de régularisation des suspens ont été effectuées par l\'agence ',
                                        'process_id' => 107,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Aucune démarche entreprise", "value": "Label"}]]',
                                    ),
                                    425 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 0,
                                        'id' => 426,
                                        'major_fact_types' => NULL,
                                    'name' => 'S\'assurer du respect du plafond fixé (1000,00DA) ',
                                        'process_id' => 107,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "non respect du plafond autorisé ", "value": "Label"}]]',
                                    ),
                                    426 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 427,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer du respect des conditions de conservation et d\'utilisation des chèques CCP ',
                                        'process_id' => 107,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "condition de conservation non respectée", "value": "Label"}]]',
                                    ),
                                    427 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 428,
                                        'major_fact_types' => NULL,
                                        'name' => 'Vérifier si l\'agence procède régulièrement au virement du solde excédentaire à l\'effet d\'éviter le gel de trésorerie  ',
                                        'process_id' => 108,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Procédure non respectée ", "value": "Label"}]]',
                                    ),
                                    428 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 0,
                                        'id' => 429,
                                        'major_fact_types' => NULL,
                                        'name' => 'Vérifier que l\'état de rapprochement est réalisé minimum chaque fin du mois  ',
                                        'process_id' => 108,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "état de rapprochement non réalisé", "value": "Label"}]]',
                                    ),
                                    429 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 430,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que les mesures appropriées ont été prises pour la régularisation des écritures en suspens  ',
                                        'process_id' => 108,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Aucune démarche entreprise", "value": "Label"}]]',
                                    ),
                                    430 => 
                                    array (
                                        'fields' => '[[{"type": "number"}, {"label": "N° de compte bancaire"}, {"name": "bank_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "bank_account_number_id"}, {"placeholder": "Entrez le numéro de compte bancaire du client"}, {"help_text": "Veuillez entrer le numéro de compte bancaire du client, Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 0,
                                        'id' => 431,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que les virements trésors déstinés au réseau sont traités rapidement',
                                        'process_id' => 108,
                                        'scores' => '[[{"score": 1}, {"label": "Aucune anomlie"}], [{"score": 3}, {"label": "retrard dans le traitement"}]]',
                                    ),
                                    431 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 432,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer du respect des conditions de conservation et d\'utilisation des chèques Trésor  ',
                                        'process_id' => 108,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "condition de conservation non respectée", "value": "Label"}]]',
                                    ),
                                    432 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 433,
                                        'major_fact_types' => NULL,
                                        'name' => 'Vérifier que l\'état de rapprochement est établi chaque fin du mois  ',
                                        'process_id' => 109,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "état de rapprochement non réalisé", "value": "Label"}]]',
                                    ),
                                    433 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 434,
                                        'major_fact_types' => NULL,
                                        'name' => 'vérifier si l\'agence procède régulièrement au virement du solde excédentaire à l\'effet d\'éviter le gel de trésorerie',
                                        'process_id' => 109,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomlie", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "l\'agence ne procède pas  au virement de l\'excédent", "value": "Label"}]]',
                                    ),
                                    434 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 435,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer de la signature de la charte de sécurité pour l\'utilisateur du système DELTA',
                                        'process_id' => 110,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Charte non signée", "value": "Label"}]]',
                                    ),
                                    435 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte de l\'employé"}, {"name": "employee_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "employee_account_number_field"}, {"placeholder": "Entrez le numéro de compte de l\'employé"}, {"help_text": "Saisissez le numéro de compte de l\'employé tel qu\'il est attribué dans le système. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 436,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer du repect des conditions d\'octrois des avances sur appointement/salaire',
                                        'process_id' => 111,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "conditions non respectées", "value": "Label"}]]',
                                    ),
                                    436 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte de l\'employé"}, {"name": "employee_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "employee_account_number_field"}, {"placeholder": "Entrez le numéro de compte de l\'employé"}, {"help_text": "Saisissez le numéro de compte de l\'employé tel qu\'il est attribué dans le système. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 437,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que le compte d\'ordre 64/51 "avance sur appointement" est soldé chaque fin du mois ',
                                        'process_id' => 111,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "compte non soldé", "value": "Label"}]]',
                                    ),
                                    437 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte de l\'employé"}, {"name": "employee_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "employee_account_number_field"}, {"placeholder": "Entrez le numéro de compte de l\'employé"}, {"help_text": "Saisissez le numéro de compte de l\'employé tel qu\'il est attribué dans le système. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 438,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la règlementaion dans le cadre d\'une avance sur salaire ',
                                        'process_id' => 111,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "anomalies constatées", "value": "Label"}]]',
                                    ),
                                    438 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte de l\'employé"}, {"name": "employee_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "employee_account_number_field"}, {"placeholder": "Entrez le numéro de compte de l\'employé"}, {"help_text": "Saisissez le numéro de compte de l\'employé tel qu\'il est attribué dans le système. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 439,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer du suivi des remboursements des avances sur salaires  ',
                                        'process_id' => 111,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Avances non remboursées", "value": "Label"}]]',
                                    ),
                                    439 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 440,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que la DRH est saisie pour la désactivation du mot de passe ',
                                        'process_id' => 112,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "DRH non saisie", "value": "Label"}]]',
                                    ),
                                    440 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 441,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer de la régularité et l\'exhaustivité des documents exigés par la règlementaion ',
                                        'process_id' => 113,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                                    ),
                                    441 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "text"}, {"label": "Grade de l\'employé"}, {"name": "employee_grade"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_grade_field"}, {"placeholder": "Entrez le grade de l\'employé"}, {"help_text": "Saisissez le grade ou la fonction de l\'employé avec précision. Ce champ est important pour identifier l\'employé et déterminer son rôle. Si nécessaire, veuillez contacter le responsable des ressources humaines pour obtenir plus d\'informations sur le grade de l\'employé."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 442,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que la DRH est saisie pour la désactivation du mot de passe ',
                                        'process_id' => 113,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "DRH non saisie", "value": "Label"}]]',
                                    ),
                                    442 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "number"}, {"label": "N° de compte de l\'employé"}, {"name": "employee_account_number"}, {"length": "30"}, {"style": "col-12 col-lg-4"}, {"id": "employee_account_number_field"}, {"placeholder": "Entrez le numéro de compte de l\'employé"}, {"help_text": "Saisissez le numéro de compte de l\'employé tel qu\'il est attribué dans le système. Veuillez vérifier que vous avez saisi le numéro correctement, sans faute d\'orthographe ou d\'omission."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 443,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer du blocage de la paie ',
                                        'process_id' => 113,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Paie non bloquée", "value": "Label"}]]',
                                    ),
                                    443 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 444,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que les registres légaux sont côtés, paraphés, bien tenus et mis à jour',
                                        'process_id' => 114,
                                        'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "anomalies constatées"}]]',
                                    ),
                                    444 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Nom et prénom de l\'employé"}, {"name": "employee_name"}, {"length": "100"}, {"style": "col-12 col-lg-4"}, {"id": "employee_name_field"}, {"placeholder": "Entrez le nom et le prénom de l\'employé"}, {"help_text": "Saisissez le nom et le prénom de l\'employé avec précision et sans fautes d\'orthographe."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 0,
                                        'id' => 445,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que l\'agent souscripteur est titulaire de la carte professionnelle délivrée par L\'union des sociétés d\'assurance et de réassurance UAR ',
                                        'process_id' => 115,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Agent souscripteur non détenteur de la carte professionnelle UAR", "value": "Label"}]]',
                                    ),
                                    445 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 0,
                                        'id' => 446,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer qu\'une chemise appropriée est ouverte contenant les informations relatives à l\'dentification du contrat et de l\'assuré ainsi que les documents de base ayant servi à l\'élaboration de la police d\'assurance  ',
                                        'process_id' => 115,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "Des anomalies constatées", "value": "Label"}]]',
                                    ),
                                    446 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 0,
                                        'id' => 447,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer de l\'existence d\'une autorisation pour les adhésions qui dépassent le pouvoir agence ',
                                        'process_id' => 115,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Absence d\'autorisation", "value": "Label"}]]',
                                    ),
                                    447 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 448,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que la prime d\'assurance a été encaissée ',
                                        'process_id' => 115,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Prime non encaissée", "value": "Label"}]]',
                                    ),
                                    448 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 0,
                                        'id' => 449,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que les bulletins d\'adhésion et les contrats d\'assurance ont été acheminés à la DMC avec copie DRE chaque fin du mois ',
                                        'process_id' => 115,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 3, "value": "Note"}, {"label": "bulletins d\'adhesion non acheminés", "value": "Label"}]]',
                                    ),
                                    449 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 0,
                                        'id' => 450,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que le dossier de sinistre a été acheminé à la DMC dans les délais ',
                                        'process_id' => 115,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                                    ),
                                    450 => 
                                    array (
                                        'fields' => '[[{"type": "text"}, {"label": "Relation"}, {"name": "relation"}, {"length": "255"}, {"style": "col-12 col-lg-4"}, {"id": "relation_id"}, {"placeholder": "Entrez le nom de la relation"}, {"help_text": "Entrez le nom de la relation correctement, sans fautes d\'orthographe, pour une meilleure identification."}, {"rules": ["required"]}], [{"type": "textarea"}, {"label": "Constat"}, {"name": "Constat"}, {"length": "700"}, {"style": "col-12 col-lg-12"}, {"id": "constat_id"}, {"placeholder": "Faites un résumé des faits et des circonstances du constat"}, {"help_text": "Il est recommandé de suivre les étapes suivantes afin de mieux renseigner votre constat :  – Décrire les faits et les circonstances du constat de manière objective et détaillée. – Utiliser un vocabulaire clair et précis sans porter de jugements ou opinions personnelles ; – Inclure des informations sur les personnes impliquées ; – Signaler les dommages éventuels et toute autre information jugée utile."}, {"rules": ["required"]}]]',
                                        'has_major_fact' => 1,
                                        'id' => 451,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que le client remplis les conditions de ristourne ',
                                        'process_id' => 115,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées ", "value": "Label"}]]',
                                    ),
                                    451 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 452,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que tout incident  a été déclaré dans les délais',
                                        'process_id' => 116,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Incidents non déclarés ", "value": "Label"}]]',
                                    ),
                                    452 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 453,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer de la fonctionnalité des serrures et combinaisons des coffres forts, armoires, salles fortes ',
                                        'process_id' => 117,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Serrures et ou combinaisons déffectueuses", "value": "Label"}]]',
                                    ),
                                    453 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 454,
                                        'major_fact_types' => NULL,
                                    'name' => 'S\'assurer que le double des clés, code de la combinaison (armoires, coffres forts) sont transmis à la DRE ',
                                        'process_id' => 117,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Double des clés et ou code confidentiel non transmis à la DRE", "value": "Label"}]]',
                                    ),
                                    454 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 455,
                                        'major_fact_types' => NULL,
                                    'name' => 'S\'assurer de la séparation des tâches dans la détention des clés et combinaisons (armoires, coffres forts)',
                                        'process_id' => 117,
                                    'scores' => '[[{"score": 1}, {"label": "Aucune anomalie"}], [{"score": 4}, {"label": "Non respect de la séparation de détention (Clés, combinaisons)"}]]',
                                    ),
                                    455 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 456,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que les essais du système d\'alarme sont périodiques et que le système est fonctionnel avec le commissariat ainsi que l\'emplacement du déclencheur est adéquat',
                                        'process_id' => 117,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Essais non effectués ", "value": "Label"}]]',
                                    ),
                                    456 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 457,
                                        'major_fact_types' => NULL,
                                    'name' => 'S’assurer de la tenue du registre des essais et qu’il est annoté (visa) régulièrement par les services de sécurité avec lesquels l’agence est reliée.',
                                        'process_id' => 117,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Registre non présenté aux services de sécurités ", "value": "Label"}]]',
                                    ),
                                    457 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 458,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que les systèmes de télésurveillance, d\'anti-intrusion, détection d\'incendie sont fonctionnels, bien entretenus, et que toutes les pannes éventuelles sont signalées et réparées avec célérité',
                                        'process_id' => 117,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "systèmes non fonctionnel ", "value": "Label"}]]',
                                    ),
                                    458 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 459,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer de la relève des gardiens jour et nuit',
                                        'process_id' => 117,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Relève non assurée", "value": "Label"}]]',
                                    ),
                                    459 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 460,
                                        'major_fact_types' => NULL,
                                        'name' => 'Vérifier que les extincteurs sont situés dans des emplacements adéquats',
                                        'process_id' => 117,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "extincteur mal emplacé ", "value": "Label"}]]',
                                    ),
                                    460 => 
                                    array (
                                        'fields' => NULL,
                                        'has_major_fact' => 1,
                                        'id' => 461,
                                        'major_fact_types' => NULL,
                                        'name' => 'S\'assurer que les extincteurs sont en nombre suffisant, bien entretenus et vérifiés périodiquement',
                                        'process_id' => 117,
                                        'scores' => '[[{"score": 1, "value": "Note"}, {"label": "Aucune anomalie ", "value": "Label"}], [{"score": 4, "value": "Note"}, {"label": "Anomalies constatées", "value": "Label"}]]',
                                    ),
                                ));
        
        
    }
}