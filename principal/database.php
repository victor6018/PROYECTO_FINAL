<?php

    $hn = 'localhost';
    $db = 'diariodb';
    $un = 'root';
    $pw = '';

    $conexion = new mysqli($hn, $un, $pw, $db);
    if ($conexion->connect_error) die ("Fatal error");
?>