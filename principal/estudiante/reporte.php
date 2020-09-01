<?php
    require '../database.php';
    include_once('funciones.php');
    session_start();

    if($_SESSION['tipo_usuario'] != "estudiantes"){
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
        $result  = $conexion->query($sql);
        if( $result->num_rows)
        {
            return $result->fetch_assoc();
        }else{
            return false; 
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
</head>
<body>
<?php
    $datos = get_data($_SESSION['codigo_usuario']);
    $sufijo = generar_sufijo($datos['sexo']);
    $cons = "select * from instituto where codigo = ";
    $ciclo_Actual = get_ciclo()
?>
    <div>
        <div>
            <p>Nombres: <span><?php echo $datos['nombres'];?></span></p>
            <p>Apellidos: <span><?php echo $datos['ap_paterno']." ".$datos['ap_materno'];?></span></p>
            <p>Semestre: <span><?php echo $ciclo_Actual['ciclo_actual'];?></span></p>
        </div>
    </div>
    <div>
        <div>
        <p>Generar</p>
             <p><a href="ficha_matricula.php" target="_blank">Ficha de matricula</a></p>
             <p><a href="avance_academico.php" target="_blank">Avance Académico</a></p>
             <p><a href="constancia_notas.php" target="_blank">Constancia de notas</a></p>
             <p><a href="Cursos_lista.php" target="_blank">Cursos </a></p>
        </div>
    </div>
</body>
</html>