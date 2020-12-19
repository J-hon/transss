<?php

namespace App\Contracts;

interface PaymentGatewayContract
{

    public function initialize(array $params);

    public function getBanks();

    public function verifyTransaction(string $transactionId);

}
