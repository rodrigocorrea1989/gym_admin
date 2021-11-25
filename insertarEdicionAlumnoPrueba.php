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
    
    
    <title>Insertar Edicion Alumno a Prueba</title>
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

$dni=htmlentities(addslashes($_POST["dni"]));

/* obtener imagen  */

$sqlimg="SELECT * FROM IMAGENES WHERE DNI='$dni'";

if($resultadoimg=mysqli_query($miconexion, $sqlimg)){

while($registroimg=mysqli_fetch_assoc($resultadoimg)){

 $imagen1=$registroimg["img1"];
 $imagen2=$registroimg["img2"];
 $imagen3=$registroimg["img3"];
 $imagen4=$registroimg["img4"];

}

} 

/* obtener imagen  */

$nombre=htmlentities(addslashes($_POST["nombre"]));

$apellido=htmlentities(addslashes( $_POST["apellido"]));

$edad=htmlentities(addslashes( $_POST["edad"]));

$tel=htmlentities(addslashes($_POST["tel"])) ;

$nacimiento=htmlentities(addslashes($_POST["nacimiento"])) ;

$fecha=htmlentities(addslashes($_POST["inscripcion"])) ;

$actividad=htmlentities(addslashes($_POST["actividad"])) ;

$latinFecha=date("d-m-Y", strtotime($fecha));

$latinFechaNacimiento=date("d-m-Y", strtotime($nacimiento));

$upload="img/";

$sql="UPDATE ALUMNOSPRUEBA SET NOMBRE='$nombre' , APELLIDO='$apellido' , EDAD='$edad', TELEFONO='$tel' , fechaNacimiento='$nacimiento', fechaInscripcion=
'$fecha', ACTIVIDAD='$actividad' WHERE DNI='$dni' ";

$insertar=mysqli_query($miconexion,$sql);

if(mysqli_affected_rows($miconexion)){


   echo  '<center><h2 class="text-success">Se ha actualizado correctamente</h2></center>';


}else{


    echo '<center><h2 class="text-danger">ERROR</h2></center>';


}




?>




    <div class="container">


        <table class="table table-success mt-5">
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
             
        
    
        </table>



    </div>





<?php
         /*  evento  */ 

         date_default_timezone_set("America/Argentina/Buenos_Aires");

         $fechaEvento=date("Y-m-d H:i:s");
       
         $nombreAlumno=$nombre." ".$apellido;
       
         $evento="editar alumno a prueba";
       
         $sqlEvento="INSERT INTO EVENTOS (USUARIO,EVENTO,ALUMNO,FECHAEVENTO) VALUES('$nombreUsuario','$evento','$nombreAlumno','$fechaEvento')";
       
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
    
            $fotoPerfil=$_FILES["fotoperfil"]["name"];
    
    
        }else{
    
            echo "ERROR!! la  segunda no se pudo copiar al directorio<br>" ;
    
            $fotoPerfil=$imagen1;  
    
        }
        
        //foto de perfil
    
         //imagen 2
    
         if(isset($_FILES["img2"]["name"])  && ($_FILES["img2"]["error"] == 
                
         UPLOAD_ERR_OK ) ){
     
             move_uploaded_file(   $_FILES["img2"]["tmp_name"]  ,  $upload.$_FILES["img2"]["name"] );
     
             echo "la imagen: ".$_FILES["img2"]["name"]. " se ha copiado correctamente<br>";
    
             $img2=$_FILES["img2"]["name"];
     
     
         }else{
     
             echo "ERROR!! la  segunda no se pudo copiar al directorio<br>" ;
    
             $img2=$imagen2;
     
         }
         
         //imagen 2
    
            //imagen 3
    
            if(isset($_FILES["img3"]["name"])  && ($_FILES["img3"]["error"] == 
                
            UPLOAD_ERR_OK ) ){
        
                move_uploaded_file(   $_FILES["img3"]["tmp_name"]  ,  $upload.$_FILES["img3"]["name"] );
        
                echo "la imagen: ".$_FILES["img3"]["name"]. " se ha copiado correctamente<br>";
    
                $img3=$_FILES["img3"]["name"];
        
        
            }else{
        
                echo "ERROR!! la  segunda no se pudo copiar al directorio<br>" ;
    
                $img3=$imagen3;
        
            }
            
            //imagen 3
    
     //imagen 4
    
     if(isset($_FILES["img4"]["name"])  && ($_FILES["img4"]["error"] == 
                
     UPLOAD_ERR_OK ) ){
    
         move_uploaded_file(   $_FILES["img4"]["tmp_name"]  ,  $upload.$_FILES["img4"]["name"] );
    
         echo "la imagen: ".$_FILES["img4"]["name"]. " se ha copiado correctamente<br>";
    
         $img4=$_FILES["img4"]["name"];
    
    
     }else{
    
         echo "ERROR!! la  segunda no se pudo copiar al directorio<br>" ;
    
         $img4=$imagen4;
    
     }
     
     //imagen 4       
    

$sqlImg="UPDATE imagenes SET img1='$fotoPerfil' , img2='$img2' , img3='$img3', img4='$img4' WHERE dni='$dni'  ";
    
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


