<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<?php

require '../database.php';
include_once('funciones.php');

function get_ciclo()
{
    global $conexion;
    $sql="Select ciclo_actual from instituto";
    $result  = $conexion->query($sql);
    if( $result->num_rows)
    {
        return $result->fetch_assoc();
    }else{
        return false;
    }
}
function get_data($id)
{
    global $conexion;
    $sql="Select * from estudiantes WHERE codigoe = {$id}";
    $result  =$conexion->query($sql);
    if($result->num_rows)
    {
        return $result->fetch_assoc();
    }else{
        return false;
    }
}
session_start();
$datos = get_data($_SESSION['codigo_usuario']);
$ciclo_Actual = get_ciclo();

$result='';
error_reporting(0);

function run_query($id,$periodo)
{
    global $conexion ;
    $sql = "SELECT * FROM matricula INNER JOIN curso ON matricula.curso_id_curso = curso.id_curso WHERE estudiantes_id_estudiante= '{$id}' and periodo='{$periodo}';";
    return $conexion->query($sql);
    $result = run_query($datos['id_estudiante'],$ciclo_Actual['ciclo_actual']);
}
$result = run_query($datos['id_estudiante'],$ciclo_Actual['ciclo_actual']);
?>
</body>
</html>