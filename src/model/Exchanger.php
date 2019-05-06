<?php

namespace ExchangeRate\model;

use ExchangeRate\entities\ExchangeRate;
use ExchangeRate\repositories\ExchangeRepoInterface;


class Exchanger implements ExchangeRateInterface
{
    private $repo;

    public function __construct(ExchangeRepoInterface $repo)
    {
        $this->repo = $repo;
    }

    public function addOrUpdateExchangeRate(string $currencyFrom, string $currencyTo, float $rate)
    {
        if ($currencyFrom == "EUR") {
            $this->repo->setEURTo($currencyTo, $rate);
            return;
        }
        if ($currencyTo == "EUR") {
            $this->repo->setEURTo($currencyFrom, 1 / $rate);
            return;
        }

        /*
        $rateEURToFrom = $this->getExchangeRateFromTo("EUR", $currencyFrom);
        if (isset($rateEURToFrom)) {
            $this->repo[$currencyTo] = new ExchangeRate($currencyTo, $rateEURToFrom->rate() * $rate);
            $this->repo->setEURTo()
            return;
        }

        $rateEURToTo = $this->getExchangeRateFromTo($currencyTo, "EUR");
        if (isset($rateEURToTo)) {
            $this->repo[$currencyTo] = new ExchangeRate($currencyTo, $rateEURToTo->rate() / $rate);
            return;
        }
        */
        throw new \Exception("Cannot update Exchange rate. One of the currencies must be EUR.");
    }

    public function getExchangeRatesFrom(string $currency): array
    {

        $exchanges = [];
        if ($currency == "EUR") {
            $exchanges = $this->repo->getAllFromEUR();
        } else {

            $euroToOthesExchange = $this->repo->getAllFromEUR();
            foreach ($euroToOthesExchange as $exchange) {
                if ($exchange->ID() === $currency) {
                    foreach ($euroToOthesExchange as $localExchange) {
                        if ($localExchange->ID() === $currency) {
                            $exchanges [] = new ExchangeRate("EUR", 1 / $localExchange->rate());
                        }
                    }
                }
            }
        }
        return $exchanges;
    }

    public function getExchangeRateFromTo(string $currencyFrom, string $currencyTo): ?ExchangeRate
    {
        if ($currencyFrom == $currencyTo) {
            return new ExchangeRate($currencyTo, 1.0);
        } elseif ($currencyFrom == "EUR") {
            return $this->repo->getFromEUR($currencyTo);
        } elseif ($currencyTo == "EUR") {
            $r1 = $this->repo->getFromEUR($currencyFrom);
            return new ExchangeRate($currencyTo, 1 / $r1->rate());
        }else {
            $r1 = $this->repo->getFromEUR($currencyFrom);
            $r2 = $this->repo->getFromEUR($currencyTo);
            if (is_null($r1) || is_null($r2)) {
                return NULL;
            }
            return new ExchangeRate($currencyTo, $r2->rate() / $r1->rate());
        }
    }
}