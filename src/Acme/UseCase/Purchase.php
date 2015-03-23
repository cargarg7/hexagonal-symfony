<?php

namespace Acme\UseCase;

use Acme\Domain\Order\Order;
use Acme\Domain\Order\CashRegister;
use Acme\Domain\Client;
use Acme\Domain\Payment\Payment;
use Acme\Domain\Payment\PaymentGateway;
use Acme\Domain\Product\Warehouse;
use Acme\Domain\Shipment\ShipmentService;

/**
 * Use Case class is a place where domain classes are collaborating together
 * in order to realize some application functionality.
 *
 * Application would normally have multiple use cases defined.
 * Use cases are infrastructure and framework agnostic. In other words,
 * each of the use case should be possible to use in the other
 * framework and/or infrastructure context
 * without changing a line of code to adjust to the other context.
 */
class Purchase
{

    /**
     * @var Warehouse
     */
    private $warehouse;

    /**
     * @var CashRegister
     */
    private $cashRegister;

    /**
     * @var PaymentGateway
     */
    private $paymentGateway;

    /**
     * @var ShipmentService
     */
    private $shipmentService;

    public function purchase(Order $order, Client $client, Payment $payment)
    {
        $products = $this->warehouse->getProducts($order->getProductsIds());

        // client is billed for products from the order
        $bill = $this->cashRegister->bill($products, $order->getDiscounts());

        // pays the bill using preferred payment method
        $this->paymentGateway->pay($bill, $client, $payment);

        // the products are removed from the warehouse
        $this->warehouse->removeProducts($order->getProductsIds());

        // and shipped to the client
        $this->shipmentService->ship($products, $client);
    }
}
