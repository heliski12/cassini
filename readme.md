##Motionry Marketplace (cassini)##

###Requirements###
+  \>= php 5.4
+  composer (<http://getcomposer.org>)
+  php ext-imagick extension
+  php mcrypt extension
+  imagemagick executables
+  mysql

###Installation###
Install dependencies
    
    composer install
    
Update the autoloader

    composer dumpautoload

Make the app storage folders writable by your web server

    chmod 777 app/storage/*

Create a local database configuration and set local properties

    mkdir app/config/local
    cp app/config/database.php app/config/local/
    vi app/config/local/database.php

Initialize the laravel migration table

    php artisan migrate:install

Load the db schema
    
    php artisan migrate

