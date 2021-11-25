
<?php include("conexion.php"); 

session_start();

if(!$_SESSION['usuario']){

  header("location:\centrofitness\acceso.php");

}


?>



<h4 class="text-primary text-weight-bold font-italic"><br>Instructor/a: <?php 


$usuario=$_SESSION["usuario"]; 

$sql="SELECT * FROM INSTRUCTORES WHERE DNI = $usuario";

if($resultado=mysqli_query($miconexion,$sql)){

  while($registro=mysqli_fetch_assoc($resultado)){


    $nombreUsuario=$registro["nombre"]." ".$registro["apellido"];

    $privilegio=$registro["privilegio"];

    echo $nombreUsuario;


  }

  

}




?>
</h4>