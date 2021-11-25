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
    <title>Alertas</title>

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
    <?php   include("mostrarUsuario.php");  ?>
    
    <center> <h2 class="text-warning font-weight-bold font-capitalize">Alerta Próximos Vencimientos</h2></center><br>

<div class="container">
    <table class="table table-warning table-striped mt-5">
        <thead class="thead-dark">
        <tr>
            <th scope="col">DNI</th>
            <th scope="col">NOMBRE/ APELLIDO</th>
            <th scope="col">ACTIVIDAD</th> 
            <th scope="col">TELEFONO</th> 
            <th scope="col">PRÓXIMO VENCIMIENTO</th> 
            <th scope="col">DÍAS RESTANTES</th> 
            <th scope="col">INFORMAR</th> 

      </tr>
    </thead>
    <tbody>        
</div>
    <?php

if(isset($_GET["dni"])){

  $dni=htmlentities(addslashes($_GET["dni"]));     
  
  }else{
  
  $dni="";   
  
  } 

    
    include("conexion.php");

    date_default_timezone_set("America/Argentina/Buenos_Aires");

    $fechaHoy=date("Y-m-d");

    if($privilegio=="instructor"){

    $sql="SELECT * FROM ALUMNOSACTIVO WHERE INSTRUCTOR = '$nombreUsuario' AND DNI LIKE '%$dni%'";

    }else if($privilegio=="admin"){

      $sql="SELECT * FROM ALUMNOSACTIVO WHERE DNI LIKE '%$dni%'";

    }

    if($resultado=mysqli_query($miconexion,$sql)){

        while($registro=mysqli_fetch_assoc($resultado)){

            $proximoVencimiento=date("Y-m-d",strtotime($registro["proximoVencimiento"])); 

            $alertaVencimiento=date("Y-m-d",strtotime($proximoVencimiento."- 3 days")); 

            $latinFecha=date("d-m-Y", strtotime($registro["proximoVencimiento"]));

            $restarVencimiento=date("d",strtotime($registro["proximoVencimiento"])); 

            $restarHoy=date("d",strtotime($fechaHoy)); 

            $diasRestantes=$restarVencimiento-$restarHoy;

            $telefono=$registro["telefono"];

            if($fechaHoy>=$alertaVencimiento && $fechaHoy<$proximoVencimiento){


    ?>           


<tr>
            <th scope="row"><?php  echo  $registro["dni"]   ?></th>
            <td><?php  echo  $registro["nombre"]." ". $registro["apellido"] ?></td>
            <td><?php  echo  $registro["actividad"]  ?></td>
            <td><?php  echo  $registro["telefono"] ?></td>
            <td><?php  echo  $latinFecha ?></td>
            <td><?php  echo  "Faltan ".$diasRestantes." Día/Días" ?></td>
            <td><center><a href="https://wa.me/<?php echo $telefono ?>/?text=Desde centro fitness le informamos que su cuota vence en <?php echo $diasRestantes  ?> día/días, por favor no espera el vencimiento para acercarse a abonar, muchas gracias" target="_Blank" class="btn btn-success text-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                   <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg> </a> </center>  </td>
            
        </tr>



     
     <?php           

            }
          
        }


      } 

      mysqli_close($miconexion);
    

    ?>




</body>
<!-- footer -->
<br><br><br>
  <div class="footer navbar-fixed-bottom mt-5"><center>
       <kbd> Centro Fitness © <?php echo date("20"."y");  ?> </kbd>
    </center></div>

     <!-- footer -->
</html>   