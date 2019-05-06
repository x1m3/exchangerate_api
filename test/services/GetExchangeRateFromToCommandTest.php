<?php

namespace ExchangeRate\services;


use ExchangeRate\model\Exchanger;
use ExchangeRate\model\ExchangeRate;
use ExchangeRate\repositories\ExchangeRepoInMemory;
use PHPUnit\Framework\TestCase;

class GetExchangeRateFromToCommandTest extends TestCase
{
    private $command;

    public function setUP() {

        $repo = new Exchanger(new ExchangeRepoInMemory());
        try {
            $repo->addOrUpdateExchangeRate("EUR", "USD", 1.12);
            $repo->addOrUpdateExchangeRate("EUR", "GBP", 0.86);
            $repo->addOrUpdateExchangeRate("EUR", "ARS", 0.5);

        }
        catch (\Exception $e){
            $this->fail("Error updating repo <" . $e->getMessage() . ">" );
        }
        $this->command = new GetExchangeRateFromToCommand($repo);
    }

    public function provider() {
        return [
            ["EUR", "USD", 1.12],
            ["USD", "EUR", 1/1.12],
            ["EUR", "ARS", 0.5],
            ["ARS", "EUR", 1/0.5],
            ["EUR", "GBP", 0.86],
            ["GBP", "EUR", 1/0.86],
            ["USD","GBP", (1/1.12) * 0.86],
            ["GBP","USD", (1/0.86) * 1.12],
        ];
    }

    /**
     * @dataProvider provider
     */
    public function testCommand($currencyFrom, $currencyTo, $rate) {
        $exchange = $this->command->run($currencyFrom, $currencyTo);
        $this->assertNotNull($exchange);
        $this->assertEquals($currencyTo, $exchange->ID());
        $this->assertEquals($rate, $exchange->rate());
    }
}
