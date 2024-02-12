<?php

namespace App\Enums;

use GuzzleHttp\Promise\Create;
use Rexlabs\Enum\Enum;

/**
 * The EventLogTypes enum.
 *
 * @method static self Contain Event Log Types()
 */
class EventLogTypes extends Enum
{
    const CREATE = 'create';
    const CREATE_VALIDATE = 'create and validate';
    const UPDATE = 'update';
    const DELETE = 'delete';
    const LOGIN = 'login';
    const LOGOUT = 'logout';
    const LOCK = 'lock';
    const UNLOCK = 'unlock';
    const VALIDATE = 'validate';
    const ATTACH = 'attach';
    const DETACH = 'detach';
    const CONTROL = 'control';
    const EXPORT = 'EXPORT';
}
