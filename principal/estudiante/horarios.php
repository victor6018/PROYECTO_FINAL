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

    $datos =get_data($_SESSION['codigo_usuario']);
    $ciclo_actual=get_ciclo();

    $result='';
    error_reporting(0);
    function rum_query ()
    {
        global $conexion;
        $sql="select dia,nombre_curso,ciclo_curso,aula,periodo,horainicial,horafinal from curso inner join horario ON curso.id_curso = horario.curso_id_curso inner join dia on dia.id_dia = horario.dia_id_dia WHERE ciclo_curso='{$_REQUEST['ciclo']}' order by dia_id_dia asc ";
        return $conexion->query($sql);  
    }

    $result = run_query();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <section id="datos_item2">
            <p>Nombres: <span><?php echo $datos['nombres'];?></span></p>
            <p>Apellidos: <span><?php echo $datos['ap_paterno']." ".$datos['ap_materno'];?></span></p>
            <p>Fecha de nacimiento: <span><?php echo $datos['fecha_nacimiento']?></span></p>
            <p>Codigo carrera: <span><?php echo $datos['carrera_alumno'] ?></span></p>
    </section>
</body>
</html>