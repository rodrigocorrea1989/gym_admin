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
    <title>PERFIL ALUMNO</title>
</head>


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
    <body>
     <?php 

        include("conexion.php");

        include("mostrarUsuario.php");

        $tipo=htmlentities(addslashes($_GET["tipo"]));

        $dni=htmlentities(addslashes($_GET["dni"]));

        $upload="img/";

        if($tipo=="activo"){

        $sql="SELECT * FROM ALUMNOSACTIVO WHERE DNI = '$dni' ";

        }else if($tipo=="prueba"){

          $sql="SELECT * FROM ALUMNOSPRUEBA WHERE DNI = '$dni' ";

        }

        if($resultado=mysqli_query($miconexion,$sql)){

            while($registro=mysqli_fetch_assoc($resultado)){

                $nombre=$registro["nombre"];

                $apellido=$registro["apellido"];

                $dni=$registro["dni"];

                $edad=$registro["edad"];

                $fechaNacimiento=$registro["fechaNacimiento"];

                $latinFechaNacimiento=date("d-m-Y", strtotime($fechaNacimiento)); 
                
                $fechaInscripcion=$registro["fechaInscripcion"];

                $latinFechaInscripcion=date("d-m-Y", strtotime($fechaInscripcion)); 

                $actividad=$registro["actividad"];

                $instructor=$registro["instructor"];

                $telefono=$registro["telefono"];

                $estado=$registro["estado"];

                $observacion=$registro["observacion"];



       
            }       
    }
        

      /* obtener imagen  */

      $sqlimg="SELECT * FROM IMAGENES WHERE DNI = '$dni' ";

      if($resultadoimg=mysqli_query($miconexion,$sqlimg)){

        while($registroimg=mysqli_fetch_assoc($resultadoimg)){

            $imagen1=$registroimg["img1"];

            $imagen2=$registroimg["img2"];

            $imagen3=$registroimg["img3"];

            $imagen4=$registroimg["img4"];

        }
        
      }  


     /*  obtener imagen */   
     
     ?>

     <br><br>
    <div class="container border border-dark">
    <center> <h2 class="text-dark font-weight-bold font-capitalize">Perfil de "<?php echo $nombre." ".$apellido  ?>"</h2></center><br><br>
    <center><img src="<?php echo $upload.$imagen1 ?>" alt="<?php echo $imagen1?>" class="img-thumbnail"> </center><br><br>
    <p class="text-dark"> DNI:<strong> "<?php echo $dni    ?>"</strong> </p>
    <p class="text-dark"> EDAD:<strong> "<?php echo $edad    ?>" </strong></p>
    <p class="text-dark"> FECHA DE NACIMIENTO:<strong> "<?php echo $latinFechaNacimiento   ?>"</strong> </p>
    <p class="text-dark"> FECHA DE INSCRIPCION: <strong>"<?php echo $latinFechaInscripcion ?>"</strong> </p>
    <p class="text-dark"> ACTIVIDAD:<strong> "<?php echo $actividad ?>"</strong> </p>
    <p class="text-dark"> A CARGO DEL INSTRUCTOR/A:<strong> "<?php echo $instructor ?>"</strong> </p>
    <p class="text-dark"> TELÉFONO:<strong> "<?php echo $telefono ?>"</strong> </p>
    <p class="text-dark"> ESTADO:<strong> "<?php echo $estado ?>"</strong> </p>
    <p class="text-dark"> OBSERVACIÓN:<strong> "<?php echo $observacion ?>"</strong> </p>
    
  </div><br><br><br>

      <!-- grid de imagenes  -->
      <div class="container">
        <h2 class="text-primary">Más Fotos</h2><br>
  <div class="row">
    <div class="col-sm">
    <img src="<?php echo $upload.$imagen2 ?>" alt="<?php echo $imagen2?>" class="img-thumbnail" >
    </div>
    <div class="col-sm">
    <img src="<?php echo $upload.$imagen3 ?>" alt="<?php echo $imagen3?>" class="img-thumbnail">
    </div>
    <div class="col-sm">
    <img src="<?php echo $upload.$imagen4 ?>" alt="<?php echo $imagen4?>" class="img-thumbnail">
    </div>
  </div><br>
  <center><a class="btn btn-primary text-light" href="panelAsistencias.php?dni=<?php echo $dni  ?>">ASISTENCIAS DE <br><?php echo $nombre." ".$apellido  ?></a><center><br>
  <center><a class="btn btn-success text-light"  href="allpagos.php?dni=<?php echo $dni  ?>">PAGOS DE <br><?php echo $nombre." ".$apellido  ?></a><center><br>
  <center><a class="btn btn-danger text-light" href="vencimientos.php?dni=<?php echo $dni  ?>">DEUDAS DE <br><?php echo $nombre." ".$apellido  ?></a><center><br>
  <center><a class="btn btn-warning text-light" href="alertas.php?dni=<?php echo $dni  ?>">ALERTAS DE <br><?php echo $nombre." ".$apellido  ?></a><center><br>
</div>
      <!-- grid de imagenes  -->
  

</body>

<!-- footer -->
<div class="footer navbar-fixed-bottom mt-5"><center>
       <kbd> Centro Fitness © <?php echo date("20"."y");  ?>
</kbd> </center></div>
<!-- footer -->

<?php



mysqli_close($miconexion);

?>
</html>