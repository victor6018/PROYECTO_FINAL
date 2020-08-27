<?php
    require_once('cabecera.php');
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
            <p>Nombres: <span><?php echo $datos['nombres'];?></span></p>
            <p>Apellidos: <span><?php echo $datos['ap_paterno']." ".$datos['ap_materno'];?></span></p>
            <p>Genero: <span><?php echo $datos['sexo']?></span></p>
            <p>Fecha de nacimiento: <span><?php echo $datos['fecha_nacimiento']?></span></p>
            <p>Correo:  <span><?php echo $datos['correo']?></span></p>
            <p>Teléfono: <span><?php echo $datos['telefono']?></span></p>
            <p>Ingresó: <span><?php echo $datos['semestre_ingreso']?></span></p>
            <p>Dirección: <span><?php echo $datos['dirección']?></span></p>
            <p>Colegio: <span><?php echo $datos['colegio']. " - ". $datos['tipo_colegio'] ?></span></p>
            <p>Codigo carrera: <span><?php echo $datos['carrera_alumno'] ?></span></p>
            <a href="#">Editar Perfil</a>
        </div>
    </div>
</body>
</html>