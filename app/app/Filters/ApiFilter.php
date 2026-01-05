<?php
namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    protected $saveParms = [];
    protected $colomnMap = [];
    protected $operatorMap = [];

    public function transForm(Request $request)
    {
        $eloQuery = [];

        foreach ($this->saveParms as $parm => $operators) {
            $query = $request->query($parm);
            if (!isset($query)) {
                continue;
            }

            $column = $this->colomnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}
