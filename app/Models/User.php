<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use App\Traits\HasDres;
use App\Traits\HasRoles;
use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

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
    public function missions()
    {
        if (hasRole('cdc')) {
            return $this->hasMany(Mission::class, 'created_by_id');
        } elseif (hasRole('ci')) {
            return $this->belongsToMany(Mission::class, 'mission_has_controllers');
        }
    }

    public function campaigns()
    {
        if (hasRole('dcp')) {
            return $this->hasMany(ControlCampaign::class, 'created_by_id');
        } elseif (hasRole('ci')) {
            return $this->hasManyDeepFromRelations($this->missions(), (new Mission())->campaign());
        }
    }
    public function details()
    {
        if (hasRole('ci')) {
            return $this->hasManyDeep(MissionDetail::class, ['mission_has_controllers', Mission::class]);
        } elseif (hasRole('cdc')) {
            return $this->hasManyDeep(MissionDetail::class, [Mission::class], ['created_by_id']);
        }
    }
    /**
     * Scopes
     */
    /**
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $code
     *
     * @return App\Models\User
     */
    public function scopeUser(Builder $query, string $code)
    {
        return $query->whereRelation('roles', 'roles.code', $code)->get();
    }
    /**
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return App\Models\User
     */
    public function scopeDcp(Builder $query)
    {
        return $this->user('dcp');
    }
    /**
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return App\Models\User
     */
    public function scopeRoot(Builder $query)
    {
        return $this->user('root');
    }
    /**
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return App\Models\User
     */
    public function scopeAdmin(Builder $query)
    {
        return $this->user('admin');
    }
    /**
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return App\Models\User
     */
    public function scopeDg(Builder $query)
    {
        return $this->user('dg');
    }
    /**
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return App\Models\User
     */
    public function scopeIg(Builder $query)
    {
        return $this->user('ig');
    }
    /**
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return App\Models\User
     */
    public function scopeCdc(Builder $query)
    {
        return $this->user('cdc');
    }
    /**
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return App\Models\User
     */
    public function scopeCi(Builder $query)
    {
        return $this->user('ci');
    }
    /**
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return App\Models\User
     */
    public function scopeCdr(Builder $query)
    {
        return $this->user('cdr');
    }
    /**
     * @param Illuminate\Database\Eloquent\Builder $query
     *
     * @return App\Models\User
     */
    public function scopeCdrcp(Builder $query)
    {
        return $this->user('cdrcp');
    }
}