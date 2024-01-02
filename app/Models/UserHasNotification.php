<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasNotification extends Model
{
    use HasFactory;

    public $with = ['type'];

    public function type()
    {
        return $this->belongsTo(NotificationType::class, 'notification_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
