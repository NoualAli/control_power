<?php

namespace App\Models;

use App\Http\Controllers\Api\MissionController;
use App\Notifications\ResetPassword;
use App\Traits\HasDres;
use App\Traits\HasRoles;
use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Znck\Eloquent\Traits\BelongsToThrough;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable,
        HasFactory,
        HasRoles,
        HasDres,
        IsOrderable,
        IsSearchable;

    protected $perPage = 10;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'last_name',
        'first_name',
        'role_id',
        'dre_id',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public $with = ['roles', 'dres'];

    public $searchable = ['last_name', 'first_name', 'username', 'email', 'phone'];

    protected $appends = ['full_name', 'roles_str', 'dres_str', 'authorizations', 'permissions_arr'];

    /**
     * Getters
     */
    public function getAuthorizationsAttribute()
    {
        $authorizations = [];
        foreach ($this->permissions_arr as $permission) {
            $authorizations[$permission] = isAbleTo($permission);
        }
        return $authorizations;
    }

    public function getPermissionsArrAttribute()
    {
        return $this->roles->pluck('permissions')->flatten()->pluck('name')->toArray();
    }
    public function getFullNameAttribute()
    {
        return $this->first_name && $this->last_name ? ucfirst(strtolower($this->first_name)) . ' ' . ucfirst(strtolower($this->last_name)) : $this->username;
    }
    public function getUsernameAttribute($username)
    {
        return strtoupper($username);
    }

    public function getAvatarAttribute($avatar)
    {
        return $avatar;
    }

    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Relationships
     */
    public function plannings()
    {
        if ($this->role->code == 'ci') {
            return $this->hasMany(Planning::class, 'first_controller_id');
        } elseif ($this->role->code == 'cdc') {
            return $this->hasMany(Planning::class, 'created_by_id');
        }
    }

    public function missions()
    {
        if (hasRole('cdc')) {
            return $this->hasMany(Mission::class, 'created_by_id');
        } elseif (hasRole('ci')) {
            return $this->belongsToMany(Mission::class, 'mission_has_controllers', 'user_id');
        }
    }

    public function campaigns()
    {
        if (hasRole('dcp')) {
            return $this->hasMany(ControlCampaign::class, 'created_by_id');
        } elseif (hasRole('ci')) {
            return $this->hasManyThrough(ControlCampaign::class, Planning::class, 'first_controller_id');
        } elseif (hasRole('cdc')) {
            return $this->hasManyThrough(ControlCampaign::class, Planning::class, 'created_by_id');
        }
    }
    /**
     * Scopes
     */
    public function scopeDcp($query)
    {
        return $query->whereRelation('role', 'roles.code', 'dcp');
    }
}