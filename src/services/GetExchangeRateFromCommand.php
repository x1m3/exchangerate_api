<?php


namespace ExchangeRate\services;


use ExchangeRate\model\ExchangeRateInterface;

class GetExchangeRateFromCommand
{
    private $exchanger;

    public function __construct(ExchangeRateInterface $repo)
    {
        $this->exchanger = $repo;
    }

    public function run(string $currencyFrom): array
    {
        return $this->exchanger->getExchangeRatesFrom($currencyFrom);
    }
}

