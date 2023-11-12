<?php
    $ServerName = "127.0.0.1";
    $Username = "root";
    $Password = 'Pa$$w0rd';
    $dbname = "TodoList";

    $conn = new mysqli($ServerName, $Username, $Password, $dbname);

    if($conn -> connect_error){
        die("Conexión fallida: " . $conn -> connect_error);
    }else{
        echo "Conexión establecida";
    }
?>