<?php

//Si on se trouve dans la partie admin
if (file_exists('./src/php/db/db_pg_connect.php')) {
    require './src/php/db/db_pg_connect.php';
    require './src/php/classes/Autoloader.class.php';
    require('./src/php/utils/check_connection.php');
    Autoloader::register();
    $cnx = Connection::getInstance($dsn, $user, $password);
} elseif (file_exists('./admin/src/php/db/db_pg_connect.php')){
    //si on se trouve dans la partie publique
        require './admin/src/php/db/db_pg_connect.php';
        require './admin/src/php/classes/Autoloader.class.php';
        Autoloader::register();
        $cnx = Connection::getInstance($dsn, $user, $password);
    } elseif (file_exists('../admin/src/php/db/db_pg_connect.php')){
            require '../admin/src/php/db/db_pg_connect.php';
            require '../admin/src/php/classes/Autoloader.class.php';
            require('./src/php/utils/check_connection_tuteur.php');
            Autoloader::register();
            $cnx = Connection::getInstance($dsn, $user, $password);
}

