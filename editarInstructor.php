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
    
    <script>

  function confirmar(){
  var respuesta=confirm("¿Esta seguro que desea Editar este Instructor?");
  if (respuesta == false){
  event.preventDefault();
  }  
  }
  </script>
    
    <title>Editar Instructor</title>
    <!-- eye -->
<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("password");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }

  function mostrarContrasena2(){
      var tipo2 = document.getElementById("password2");
      if(tipo2.type == "password"){
          tipo2.type = "text";
      }else{
          tipo2.type = "password";
      }
  }

  


</script>

<!-- eye -->
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

      $dni=$_GET["dni"];

      $sql="SELECT * FROM INSTRUCTORES WHERE DNI = '$dni'";

      if($resultado=mysqli_query($miconexion,$sql)){

        while($registro=mysqli_fetch_assoc($resultado)){

            $cuil=$registro["cuil"];

            $nombre=$registro["nombre"];

            $apellido=$registro["apellido"];

            $edad=$registro["edad"];

            $fechaNacimiento=$registro["fechaNacimiento"];

            $telefono=$registro["numeroContacto"];

            $fechaIngreso=$registro["fechaIngreso"];

            $password=$registro["password"];

            $privilegio=$registro["privilegio"];

        }
        
      } 

  ?>
  
  <!-- comienzo el formulario -->  
  <center>
  <div class="container">
      <h2 class="text-success">Editar Instructor</h2>
    <div class="col-md-8 col-lg-6 mt-5">
        <form action="\centrofitness\aplicarEdicionInstructor.php" method="POST">
        <div class="form-group">
          <label class="text-success" for="formGroupExampleInput" >D.N.I</label>
          <input  type="number" value="<?php echo $dni;  ?>" class="form-control mt-3 text-danger" name="dni" id="formGroupExampleInput" placeholder="Documento Nacional De Identidad" required readonly>
        </div>
        <div class="form-group">
          <label class="text-success" for="formGroupExampleInput">C.U.I.L</label>
          <input  type="number" value="<?php echo $cuil   ?>" name="cuil" class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="XX-XXXXXXXX-X">
        </div>
        <div class="form-group">
          <label class="text-success" for="formGroupExampleInput">Nombre</label>
          <input  type="text" value="<?php echo $nombre ?>" name="nombre" class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="Juan" required>
        </div>
        <div class="form-group">
          <label class="text-success" for="formGroupExampleInput">Apellido</label>
          <input  type="text" value="<?php echo $apellido ?>" name="apellido" class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="Peréz" required>
        </div>
        <div class="form-group">
          <label class="text-success" for="formGroupExampleInput">Edad</label>
          <input  type="number" value="<?php echo $edad ?>" name="edad" class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="31" required>
        </div>
        <div class="form-group">
          <label class="text-success" for="formGroupExampleInput">Fecha De Nacimiento</label>
          <input  type="date" value="<?php echo $fechaNacimiento ?>" name="nacimiento" class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="31" required>
        </div>
        <div class="form-group">
          <label class="text-success" for="formGroupExampleInput">Télefono De Contacto</label>
          <input  type="number" value="<?php echo $telefono ?>" name="tel" class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="37643228753" required>
        </div>
        <div class="form-group">
          <label class="text-success" for="formGroupExampleInput">Fecha de Registro</label>
          <input  type="date" value="<?php echo $fechaIngreso ?>"  name="fecha" class="form-control mt-3 text-danger" id="formGroupExampleInput" required>
        </div>
        <div class="form-group">
            <label for="inputState" class="text-success">Privilegio</label>
            <select id="inputState" name="privilegio" class="form-control text-danger">
            <option value="<?php echo $privilegio  ?>"><?php echo $privilegio  ?></option>
            <option value="admin">admin</option>
            <option value="instructor">instructor</option>
            </select>
      </div>  
        <div class="form-group">
          <label class="text-success"  for="formGroupExampleInput">Contraseña de acceso</label>
          <a class="btn btn-outline-primary" onclick="mostrarContrasena()"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
          </svg></a>
          <input  type="password" id="password" name="password"  value="<?php echo $password  ?>" class="form-control mt-3 text-danger" id="formGroupExampleInput" required>
        </div>
        <div class="form-group">
          <label class="text-success"  for="formGroupExampleInput">Repetir contraseña</label>
          <a class="btn btn-outline-primary" onclick="mostrarContrasena2()"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
          </svg></a>
          <input  type="password" id="password2" value="<?php echo $password  ?>" name="password2" class="form-control mt-3 text-danger" id="formGroupExampleInput " required>
        </div>
        <button type="submit" class="btn btn-success mt-3" id="registrar" onclick="confirmar();">Editar Instructor</button>
      </form>
    <div>
    <div>
    </center>
     <!--  cierre de formulario  -->   


  </body>

      <?php  

          mysqli_close($miconexion);

      ?>

  <!-- footer -->
<div class="footer navbar-fixed-bottom mt-5"><center>
       <kbd> Centro Fitness © <?php echo date("20"."y");  ?>
</kbd> </center></div>
<!-- footer -->

  <html>