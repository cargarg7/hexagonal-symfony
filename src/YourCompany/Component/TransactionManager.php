<?php

namespace YourCompany\Component;


interface TransactionManager
{
    public function begin();
    public function commit();
    public function rollback();
}
