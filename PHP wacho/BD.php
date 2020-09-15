<?php
	//funcion que conecta a la base de datos
	function conexion(){
		$link=mysqli_connect('localhost','root','','thewall') or die ("Error".mysqli_error($link));
		return $link; 
	}

 ?>