<?php
session_start();
require("principal/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
	<meta name="keywords" content="" >
    <meta name="author" content="EES">
    <title>LOGIN</title>

</head>
<body>
    hola mundo por primera vez
    <div id ="contenedor principal">
        <header id="cabecera_principal">
                BIENVENIDO AL INSTITUTO
        </header>
        <section id="formulario_principal">
            <div id="cont"> 
            <form id="form1" name="form1" method="post" action="principal/validar.php" class="form-submit">
                <div id="contenedor_input">
                <span id="texot1">Ingresar:</span>

                <input type="text" class="form-control"  name="user" id="user" placeholder="Usuario" class="login_text" required>
                <input type="password" class="form-control" name="pass" id="pass"  pattern="[A-Za-z0-9_-]{1,15}" placeholder="Contraseña" required class="login_text">
                
                <span><a href="#">Olvido su contraseña?</a></span>
                </div>
                <input type="submit" class="botonlg" value="Iniciar Sesion" id="entrar" name="entrar">
            </form>
            </div>  
        </section>
    </div>

</body>
</html>