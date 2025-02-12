<?php

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'cms';

    $connect = mysqli_connect('localhost', 'root', '', 'cms');

    if(!$connect){
        echo("database connection error");
    }

?>