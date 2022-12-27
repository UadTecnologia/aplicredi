<?php

namespace Modules\Demandas\Services\Demandas;

class Demandas
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway;
    }

    public function getAssuntos($setorId)
    {
        return [
            'data' => $this->gateway->getAssuntos($setorId),
            'status' => true,
        ];
    }

    public function getSetores()
    {
        return [
            'data' => $this->gateway->getSetores(),
            'status' => true,
        ];
    }

	public function getUsuarios($setorId)
	{
        return [
            'data' => $this->gateway->getUsuarios($setorId),
            'status' => true,
        ];
    }
}