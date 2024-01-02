<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\HasUuid;
use App\Traits\IsFilterable;
use App\Traits\IsSearchable;
use App\Traits\IsSortable;

class Bug extends BaseModel
{
    use IsSearchable, IsSortable, IsFilterable, HasMedia, HasUuid;

    protected $fillable = [
        'reference',
        'type',
        'description',
        'created_by_id',
        'fixed_at',
        'priority',
    ];

    protected $searchable = ['reference'];

    protected $casts = [
        'type' => 'integer',
        'priority' => 'integer',
        'fixed_at' => 'datetime:d-m-Y',
        'created_at' => 'datetime:d-m-Y'
    ];

    protected const TYPES = [
        'Interface utilisateur (UI)',
        'Erreur d\'exécution',
        'Problèmes de logique',
        'Fuite de mémoire',
        'Bugs de compatibilité',
        'Bugs de performance',
        'Autre',
    ];

    protected const PRIORITIES = [
        'Normal',
        'Moyenne',
        'Urgente'
    ];

    public $appends = ['priority_html', 'state_html', 'media_links_list'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->reference = 'bt-' . str_pad(Bug::count() + 1, 4, 0, STR_PAD_LEFT);
        });
    }

    public function getStateHtmlAttribute()
    {
        $icon = 'las la-exclamation-triangle';
        $color = 'text-warning';
        $title = "En attente";
        if ($this->is_fixed) {
            $icon = 'las la-check-circle';
            $color = 'text-success';
            $title = "Résolut";
        }
        return "<i class='icon $icon $color' title='$title'></i>";
    }

    public function getTypeAttribute($type)
    {
        return self::TYPES[$type - 1];
    }

    public function getPriorityStrAttribute()
    {
        return self::PRIORITIES[$this->priority - 1];
    }

    public function getPriorityHtmlAttribute()
    {
        $priority = $this->priority;
        $priorityStr = $this->priority_str;

        switch ($priority) {
            case 1:
                $class = 'bg-success text-white';
                break;
            case 2:
                $class = 'bg-warning';
                break;
            case 3:
                $class = 'bg-danger text-white';
                break;
            default:
                $class = 'bg-grey text-dark';
                break;
        }
        return '<span class="container">' .
            '<span class="has-border-radius d-inline-block p-1 text-bold text-center ' . $class . '">' . $priorityStr . '</span>' .
            '</span>';
    }

    public function getIsFixedAttribute()
    {
        return (bool) $this->fixed_at;
    }

    /**
     * Relationships
     */

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
