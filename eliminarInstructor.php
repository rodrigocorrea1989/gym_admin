<?php
	include("mostrarUsuario.php"); 

	$dni=$_GET["dni"];

	$nombre=$_GET["nombre"];

	$apellido=$_GET["apellido"];
	
	require ("conexion.php");

	mysqli_set_charset($miconexion,"utf8");

	$sql="DELETE FROM INSTRUCTORES WHERE  DNI =' $dni' ";

    $registro=mysqli_query($miconexion,$sql);

    header("Location:\centrofitness\allinstructors.php");

	
	/*  evento  */ 

	date_default_timezone_set("America/Argentina/Buenos_Aires");

	$fechaEvento=date("Y-m-d H:i:s");

	$nombreInstructor=$nombre." ".$apellido;

	$evento="eliminar instructor";

	$sqlEvento="INSERT INTO EVENTOS (USUARIO,EVENTO,ALUMNO,FECHAEVENTO) VALUES('$nombreUsuario','$evento','$nombreInstructor','$fechaEvento')";

	$insertarEvento=mysqli_query($miconexion,$sqlEvento);



/* evento  */ 
	
	mysqli_close($miconexion);
	

?>