<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="css/estiloperfil.css">
</head>
<body>
    <?php
        require '../database.php';
        include_once('funciones.php');
        session_start();

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


        if($_SESSION['tipo_usuario'] != "estudiantes")
        {
            header('location:../../index.php');
        }
        $dato= get_data($_SESSION['codigo_usuario']);

        if(isset($_POST['telefono'] ) and isset($_POST['email']))
        {
            if($_POST and $_POST['password'] == $_POST['repassword'])
            {
                header('Location: perfil.php');
                $email = isset( $_POST['email'] ) ? $_POST['email'] : '';
                $id = $dato['codigoe'];
                $telefono = isset( $_POST['telefono'] ) ? $_POST['telefono'] : '';
                $password = isset( $_POST['password'] ) ? $_POST['password'] : '';

                update($id, $email, $telefono, $password);
                die();
            }else{
                echo "<br><br><br>Las contraseñas no coinciden !!!";
            }
        }
    ?>
    <?php
    $datos = get_data($_SESSION['codigo_usuario']);
    $sufijo = generar_sufijo($datos['sexo']);
    $cons = "select * from instituto where codigo = ";
?>
    <h1 class="title">EDITAR PERFIl</h1>
    <div class="container">
        <div class="card">
        <img src="img/img1.jpg">
        <form method="post">
            <p><b>Nombres: </b><span><?php echo $datos['nombres'];?></span></p>
            <p><b>Apellidos: </b><span><?php echo $datos['ap_paterno']." ".$datos['ap_materno'];?></span></p>
            <p><b>Genero: </b><span><?php echo $datos['sexo']?></span></p>
            <p><b>Codigo carrera: </b><span><?php echo $datos['carrera_alumno'] ?></span></p>
            <p><b>Correo:  </b><span><input type="text" value="<?php echo $datos['correo']?>" name="email"></span></p>
            <p><b>Teléfono: </b><span><input type="text" value="<?php echo $datos['telefono']?>" name="telefono"></span></p>
            <p><b>Contraseña: </b><span><input type="password" value="<?php echo $datos['password']?>" name="password"></span></p>
            <p><b>Confirma contraseña: </b><span><input type="password" value="<?php echo $datos['password']?>" name="repassword"></span></p>
            <input type="submit" value="modificar datos" id="boton_modificar">
        </form>
        </div>
    </div>
</body>
</html>