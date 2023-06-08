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
        'fixed_at' => 'datetime:d-m-Y'
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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->reference = 'bt-' . str_pad(Bug::count() + 1, 4, 0, STR_PAD_LEFT);
        });
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
        return '<div class="container">' .
            '<div class="has-border-radius d-inline-block p-1 text-bold text-center ' . $class . '">' . $priorityStr . '</div>' .
            '</div>';
    }

    public function getIsFixedAttribute()
    {
        return !$this->fixed_at ? 'En attente' : 'Fixé';
    }

    /**
     * Relationships
     */

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
