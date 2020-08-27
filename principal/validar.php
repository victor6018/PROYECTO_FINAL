<?php
				$codigo=$_POST['user'];
				$pass=$_POST['pass'];
				
require("database.php");
   if(isset($_POST['entrar'])){
       //consulta para estudiante
    if($_POST['user']!="" && $_POST['pass']!="" && $_POST['user']>"30000"){
        $codigo=$_POST['user'];
        $pass=$_POST['pass'];
        $consulta="SELECT * FROM estudiantes WHERE codigoe='$codigo' and password ='$pass'";
        $res = mysqli_query($conexion,$consulta);
        $cont=mysqli_num_rows($res);
        if($cont >0){
            $_SESSION['entrar']='dog';
            $consulta1="SELECT id_estudiante FROM estudiantes WHERE codigoe='$codigo' and password='$pass';";
        $res1 = mysqli_query($conexion,$consulta1);
        $cont1=mysqli_fetch_array($res1);
            session_start();
            $_SESSION['tipo_usuario'] = "estudiantes";
            $_SESSION['codigo_usuario'] = $_POST['user'] ;
            header("location: estudiante/index.php");
        }else{
            
            header("location: #");
        }
    }
   }


?>