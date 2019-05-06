<?php

namespace ExchangeRate\services;


use ExchangeRate\model\Exchanger;
use ExchangeRate\repositories\ExchangeRepoInMemory;
use PHPUnit\Framework\TestCase;

class GetExchangeRateFromCommandTest extends TestCase
{
    private $command;

    public function setUP()
    {

        $repo = new Exchanger(new ExchangeRepoInMemory());
        try {
            $repo->addOrUpdateExchangeRate("EUR", "USD", 1.12);
            $repo->addOrUpdateExchangeRate("EUR", "GBP", 0.86);
            $repo->addOrUpdateExchangeRate("EUR", "ARS", 0.5);

        } catch (\Exception $e) {
            $this->fail("Error updating repo <" . $e->getMessage() . ">");
        }
        $this->command = new GetExchangeRateFromCommand($repo);
    }

    function provider()
    {
        return [
            ["EUR", [
                "USD" => 1.12,
                "GBP" => 0.86,
                "ARS" => 0.5,
            ]],
            ["USD", [
                "EUR" => 1/1.12,
                "GBP" => (1/1.12) * 0.86,
                "ARS" => (1/1.12) * 0.5,
            ]],
        ];
    }

    /**
     * @dataProvider provider
     */
    public function testCommand(string $currency, array $expected)
    {
        $rates = $this->command->run($currency);
        $this->assertEquals(count($expected), count($rates));

        foreach ($rates as $rate) {
            if (!in_array($rate->ID(), array_keys($expected))) {
                $this->fail("Expected currency with id <" . $rate->ID() . ">");
            }

            $this->assertEquals($expected[$rate->ID()], $rate->rate());
        }
    }
}
