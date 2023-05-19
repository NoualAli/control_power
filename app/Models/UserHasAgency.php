<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class UserHasAgency extends BaseModel
{
    // Define the table name and primary key
    protected $table = 'user_has_agencies';
    protected $primaryKey = ['user_id', 'agency_id'];

    // Define the many-to-one relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the many-to-one relationship with Agency
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
