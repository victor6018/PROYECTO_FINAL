<?php
    function delete($id){
        global $conexion;
        $sql = "DELETE FROM estudiantes WHERE id ={$id}";
        $conexion-> query($sql);
    }
    
    function add($email, $password){
        global $conexion;
        $sql = "INSERT INTO user (id,email,password) VALUES (null,'{$email}','{$password}')";
        $conexion->query($sql);
    }
    function update($id, $email, $telefono, $password){
        global $conexion;
        $sql = "UPDATE estudiantes SET correo = '{$email}', telefono = '{$telefono}',password = '{$password}' WHERE codigoe = '{$id}'";
        $conexion->query($sql);
    }


    function unirtablas($id){
        global $conexion;
        $sql = "SELECT nombre_carrera FROM carrera INNER JOIN estudiantes ON carrera.idcarrera = estudiantes.id_carrera WHERE codigoe = '{$id}'";
        $result  = $conexion->query($sql);
        if( $result->num_rows){
            return $result->fetch_assoc();
        }else{
            return false; 
        }   
    }
  function generar_sufijo($genero){
      if($genero == "M"){
          return "o";
      }else if($genero == "F"){
          return "a";
      }else{
          return false;
      }
  }
  function get_data_horario($ciclo){
        global $conexion;
        $sql="Select curso_idcurso,hora,dia_idDia,duracion from horario WHERE curso_idcurso = 'PSI2'";
        $result  = $conexion->query($sql);
        if( $result->num_rows){
            return $result->fetch_assoc();
        }else{
            return false; 
        }
      
  }
  function get_data_instituto($id){
        global $conexion;
        $sql="Select * from instituto WHERE cod_modular = '{$id}'";
        $result  = $conexion->query($sql);
        if( $result->num_rows){
            return $result->fetch_assoc();
        }else{
            return false; 
        }
    }
 
    function carrera($id){
        global $conexion;
        $sql = "SELECT carrera_alumno FROM estudiantes WHERE codigoe = '{$id}';";
        $result = $conexion->query($sql);
        if( $result->num_rows){
            return $result->fetch_assoc();
        }else{
            return false; 
        }
    }
    function insertar_foto($direccion,$id){
        global $conexion;
        $sql = "UPDATE estudiantes SET foto = '{$direccion}' WHERE codigoe = '{$id}'";
        $conexion->query($sql);
    }
  ?>