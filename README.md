Dev Branch

0 - https://www.php.net/manual/en/mongodb.installation.pecl.php

1 - git clone -b dev --single-branch https://github.com/Moraes-Bruno/EstacionaPlus.git

2 - cd EstacionaPlus/root

3 - sudo cp .env.example .env
    3.1 - Fazer as alterações no arquivo .env

4 - composer install

5 - composer require jenssegers/mongodb

6 - sudo php artisan key:generate

7 - Alterar a api_key: resources/views/welcome.blade.php

8 - php artisan serve
