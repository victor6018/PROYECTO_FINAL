<?php

    $hn = 'localhost';
    $db = 'diariodb';
    $un = 'root';
    $pw = '';

    $basedatos = "gestion_academica";
	$conexion = mysqli_connect($hn, $un, $pw, $db);	
	if(mysqli_connect_errno()){
		echo "no se conecto al servidor";		
	}
	mysqli_set_charset($conexion,"UTF8");
	mysqli_select_db($conexion,$basedatos) or die ("no exisite base de datos");
?>