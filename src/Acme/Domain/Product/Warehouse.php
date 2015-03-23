<?php

namespace Acme\Domain\Product;


interface Warehouse
{
    public function getProducts($productsIds);
    public function removeProducts($productsIds);
} 