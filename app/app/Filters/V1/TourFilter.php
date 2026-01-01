<?php

namespace App\Filters\V1;

use App\Casts\PriceCast;
use App\Filters\ApiFilter;

class TourFilter extends ApiFilter
{
    protected $saveParms = [
        'travelId' => ['eq'],
        'name' => ['eq'],
        'status' => ['eq', 'ne'],
        'startingDate' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'endingDate' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'price' => ['eq', 'gt', 'lt', 'gte', 'lte'],
    ];
    protected $colomnMap = [
        'travelId' => 'travel_id',
        'startingDate' => 'starting_date',
        'endingDate' => 'ending_date',
    ];
    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '>',
        'lte' => '<=',
        'ne' => '!=',
    ];
}
