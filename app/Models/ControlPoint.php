<?php

namespace App\Models;

use App\Traits\IsFilterable;
use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Znck\Eloquent\Traits\BelongsToThrough;

class ControlPoint extends BaseModel
{
    use HasFactory, IsFilterable, BelongsToThrough, IsSearchable, IsSortable;

    protected $filter = 'App\Filters\PCF';

    protected $fillable = [
        'name',
        'process_id',
        'scores',
        'fields',
        'has_major_fact',
        'major_fact_types',
    ];

    public $timestamps = false;

    protected $perPage = 10;

    protected $searchable = ['name', 'domain.name', 'familly.name', 'process.name'];

    protected $appends = ['scores_str', 'major_fact_str'];

    public $casts = [
        'has_major_fact' => 'boolean',
        'scores' => 'object',
        'fields' => 'object',
    ];

    /**
     * Getters
     */

    public function getMajorFactStrAttribute()
    {
        return $this->has_major_fact ? 'Oui' : 'Non';
    }

    public function getScoresStrAttribute()
    {
        $scores = $this->scores;
        $scores_str = '';
        $containerStart = '<div class="d-flex justify-start align-center gap-2">';
        $containerEnd = '</div>';
        if (is_array($scores)) {
            foreach ($scores as $score) {
                $scores_str .= '<span class="tag"><b>' . $score[1]->label . ':</b> ' . $score[0]->score . '</span>';
            }
        }
        return $containerStart . $scores_str . $containerEnd;
    }

    public function getScoresArrAttribute()
    {
        $scores = $this->scores;
        $scores_arr = [];
        if (is_array($scores)) {
            foreach ($scores as $score) {
                $scores_arr[intval($score[0]->score)] = $score[1]->label;
            }
        }
        return $scores_arr;
    }

    /**
     * Relationships
     */
    public function familly()
    {
        return $this->belongsToThrough(Familly::class, [Domain::class, Process::class]);
    }
    public function process()
    {
        return $this->belongsTo(Process::class);
    }
    public function domain()
    {
        return $this->belongsToThrough(Domain::class, Process::class);
    }
}
