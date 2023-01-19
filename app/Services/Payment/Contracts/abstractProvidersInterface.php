<?php
namespace App\Services\Payment\Contracts;


abstract class abstractProvidersInterface
{
    protected $request;

    public function __construct(requestInterFaces $request)
    {
        $this->request = $request;
    }

}