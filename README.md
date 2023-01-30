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
    cd SaloodoTask
    composer install
    php artisan migrate
    php artisan db:seed //to get som dummy data on database .
    php artisan test //to see unit test result and every thing is okay 
    //now all backend is ready to use 
    run npm install
    //finally
    php artisan serve

## Endpoints and steps

login url : post used to log in for sender and biker return jwt token with user info and type`
http://127.0.0.1:8000/api/auth/login

    {
    "email": "sender@test.com",
    "password": "password"
    }

create parcel: post create parcel after sender login only sender can create it
http://127.0.0.1:8000/api/v1/parcels

    {
        "name": "Iphone 12 pro max",
        "pick_up_address": "aswan",
        "drop_off_address": "cairo", 
        "notes": "notes",
        "details": "details"
    }

create parcel: get show parcel the sender created return parcel info
http://127.0.0.1:8000/api/v1/senders/parcels

create parcel: get list of parcels the sender created return parcels paginated info
http://127.0.0.1:8000/api/v1/senders/parcels/{id}

biker login url : post used to log in for biker
http://127.0.0.1:8000/api/auth/login
        
    {
    "email": "biker@test.com",
    "password": "password"
    }

list parcel for pick: get method used to list parcels that senders created only biker can see that return parcels with senders info
http://127.0.0.1:8000/api/v1/bikers/parcels/pick

parcel for drop off: get method used to list parcels that senders created only biker can see that return parcels with senders info
http://127.0.0.1:8000/api/v1/bikers/parcels/drop-off

pick parcel: pick specific parcel that sender created
http://127.0.0.1:8000/api/v1/bikers/parcels/pick/{id} 

drop off parcel: drop off  specific parcel that sender created
http://127.0.0.1:8000/api/v1/bikers/parcels/pick/{id}

some screenshot for task 
api
![Screenshot from 2023-01-31 01-33-01.png](..%2F..%2F..%2F..%2Fhome%2Fmahmoudelhawy%2FPictures%2FScreenshot%20from%202023-01-31%2001-33-01.png)
![Screenshot from 2023-01-31 01-32-38.png](..%2F..%2F..%2F..%2Fhome%2Fmahmoudelhawy%2FPictures%2FScreenshot%20from%202023-01-31%2001-32-38.png)
![Screenshot from 2023-01-31 01-32-23.png](..%2F..%2F..%2F..%2Fhome%2Fmahmoudelhawy%2FPictures%2FScreenshot%20from%202023-01-31%2001-32-23.png)
![Screenshot from 2023-01-31 01-32-16.png](..%2F..%2F..%2F..%2Fhome%2Fmahmoudelhawy%2FPictures%2FScreenshot%20from%202023-01-31%2001-32-16.png)
![Screenshot from 2023-01-31 01-32-13.png](..%2F..%2F..%2F..%2Fhome%2Fmahmoudelhawy%2FPictures%2FScreenshot%20from%202023-01-31%2001-32-13.png)

web
![Screenshot from 2023-01-31 01-24-01.png](..%2F..%2F..%2F..%2Fhome%2Fmahmoudelhawy%2FPictures%2FScreenshot%20from%202023-01-31%2001-24-01.png)
![Screenshot from 2023-01-31 01-23-45.png](..%2F..%2F..%2F..%2Fhome%2Fmahmoudelhawy%2FPictures%2FScreenshot%20from%202023-01-31%2001-23-45.png)
![Screenshot from 2023-01-31 01-23-43.png](..%2F..%2F..%2F..%2Fhome%2Fmahmoudelhawy%2FPictures%2FScreenshot%20from%202023-01-31%2001-23-43.png)
![Screenshot from 2023-01-31 01-23-34.png](..%2F..%2F..%2F..%2Fhome%2Fmahmoudelhawy%2FPictures%2FScreenshot%20from%202023-01-31%2001-23-34.png)
