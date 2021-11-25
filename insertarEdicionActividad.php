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
     <title>Edición Insertada</title>
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
        
        $nombreActividad=htmlentities(addslashes($_POST["nombreActividad"]));

        $instructor=htmlentities(addslashes($_POST["nombreInstructor"]));

        $costoActividad=htmlentities(addslashes($_POST["costoActividad"]));

        $sql="UPDATE ACTIVIDAD SET INSTRUCTOR='$instructor' , COSTO='$costoActividad' WHERE NOMBRE='$nombreActividad' ";

        $insertar=mysqli_query($miconexion,$sql);

        if(mysqli_affected_rows($miconexion)){

            echo "<div class='container mt-3'>";
            echo "<br><center><h2 class='text-success text-capitalize font-weight-bold font-italic'>se ha actualizado correctamente</h2></center>";
            echo "</div>";
          
           
        
        }else{
            
            echo "error al insertar";
        
        }   

        $sql2="UPDATE ALUMNOSACTIVO SET INSTRUCTOR='$instructor' WHERE ACTIVIDAD='$nombreActividad' ";

        $insertar2=mysqli_query($miconexion,$sql2);   

        $sql3="UPDATE ALUMNOSPRUEBA SET INSTRUCTOR='$instructor' WHERE ACTIVIDAD='$nombreActividad' ";

        $insertar3=mysqli_query($miconexion,$sql3);   
        
    ?>

        <div class="container">

        <table class="table table-primary mt-5">

            <tr>
                <th><center><p class="text-dark">Instructor/a </p> <p class="text-danger font-weight-bold"> <?php echo $instructor  ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Nombre De Actividad </p> <p class="text-danger font-weight-bold"> <?php echo $nombreActividad  ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Costo </p> <p class="text-danger font-weight-bold"> $ <?php echo $costoActividad  ?> </p></center> </th>
             </tr>
             
        </table>



    </div>
    
<?php

        
        /*  evento  */ 

	    date_default_timezone_set("America/Argentina/Buenos_Aires");

	    $fechaEvento=date("Y-m-d H:i:s");

	    $evento="editar actividad";

	    $sqlEvento="INSERT INTO EVENTOS (USUARIO,EVENTO,ALUMNO,FECHAEVENTO) VALUES('$nombreUsuario','$evento','$nombreActividad','$fechaEvento')";

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
