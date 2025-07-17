<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "smoke";

    $connection = new mysqli($host, $user, $password, $db);

    if($connection -> connect_error){
        echo "Connection Error" . $connection -> connect_error;
        exit;
    }
?>