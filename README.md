# exchangerate_api

This code is not finished or usable yet. There is no controller. Just php code with logic and some tests. 

To implement a real API we should create some controllers that matches the desired HTTP verbs and endpoints with a call to each
of the commands we found in /src/services.

The code is framework agnostic. We could use a symfony or laravel to define the routes, the dependency injection, etc..

There are 2 small test in /test than can help us to understand how to use it in a controller.

We should implement a persistence repository for the data. Right now, there is only a memory implementation. To create a database version,
simply create a new repo that implements ExchangeRepoInterface, as I did in https://github.com/x1m3/exchangerate_api/blob/master/src/repositories/ExchangeRepoInMemory.php


To run the tests, first do a 
```
composer install
```


Then run
```
php vendor\phpunit\phpunit\phpunit 
```
if running php in local. 


You could also use the dockers provided. I didn't used it, sorry for including. Just copied from a standar template I usually use for php.
