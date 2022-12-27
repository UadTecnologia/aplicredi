<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function returnQuery(array $query)
    {
        if ($query['status']) {
            return response()->json($query['data'], 200);
        }

        return response()->json($query, 400);
    }
}
