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
    <link rel="stylesheet" href="css/estiloreporte.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../materialize/css/materialize.min.css">
</head>
<body>
<?php
    $datos = get_data($_SESSION['codigo_usuario']);
    $sufijo = generar_sufijo($datos['sexo']);
    $cons = "select * from instituto where codigo = ";
    $ciclo_Actual = get_ciclo()
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
    <div class="modal">
        <img src="img/profile.jpg" alt="">
    </div>
    <div class="container1">
        <div  class="card">
            <div class="header">
                <div class="main">
                    <div class="image">
                        <div class="hover">
                            <i class="fas fa-camera fa-2x"></i>
                        </div>
                    </div>
                    <h3 class="name"> <p><span><?php echo $datos['nombres'];?></span></p></h3>
                    <h3 class="name"><p><span><?php echo $datos['ap_paterno']." ".$datos['ap_materno'];?></span></p></h3>
                </div>
            </div>
            <div class="content">
                <div class="left">
                    <div class="about-container">
                        <p class="text">Semestre: <span><?php echo $ciclo_Actual['ciclo_actual'];?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col6">
        <ul class="collection with-header">
          <li class="collection-header">
            <h4> Generar Reportes</h4>
          </li>
          <li class="collection-item">
            <div>
              Ficha de matricula
              <a href="ficha_matricula.php" target="_blank" class="secondary-content">
                <i class="material-icons">send</i>
              </a>
            </div>
          </li>
          <li class="collection-item">
            <div>
              Avance Academico
              <a href="avance_academico.php" target="_blank" class="secondary-content">
                <i class="material-icons">send</i>
              </a>
            </div>
          </li>
          <li class="collection-item">
            <div>
              Constancia de notas
              <a href="constancia_notas.php" target="_blank" class="secondary-content">
                <i class="material-icons">send</i>
              </a>
            </div>
          </li>
          <li class="collection-item">
            <div>
              Cursos
              <a href="Cursos_lista.php" target="_blank" class="secondary-content">
                <i class="material-icons">send</i>
              </a>
            </div>
          </li>
        </ul>
      </div>
    <script src="app.js"></script>
    <script src="materialize/js/materialize.min.js"></script>
</body>
</html>