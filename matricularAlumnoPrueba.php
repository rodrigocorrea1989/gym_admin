<?php

include("mostrarUsuario.php");

include("conexion.php");

$dni=$_GET["dni"];

$sql="SELECT * FROM ALUMNOSPRUEBA WHERE DNI='$dni'";

if($insertar=mysqli_query($miconexion, $sql)){

while($registro=mysqli_fetch_assoc($insertar)){

    date_default_timezone_set("America/Argentina/Buenos_Aires");

    $fechaHoy=date("Y-m-d");

    $proximoVencimiento=date("Y-m-d",strtotime($fechaHoy."+ 1 month")); 

    $nombre=$registro["nombre"];

    $apellido=$registro["apellido"];

    $edad=$registro["edad"];

    $fechaNacimiento=$registro["fechaNacimiento"];

    $fechaInscripcion=$registro["fechaInscripcion"];

    $actividad=$registro["actividad"];

    $telefono=$registro["telefono"];

    $observacion=$registro["observacion"];

    $instructor=$registro["instructor"];

    $estado="activo";

    $mesesConsumidos=1;

    $mesesPagados=1;



}

}


$sqlInsertar="INSERT INTO ALUMNOSACTIVO (DNI,NOMBRE,APELLIDO,EDAD,fechaNacimiento,fechaInscripcion,ACTIVIDAD,INSTRUCTOR,TELEFONO,ESTADO,mesesConsumidos,mesesPagados,proximoVencimiento,observacion) 

VALUES ('$dni','$nombre', '$apellido','$edad','$fechaNacimiento','$fechaHoy', '$actividad','$instructor', '$telefono', '$estado','$mesesConsumidos','$mesesPagados','$proximoVencimiento','$observacion')";


$insertar2=mysqli_query($miconexion,$sqlInsertar);

if(mysqli_affected_rows($miconexion)){

    $sqlDelete="DELETE FROM ALUMNOSPRUEBA WHERE  DNI =' $dni' ";

    $registro2=mysqli_query($miconexion,$sqlDelete);

    /*  registrar pago   */

        $sqlMonto="SELECT * FROM ACTIVIDAD WHERE NOMBRE = '$actividad'";

        $monto=0;

        if($resultadoMonto=mysqli_query($miconexion,$sqlMonto)){

    while($registroMonto=mysqli_fetch_assoc($resultadoMonto)){

    $monto=$registroMonto["costo"];

  }
 
} 


$sqlRegistroPago="INSERT INTO PAGOS (dni,nombre,apellido,telefono,fechaPago,monto,actividad,usuario) VALUES ('$dni','$nombre','$apellido','$telefono','$fechaHoy','$monto','$actividad','$nombreUsuario')";

$insertarRegistroPago=mysqli_query($miconexion,$sqlRegistroPago);


/* registrar pago  */

    header("Location:\centrofitness\allalumnosprueba.php");


}else{
    
    echo "ERRAR AL MATRICULAR" ;

}   

         /*  evento  */ 

         date_default_timezone_set("America/Argentina/Buenos_Aires");

         $fechaEvento=date("Y-m-d H:i:s");
     
         $nombreAlumno=$nombre." ".$apellido;
     
         $evento="matricular alumno a prueba";
     
         $sqlEvento="INSERT INTO EVENTOS (USUARIO,EVENTO,ALUMNO,FECHAEVENTO) VALUES('$nombreUsuario','$evento','$nombreAlumno','$fechaEvento')";
     
         $insertarEvento=mysqli_query($miconexion,$sqlEvento);
     
     
     
     /* evento  */ 




mysqli_close($miconexion);

?>