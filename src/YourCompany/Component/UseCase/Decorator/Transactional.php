<?php

namespace YourCompany\UseCase\Decorator;

use YourCompany\Component\TransactionManager;

/**
 * purpose of the decorator is to wrap the use case to run it in as in transaction.
 * Example usage:
 *
 * $useCase = new MyUseCase();
 *
 * define as transactional
 *
 * $transactional = new Transactional($transactionManager);
 * $transactional->wrap($useCase);
 *
 * $transactional->myUseCaseMethod();
 *
 */
class Transactional
{
    private $transactionManager;

    private $useCase;

    public function __construct(TransactionManager $transactionManager)
    {
        $this->transactionManager = $transactionManager;
    }

    public function wrap($useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * treats all method calls as useCase calls and wraps them in transaction
     */
    public function __call($name, $arguments)
    {
        $this->transactionManager->begin();

        try {
            $result = call_user_func_array(array($this->useCase, $name), $arguments);
            $this->transactionManager->commit();
        } catch (\Exception $e) {
            $this->transactionManager->rollback();
            throw $e;
        }

        return $result;
    }
} 