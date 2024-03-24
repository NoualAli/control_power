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
            // Fetch newly updated module id
            $structuresManagementModule = DB::table('modules')->select('id')->where('code', 'structures_management')->first()->id;

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

            // Fetch newly created roles
            $irs = DB::table('roles')->select('id')->whereIn('code', ['ir', 'iga'])->pluck('id')->toArray();

            // Fetch ig permissions
            $ig = DB::table('roles')->select('id')->where('code', 'ig')->first()->id;
            $igPermissions = DB::table('role_has_permissions')->select('permission_id')->where('role_id', $ig)->pluck('permission_id')->toArray();

            // Set same permissions to ir and iga as ig
            foreach ($irs as $ir) {
                foreach ($igPermissions as $permission) {
                    DB::table('role_has_permissions')->insert(['role_id' => $ir, 'permission_id' => $permission]);
                }
            }
        });
    }
}
