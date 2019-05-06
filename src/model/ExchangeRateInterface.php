<?php


namespace ExchangeRate\model;


use ExchangeRate\entities\ExchangeRate;

interface ExchangeRateInterface
{
    public function getExchangeRateFromTo(string $currencyFrom, string $currencyTo): ?ExchangeRate;
    public function getExchangeRatesFrom(string $currency):array;
    public function addOrUpdateExchangeRate(string $currencyFrom, string $currencyTo, float $rate);
}