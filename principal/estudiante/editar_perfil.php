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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="css/estiloperfileiditar.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../materialize/css/materialize.min.css">
</head>
<body>

<?php
    $datos = get_data($_SESSION['codigo_usuario']);
    $sufijo = generar_sufijo($datos['sexo']);
    $cons = "select * from instituto where codigo = ";
?>
    <nav class="nav-extended blue">
        <div class="nav-wrapper">
            <a class="brand-logo">
                <p>Bienvenido al 
                Instituto</p>
            </a>
            <ul class="right hide-on-med-and-down">
                <li><a href="">sobre nosotros</a></li>
                <li><a href="">contactanos</a></li>
                <li><a href="cerrar_session.php">cerrar secion</a></li>
            </ul>
        </div>
        <div class="nav-content">
        <span class="nav-title"><p></p></span>
        <a href="index.php" class="btn-floating red btn-large halfway-fab ">
            <i class="material-icons">home</i>
        </a>
        </div>
    </nav>
    <h2 class="text1">Editar Perfil</h2>
    <div class="container1">
        <div  class="card">
            <div class="header">
                <div class="main">
                    <div class="image">
                        <div class="hover">
                            <i class="fas fa-camera fa-2x"></i>
                        </div>
                    </div>
                    <h3 class="name"><p><span><?php echo $datos['nombres'];?></span></p></h3>
                    <h3 class="name"><p><span><?php echo $datos['ap_paterno']." ".$datos['ap_materno'];?></span></p></h3>
                </div>
            </div>
            <div class="content">
                <div class="left">
                    <div class="about-container">
                        <form method="post">
                            <p class="text"><b>Genero: </b><span><?php echo $datos['sexo']?></span></p>
                            <p class="text"><b>Codigo carrera: </b><span><?php echo $datos['carrera_alumno'] ?></span></p>
                            <p class="text"><b>Correo:  </b><span><input type="text" value="<?php echo $datos['correo']?>" name="email"></span></p>
                            <p class="text"><b>Teléfono: </b><span><input type="text" value="<?php echo $datos['telefono']?>" name="telefono"></span></p>
                            <p class="text"><b>Contraseña: </b><span><input type="password" value="<?php echo $datos['password']?>" name="password"></span></p>
                            <p class="text"><b>Confirma contraseña: </b><span><input type="password" value="<?php echo $datos['password']?>" name="repassword"></span></p>
                            <div class="buttons-wrap1">
                                <input type="submit" value="Guardar" id="boton_modificar" class="follow1">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>