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
    <title>Editar Alumnos Activo</title>
  
  <script>

  function confirmar(){
  var respuesta=confirm("¿Esta seguro que desea editar?");
  if (respuesta == false){
  event.preventDefault();
  }  
  }
  </script> 


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
                  <a class="nav-link"href="\centrofitness\index.php">Página Principal <span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
          </nav>
          <!-- cierre de barra de navegación-->
    </header>
  
    <div class="container mt-5">
     <?php 
     
     include("mostrarUsuario.php"); 

     include("conexion.php");


     $dni=$_GET["dni"];
     

     $sql="SELECT * FROM ALUMNOSACTIVO WHERE DNI='$dni'";

     if($resultado=mysqli_query($miconexion, $sql)){
         
        while($registro=mysqli_fetch_assoc($resultado)){

     
     ?>
      
        
        <h2 class="text-primary text-center font-weight-bold font-italic mt-5">Editar Alumnos Activo</h2>    
    <!-- comienzo el formulario -->  
    <center>
    <div class="col-md-8 col-lg-6 mt-5">
        <form action="insertarEdicionAlumnoActivo.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label class="text-primary" for="formGroupExampleInput">D.N.I</label>
          <input  type="number" name="dni" value="<?php echo $registro["dni"];  ?>"  class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="Documento Nacional De Identidad" required readonly>
        </div>
        <div class="form-group">
          <label class="text-primary" for="formGroupExampleInput">Nombre</label>
          <input  type="text" name="nombre" value="<?php echo $registro["nombre"];  ?>" class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="Juan" required>
        </div>
        <div class="form-group">
          <label class="text-primary" for="formGroupExampleInput">Apellido</label>
          <input  type="text" name="apellido" value="<?php echo $registro["apellido"];  ?>" class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="Peréz" required>
        </div>
        <div class="form-group">
          <label class="text-primary" for="formGroupExampleInput">Edad</label>
          <input  type="number" name="edad" value="<?php echo $registro["edad"];  ?>" class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="31" required>
        </div>
        <div class="form-group">
          <label class="text-primary" for="formGroupExampleInput">Teléfono</label>
          <input  type="number" name="tel" class="form-control mt-3 text-danger" value="<?php echo $registro["telefono"];  ?>" id="formGroupExampleInput " placeholder="543765332266" required>
        </div>
        <div class="form-group">
          <label class="text-primary" for="formGroupExampleInput">Fecha De Nacimiento</label>
          <input  type="date" name="nacimiento" value="<?php echo $registro["fechaNacimiento"];  ?>" class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="31" required>
        </div>
        <div class="form-group">
          <label class="text-primary" for="formGroupExampleInput">Fecha De Inscripción</label>
          <input  type="date" name="inscripcion" value="<?php echo $registro["fechaInscripcion"];  ?>" class="form-control mt-3 text-danger" id="formGroupExampleInput" placeholder="31" required>
        </div>
        <div class="form-group">
            <label for="inputState" class="text-primary">Actividad/Entrenamiento</label>
            <select id="inputState" name="actividad" class="form-control text-danger">
            <option selected><?php echo $registro["actividad"];  ?></option>
              <?php   
                include("conexion.php");

                $sql="SELECT * FROM ACTIVIDAD ";

                if($resultado=mysqli_query($miconexion,$sql)){

                  while($registro=mysqli_fetch_assoc($resultado)){

                    echo " <option>".$registro['nombre']."</option>";

                  }
                }
              
              
              ?>
            </select>
           </div> 
           <div class="form-group">
            <label for="exampleFormControlFile1" class="text-primary">Foto de Perfil</label>
            <input type="file" name="fotoperfil" value="...\centrofitness\img\<?php echo $imagenPerfil  ?>" class="form-control-file" id="exampleFormControlFile1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1" class="text-primary">Imagen1</label>
            <input type="file" name="img2" class="form-control-file" id="exampleFormControlFile1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1" class="text-primary">imagen2</label>
            <input type="file" name="img3" class="form-control-file" id="exampleFormControlFile1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1" class="text-primary">imagen3</label>
            <input type="file" name="img4" class="form-control-file" id="exampleFormControlFile1">
          </div>    


           <input type="submit" name="estado" onclick="confirmar();" value="Editar" class="btn btn-primary mt-3" >
           


    <?php
        }
            
            } 

             mysqli_close($miconexion);

    ?>

      </form>
    <div>
    </center>
     <!--  cierre de formulario  -->   

   
    
</body>
  <!-- footer -->
  <br><br><br>
  <div class="footer navbar-fixed-bottom mt-5"><center>
       <kbd> Centro Fitness © <?php echo date("20"."y");  ?> </kbd>
    </center></div>

     <!-- footer -->
</html>