<?php

$miconexion=mysqli_connect("localhost","centrofitness","centrofitness","centroFitness");

mysqli_set_charset($miconexion,"utf8");


	//comprobar conexión
	
	if(!$miconexion){
		
		echo "<kbd>no hay conexión ".mysqli_error()."</kbd>";
		
		exit();
		
            
        }


?>