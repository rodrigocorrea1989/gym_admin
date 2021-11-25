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
    
    
    <title>Finalizar Re Matriculación</title>
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

require("conexion.php");


date_default_timezone_set("America/Argentina/Buenos_Aires");

$fechaHoy=date("Y-m-d");

$dni=htmlentities(addslashes($_POST["dni"]));

$nombre=htmlentities(addslashes($_POST["nombre"]));

$apellido=htmlentities(addslashes( $_POST["apellido"]));

$edad=htmlentities(addslashes( $_POST["edad"]));

$telefono=htmlentities(addslashes($_POST["tel"])) ;

$nacimiento=htmlentities(addslashes($_POST["nacimiento"])) ;

$fecha=htmlentities(addslashes($_POST["inscripcion"])) ;

$actividad=htmlentities(addslashes($_POST["actividad"])) ;

$observacion=htmlentities(addslashes($_POST["observacion"])) ;

$latinFecha=date("d-m-Y", strtotime($fecha));

$latinFechaNacimiento=date("d-m-Y", strtotime($nacimiento));

$proximoVencimiento=date("Y-m-d",strtotime($fecha."+ 1 month")); 

$estado="activo";

$mesesConsumidos=1;

$mesesPagados=1;

/* obtener costo actividad  */

$sql="SELECT * FROM ACTIVIDAD WHERE NOMBRE= '$actividad' ";

if($resultado=mysqli_query($miconexion,$sql)){

  while($registro=mysqli_fetch_assoc($resultado)){
     
    $costo=$registro["costo"];

    $instructor=$registro["instructor"];

}

}

/* obtener costo actividad  */



/*  Insertar en alumnos activos  */

$sqlInsertar="INSERT INTO ALUMNOSACTIVO (DNI,NOMBRE,APELLIDO,EDAD,fechaNacimiento,fechaInscripcion,ACTIVIDAD,TELEFONO,ESTADO,mesesConsumidos,mesesPagados,proximoVencimiento,observacion,instructor) 

VALUES ('$dni','$nombre', '$apellido','$edad','$nacimiento','$fecha', '$actividad', '$telefono', '$estado','$mesesConsumidos','$mesesPagados','$proximoVencimiento','$observacion','$instructor')";


$insertar2=mysqli_query($miconexion,$sqlInsertar);



if(mysqli_affected_rows($miconexion)){

    $sqlDelete="DELETE FROM ALUMNOSBAJA WHERE  DNI =' $dni' ";

    $registro2=mysqli_query($miconexion,$sqlDelete);

      /*  registrar pago   */

    $sqlMonto="SELECT * FROM ACTIVIDAD WHERE NOMBRE = '$actividad'";

    $monto=0;

if($resultadoMonto=mysqli_query($miconexion,$sqlMonto)){

while($registroMonto=mysqli_fetch_assoc($resultadoMonto)){

    $monto=$registroMonto["costo"];

  }
 
} 


$sqlRegistroPago="INSERT INTO PAGOS (dni,nombre,apellido,telefono,fechaPago,monto,actividad,usuario) VALUES ('$dni','$nombre','$apellido','$telefono','$fechaHoy','$monto','$actividad','$nombreUsuario')";

$insertarRegistroPago=mysqli_query($miconexion,$sqlRegistroPago);


/* registrar pago  */

}else{
    
    echo "ERROR AL RE-MATRICULAR" ;

}   



/*  Insertar en alumnos activos   */



/*  evento  */ 



$fechaEvento=date("Y-m-d H:i:s");

$nombreAlumno=$nombre." ".$apellido;

$evento="rematricular alumno";

$sqlEvento="INSERT INTO EVENTOS (USUARIO,EVENTO,ALUMNO,FECHAEVENTO) VALUES('$nombreUsuario','$evento','$nombreAlumno','$fechaEvento')";

$insertarEvento=mysqli_query($miconexion,$sqlEvento);



/* evento  */ 



mysqli_close($miconexion);




?>









    <div class="container">

        <center><h2 class="text-primary">Se Re-matriculo correctamente</h2></center>


        <table class="table table-primary mt-5">
            <tr>
                <th><center><p class="text-dark">Dni</p> <p class="text-danger font-weight-bold"> <?php echo $dni ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Nombre y Apellido </p> <p class="text-danger font-weight-bold"> <?php echo $nombre." ".$apellido ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Edad </p> <p class="text-danger font-weight-bold"> <?php echo $edad ?> </p></center> </th> 
             </tr>
             <tr>
                <th><center><p class="text-dark">Teléfono </p> <p class="text-danger font-weight-bold"> <?php echo $telefono ?> </p></center> </th> 
             </tr>
             <tr>
                <th><center><p class="text-dark">Fecha De Nacimiento </p> <p class="text-danger font-weight-bold"> <?php echo $latinFechaNacimiento ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Fecha de Inscripción</p> <p class="text-danger font-weight-bold"> <?php echo $latinFecha ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Actividad</p> <p class="text-danger font-weight-bold"> <?php echo $actividad ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Costo</p> <p class="text-danger font-weight-bold"> <?php echo $costo ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Observacion</p> <p class="text-danger font-weight-bold"> <?php echo $observacion ?> </p></center> </th>
             </tr>
             
             
        
    
        </table>



    </div>



    <!-- footer -->
<br><br><br>
<div class="footer navbar-fixed-bottom mt-5"><center>
     <kbd> Centro Fitness © <?php echo date("20"."y");  ?> </kbd>
  </center></div>

   <!-- footer -->
</body>

</html>


