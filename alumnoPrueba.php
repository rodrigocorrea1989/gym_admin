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
    
    
    <title>Alumno prueba</title>
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

$actividad=htmlentities(addslashes($_POST["actividad"])) ;

/*  obtener instructor */

$sqlInstructor="SELECT * FROM ACTIVIDAD WHERE NOMBRE = '$actividad'";

if($resultadoInstructor=mysqli_query($miconexion,$sqlInstructor)){

  while($registroInstructor=mysqli_fetch_assoc($resultadoInstructor)){

    $instructor=$registroInstructor["instructor"];


  }
}


/* obtener instructor */



date_default_timezone_set("America/Argentina/Buenos_Aires");

$fechaHoy=date("Y-m-d");

$proximoVencimiento=date("Y-m-d",strtotime($fechaHoy."+ 1 month")); 

$dni=htmlentities(addslashes($_POST["dni"]));

$nombre=htmlentities(addslashes($_POST["nombre"]));

$apellido=htmlentities(addslashes( $_POST["apellido"]));

$edad=htmlentities(addslashes( $_POST["edad"]));

$tel=htmlentities(addslashes($_POST["tel"])) ;

$nacimiento=htmlentities(addslashes($_POST["nacimiento"])) ;

$fecha=htmlentities(addslashes($_POST["inscripcion"])) ;

$estado="prueba";

$estadoActivo="activo";

$latinFecha=date("d-m-Y", strtotime($fecha));

$latinFechaNacimiento=date("d-m-Y", strtotime($nacimiento));

$submit=$_POST["estado"];

$mesesConsumidos=1;

$mesesPagados=1;

$observacion=htmlentities(addslashes($_POST["observacion"])) ;

$upload="img/";





/*  comparar usuario multiple en bd alumonsactivo  */

$sql="SELECT * FROM alumnosactivo ";

if($resultado=mysqli_query($miconexion,$sql)){

while($registro=mysqli_fetch_assoc($resultado)){


      $dniAlumnoActivo=$registro["dni"];

}

}

/*  comparar usuario multiple en bd alumonactivo   */


/*  comparar usuario multiple en bd alumonsprueba  */

$sql="SELECT * FROM alumnosprueba";

if($resultado=mysqli_query($miconexion,$sql)){

while($registro=mysqli_fetch_assoc($resultado)){


      $dniAlumnoPrueba=$registro["dni"];

}

}

/*  comparar usuario multiple en bd alumonsprueba  */
 



if($submit=="Registrar alumno a prueba"){

if ($dni==$dniAlumnoActivo){

  echo "<script> alert('Alumno ya esta registrado como \"alumno activo\" ') </script>";


} else { 


$sql="INSERT INTO ALUMNOSPRUEBA (dni , nombre , apellido , edad , fechaNacimiento , fechaInscripcion , actividad , telefono , estado, observacion,instructor) VALUES 
                                ('$dni','$nombre','$apellido','$edad','$nacimiento','$fecha','$actividad','$tel','$estado','$observacion','$instructor')";

$insertar=mysqli_query($miconexion,$sql);

if(mysqli_affected_rows($miconexion)){

    echo "<div class='container mt-3'>";
    echo "<br><center><h2 class='text-success text-capitalize font-weight-bold font-italic'>se ha insertado correctamente \" un alumno a prueba\"</h2></center>";
    echo "</div>";


}else{
    
    echo "error al insertar";

}   

}

} else if ($submit=="Registrar alumno activo") {

  if ($dni==$dniAlumnoPrueba){

    echo "<script> alert('Alumno ya esta registrado como \"alumno a prueba\" ') </script>";

  }else{

  $sql="INSERT INTO ALUMNOSACTIVO (dni , nombre , apellido , edad , fechaNacimiento , fechaInscripcion , actividad , telefono , estado, mesesConsumidos,mesesPagados,proximoVencimiento,observacion,instructor) VALUES 
                                ('$dni','$nombre','$apellido','$edad','$nacimiento','$fecha','$actividad','$tel','$estadoActivo','$mesesConsumidos','$mesesPagados','$proximoVencimiento','$observacion','$instructor')";

$insertar=mysqli_query($miconexion,$sql);

if(mysqli_affected_rows($miconexion)){

  echo "<div class='container mt-3'>";
  echo "<br><center><h2 class='text-primary text-capitalize font-weight-bold font-italic'>se ha insertado correctamente \" un alumno activo\"</h2></center>";
  echo "</div>";

  /*  registrar pago   */

  $sqlMonto="SELECT * FROM ACTIVIDAD WHERE NOMBRE = '$actividad'";

  $monto=0;

if($resultadoMonto=mysqli_query($miconexion,$sqlMonto)){

  while($registroMonto=mysqli_fetch_assoc($resultadoMonto)){

      $monto=$registroMonto["costo"];

    }
   
  } 


$sqlRegistroPago="INSERT INTO PAGOS (dni,nombre,apellido,telefono,fechaPago,monto,actividad) VALUES ('$dni','$nombre','$apellido','$tel','$fechaHoy','$monto','$actividad')";

$insertarRegistroPago=mysqli_query($miconexion,$sqlRegistroPago);


  /* registrar pago  */
  

}else{
    
    echo "error al insertar";

}   

}
  
}

?>




    <div class="container">

        <table class="table table-primary mt-5">
            <tr>
                <th><center><p class="text-dark">Dni</p> <p class="text-danger font-weight-bold"> <?php echo $dni ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Nombre y Apellido </p> <p class="text-danger font-weight-bold"> <?php echo $nombre." ".$apellido ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Edad </p> <p class="text-danger font-weight-bold"> <?php echo $edad ?> </p></center> </th> 
             </tr>
             <tr>
                <th><center><p class="text-dark">Teléfono </p> <p class="text-danger font-weight-bold"> <?php echo $tel ?> </p></center> </th> 
             </tr>
             <tr>
                <th><center><p class="text-dark">Fecha De Nacimiento </p> <p class="text-danger font-weight-bold"> <?php echo $latinFechaNacimiento ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Fecha de Inscripción</p> <p class="text-danger font-weight-bold"> <?php echo $latinFecha ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Actividad</p> <p class="text-danger font-weight-bold"> <?php echo $actividad ?> </p></center> </th>
             </tr>
             <tr>
                <th><center><p class="text-dark">Observación</p> <p class="text-danger font-weight-bold"> <?php echo $observacion?> </p></center> </th>
             </tr>
             
        
    
        </table>



    </div>





<?php

 /*  evento  */ 

$fechaEvento=date("Y-m-d H:i:s");

$nombreAlumno=$nombre." ".$apellido;

$sqlEvento="INSERT INTO EVENTOS (USUARIO,EVENTO,ALUMNO,FECHAEVENTO) VALUES('$nombreUsuario','$submit','$nombreAlumno','$fechaEvento')";

$insertarEvento=mysqli_query($miconexion,$sqlEvento);




/* evento  */

$fotoPerfil="";

$img2="";

$img3="";

$img4="";



    //foto de perfil

    if(isset($_FILES["fotoperfil"]["name"])  && ($_FILES["fotoperfil"]["error"] == 
			
    UPLOAD_ERR_OK ) ){

        move_uploaded_file(   $_FILES["fotoperfil"]["tmp_name"]  ,  $upload.$_FILES["fotoperfil"]["name"] );

        echo "la imagen: ".$_FILES["fotoperfil"]["name"]. " se ha copiado correctamente<br>";


    }else{

        echo "ERROR!! la  segunda no se pudo copiar al directorio<br>" ;

    }
    
    //foto de perfil

     //imagen 2

     if(isset($_FILES["img2"]["name"])  && ($_FILES["img2"]["error"] == 
			
     UPLOAD_ERR_OK ) ){
 
         move_uploaded_file(   $_FILES["img2"]["tmp_name"]  ,  $upload.$_FILES["img2"]["name"] );
 
         echo "la imagen: ".$_FILES["img2"]["name"]. " se ha copiado correctamente<br>";
 
 
     }else{
 
         echo "ERROR!! la  segunda no se pudo copiar al directorio<br>" ;
 
     }
     
     //imagen 2

        //imagen 3

        if(isset($_FILES["img3"]["name"])  && ($_FILES["img3"]["error"] == 
			
        UPLOAD_ERR_OK ) ){
    
            move_uploaded_file(   $_FILES["img3"]["tmp_name"]  ,  $upload.$_FILES["img3"]["name"] );
    
            echo "la imagen: ".$_FILES["img3"]["name"]. " se ha copiado correctamente<br>";
    
    
        }else{
    
            echo "ERROR!! la  segunda no se pudo copiar al directorio<br>" ;
    
        }
        
        //imagen 3

 //imagen 4

 if(isset($_FILES["img4"]["name"])  && ($_FILES["img4"]["error"] == 
			
 UPLOAD_ERR_OK ) ){

     move_uploaded_file(   $_FILES["img4"]["tmp_name"]  ,  $upload.$_FILES["img4"]["name"] );

     echo "la imagen: ".$_FILES["img4"]["name"]. " se ha copiado correctamente<br>";


 }else{

     echo "ERROR!! la  segunda no se pudo copiar al directorio<br>" ;

 }
 
 //imagen 4       


$fotoPerfil=$_FILES["fotoperfil"]["name"];

$img2=$_FILES["img2"]["name"];

$img3=$_FILES["img3"]["name"];

$img4=$_FILES["img4"]["name"];



$sqlImg="INSERT INTO IMAGENES (DNI,IMG1,IMG2,IMG3,IMG4) VALUES('$dni','$fotoPerfil','$img2','$img3','$img4')";

     
$insertarImg=mysqli_query($miconexion,$sqlImg);



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


