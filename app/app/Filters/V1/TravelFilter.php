<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class TravelFilter extends ApiFilter
{
    protected $saveParms = [
        'isPublic' => ['eq'],
        'name' => ['eq'],
        'type' => ['eq'],
        'numberOfDays' => ['eq', 'gt', 'lt'],
    ];
    protected $colomnMap = [
        'isPublic' => 'is_public',
        'numberOfDays' => 'number_of_days',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'gte' => '<=',
        'lt' => '>',
        'lte' => '>=',
    ];
}
