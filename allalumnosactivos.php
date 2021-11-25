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
    <title>Todos los Alumnos Activos</title>
    <script>
    
  


    </script>
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

    <br>

    <div class="container">
      <?php
          require("conexion.php");

          if($privilegio=="instructor"){

          $sqlCount="SELECT * FROM ALUMNOSACTIVO WHERE INSTRUCTOR = '$nombreUsuario'";

          }else if($privilegio=="admin"){

            $sqlCount="SELECT * FROM ALUMNOSACTIVO";

          }

          $contador=0;

          if($resultadoCount=mysqli_query($miconexion,$sqlCount)){

            while($registroCount=mysqli_fetch_assoc($resultadoCount)){

               $contador++;
              
            }


          } 

      ?>

    <center> <h2 class="text-primary font-weight-bold font-capitalize">Alumnos Activos (<?php echo $contador ?>)</h2></center>
    <br><br>

    <?php

if(isset($_GET["dni"])){

$dni=htmlentities(addslashes($_GET["dni"]));     

}else{

$dni="";   

} 

if(isset($_GET["nombre"])){

$nombre=htmlentities(addslashes($_GET["nombre"]));     

}else{

$nombre="";   

} 

if(isset($_GET["apellido"])){

$apellido=htmlentities(addslashes($_GET["apellido"]));     

}else{

$apellido="";   

}  

if(isset($_GET["actividad"])){

 $actividad=htmlentities(addslashes($_GET["actividad"]));     

 }else{

  $actividad="";   

 }       
 
          

?>

    
    <br> <br>

<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<div class="row">
<div class="col">
 <input type="number" value="<?php echo $dni  ?>" name="dni" class="form-control" placeholder="D.N.I">
</div>
<div class="col">
 <input type="text" name="nombre"  value="<?php echo $nombre  ?>"class="form-control" placeholder="NOMBRE">
</div>
<div class="col">
 <input type="text" name="apellido" value="<?php echo $apellido  ?>" class="form-control" placeholder="APELLIDO">
</div>
<div class="form-group">
 <select id="inputState" name="actividad" class="form-control">
 <option selected value="">Todos</option>
   <?php   
   
     include("conexion.php");

     $sqlActividad="SELECT * FROM ACTIVIDAD ";

     if($resultadoActividad=mysqli_query($miconexion,$sqlActividad)){

       while($registroActividad=mysqli_fetch_assoc($resultadoActividad)){

         echo " <option>".$registroActividad['nombre']."</option>";

       }
     }
     
   
   ?>
 </select>
</div> 
<div class="col">
 <input type="submit" class="form-control btn btn-primary" value="FILTRAR">
</div>
</div>
</form>


    <table class="table table-primary table-striped mt-5">
        <thead class="thead-dark">
        <tr>
            <th scope="col">DNI</th>
            <th scope="col">NOMBRE/ APELLIDO</th>
            <th scope="col">EDAD</th>
            <th scope="col">FECHA DE NACIMIENTO</th>
            <th scope="col">FECHA DE INSCRIPCIÓN</th>
            <th scope="col">ACTIVIDAD</th>
            <th scope="col">TELEFÓNO</th>
            <th scope="col">ESTADO</th>
            <th scope="col">OBSERVACIÓN</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
      </tr>
    </thead>
    <tbody>

    </div>

    <?php

        
      if($privilegio=="instructor"){

      $sql="SELECT * FROM ALUMNOSACTIVO WHERE DNI LIKE '%$dni%' AND NOMBRE LIKE '%$nombre%' AND APELLIDO LIKE '%$apellido%'
      AND ACTIVIDAD LIKE '%$actividad%' AND INSTRUCTOR = '$nombreUsuario' "; 

      }else if($privilegio=="admin") {

        $sql="SELECT * FROM ALUMNOSACTIVO WHERE DNI LIKE '%$dni%' AND NOMBRE LIKE '%$nombre%' AND APELLIDO LIKE '%$apellido%'
      AND ACTIVIDAD LIKE '%$actividad%' "; 

      }

        if($resultado=mysqli_query($miconexion,$sql)){

            while($registro=mysqli_fetch_assoc($resultado)){

            $latinFecha=date("d-m-Y", strtotime($registro["fechaInscripcion"]));   

            $latinNacimiento=date("d-m-Y", strtotime($registro["fechaNacimiento"]));   


      ?>
                

                <tr>
                    <th scope="row"><?php  echo  $registro["dni"]   ?></th>
                    <td><?php  echo  $registro["nombre"]." ". $registro["apellido"] ?></td>
                    <td><?php  echo  $registro["edad"] ?></td>
                    <td><?php  echo  $latinNacimiento ?></td>
                    <td><?php  echo  $latinFecha ?></td>
                    <td><?php  echo  $registro["actividad"]  ?></td>
                    <td><?php  echo  $registro["telefono"] ?></td>
                    <td><?php  echo  $registro["estado"] ?></td>
                    <td><?php  echo  $registro["observacion"] ?></td>
                    <td><a class="btn btn-success text-light" href="profile.php?dni=<?php  echo $registro["dni"]   ?>&tipo=activo">VER PERFIL</a></td> 
                    <td><a class="btn btn-danger text-light" href="darBajaAlumnaActivo.php?dni=<?php  echo $registro["dni"]   ?>">DAR DE BAJA</a></td>
                    <td><a class="btn btn-primary text-light" href="editarAlumnoActivo.php?dni=<?php  echo $registro["dni"]   ?>">EDITAR</a></td>
                    
                    
                </tr>
               


                <?php
                }
            }
            
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