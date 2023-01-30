<p align="center">Saloodo!</p>

## About Saloodo Task

A private delivery project build using laravel framework and som page in vue js .

## requirements
    php 7.4
    mysql 
    appcache server
    SQLite for testing
## Laravel installations
    clone repository 
    create local database { call it ubex not mandatory but to follow .emv.example :( }
    copy .env, example with name .env add 
    chenge database config on .env DB_DATABASE, DB_USERNAME, DB_PASSWORD
    run the following commands
    cd ubex
    composer install
    php artisan migrate
    php artisan test //to see unit test result and every thing is okay
    php artisan db:seed //to get som dummy data on database .
## Endpoints
`list per week statistics : get`
http://127.0.0.1:8000/api/v1/shipments/statics?week=5&year=2020

    `query params => ['week', 'year'] `
`

`create shipment: post`
http://127.0.0.1:8000/api/v1/shipments/statics

    `request body =>
    {
        "number": "25654223880",
        "type": "DOC",
        "last_update": "2022-12-07T21:06:35.000000Z",
        "date_created": "2022-12-07T21:06:35.000000Z",
        "id": 28
    }`
`
