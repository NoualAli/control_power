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
        DB::table('permissions')->whereLike('code', '%view_page%')->delete();
        DB::table('permissions')->whereLike('code', '%familly%')->delete();
        DB::table('permissions')->whereIn('code', ['view_modules', 'manage_modules'])->delete();

        DB::table('permissions')->insert([
            'name' => 'Créer les familles',
            'code' => 'create_family',
            'module_id' => 5,
        ]);
        DB::table('permissions')->insert([
            'name' => 'Modifier les familles',
            'code' => 'edit_family',
            'module_id' => 5,
        ]);
        DB::table('permissions')->insert([
            'name' => 'Voir les familles',
            'code' => 'view_family',
            'module_id' => 5,
        ]);
        DB::table('permissions')->insert([
            'name' => 'Supprimer les familles',
            'code' => 'delete_family',
            'module_id' => 5,
        ]);

        DB::table('permissions')->insert([
            'name' => 'Voir un module',
            'code' => 'view_module',
            'module_id' => 2,
        ]);
        DB::table('permissions')->insert([
            'name' => 'Gérer les modules',
            'code' => 'manage_module',
            'module_id' => 2,
        ]);

        $role = Role::where('code', 'ROOT')->first();

        $permissions = recursivelyToArray(DB::table('permissions')->whereIn('module_id', [2, 5])->get()->pluck('id'));
        $role->permissions()->attach($permissions);
    }
}
