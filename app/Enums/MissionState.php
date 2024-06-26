<?php

namespace App\Enums;

use Rexlabs\Enum\Enum;

/**
 * The MissionState enum.
 *
 * @method static self TODO()
 * @method static self ACTIVE()
 * @method static self PENDING_CDC_VALIDATION()
 * @method static self PENDING_CC_VALIDATION()
 * @method static self PENDING_CC_VALIDATION()
 * @method static self PENDING_CDCR_VALIDATION()
 * @method static self PENDING_DCP_VALIDATION()
 * @method static self PENDING_DA_VALIDATION()
 */
class MissionState extends Enum
{
    const TODO = 1;
    const ACTIVE = 2;
    const PENDING_CDC_VALIDATION = 3;
    const PENDING_CC_VALIDATION = 4;
    const PENDING_CDCR_VALIDATION = 5;
    const PENDING_DCP_VALIDATION = 6;
    const PENDING_DA_VALIDATION = 7;
    const DONE = 8;

    const TODO_STR = 'À réaliser';
    const ACTIVE_STR = 'En cours';
    const PENDING_CDC_VALIDATION_STR = 'En attente de validation CDC';
    const PENDING_CC_VALIDATION_STR = 'En attente de validation CC';
    const PENDING_CDCR_VALIDATION_STR = 'En attente de validation CDCR';
    const PENDING_DCP_VALIDATION_STR = 'En attente de validation DCP';
    const PENDING_DA_VALIDATION_STR = 'En attente de validation DA';
    const DONE_STR = 'Réalisée, validée et régularisée';
}
