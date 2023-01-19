<?php

namespace App\Services\Payment\Request;

use App\Services\Payment\Contracts\requestInterFaces;

class idpayRequest implements requestInterFaces{

    private $amount;
    private $name;
    private $email;

    public function __construct(array $data) 
    {
        $this->amount = $data['amount'];
        $this->name = $data['name'];
        $this->email = $data['email'];
    }


    public function getAmount()
    {
        return $this->amount;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

}