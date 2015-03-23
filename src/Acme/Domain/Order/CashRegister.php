<?php

namespace Acme\Domain\Order;


interface CashRegister
{
    public function bill(array $products);
} 