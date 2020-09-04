<?php
    require '../database.php';
    include_once('funciones.php');
    session_start();

    $datos=get_data($_SESSION['codigo_usuario']);
    $sufijo=generar_sufijo($datos['sexo']);
    $cons="select * from instituto where codigo = ";
    
    if($_SESSION['tipo_usuario'] != "estudiantes")
    {
        header('location:../../index.php');
    }

    function get_data($id)
    {
        global $conexion;
        $sql="Select * from estudiantes WHERE codigoe = {$id}";
        $result  =$conexion->query($sql);

        if( $result->num_rows)
        {
            return $result->fetch_assoc();

        }else{
            return false; 

        }
    }

    function get_ciclo()
    {
        global $conexion;
        $sql="Select ciclo_actual from instituto";
        $result=$conexion->query($sql);
        if($result->num_rows)
        {
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }
    function matriculado($cod_curso, $id, $periodo)
    {
        global $conexion;
        $sql="SELECT * FROM matricula WHERE curso_id_curso = '{$cod_curso}' and estudiantes_id_estudiante ='{$id}' and periodo ='$periodo';";
        $result=$conexion->query($sql);
        if( $result->num_rows)
        {
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    $datos =get_data($_SESSION['codigo_usuario']);
    $ciclo_actual=get_ciclo();


    $result='';
    error_reporting(0);
    function rum_query ($id,$carrera)
    {
        global $conexion;
        $sql="SELECT * from estudiantes INNER JOIN curso ON estudiantes.ciclo = curso.ciclo_curso WHERE codigoe = '{$id}' and carrera_alumno = '{$carrera}';";
        return $conexion->query($sql);  
    }

    function matriculados($id, $periodo)
    {
        global $conexion ;
        $sql = "SELECT * FROM matricula INNER JOIN curso ON matricula.curso_id_curso = curso.id_curso WHERE estudiantes_id_estudiante= '{$id}' and periodo='{$periodo}';";
        return $conexion->query($sql);
    }

    $result = rum_query($_SESSION['codigo_usuario'],$datos['carrera_alumno'] );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
</body>
</html>