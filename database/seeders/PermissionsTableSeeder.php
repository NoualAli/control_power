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
            DB::table('permissions')->insert([
                ['name' => 'Gérer les textes réglementaire', 'code' => 'manage_regulations', 'module_id' => 5],
                ['name' => 'Commenter une régularisation', 'code' => 'comment_regularization', 'module_id' => 6]
            ]);

            $roles = DB::table('roles')->whereIn('code', ['der', 'cder', 'cdc'])->get();

            foreach ($roles as $role) {
                $permissions = DB::table('permissions')->select('id')->whereIn('code', ['comment_regularization', 'reject_regularization'])->get();
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
