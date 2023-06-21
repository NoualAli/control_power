<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use App\Traits\HasDres;
use App\Traits\HasRoles;
use App\Traits\IsFilterable;
use App\Traits\IsSortable;
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
        IsSortable,
        IsSearchable,
        IsFilterable;

    protected $filter = 'App\Filters\User';

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
        'must_change_password'
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
        'must_change_password' => 'boolean',
    ];

    public $searchable = ['last_name', 'first_name', 'username', 'email', 'phone'];

    protected $appends = ['full_name', 'abbreviated_name', 'roles_str', 'dres_str', 'authorizations', 'permissions_arr'];

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
    public function getAbbreviatedNameAttribute()
    {
        return $this->first_name && $this->last_name ? substr(strtoupper($this->first_name), 0, 1) . '.' . strtoupper($this->last_name) : $this->full_name;
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
        if ($avatar) {
            return !str_contains($avatar, '/app/') ? '/app' . $avatar : $avatar;
        }
        return null;
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
        } elseif (hasRole('cc', $this)) {
            return $this->hasManyThrough(Mission::class, MissionDetail::class, 'assigned_to_cc_id');
        } elseif (hasRole(['da', 'dre'])) {
            return $this->hasManyDeepFromRelations($this->agencies(), (new Agency())->missions());
        }
    }

    public function campaigns()
    {
        if (hasRole(['dcp', 'cdcr'])) {
            return $this->hasMany(ControlCampaign::class, 'created_by_id');
        } elseif (hasRole(['ci', 'cc'])) {
            return ControlCampaign::whereIn('id', function ($query) {
                $query->select('control_campaigns.id')
                    ->from('control_campaigns')
                    ->join('missions', 'missions.control_campaign_id', '=', 'control_campaigns.id')
                    ->join('mission_has_controllers', 'mission_has_controllers.mission_id', '=', 'missions.id')
                    ->where('mission_has_controllers.user_id', '=', $this->id);
            })->groupBy('control_campaigns.id', 'control_campaigns.description', 'control_campaigns.start', 'control_campaigns.end', 'control_campaigns.reference', 'control_campaigns.created_by_id', 'control_campaigns.validated_by_id', 'control_campaigns.validated_at', 'control_campaigns.created_at', 'control_campaigns.updated_at', 'control_campaigns.deleted_at')->distinct();
        }
    }

    public function details()
    {
        if (hasRole('ci')) {
            return $this->hasManyDeep(MissionDetail::class, [MissionHasController::class, Mission::class]);
        } else if (hasRole('cc')) {
            return $this->hasMany(MissionDetail::class, 'assigned_to_cc_id');
        } elseif (hasRole('cdc')) {
            return $this->hasManyDeep(MissionDetail::class, [Mission::class], ['created_by_id']);
        } elseif (hasRole(['da', 'dre'])) {
            return $this->hasManyDeepFromRelations($this->agencies(), (new Agency())->details());
        }
    }

    // public function dispatchedDetails(){
    //     $details = $this->hasManyDeep(MissionDetail::class, [MissionHasController::class, Mission::class]);
    //     if (hasRole('ci')) {
    //         $details->where('')
    //     }else if(hasRole('cc')){

    //     }
    //     return $details;
    // }

    public function majorFacts()
    {
        if (hasRole(['ci', 'cc'])) {
            $majorFacts = $this->hasManyDeep(MissionDetail::class, [MissionHasController::class, Mission::class])->onlyMajorFacts();
        } elseif (hasRole('cdc')) {
            $majorFacts = $this->hasManyDeep(MissionDetail::class, [Mission::class], ['created_by_id'])->onlyMajorFacts();
        } elseif (hasRole(['da', 'dre'])) {
            $majorFacts = $this->hasManyDeepFromRelations($this->agencies(), (new Agency())->details())->onlyMajorFacts();
        }
        return $majorFacts;
    }
    public function regularization()
    {
        return $this->hasMany(User::class);
    }

    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    public function bugs()
    {
        return $this->hasMany(Bug::class, 'created_by_id', 'id');
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
    public function scopeCc(Builder $query)
    {
        return $this->user('cc');
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
    public function scopeCdcr(Builder $query)
    {
        return $this->user('cdcr');
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

    public function scopeWhereRoles(Builder $query, $roles)
    {
        return $query->whereHas('roles', function ($query) use ($roles) {
            return $query->whereIn('code', $roles);
        });
    }
}
