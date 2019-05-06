<?php


namespace ExchangeRate\repositories;


use ExchangeRate\entities\ExchangeRate;

class ExchangeRepoInMemory implements ExchangeRepoInterface
{
    private $exchangeFromEUR;

    public function __construct()
    {
        $this->exchangeFromEUR = [];
    }

    public function setEURTo(string $currency, float $rate)
    {
        $this->exchangeFromEUR[$currency] = new ExchangeRate($currency, $rate);
    }

    public function getAllFromEUR(): array
    {
        return $this->exchangeFromEUR;
    }

    public function getFromEUR(string $currency): ?ExchangeRate
    {
        if (isset($this->exchangeFromEUR[$currency])) {
            return $this->exchangeFromEUR[$currency];
        } else {
            return NULL;
        }
    }
}