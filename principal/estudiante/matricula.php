<?php
    require '../database.php';
    include_once('funciones.php');
    session_start();

    $datos=get_data($_SESSION['codigo_usuario']);
    $sufijo=generar_sufijo($datos['sexo']);
    $cons="select * from instituto where codigo = ";
    
    if($_SESSION['tipo_usuario'] != "estudiantes")
    {
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
        $result=$conexion->query($sql);
        if($result->num_rows)
        {
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }
    function matriculado($cod_curso, $id, $periodo)
    {
        global $conexion;
        $sql="SELECT * FROM matricula WHERE curso_id_curso = '{$cod_curso}' and estudiantes_id_estudiante ='{$id}' and periodo ='$periodo';";
        $result=$conexion->query($sql);
        if( $result->num_rows)
        {
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }

    $datos =get_data($_SESSION['codigo_usuario']);
    $ciclo_actual=get_ciclo();


    $result='';
    error_reporting(0);
    function rum_query ($id,$carrera)
    {
        global $conexion;
        $sql="SELECT * from estudiantes INNER JOIN curso ON estudiantes.ciclo = curso.ciclo_curso WHERE codigoe = '{$id}' and carrera_alumno = '{$carrera}';";
        return $conexion->query($sql);  
    }

    function matriculados($id, $periodo)
    {
        global $conexion ;
        $sql = "SELECT * FROM matricula INNER JOIN curso ON matricula.curso_id_curso = curso.id_curso WHERE estudiantes_id_estudiante= '{$id}' and periodo='{$periodo}';";
        return $conexion->query($sql);
    }

    $result = rum_query($_SESSION['codigo_usuario'],$datos['carrera_alumno'] );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <title></title>
    <link rel="stylesheet" href="css/matricula.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../materialize/css/materialize.min.css">
</head>
<body>
<nav class="nav-extended blue">
    <div class="nav-wrapper">
      <a class="brand-logo">
        <p>Bienvenido al 
          Instituto</p>
      </a>
      <ul class="right hide-on-med-and-down">
        <li><a href="">sobre nosotros</a></li>
        <li><a href="">contactanos</a></li>
        <li><a href="">cerrar secion</a></li>
      </ul>
    </div>
    <div class="nav-content">
      <span class="nav-title"><p></p></span>
      <a href="index.php" class="btn-floating red btn-large halfway-fab ">
        <i class="material-icons">home</i>
      </a>
    </div>
  </nav>
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
                        <p class="text"><b>Ingresó: </b><span><?php echo $datos['semestre_ingreso']?></span></p>
                        <p class="text"><b>Colegio: </b><span><?php echo $datos['colegio']. " - ". $datos['tipo_colegio'] ?></span></p>
                        <p class="text"><b>Carrera: </b><span><?php echo $datos['carrera_alumno'] ?></span></p>
                        <p class="text"><b>Fecha: </b><span><?php echo date("d/m/y"); $creditos = 23;?></span></p>
                        <p class="text"><b>Semestre: </b><span><?php echo $ciclo_Actual['ciclo_actual'];?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>