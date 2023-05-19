<?php

namespace App\Models;

use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, IsSearchable, IsSortable;

    protected $fillable = [
        'code',
        'name',
        'guard_name',
    ];

    public $timestamps = false;

    public $with = ['permissions'];

    protected $perPage = 10;

    protected $searchable = ['name', 'code'];

    protected $appends = ['permissions_str', 'full_name'];

    /**
     * Getters
     */
    public function getFullNameAttribute()
    {
        return $this->name . ' (' . $this->code . ')';
    }
    public function getPermissionsStrAttribute()
    {
        $permissions = $this->permissions->pluck('name')->flatten()->toArray();
        $permissions_str = '';
        foreach ($permissions as $permission) {
            $permissions_str .= '<span class="tag">' . $permission . '</span>';
        }
        return $permissions_str;
        // return !empty($permissions) ? $permissions : '-';
    }
    /**
     * Relationships
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
