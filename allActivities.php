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
    <title>Ver Actividades</title>
    <script>

function confirmar(){
var respuesta=confirm("¿Esta seguro que desea Eliminar la actividad?");
if (respuesta == false){
event.preventDefault();
}  
}
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
     <?php include("mostrarUsuario.php");  ?>
    <!-- Contenido  -->
    <?php 
    
        include("conexion.php");

      
    
    ?>

    <div class="container">
   

           <center> <h2 class="text-primary font-weight-bold font-capitalize">Todas las actividades</h2></center>

            <table class="table mt-5">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">ACTIVIDAD</th>
                    <th scope="col">INSTRUCTOR/A</th>
                    <th scope="col">FECHA DE INICIO DE ACTIVIDAD</th>
                    <th scope="col">COSTO</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

        <?php



            $sql="SELECT * FROM ACTIVIDAD ";

            
            if($resultado=mysqli_query($miconexion,$sql)){

            while($registro=mysqli_fetch_assoc($resultado)){

            $latinFecha=date("d-m-Y", strtotime($registro["fechaAlta"]));    
            
            $id=$registro["id"];
            

        ?>

        
                  <tr>
                    <th scope="row"><?php  echo  $registro["nombre"]   ?></th>
                    <td><?php  echo  $registro["instructor"] ?></td>
                    <td><?php  echo  $latinFecha ?></td>
                    <td><?php  echo  "$ ".$registro["costo"] ?></td>
                    <td><a class="btn btn-danger text-light" onclick="confirmar();" href="\centrofitness\eliminarActividad.php?id=<?php echo $id ?>&nombreActividad=<?php echo $registro["nombre"]   ?>">ELIMINAR</a></td>
                    <td><a class="btn btn-success text-light" href="\centrofitness\editarActividad.php?id=<?php echo $id ?>">EDITAR</a></td>
                  </tr>
               


        <?php
                }
            }
            
            mysqli_close($miconexion);
        

        ?>


            </tbody>
              </table>    
                    </div>




    <!-- cierre de Contenido  -->
    
</body>
<!-- footer -->
<br><br><br>
  <div class="footer navbar-fixed-bottom mt-5"><center>
       <kbd> Centro Fitness © <?php echo date("20"."y");  ?> </kbd>
    </center></div>

     <!-- footer -->
</html>