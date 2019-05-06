<?php


namespace ExchangeRate\entities;

class ExchangeRate
{
    private $ID;
    private $rate;

    public function __construct(string $ID, float $rate)
    {
        $this->ID = $ID;
        $this->rate = $rate;
    }

    public function ID()
    {
        return $this->ID;
    }

    public function rate() {
        return $this->rate;
    }
}