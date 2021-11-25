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
    <title>Panel de Asistencias</title>
    

       

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
    <div class="container">

    

    <?php 


    include("mostrarUsuario.php"); 

    require("conexion.php");

    
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
                  
                  
                  if(isset($_GET["fecha"])){
  
                      $fecha=htmlentities(addslashes($_GET["fecha"]));     
                  
                      }else{
                  
                       $fecha="";   
                  
                      }     


    ?>

    <center> <h2 class="text-warning font-weight-bold font-capitalize">Panel de Asistencias</h2></center><br>
    
    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
        <div class="row">
          <div class="col">
            <input type="number" value="<?php echo $dni  ?>" name="dni" class="form-control" placeholder="D.N.I">
          </div>
          <div class="col">
            <input type="text" name="nombre" value="<?php echo $nombre ?>" class="form-control" placeholder="NOMBRE">
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
            <input type="date" name="fecha" value="<?php echo $fecha ?>" class="form-control" placeholder="FECHA ASISTENCIA">
          </div>
          <div class="col">
            <input type="submit" class="form-control btn btn-primary" value="FILTRAR">
          </div>
        </div>
      </form>

    <table class="table table-warning table-striped mt-5">
        <thead class="thead-dark">
        <tr>
            <th scope="col">DNI</th>
            <th scope="col">NOMBRE/ APELLIDO</th>
            <th scope="col">ACTIVIDAD</th> 
            <th scope="col">TELEFONO</th> 
            <th scope="col">FECHA DE ASISTENCIA</th> 
      </tr>
    </thead>
    <tbody>

    </div>

    <?php
        
    if($privilegio=="instructor"){            

    $sql="SELECT * FROM ASISTENCIA WHERE DNI LIKE '%$dni%' AND NOMBRE LIKE '%$nombre%' AND APELLIDO LIKE '%$apellido%'
    AND ACTIVIDAD LIKE '%$actividad%' AND FECHA LIKE '%$fecha%' AND INSTRUCTOR = '$nombreUsuario' ";

    }else if($privilegio=="admin"){

      $sql="SELECT * FROM ASISTENCIA WHERE DNI LIKE '%$dni%' AND NOMBRE LIKE '%$nombre%' AND APELLIDO LIKE '%$apellido%'
    AND ACTIVIDAD LIKE '%$actividad%' AND FECHA LIKE '%$fecha%' ";


    }

    if($resultado=mysqli_query($miconexion,$sql)){

    while($registro=mysqli_fetch_assoc($resultado)){

    $latinFecha=date("d-m-Y", strtotime($registro["fecha"]));  
    
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    
    $fechaHoy=date("Y-m-d");

    

?>
        
        
        <tr>
            <th scope="row"><?php  echo  $registro["dni"]   ?></th>
            <td><?php  echo  $registro["nombre"]." ". $registro["apellido"] ?></td>
            <td><?php  echo  $registro["actividad"]  ?></td>
            <td><?php  echo  $registro["telefono"] ?></td>
            <td><?php  echo  $latinFecha ?></td>
            
        </tr>
       

        <?php

        }
    }

    
    mysqli_close($miconexion);

?>
