<?php


namespace ExchangeRate\repositories;


use ExchangeRate\entities\ExchangeRate;

interface ExchangeRepoInterface
{
    public function setEURTo(string $currency, float $rate);
    public function getAllFromEUR() : array;
    public function getFromEUR(string $currency): ?ExchangeRate;
}