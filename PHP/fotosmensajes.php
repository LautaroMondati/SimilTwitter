<?php 

	include"BD.php";
		$id=$_GET['id'];
		$link=conexion(); 	
		$query="select imagen_contenido,imagen_tipo
				from mensaje m
				where m.id='$id'";
		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
		header("Content-type:".$row['imagen_tipo']);
		echo($row['imagen_contenido']);
		include "desconexion.php";
 ?>
