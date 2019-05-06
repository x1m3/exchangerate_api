<?php

    require './../vendor/autoload.php';

    use ExchangeRate\services\Dummy;
    use phpDocumentor\Reflection\Location;

    $lala = new Location(333,666);

    echo "A dump of a very simple class located in vendor to see if configuration is ok<br />";

    var_export($lala);

    $dummy  = new Dummy();
    echo "<br />This is a random number. We are checking that autoloader works with our code<br />";
    echo $dummy->do();

