<?php

namespace App\Models;

use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory, IsSearchable, IsOrderable;

    protected $fillable = [
        'name',
        'guard_name',
    ];

    public $timestamps = false;

    protected $perPage = 10;

    protected $searchable = ['name'];
    /**
     * Getters
     */
    public function getRolesStrAttribute()
    {
        $roles = implode(', ', $this->roles->pluck('name')->flatten()->toArray());
        return !empty($roles) ? $roles : '-';
    }

    /**
     * Relationships
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions');
    }
}