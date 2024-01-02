<?php

namespace Database\Seeders;

use App\Models\ControlPoint;
use App\Models\Field;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use stdClass;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $controlPoints = DB::table('control_points', 'cp')->whereNotNull('fields')->get();
            $fields = collect([]);
            foreach ($controlPoints as $cp) {
                $items = json_decode($cp->fields);
                if ($items) {
                    foreach ($items as $item) {
                        $row = new stdClass;
                        foreach (flattenArray(collect($item)) as $key => $value) {
                            $row->$key = $value;
                        }
                        $row->cp_id = $cp->id;
                        $row->existing_fields = $cp->fields;
                        $fields->push($row);
                    }
                }
            }

            foreach ($fields as $field) {
                if (!is_null($field->existing_fields)) {
                    if (!is_array($field->style)) {
                        $columns = preg_match('/col.*lg.*?(\d+)/', $field->style, $matches) ? $matches[1] : 12;
                        $createdField = Field::firstOrCreate([
                            'type' => $field->type,
                            'name' => $field->name,
                            'label' => $field->label,
                            'max_length' => $field->length,
                            'placeholder' => $field->placeholder,
                            'required' => in_array('required', $field->rules),
                            'distinct' => in_array('distinct', $field->rules),
                            'is_integer_or_float' => $field->type == 'number',
                            'columns' => (int) $columns,
                        ]);
                        DB::table('has_fields')->insert([
                            'attachable_id' => $field->cp_id,
                            'attachable_type' => ControlPoint::class,
                            'field_id' => $createdField->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
            Schema::table('control_points', function (Blueprint $table) {
                $table->dropColumn('fields');
            });

            $module = DB::table('modules')->where('code', 'pcf_management')->first();

            DB::table('permissions')->updateOrInsert([
                'code' => 'create_field',
                'name' => 'Créer un champ (metadata)',
                'module_id' => $module->id,
            ]);

            DB::table('permissions')->updateOrInsert([
                'code' => 'edit_field',
                'name' => 'Modifier un champ (metadata)',
                'module_id' => $module->id,
            ]);

            DB::table('permissions')->updateOrInsert([
                'code' => 'view_field',
                'name' => 'Voir les champs (metadata)',
                'module_id' => $module->id,
            ]);
            $role = Role::where('code', 'ROOT')->first();

            $permissions = recursivelyToArray(DB::table('permissions')->where('module_id', $module->id)->get()->pluck('id'));
            $role->permissions()->attach($permissions);
        });
    }
}
