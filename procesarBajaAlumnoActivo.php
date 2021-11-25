<?php

date_default_timezone_set("America/Argentina/Buenos_Aires");

include("mostrarUsuario.php"); 

include("conexion.php");

$dni=htmlentities(addslashes($_POST["dni"]));

$nombre=htmlentities(addslashes($_POST["nombre"]));

$apellido=htmlentities(addslashes($_POST["apellido"]));

$edad=htmlentities(addslashes($_POST["edad"]));

$telefono=htmlentities(addslashes($_POST["tel"]));

$nacimiento=htmlentities(addslashes($_POST["nacimiento"]));

$fechaInscipcion=htmlentities(addslashes($_POST["inscripcion"]));

$actividad=htmlentities(addslashes($_POST["actividad"]));

$estado=htmlentities(addslashes($_POST["estado"]));

$fechaBaja=date("Y-m-d");

$descripcion=htmlentities(addslashes($_POST["descripcion"]));

$observacion=htmlentities(addslashes($_POST["observacion"]));

$instructor=htmlentities(addslashes($_POST["instructor"]));


$sql="INSERT INTO ALUMNOSBAJA (DNI, NOMBRE, APELLIDO , EDAD , fechaNacimiento, fechaInscripcion, ACTIVIDAD, TELEFONO, ESTADO, fechaBaja, DESCRIPCION,OBSERVACION,INSTRUCTOR) 
VALUES ('$dni', '$nombre', '$apellido'  ,'$edad', '$nacimiento', '$fechaInscipcion', '$actividad', '$telefono', '$estado', '$fechaBaja', '$descripcion','$observacion','$instructor' )";

$insertar=mysqli_query($miconexion,$sql);

if(mysqli_affected_rows($miconexion)){


    $sqlDelete="DELETE FROM ALUMNOSACTIVO WHERE DNI = '$dni' ";

    $eliminar=mysqli_query($miconexion,$sqlDelete);

    header("Location:\centrofitness\allalumnosbaja.php");


}else{

    echo "error al dar baja";


}


/*  evento  */ 



$fechaEvento=date("Y-m-d H:i:s");

$nombreAlumno=$nombre." ".$apellido;

$evento="dar de baja alumno activo";

$sqlEvento="INSERT INTO EVENTOS (USUARIO,EVENTO,ALUMNO,FECHAEVENTO) VALUES('$nombreUsuario','$evento','$nombreAlumno','$fechaEvento')";

$insertarEvento=mysqli_query($miconexion,$sqlEvento);



/* evento  */ 


mysqli_close($miconexion);










?>