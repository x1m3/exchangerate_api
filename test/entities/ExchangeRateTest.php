<?php

namespace ExchangeRate\test;

use ExchangeRate\entities\ExchangeRate;
use PHPUnit\Framework\TestCase;

class ExchangeRateTest extends TestCase
{
    public function testItWorks()
    {
        $rate = new ExchangeRate("USD", 666);

        $this->assertEquals($rate->ID(),"USD");
        $this->assertEquals($rate->rate(),666);
    }
}
