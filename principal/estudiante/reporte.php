<?php
    require('cabecera.php');
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
</head>
<body>
    
</body>
</html>