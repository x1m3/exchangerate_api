<?php

namespace ExchangeRate\services;

use ExchangeRate\entities\ExchangeRate;
use ExchangeRate\model\ExchangeRateInterface;

class GetExchangeRateFromToCommand {
    private $repo;

    public function __construct(ExchangeRateInterface $repo) {
        $this->repo = $repo;
    }

    public function run(string $currencyFrom, $currencyTo): ExchangeRate{
        return $this->repo->getExchangeRateFromTo($currencyFrom, $currencyTo);
    }
}
