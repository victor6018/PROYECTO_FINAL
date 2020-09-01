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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/estiloinicio.css">
</head>
<body>
<?php
    $datos = get_data($_SESSION['codigo_usuario']);
    $sufijo = generar_sufijo($datos['sexo']);
    $cons = "select * from instituto where codigo = ";
?>
    <div class="container">
        <h1>Bienvenido al instituto</h1>
        <div class="containerP">
            <p>Bienvenid<?php echo $sufijo;
            echo " ".$datos['nombres'];?> a nuestro sistema de gestion academica, en el que se incluye su información académica.</p>
            <p>Este sistema está a su disposición, esperamos que le permita accdeder de manera rápida y eficiente a la informacion que busca.</p>
        </div>
        <div class="card">
            <div class="circle">
                <h2>Perfil</h2>
            </div>
            <div class="content">
                <p>Ver, cambiar y 
                    administrar tu 
                    perfil</p>
                <a href="perfil.php">entrar</a>
            </div>
        </div>
        <div class="card">
            <div class="circle">
                <h2>Reportes</h2>
            </div>
            <div class="content">
                <p>Visuaizar, generar y administrar 
                    reportes</p>
                <a href="reporte.php">entrar</a>
            </div>
        </div>
        <div class="card">
            <div class="circle">
                <h2>Cursos</h2>
            </div>
            <div class="content">
                <p>Ver, cambiar y 
                    administrar tus
                    cursos</p>
                <a href="perfil.php">entrar</a>
            </div>
        </div>
        <div class="card">
            <div class="circle">
                <h2>Matricula</h2>
            </div>
            <div class="content">
                <p>Visuaizar el estado 
                    de tu matricula</p>
                <a href="perfil.php">entrar</a>
            </div>
        </div>
        <div class="card">
            <div class="circle">
                <h2>Horario</h2>
            </div>
            <div class="content">
                <p>Visuaizar el horario
                    de tus cursos favoritos</p>
                <a href="perfil.php">entrar</a>
            </div>
        </div>
    </div>
</body>
</html>