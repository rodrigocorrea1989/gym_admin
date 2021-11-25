<?php
	include("mostrarUsuario.php"); 

	$id=$_GET["id"];

	$nombreActividad=$_GET["nombreActividad"];
	
	require ("conexion.php");

	mysqli_set_charset($miconexion,"utf8");

	$sql="DELETE FROM ACTIVIDAD WHERE  id =' $id' ";

    $registro=mysqli_query($miconexion,$sql);

    header("Location:\centrofitness\allActivities.php");

	
        /*  evento  */ 

	    date_default_timezone_set("America/Argentina/Buenos_Aires");

	    $fechaEvento=date("Y-m-d H:i:s");

	    $evento="eliminar actividad";

	    $sqlEvento="INSERT INTO EVENTOS (USUARIO,EVENTO,ALUMNO,FECHAEVENTO) VALUES('$nombreUsuario','$evento','$nombreActividad','$fechaEvento')";

	    $insertarEvento=mysqli_query($miconexion,$sqlEvento);

    /* evento  */
	
	mysqli_close($miconexion);
	

?>