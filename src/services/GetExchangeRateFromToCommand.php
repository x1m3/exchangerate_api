<?php

namespace ExchangeRate\services;

use ExchangeRate\entities\ExchangeRate;
use ExchangeRate\model\ExchangeRateInterface;

class GetExchangeRateFromToCommand {
    private $exchanger;

    public function __construct(ExchangeRateInterface $repo) {
        $this->exchanger = $repo;
    }

    public function run(string $currencyFrom, $currencyTo): ExchangeRate{
        return $this->exchanger->getExchangeRateFromTo($currencyFrom, $currencyTo);
    }
}
