<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img\pesa.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Registrar Pago</title> 
</head>

<body>
<header>  
        <!-- barra de navegación-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
          <a href="\centrofitness\index.php"><img src="img/logo.png" width="250" height="100" class="d-inline-block align-top" alt=""></a>
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="\centrofitness\index.php">Página Principal <span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
          </nav>
          <!-- cierre de barra de navegación-->
    </header>
    <?php    include("mostrarUsuario.php"); ?>
<?php

include("conexion.php");

$dni=htmlentities(addslashes($_GET["dni"]));

date_default_timezone_set("America/Argentina/Buenos_Aires");

$fechaHoy=date("Y-m-d");

$sql="SELECT * FROM ALUMNOSACTIVO WHERE DNI='$dni' ";

            
            if($resultado=mysqli_query($miconexion,$sql)){

            while($registro=mysqli_fetch_assoc($resultado)){

        
           $sumarPago=$registro["mesesPagados"]+1;  
            
           $nombre=$registro["nombre"];

           $apellido=$registro["apellido"];

           $telefono=$registro["telefono"];

           $nombreActividad=$registro["actividad"];
              
           
            }

        }



$sqlPago="UPDATE ALUMNOSACTIVO SET mesesPagados='$sumarPago' WHERE DNI='$dni' ";

$insertarPago=mysqli_query($miconexion,$sqlPago);

if(mysqli_affected_rows($miconexion)){

    echo "<div class='container mt-3'>";
    echo "<br><center><h2 class='text-success text-capitalize font-weight-bold font-italic'>Se ha realizado el cobro correctamente</h2></center>";
    echo "</div>";


}else{
    
    echo "error al insertar";

}   


$sqlMonto="SELECT * FROM ACTIVIDAD WHERE NOMBRE = '$nombreActividad'";

$monto=0;

if($resultadoMonto=mysqli_query($miconexion,$sqlMonto)){

  while($registroMonto=mysqli_fetch_assoc($resultadoMonto)){

      $monto=$registroMonto["costo"];

    }
   
  } 


$sqlRegistroPago="INSERT INTO PAGOS (dni,nombre,apellido,telefono,fechaPago,monto,actividad,usuario) VALUES ('$dni','$nombre','$apellido','$telefono','$fechaHoy','$monto','$nombreActividad','$nombreUsuario')";

$insertarRegistroPago=mysqli_query($miconexion,$sqlRegistroPago);


/*  evento  */ 


$fechaEvento=date("Y-m-d H:i:s");

$nombreAlumno=$nombre." ".$apellido;

$evento="cobro de cuota $";

$sqlEvento="INSERT INTO EVENTOS (USUARIO,EVENTO,ALUMNO,FECHAEVENTO) VALUES('$nombreUsuario','$evento','$nombreAlumno','$fechaEvento')";

$insertarEvento=mysqli_query($miconexion,$sqlEvento);



/* evento  */ 

        
 mysqli_close($miconexion);       


?>

<!-- footer -->
<br><br><br>
  <div class="footer navbar-fixed-bottom mt-5"><center>
       <kbd> Centro Fitness © <?php echo date("20"."y");  ?> </kbd>
    </center></div>

     <!-- footer -->
     </body>
</html>