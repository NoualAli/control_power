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
        'id',
        'username',
        'email',
        'password',
        'last_name',
        'first_name',
        'phone',
        'must_change_password',
        'active_role_id',
        'gender',
        'is_active',
        'registration_number',
        'active_post',
        'first_login_password',
        'is_notified',
        'is_for_testing',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        // 'must_change_password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'must_change_password' => 'boolean',
        'is_active' => 'boolean',
        'is_for_testing' => 'boolean',
        'gender' => 'integer',
    ];

    public $searchable = ['last_name', 'first_name', 'username', 'email', 'phone'];

    protected $appends = [
        'full_name',
        'abbreviated_name',
        'dres_str',
        'gender_str',
        'martial_status',
        'full_name_with_martial',
        'authorizations',
        'permissions_arr',
        'agencies_str',
        'is_for_testing_str'
    ];

    /**
     * Getters
     */
    public function getIsForTestingStrAttribute()
    {
        return $this->is_for_testing ? 'Oui' : 'Non';
    }

    public function getCreatedAtAttribute($created_at)
    {
        return \Carbon\Carbon::parse($created_at)->format('d-m-Y');
    }

    public function getGenderStrAttribute()
    {
        return $this->gender == 1 ? 'Homme' : 'Femme';
    }

    public function getMartialStatusAttribute()
    {
        return $this->gender == 1 ? 'Mr' : 'Mme';
    }

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
        return $this->roles->pluck('permissions')->flatten()->pluck('code')->toArray();
    }
    public function getAbbreviatedNameAttribute()
    {
        return $this->first_name && $this->last_name ? substr(strtoupper($this->first_name), 0, 1) . '.' . strtoupper($this->last_name) : $this->full_name;
    }
    public function getFullNameAttribute()
    {
        return $this->first_name && $this->last_name ? ucfirst(strtolower($this->first_name)) . ' ' . ucfirst(strtolower($this->last_name)) : $this->username;
    }

    public function getFullNameWithMartialAttribute()
    {
        return $this->full_name ? $this->martial_status . ' ' . $this->full_name : null;
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
        } elseif (hasRole('cc')) {
            return Mission::whereRelation('details', 'assigned_to_cc_id', $this->id)->distinct();
            return $this->hasManyThrough(Mission::class, MissionDetail::class, 'mission_details.assigned_to_cc_id', 'missions.id', 'users.id', 'mission_details.mission_id')->distinct('id');
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

    public function details(User $user = null)
    {
        try {
            if (hasRole('ci', $user)) {
                return $this->hasManyDeep(MissionDetail::class, [MissionHasController::class, Mission::class]);
            } else if (hasRole('cc', $user)) {
                return $this->hasMany(MissionDetail::class, 'assigned_to_cc_id');
            } elseif (hasRole('cdc', $user)) {
                return $this->hasManyDeep(MissionDetail::class, [Mission::class], ['created_by_id']);
            } elseif (hasRole(['da', 'dre'], $user)) {
                return $this->hasManyDeepFromRelations($this->agencies(), (new Agency())->details());
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

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

    public function last_login()
    {
        return $this->hasOne(Login::class)->orderBy('last_activity', 'DESC');
    }

    public function bugs()
    {
        return $this->hasMany(Bug::class, 'created_by_id', 'id');
    }

    public function notification_settings()
    {
        return $this->hasMany(UserHasNotification::class);
    }

    /**
     * Scopes
     */
    public function scopeWhereRoles(Builder $query, $roles)
    {
        return $query->whereHas('role', function ($query) use ($roles) {
            if (is_array($roles)) {
                return $query->whereIn('code', $roles);
            }
            return $query->where('code', $roles);
        });
    }

    public function scopeIsActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    public function scopeIsInactive(Builder $query)
    {
        return $query->where('is_active', false);
    }

    public function scopeIsForTesting(Builder $query)
    {
        return $query->where('is_for_testing', true);
    }
    public function scopeIsNotForTesting(Builder $query)
    {
        return $query->where('is_for_testing', false);
    }
}
