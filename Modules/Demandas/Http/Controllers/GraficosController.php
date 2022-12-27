<?php

namespace Modules\Demandas\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Demandas\Services\Graficos\Graficos;

class GraficosController extends Controller
{
    private $service;

    public function __construct(Graficos $service)
    {
        $this->service = $service;
    }

    public function all()
    {
        return $this->returnQuery(
            $this->service->all()
        );
    }

    public function render(Request $request)
    {
        return $this->returnQuery(
            $this->service->render($request)
        );
    }
}
