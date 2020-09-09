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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTE</title>
    <link rel="stylesheet" type="text/css" href="css/estilo4.css">

</head>
<body>
    <div id="contenedor_ficha_matricula">
        <header id="titulo_matricula">
            <div id="nombre_instituto"><strong>ISTITUTO</strong>
            <br>
            Andahuaylas</div>
            <div id="fecha">Fecha:<?php
                echo date("d/m/y");
            ?></div>
            <div id="codigo_usuario"><?php
            echo "Usuario: ".$_SESSION['codigo_usuario'];
            ?>
            <input type="button" name="imprimir" value="print" onclick="window.print();return false">
            <br>Semestre: <span><?php echo $ciclo_Actual['ciclo_actual'];?></span>
            </div>
        </header>
        <section id="titulo_ficha_matricula">Avance académico </section>
        <header id="titulo_matricula">
            <div id="nombre_instituto"><strong>Carrera:</strong>
            <br>
            <br>
            <?php
            echo "<strong>Codigo: </strong>".$_SESSION['codigo_usuario'];
            ?>
            </div>
            <div id="fecha"></div>
            <div id="codigo_usuario">
            Nombre: <span><?php echo $datos['nombres']." ". $datos['ap_paterno']." ". $datos['ap_materno'];?>
            </span>
            <br>
            <br>
            <strong>Fecha:</strong><?php
                echo date("d/m/y");
                $creditos = 23;
            ?>
            </div>
        </header>
            <hr>
        <section id="curso_title">

            <div id="codigo_curso">Cod.</div>
            <div id="sec_curso">Creditos</div>
            <div id="nombre_curso">Nombre del curso</div>
            <div id="ciclo_curso">1ra Unidad</div>
            <div id="creditos_curso">2da Unidad</div>
            <div id="Vez_curso">3ra Unidad</div>
            <div id="final_curso">Prom Final</div>
        </section>
        <hr>
        
        <?php
                while($usuario = $result->fetch_assoc()){
                ?>
                
        <section id="curso_title">

            <div id="codigo_curso"><?php echo $usuario['id_curso'] ?></div>
            <div id="sec_curso"><?php echo $usuario['creditos'] ?></div>
            <div id="nombre_curso"><?php echo $usuario['Nombre_curso'] ?></div>
            <div id="ciclo_curso"><?php echo $usuario['promedio1'] ?></div>
            <div id="creditos_curso"><?php echo $usuario['promedio2']."<br>"?></div>
            <div id="Vez_curso"><?php echo $usuario['promedio3']."<br>"?></div>
            <div id="final_curso"><?php echo round(($usuario['promedio1'] + $usuario['promedio3'] + $usuario['promedio2'])/3);?></div>
        </section>
        
    <?php
                }
        ?>
        <hr>
        <br>
        <pre>Este documento carece de valor sin la firma del responsable académico.</pre>
        
        <div id="contenedor_firma">
            <div id="firmaestudiante">Firma Estudiante</div>
            <div id="firmaestudiante">Firma responsable</div>
        </div>
        
        
    </div>
</body>

</html>