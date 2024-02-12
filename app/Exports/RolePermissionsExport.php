<?php

namespace App\Exports;

use App\Enums\EventLogTypes;
use App\Models\EventLog;
use App\Models\Role;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;

class RolePermissionsExport extends BaseExport implements FromView, WithProperties, ShouldAutoSize
{

    /**
     * @var App\Models\Role
     */
    private $data;

    public function __construct(Role $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $permissions = $this->data->permissions;
        $role = $this->data;
        EventLog::store(['type' => EventLogTypes::EXPORT, 'attachable_type' => Role::class, 'attachable_id' => $role->id, 'payload' => ['content' => 'Liste des permissions du rôle ' . $role->full_name]]);
        return view('export.role_permissions', compact('permissions', 'role'));
    }

    /**
     * Set file properties
     *
     * @return array
     */
    public function properties(): array
    {
        return [
            'creator'        => env('APP_NAME'),
            'lastModifiedBy' => env('APP_NAME'),
            'title'          => 'Liste des rôles utilisateur',
            'description'    => 'Liste des rôles utilisateur ControlPower',
            'subject'        => 'Liste des rôles utilisateur',
            'keywords'       => 'roles,export,spreadsheet,excel',
            'category'       => 'Roles',
            'manager'        => 'Noual Ali - noualdev@gmail.com',
            'company'        => 'Banque Nationale d\'Algérie (BNA)',
        ];
    }
}
