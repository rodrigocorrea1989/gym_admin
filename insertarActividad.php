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
    <title>Agregar Actividad</title>
    

</head>
<body>
    <header>  
        <!-- barra de navegación-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
  
  
  <?php  
    
      include("mostrarUsuario.php");

        include("conexion.php");

        $nombreActividad=htmlentities(addslashes($_POST["nombreActividad"]));

        $instructor=htmlentities(addslashes($_POST["nombreInstructor"]));

        $costo=htmlentities(addslashes($_POST["costo"]));

        date_default_timezone_set("America/Argentina/Buenos_Aires");

        $fecha=date("Y-m-d");

        $sql="INSERT INTO ACTIVIDAD (nombre , instructor, fechaAlta , costo) VALUES ('$nombreActividad','$instructor','$fecha','$costo')";

        $insertar=mysqli_query($miconexion,$sql);

        /*  evento  */ 

	    date_default_timezone_set("America/Argentina/Buenos_Aires");

	    $fechaEvento=date("Y-m-d H:i:s");

	    $evento="registrar actividad";

	    $sqlEvento="INSERT INTO EVENTOS (USUARIO,EVENTO,ALUMNO,FECHAEVENTO) VALUES('$nombreUsuario','$evento','$nombreActividad','$fechaEvento')";

	    $insertarEvento=mysqli_query($miconexion,$sqlEvento);

    /* evento  */
    
    mysqli_close($miconexion);


    ?>

    <div class="container">

        
       <center> <h2 class="text-primary text-capitalize font-weight-bold font-italic">Se ha insertado correctamente la siguiente actividad</h2></center>

        <table class="table table-primary mt-5">
            <tr>
                <th><center><p class="text-dark">Actividad:  </p> <p class="text-danger font-weight-bold"> <?php echo $nombreActividad ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Instructor: </p>  <p class="text-danger font-weight-bold"> <?php echo $instructor ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Costo: </p>  <p class="text-danger font-weight-bold"> <?php echo $costo ?> </p></center> </th>
             </tr>
        </table>


    </div>

    <center><a class="btn btn-primary text-capitalize text-light mt-5" href="\centrofitness\allActivities.php">Ver todas las actividades</a></center>
   
    
</body>
  <!-- footer -->
  <br><br><br>
  <div class="footer navbar-fixed-bottom mt-5"><center>
       <kbd> Centro Fitness © <?php echo date("20"."y");  ?> </kbd>
    </center></div>

     <!-- footer -->
</html>