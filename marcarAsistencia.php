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
    <title>Asistencia</title>

   

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
$nombre=htmlentities(addslashes($_GET["nombre"]));
$apellido=htmlentities(addslashes($_GET["apellido"]));
$actividad=htmlentities(addslashes($_GET["actividad"]));
$telefono=htmlentities(addslashes($_GET["telefono"]));
$instructor=htmlentities(addslashes($_GET["instructor"]));
date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHoy=date("Y-m-d");


$sqlAsistencia="SELECT * FROM ASISTENCIA WHERE DNI= '$dni'";

if($ejecutar=mysqli_query($miconexion,$sqlAsistencia)){

while($registroAsistencia=mysqli_fetch_assoc($ejecutar)){

    $dniAsistencia=$registroAsistencia["dni"];

    $fechaAsistencia=$registroAsistencia["fecha"];

  }

}


if($dniAsistencia==$dni && $fechaAsistencia==$fechaHoy){

    echo '<center> <h2 class="text-danger">Ya se tomo asistencia a este usuario el día de hoy </h2><br><br>';

    echo '<a class="btn btn-warning" href="\centrofitness\registrarAsistencia.php" > VOLVER </a></center>';


}else{

$sql="INSERT INTO ASISTENCIA (DNI, NOMBRE ,APELLIDO, ACTIVIDAD,TELEFONO,FECHA,INSTRUCTOR) VALUES ('$dni', '$nombre', '$apellido','$actividad','$telefono','$fechaHoy','$instructor')";

$insertar=mysqli_query($miconexion,$sql);

if(mysqli_affected_rows($miconexion)){

    echo '<center> <h2 class="text-success">Se tomo asistencia correctamente </h2><br><br>';

    echo '<a class="btn btn-warning" href="\centrofitness\registrarAsistencia.php" > VOLVER </a></center>';


}else {

    echo "Error";

    

}

}

/*  evento  */ 



$fechaEvento=date("Y-m-d H:i:s");

$nombreAlumno=$nombre." ".$apellido;

$evento="Marcar Asistencia";

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