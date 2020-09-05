<?php
    require '../database.php';
    include_once('funciones.php');
    session_start();

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
    function get_ciclo(){
        global $conexion;
        $sql="Select ciclo_actual from instituto";
        $result  = $conexion->query($sql);
        if( $result->num_rows){
            return $result->fetch_assoc();
        }else{
            return false; 
        }
    }

    $datos = get_data($_SESSION['codigo_usuario']);
    $ciclo_Actual = get_ciclo();


     $result = '';
     error_reporting(0);
     function run_query(){
         global $conexion ;
         $sql = "SELECT dia, Nombre_curso, ciclo_curso, aula, periodo, horainicio, horafinal FROM curso INNER JOIN horario ON curso.horario_id_horario = horario.id_horario INNER JOIN dia ON horario.Dia_id_Dia = dia.id_Dia  WHERE ciclo_curso='{$_REQUEST['ciclo']}' order by dia_id_dia asc";
         return $conexion->query($sql);
     }
     $result = run_query();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <title>Horario</title>
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
                        <p class="text"><b>Carrera: </b><span><?php echo $datos['carrera_alumno'] ?></span></p>
                        <p class="text"><b>Fecha: </b><span><?php echo date("d/m/y"); $creditos = 23;?></span></p>
                        <p class="text"><b>Semestre: </b><span><?php echo $ciclo_Actual['ciclo_actual'];?></span></p>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container1">
        <form action="horarios.php"  id="form_horario_principal">
            <p><h3>Ver Horarios</h3></p>
            <select name="ciclo" id="selecionar_ciclo">
                <option value="I">1er ciclo</option>
                <option value="II">2do ciclo</option>
                <option value="III">3er ciclo</option>
                <option value="I">4to ciclo</option>
                <option value="V">5to ciclo</option>
                <option value="VI">6to ciclo</option>
            </select>
            <input type="submit" id="boton_enviar_horario" value="Ver horario" class="follow1">
        </form>
    </div>
    <div class="container">
    <table class="table">
        <thead>
          <tr>
              <th>Dia</th>
              <th>Aula</th>
              <th>Asignatura</th>
              <th>Hora Inicio</th>
              <th>Hora final</th>
          </tr>
        </thead>
        <tbody>
            <?php
                while($usuario = $result->fetch_assoc())
                {
            ?>
          <tr>
            <td><?php echo $usuario['dia'] ?></td>
            <td><?php echo $usuario['aula'] ?></td>
            <td><?php echo $usuario['Nombre_curso'] ?></td>
            <td><?php echo $usuario['horainicio'] ?></td>
            <td><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$usuario['horafinal']."<br>"?></td>
          </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>