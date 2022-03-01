<?php

class News
{
    private $createdAt;
    private $totalCommentsCount;

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getTotalCommentsCount(): int
    {
        return $this->totalCommentsCount;
    }
}

interface IPaymentMethod
{
    public function pay(float $sum, string $phoneNumber);
}

class QiwiPaymentMethod implements IPaymentMethod
{
    public function pay(float $sum, string $phoneNumber)
    {
        echo "Оплатить $sum через Qiwi. Отправить подтверждение на номер $phoneNumber" . PHP_EOL;
    }
}

class YandexPaymentMethod implements IPaymentMethod
{
    public function pay(float $sum, string $phoneNumber)
    {
        echo "Оплатить $sum через Yandex. Отправить подтверждение на номер $phoneNumber" . PHP_EOL;
    }
}

class WebMoneyPaymentMethod implements IPaymentMethod
{
    public function pay(float $sum, string $phoneNumber)
    {
        echo "Оплатить $sum через WebMoney. Отправить подтверждение на номер $phoneNumber" . PHP_EOL;
    }
}

class Order
{
    private $sum;
    private $phoneNumber;

    public function __construct($sum, $phoneNumber)
    {
        $this->sum = $sum;
        $this->phoneNumber = $phoneNumber;
    }

    public function payOrder(IPaymentMethod $paymentService)
    {
        $paymentService->pay($this->sum, $this->phoneNumber);
    }
}

$order = new Order(150, '89991237755');
$order->payOrder(new QiwiPaymentMethod());
$order->payOrder(new YandexPaymentMethod());
$order->payOrder(new WebMoneyPaymentMethod());