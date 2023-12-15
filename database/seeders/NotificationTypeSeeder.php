<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            DB::table('notification_types')->delete();

            $groups = DB::table('notification_groups')->get();

            $groupControlCampaignId = $groups->where('code', 'control_campaigns')->pluck('id')->first();
            $groupMissionId = $groups->where('code', 'missions')->pluck('id')->first();

            DB::table('notification_types')->insert([
                [
                    'code' => 'control_campaign_created',
                    'label' => 'Création de la campagne de contrôle',
                    'notification_group_id' => $groupControlCampaignId,
                ],
                [
                    'code' => 'control_campaign_deleted',
                    'label' => 'Suppression de la campagne de contrôle',
                    'notification_group_id' => $groupControlCampaignId,
                ],
                [
                    'code' => 'control_campaign_updated',
                    'label' => 'Mise à jour de la campagne de contrôle',
                    'notification_group_id' => $groupControlCampaignId,
                ],
                [
                    'code' => 'mission_assigned',
                    'label' => 'Assignation d\'une mission',
                    'notification_group_id' => $groupMissionId,
                ],
                [
                    'code' => 'mission_updated',
                    'label' => 'Mise à jour d\'une mission',
                    'notification_group_id' => $groupMissionId,
                ],
                [
                    'code' => 'mission_validated',
                    'label' => 'Validation d\'une mission',
                    'notification_group_id' => $groupMissionId,
                ],
                [
                    'code' => 'mission_assignation_removed',
                    'label' => 'Mission retirer',
                    'notification_group_id' => $groupMissionId,
                ],
                [
                    'code' => 'mission_major_fact_detected',
                    'label' => 'Fait majeur déclencher',
                    'notification_group_id' => $groupMissionId,
                ],
                [
                    'code' => 'mission_major_fact_rejected',
                    'label' => 'Fait majeur rejeter',
                    'notification_group_id' => $groupMissionId,
                ],
                [
                    'code' => 'mission_pdf_repport_generated',
                    'label' => 'Rapport PDF générer',
                    'notification_group_id' => $groupMissionId,
                ],
            ]);
        });
    }
}
