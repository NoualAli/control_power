<?php

namespace App\Rules;

use App\Models\Structures\Dre;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CanBeControlled implements Rule
{
    private $type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $type = 1)
    {
        $this->type = $type;
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
        $result = $this->type == 1 ? auth()->user()->hasAgencies($value) : $this->canControlDre($value);
        return $result;
    }

    private function canControlDre($value)
    {
        $structureExist = DB::table('dre_control_campaign_has_structures AS dcchs')->select(['controller_structure_id', 'controlled_structure_id'])
            ->where('controller_structure_type', Dre::class)->where('controlled_structure_type', Dre::class)
            ->where('controller_structure_id', auth()->user()->dre->id)->where('controlled_structure_id', $value)->get()->count();
        return $structureExist;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Vous n\'avez pas accès aux agences sélectionnées.';
    }
}
