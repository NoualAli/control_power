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
            // Fetch newly created module id
            $structuresManagementModule = DB::table('modules')->select('id')->where('code', 'structures_management')->first()->id;
            // Update module id of existing permissions
            DB::table('permissions')
                ->whereIn('code', ['view_dre', 'create_dre', 'edit_dre', 'delete_dre', 'view_agency', 'create_agency', 'edit_agency', 'delete_agency', 'view_category', 'create_category', 'edit_category', 'delete_category'])
                ->update(['module_id' => $structuresManagementModule]);

            // Insert new permissions for regional inspection management
            DB::table('permissions')->insert([
                ['name' => 'Voir les inspections régionales', 'code' => 'view_regional_inspection', 'module_id' => $structuresManagementModule],
                ['name' => 'Créer les inspections régionales', 'code' => 'create_regional_inspection', 'module_id' => $structuresManagementModule],
                ['name' => 'Modifier les inspections régionales', 'code' => 'edit_regional_inspection', 'module_id' => $structuresManagementModule],
                ['name' => 'Supprimer les inspections régionales', 'code' => 'delete_regional_inspection', 'module_id' => $structuresManagementModule],
            ]);

            // Update root and admin roles to add new permissions
            $roles = DB::table('roles')->whereIn('code', ['root', 'admin'])->get();
            foreach ($roles as $role) {
                $permissions = DB::table('permissions')->select('id')->whereLike('code', '%regional_inspection%')->get();
                foreach ($permissions as $permission) {
                    DB::table('role_has_permissions')->insert([
                        'role_id' => $role->id,
                        'permission_id' => $permission->id
                    ]);
                }
            }
        });
    }
}