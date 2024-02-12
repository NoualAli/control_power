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

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($mission = null)
    {
        $this->mission = $mission;
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
            $missions = DB::table('missions as m')->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')->whereNull('m.deleted_at');

            if ($this->mission) {
                $missions = $missions->where('m.id', '!=', $this->mission->id);
            }
            // dd($missions->count(), $missions->get());
            $missions = $missions->where(fn ($query) => $query->where('m.assigned_to_ci_id', $value)->orWhere('mhc.user_id', $value))->get()->filter(function ($item) {
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
        $mission = $this->totalMissions > 1 ? ' missions' : ' mission';
        return normalizeFullName(getUserFullNameWithRole($this->controllerId)) . ' a déjà ' . $this->totalMissions . $mission . ' dans cette plage de date';
    }
}