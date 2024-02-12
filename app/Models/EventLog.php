<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventLog extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'type',
        'user_id',
        'user_full_name',
        'attachable_type',
        'attachable_id',
        'payload'
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

    /**
     * Insert new entry in events_log table and return uuid if inserted else false
     *
     * @param array $params
     *
     * @return string|false
     */
    public static function store(array $params)
    {
        // Extraction des paramètres
        $type = $params['type'];
        $user_full_name = isset($params['user_full_name']) && !empty($params['user_full_name']) ? $params['user_full_name'] : null;
        $attachable_id = isset($params['attachable_id']) && !empty($params['attachable_id']) ? $params['attachable_id'] : null;
        $attachable_type = isset($params['attachable_type']) && !empty($params['attachable_type']) ? $params['attachable_type'] : null;
        $payload = isset($params['payload']) && !empty($params['payload']) ? $params['payload'] : null;
        // Traitement du payload si présent
        if ($payload && !empty($payload)) {
            $payload = json_encode($payload);
        }

        $user_id = auth()->user()?->id;
        if (!$user_full_name && $user_id) {
            $user_full_name = normalizeFullName(getUserFullNameWithRole($user_id));
        }

        $uuid = Str::uuid();

        $result = DB::table('event_logs')->insert([
            'uuid' => $uuid,
            'type' => $type,
            'user_full_name' => $user_full_name,
            'user_id' => $user_id,
            'attachable_id' => $attachable_id,
            'attachable_type' => $attachable_type,
            'payload' => $payload,
        ]);

        return $result ? $uuid : false;
    }
}
