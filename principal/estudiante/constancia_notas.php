<?php
    require '../database.php';
    include_once('funciones.php');

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

    function get_data($id)
    {
        global $conexion;
        $sql="Select * from estudiantes WHERE codigoe =($id)";
        $result=$conexion->query($sql);
        if( $result->num_rows)
        {
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }
    session_start();
    $datos =get_data($_SESSION['codigo_usuario']);
    $ciclo_actual=get_ciclo();


    $result='';
    error_reporting(0);
    function rum_query ($id,$periodo)
    {
        global $conexion;
        $sql="Select * from matricula INNER JOIN curso ON matricula.curso_id_curso=curso.id_curso WHERE estudiantes_id_estudiante='{$id}' and periodo='{$periodo}';";
        return $conexion->query($sql);  
    }

    $result = rum_query($datos['id_estudiante'],$ciclo_actual['ciclo_actual']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTES</title>
    <link rel="stylesheet" type="text/css" href="css/estilo4.css">
</head>
<body>
    <div id="contenedor_ficha_matricula">
        <header id="titulo_matricula">
            <div id="nombre_instituto"><strong>Istepsa</strong>
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
        <section id="titulo_ficha_matricula">Constancia de Notas </section>
        <header id="titulo_matricula">
            <div id="nombre_instituto"><strong>Carrera:</strong>contabilidad
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
            <div id="sec_curso">Secc.</div>
            <div id="nombre_curso">Nombre del curso</div>
            <div id="ciclo_curso">Cred.</div>
            
            <div id="ciclo_curso">Vez</div>
            <div id="ciclo_curso">ciclo</div>
            <div id="final_curso">Prom Final</div>
        </section>
        <hr>
        
        <?php
                while($usuario = $result->fetch_assoc()){
                ?>
                
        <section id="curso_title">

            <div id="codigo_curso"><?php echo $usuario['id_curso'] ?></div>
            <div id="sec_curso">A</div>
            <div id="nombre_curso"><?php echo $usuario['Nombre_curso'] ?></div>
            <div id="ciclo_curso"><?php echo $usuario['creditos'] ?></div>
            <div id="ciclo_curso">1</div>
            <div id="ciclo_curso"><?php echo $usuario['ciclo_curso'] ?></div>
            <div id="final_curso"><?php echo round(($usuario['promedio1'] + $usuario['promedio3'] +  $usuario['promedio2'])/3);?></div>
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
        <div>
    </div>
</body>
</html>