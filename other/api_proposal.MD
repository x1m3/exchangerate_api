The first decision I made is to use alphanumeric IDs based on ISO 4257 (https://en.wikipedia.org/wiki/ISO_4217). There is a 3 letters code for each currency. It gives more readability to the endpoints. 

Another approach would be using numeric IDs. This would give more flexibility to use custom currencies, like points earned 
under some condition that could used as money. Anyway, we could always create custom ids using alphanumericals if we define 
a superset of ISO 4257.

The second decision, that is relevant for the update endpoint is use a pivot or main currency. In this case this will be the Euro.
Any exchange rate will be defined based on the conversion from/to Euros, althouht the API will return exchange rates between 
other currencies if it is able to convert from to Euro. (Example. 1 EUR = 0.88 GBP. 1 EUR = 1.12 USD. Exchange rate from 
USD to GBP is 0.88 / 1.12. 

GET /exchangerate/{currency1}/{currency2}

This endpoint will return and exchange rate from currency1 to currency2. Returns a 200 code if succesful and an object with the exchange rate.

PUT /exchangerate{currency1}/{currency2}

Using method PUT we will be able to update the exchange rate between currency1 to currency2. One of the should be EUR, because we decided to use EUR as a pivot currency.

IF all runs OK we could get a 201 with the new value or a 204  (to be defined). Or other error code is something went wrong.

GET /exchangerate/{currency1}
Similar to first endpoint, but, in this case we will get a list of all the conversions from currency1 to others. This could be useful for listing or to avoid multiple calls.

PATCH /exchangerate/{currency1}
Similar to the second endpoint, this will be usefull to update multiple currencies at a time. In the body of the request we will submit a collection of exchangerates from currency1 to other. We could get as a response a 201 code and the list of objects updates or a 204 (to be defined). A patch action should be atomic, meaning that if something fails with one currency, none of them should be updated. 

Examples:

1) Add or update the exchange rate between EUR to USD
PUT /exchangerate/EUR/USD
Request Body : {"rate":1.12}
Response Body : {"id1":"EUR, "id2:"USD", "rate":1.12}

2) Get the exchange rate between EUR to USD
GET /exchangerate/EUR/USD
Status: 200
Response Body:{"id1":"EUR, "id2:"USD", "rate":1.12}

3) GET all the exchange rate from GBP (asuming we have more data than the ingested in point 1)
GET /exchangerate/GBP
Status: 200
Response body: [ {"id1":"GPB, "id2:"EUR", "rate":1.23}, {"id1":"GPB, "id2:"USD", "rate":1.23}, {"id1":"GPB, "id2:"ARS", "rate":1.23}, .... ]


4) Update to exchange rates from EUR to USD and GBP
PATCH /exchangerate/EUR
Request body: [ {"id1":"EUR, "id2:"USD", "rate":1.23}, {"id1":"EUR", "id2:"GBP", "rate":1.23}]
Response body: [ {"id1":"EUR, "id2:"USD", "rate":1.23}, {"id1":"EUR", "id2:"GBP", "rate":1.23}, ....] (the full collection)


