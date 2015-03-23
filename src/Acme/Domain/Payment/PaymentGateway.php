<?php

namespace Acme\Domain\Payment;


use Acme\Domain\Client;

interface PaymentGateway
{
    public function pay(Bill $bill, Client $client, Payment $payment);
} 