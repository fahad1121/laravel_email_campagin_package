###INSTRUCTIONS to setup package with laravel project:

###NOTE: Package is developed n configured within laravel project for easy testing. 
        you can find package source code in package folder at root

SETUP:

- composer update/install
- setup env 
- install package: composer require composer require fahad/email-campaign:@dev
- run following commands: 
  - php artisan migrate:refresh,php artisan serve,  php artisan queue:work
- import api collection to test apis: I'm sharing postman collection in project root and customer table.
