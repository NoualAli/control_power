<?php

namespace App\Rules;

use App\Models\Agency;
use App\Models\Dre;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UniqueUserRole implements Rule
{
    protected $role;

    protected $agency;

    protected $dre;

    protected $user;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($value = null, ?int $id = null)
    {
        if ($id) {
            $this->user = User::findOrFail($id);
        }
        if (request()->role == 11 && is_numeric($value)) {
            $this->agency = Agency::findOrFail($value);
        }
        if (in_array(request()->role, [13, 5])) {
            $this->dre = $this->user->dres->last();
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->role = Role::findOrFail($value);
        if (in_array($value, [2, 3, 4, 8, 9, 12, 14, 15, 16])) {
            $users = User::where('active_role_id', $value)->where('is_active', true);
            if ($this->user) {
                $users = $users->where('id', '!=', $this->user->id);
            }
            return !$users->count();
        } elseif ($value == 11) {
            // Vérifier qu'un seul directeur d'agence actif existe
            $users = User::whereRoles('da')->where('is_active', true)->whereHas('agencies', fn ($query) =>  $query->whereIn('agencies.id', [$this->agency->id]));
            if ($this->user) {
                $users = $users->where('id', '!=', $this->user->id);
            }
            return !$users->count();
        } elseif (in_array($value, [13, 5])) {
            // Vérifier qu'un seul chef de département de contrôle / dre actif existe
            $role = $value == 13 ? 'dre' : 'cdc';
            $users = User::whereRoles($role)->where('is_active', true)->whereHas('dres', fn ($query) =>  $query->whereIn('dres.id', [$this->dre->id]));
            if ($this->user) {
                $users = $users->where('id', '!=', $this->user->id);
            }
            return !$users->count();
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Un utilisateur actif avec le rôle ' . $this->role->name . ' existe déjà.';
    }
}
