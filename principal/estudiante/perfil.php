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
    <title>MI PERFIL</title>
    <link rel="stylesheet" href="css/estiloperfil.css">
</head>
<body>
   <?php
        $datos = get_data($_SESSION['codigo_usuario']);
        $sufijo = generar_sufijo($datos['sexo']);
        $cons = "select * from instituto where codigo = ";
   ?>
   <header id="cabecera_principal">
      <div id="mostar_nav"></div>
        <div id="item1">
           Bienvenido<?php echo $sufijo;
           ?>
       </div>
        <div class="etiqueta">
       <?php
            echo $datos['nombres'];
        ?>
       </div>
       <div id="item3">
           <a href="index.php">
               Inicio
           </a>
       </div>
   </header>
    <h1 class="title">Mi Perfil</h1>
    <div class="container">
        <div class="card">
        <img src="img/img1.jpg">
            <p><b>Nombres: </b><span><?php echo $datos['nombres'];?></span></p>
            <p><b>Apellidos: </b><span><?php echo $datos['ap_paterno']." ".$datos['ap_materno'];?></span></p>
            <p><b>Genero: </b><span><?php echo $datos['sexo']?></span></p>
            <p><b>Fecha de nacimiento: </b><span><?php echo $datos['fecha_nacimiento']?></span></p>
            <p><b>Correo:  </b><span><?php echo $datos['correo']?></span></p>
            <p><b>Teléfono: </b><span><?php echo $datos['telefono']?></span></p>
            <p><b>Ingresó: </b><span><?php echo $datos['semestre_ingreso']?></span></p>
            <p><b>Dirección: </b><span><?php echo $datos['dirección']?></span></p>
            <p><b>Colegio: </b><span><?php echo $datos['colegio']. " - ". $datos['tipo_colegio'] ?></span></p>
            <p><b>Carrera: </b><span><?php echo $datos['carrera_alumno'] ?></span></p>
            <a href="editar_perfil.php"><b>Editar Perfil</b></a>
        </div>
    </div>
</body>
</html>