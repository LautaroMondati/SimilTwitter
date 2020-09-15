<?php 
		include"BD.php";
		$id=$_GET['id'];
		$link=conexion(); 	
		$query="select foto_contenido,foto_tipo
				from usuarios u
				where u.id=$id";
		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
		header("Content-type:".$row['foto_tipo']);
		echo($row['foto_contenido']);
		include"desconexion.php";
	
 ?>
