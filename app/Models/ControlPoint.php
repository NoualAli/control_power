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

    protected $searchable = ['name', 'domain.name', 'family.name', 'process.name'];

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
        $containerStart = '<div class="tags gap-2 my-2 w-100">';
        $containerEnd = '</div>';
        if (is_array($scores)) {
            foreach ($scores as $score) {
                $tagType = '';
                switch ($score[0]->score) {
                    case 1:
                        $tagType = 'is-success';
                        break;
                    case 2:
                        $tagType = 'is-info';
                        break;
                    case 3:
                        $tagType = 'is-warning';
                        break;
                    case 4:
                        $tagType = 'is-danger';
                        break;
                    default:
                        $tagType = 'is-primary';
                        break;
                }
                $scores_str .= '<div class="tag ' . $tagType . '"><b>' . $score[1]->label . ':</b> ' . $score[0]->score . '</div>';
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

    public function getScoresArrNumAttribute()
    {
        $scores = $this->scores;
        $scores_arr = [];
        if (is_array($scores)) {
            foreach ($scores as $score) {
                array_push($scores_arr, intval($score[0]->score));
            }
        }
        return $scores_arr;
    }

    /**
     * Relationships
     */
    public function family()
    {
        return $this->belongsToThrough(Family::class, [Domain::class, Process::class]);
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
