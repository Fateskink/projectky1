<?php
    require './configuration.php';
    $conection_string = "mysql:host=".HOST.";root=".DB_USER.";root_password=".DB_PASSWORD;
    $connection =NULL;
    $options=[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $connection = new PDO(
            $conection_string,
            DB_USER,
            DB_PASSWORD,
            $options
        );
    $sql = "CREATE DATABASE  IF NOT EXISTS projectNhom1;";

    $connection-> exec($sql);
    echo "Tao database Thanh Cong";
?>