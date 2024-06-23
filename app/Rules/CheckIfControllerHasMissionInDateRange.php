<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CheckIfControllerHasMissionInDateRange implements Rule
{
    private $totalMissions;
    private $controllerId;
    private $mission;
    private $alias;
    private $prefix;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($mission = null, int $type = 1)
    {
        $this->mission = $mission;
        $this->alias = $type == 2 ? 'dm' : 'm';
        $this->prefix = $type == 2 ? 'dre_' : '';
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
        $this->controllerId = $value;
        if ($value) {

            $missions = DB::table($this->prefix . 'missions as ' . $this->alias)
                ->leftJoin($this->prefix . 'mission_has_controllers as ' . $this->alias . 'hc', $this->alias . 'hc.' . $this->prefix . 'mission_id', $this->alias . '.id');

            if ($this->mission) {
                $missions = $missions->where($this->alias . '.id', '!=', $this->mission->id);
            }
            $missions = $missions->where(fn ($query) => $query->where($this->alias . '.assigned_to_ci_id', $value)->orWhere($this->alias . 'hc.user_id', $value))->get()->filter(function ($item) {
                $endDate = $item->programmed_end;
                $startDate = Carbon::parse($item->programmed_start)->format('d-m-Y');
                if ($item->real_end) {
                    $endDate = $item->real_end;
                }
                $endDate = Carbon::parse($endDate)->format('d-m-Y');
                if (request('programmed_start') && request('programmed_end')) {
                    return Carbon::parse($startDate)->betweenIncluded(request('programmed_start'), request('programmed_end')) || Carbon::parse($endDate)->betweenIncluded(request('programmed_start'), request('programmed_end'));
                }
                return false;
            });

            $this->totalMissions = $missions->count();
            return !$this->totalMissions;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // $mission = $this->totalMissions > 1 ? ' missions' : ' mission';
        return normalizeFullName(getUserFullNameWithRole($this->controllerId)) . ' a déjà une mission dans cette plage de date';
    }
}
