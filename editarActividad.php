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

    <script>

function confirmar(){
var respuesta=confirm("¿Esta seguro que desea Editar la Actividad?");
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
                  <a class="nav-link" href="\centrofitness\index.php">Página Principal <span class="sr-only">(current)</span></a>
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

    $id=$_GET["id"];

    $sql2="SELECT * FROM ACTIVIDAD WHERE ID = '$id' ";

                if($resultado2=mysqli_query($miconexion,$sql2)){

                  while($registro2=mysqli_fetch_assoc($resultado2)){

                   $instructor=$registro2["instructor"];

                   $nombre=$registro2["nombre"];

                   $costo=$registro2["costo"];

                  }
                }
              
    ?>

  
        
        <h2 class="text-success text-center font-weight-bold font-italic mt-5">Editar Actividad</h2>    
    <!-- comienzo el formulario -->  
    <center>
    <div class="col-md-8 col-lg-6 mt-5">
        <form action="insertarEdicionActividad.php" method="POST">
        <div class="form-group">
          <label class="text-primary" for="formGroupExampleInput">Nombre de la actividad</label>
          <input  type="text" value="<?php echo $nombre ?>" name="nombreActividad" class="form-control mt-3 text-success" id="formGroupExampleInput" placeholder="Funcional" required readonly>
        </div>
        <div class="form-group">
            <label for="inputState" class="text-primary">Instructor/a Entrenador/a</label>
            <select id="inputState" name="nombreInstructor" class="form-control text-success">
                <option selected><?php echo $instructor ?></option>
              <?php   
                    

                $sql="SELECT * FROM INSTRUCTORES ";

                if($resultado=mysqli_query($miconexion,$sql)){

                  while($registro=mysqli_fetch_assoc($resultado)){

                    echo " <option>".$registro['nombre']." ".$registro['apellido']."</option>";

                  }
                }
                
              
              ?>
               

            </select>
           </div> 

           <div class="form-group">
          <label class="text-primary" for="formGroupExampleInput">$ Costo</label>
          <input  type="number" value="<?php echo $costo ?>" name="costoActividad" class="form-control mt-3 text-success" id="formGroupExampleInput" placeholder="3500" required>
        </div>

        <?php 
        
          mysqli_close($miconexion);
        
        ?>
          
        <button type="submit" class="btn btn-success mt-3" onclick="confirmar();">Editar Actividad</button>
      </form>
    <div>
      
    <center><a class="btn btn-primary text-capitalize text-light mt-5" href="\centrofitness\allActivities.php">Ver todas las actividades</a></center>
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