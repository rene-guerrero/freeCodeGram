## freeCodeGram
A Laravel Instagram Clone

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing 
purposes. See deployment for notes on how to deploy the project on a live system.

## Prerequisites
* `php`: 7.3 or lastest,
* `Composer` 1.8.6 or lastest
* `Laravel` 1.5.6 or lastest
* `npm` 6.9.0 or lastest
* `Node.js` 10.16.0 or lastest

## Installing
Open Terminal / Command Prompt and type: 

    git clone https://github.com/rene-guerrero/freeCodeGram.git

Then change your directory to the project you have cloned and install deps with composer

    cd freeCodeGram
    composer install

Then rename the `.env.example` file to `.env` and run:

    php artisan key:generate

Inside new `.env` file find this database code:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=freecodegram
    DB_USERNAME=root
    DB_PASSWORD=

And replace all of it for:
    
    DB_CONNECTION=sqlite

Then create a `database.sqlite` file inside `./database` folder and run these command:

    php artisan migrate
    php artisan storage:link
    
To run the project, type:

    php artisan serve

Open your Browser and enter:

    http://127.0.0.1:8000

The app should be running on your browser.
