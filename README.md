Eurognia Chat

Instrukce k sprovoznění:

1. composer install

2. cp env .env

3.  v .env si nastavit vaši database + vytvoření database

    database.default.hostname = localhost
    database.default.database = eurogniachat
    database.default.username = root
    database.default.password = 
    database.default.DBDriver = MySQLi

4. php spark migrate
5. php spark db:seed MainSeeder
6. php spark serve




Er Diagram a Navrh view mistností jsou doložené ve složce docs.

Spuštění testů: 
    -vendor/bin/phpunit
    -testy běží na sqlite3