<?php

namespace Modules\Demandas\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Demandas\Services\Demandas\Demandas;

class DemandasController extends Controller
{
    private $service;

    public function __construct(Demandas $service)
    {
        $this->service = $service;
    }

    public function setores()
    {
        return $this->returnQuery(
            $this->service->getSetores()
        );
    }

    public function assuntos(Request $request)
    {
        return $this->returnQuery(
            $this->service->getAssuntos($request->get('setor_id'))
        );
    }

    public function usuarios(Request $request)
    {
        return $this->returnQuery(
            $this->service->getUsuarios($request->get('setor_id'))
        );
    }
}
