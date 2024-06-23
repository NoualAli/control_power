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
    const ATTACH = 'attach';
    const CONTROL = 'control';
    const CREATE = 'create';
    const DETACH = 'detach';
    const CREATE_VALIDATE = 'create_and_validate';
    const DELETE = 'delete';
    const UPDATE_PASSWORD = 'update_password';
    const UPDATE = 'update';
    const DISPATCH = 'dispatch';
    const EXPORT = 'export';
    const LOGIN = 'login';
    const LOGOUT = 'logout';
    const LOCK = 'lock';
    const RESET = 'reset';
    const UNLOCK = 'unlock';
    const VALIDATE = 'validate';
    const regularize = 'regularize';
}
