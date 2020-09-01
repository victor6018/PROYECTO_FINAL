<?php
session_start();
require("principal/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>LOGIN</title> 
    <link rel="stylesheet" href="estilologin.css">

</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form id="form1" name="form1" method="post" action="principal/validar.php" class="sign-in-form">
                <h2 class="title">Bienvenido al Instituto</h2>
                <h2 class="title">Iniciar Sesion</h2>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="text" name="user" id="user" placeholder="Usuario" class="login_text" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="password" class="form-control" name="pass" id="pass"  pattern="[A-Za-z0-9_-]{1,15}" placeholder="Contraseña" required class="login_text">
                    </div>
                    <input type="submit" class="btn solid" value="Iniciar Sesion" id="entrar" name="entrar">
                    <p class="social-text">O visitanos en nuestras redes sociales</p>
                    <div class="social-media">
                        <a href="https://www.facebook.com/ivan.alarconalarcon.7" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Ya eres parte de nosotros?</h3>
                    <p>
                        te estas perdiendo de muchas cosas, tomate un cafe y
                        vamos por los cursos que te esperan. 
                    </p>
                </div>
                <img src="img/logo1.svg" class="image" alt="">
            </div>
        </div>
    </div>
    <script src="js/app.js"></script>
</body>
</html>