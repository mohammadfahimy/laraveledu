<?php

namespace App\Services\Payment;

use App\Services\Payment\Contracts\requestInterFaces;

class Payment{

    public const IDPAY_PROVIDER = 'idpayProvider';
    public $provider;
    public $request;


    public function __construct(string $provider,requestInterFaces $request)
    {
        $this->provider = $provider;
        $this->request = $request;
        
    }

    public function pay()
    {
        $provider = $this->findProvider();
        return $provider->pay();
    }

    public function verify()
    {
        $provider = $this->findProvider();
        return $provider->verify();
    }

    public function findProvider()
    {
        $className = 'App\Services\Payment\Providers\\'.$this->provider;
        if(!class_exists($className))
        {
            throw new \Exception('نوع پرداخت وجود ندارد');
        }
        return new $className($this->request);
    }



}