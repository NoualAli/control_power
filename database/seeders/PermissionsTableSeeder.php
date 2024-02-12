<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            DB::table('permissions')->whereLike('code', '%view_page%')->delete();
            DB::table('permissions')->whereLike('code', '%familly%')->delete();
            DB::table('permissions')->whereIn('code', ['view_modules', 'manage_modules'])->delete();

            DB::table('permissions')->insert([
                [
                    'name' => 'Créer les familles',
                    'code' => 'create_family',
                    'module_id' => 5,
                ],
                [
                    'name' => 'Modifier les familles',
                    'code' => 'edit_family',
                    'module_id' => 5,
                ],
                [
                    'name' => 'Voir les familles',
                    'code' => 'view_family',
                    'module_id' => 5,
                ],
                [
                    'name' => 'Supprimer les familles',
                    'code' => 'delete_family',
                    'module_id' => 5,
                ],
                [
                    'name' => 'Voir un module',
                    'code' => 'view_module',
                    'module_id' => 2,
                ],
                [
                    'name' => 'Gérer les modules',
                    'code' => 'manage_module',
                    'module_id' => 2,
                ],
                [
                    'name' => 'Rejeter les régularisations des anomalies',
                    'code' => 'reject_regularization',
                    'module_id' => 6,
                ],
                [
                    'name' => 'Valider les régularisations des anomalies',
                    'code' => 'validate_regularization',
                    'module_id' => 6,
                ]
            ]);

            $role = Role::where('code', 'ROOT')->first();

            $permissions = recursivelyToArray(DB::table('permissions')->whereIn('module_id', [2, 5])->get()->pluck('id'));
            $role->permissions()->attach($permissions);

            $roles = Role::whereNotIn('code', ['admin', 'root'])->get();
            $permissions = recursivelyToArray(DB::table('permissions')->whereIn('id', [20, 21, 16, 15])->get()->pluck('id'));
            foreach ($roles as $role) {
                $role->permissions()->detach($permissions);
            }

            $roles = Role::where('code', 'cdc')->get();
            foreach ($roles as $role) {
                $permissions = recursivelyToArray(DB::table('permissions')->whereIn('code', ['reject_regularization', 'validate_regularization'])->get()->pluck('id'));
                $role->permissions()->attach($permissions);
            }

            $derc = Role::create([
                'name' =>   'Contrôleur DER',
                'code' =>   'cder',
            ]);
            $permissions = recursivelyToArray(DB::table('permissions')->whereIn('code', ['view_control_campaign', 'view_mission', 'view_mission_detail', 'view_major_fact', 'view_dre_report'])->get()->pluck('id'));
            $derc->permissions()->attach($permissions);

            $roles = Role::where('code', 'da')->get();
            foreach ($roles as $role) {
                $permissions = recursivelyToArray(DB::table('permissions')->whereIn('code', ['view_major_fact'])->get()->pluck('id'));
                $role->permissions()->detach($permissions);
            }
        });
    }
}