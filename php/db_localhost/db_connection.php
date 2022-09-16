<?php
    $conection_string = "mysql:host=".HOST.";dbname=".DB_NAME.";charset=UTF8";
    $connection =NULL;
    $options=[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $connection = new PDO(
            $conection_string,
            DB_USER,
            DB_PASSWORD,
            $options
        );
?>