<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ControlCampaignProcess extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'control_campaign_id',
        'process_id',
    ];

    public $timestamps = false;

    /**
     * Relationships
     */

    public function processes()
    {
        return $this->belongsTo(Process::class);
    }

    public function ControlCampaign()
    {
        return $this->belongsTo(ControlCampaign::class);
    }
}
