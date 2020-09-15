<?php
  if(!session_id()){session_start();}
	include"autenticador.php";
	try{
	 $autenticado= new autenticador(); 
		$autenticado->autenticado();
		
	}
	catch(Exception $e){
		$_SESSION['error']='Debe iniciar sesion';
		header('location:index.php');
	}	
	?>
<!DOCTYPE html>
<html>
	<?php include "head.php"; ?>
<body>
	<?php include"header.php"; ?>
	 <?php include "mimenu.php" ;?>
	 <?php include"modelo.php" ;?>
	 <div class="tabla-conteiner">
	 	<p>Mis Amigos</p>
	 	<hr>
	 	<div>
	 		<table>
	 			<tr>
	 				<th><legend>Nombre y Apellido </legend> </th>
	 				<th> <legend> Usuario </legend></th>
	 				<th> <legend> Email </legend></th>
	 				<th><legend>Ir a Perfil</legend></th>
	 				<th><img src="seguidores.svg"></th>
	 			</tr>
	 			<?php
	 			$amigos=getAmigos($_SESSION['usuario']['id']);
	 			while($row=mysqli_fetch_array($amigos)){?>		
	 			<tr>
	 				<td><?php echo $row['nombre']; echo $row['apellido']; ?></td>
	 				<td><?php echo $row['nombreusuario']; ?></td>
	 				<td><?php echo $row['email']; ?></td>
	 				<td><a href="superfil.php?id=<?php echo $row['id'];?>" type="image"><img class="imagen-boton" src="adelante.svg" title="Visitar Perfil"></a></td>
	 				<td><a href="eliminarAmigo.php?id=<?php echo $row['id']; ?>&ok=2"><img class="imagen-boton" src="usuario.svg" title="Eliminar Usuario" onclick="return confirm('¿Desea dejar de seguir al usuario?');"></a></td>
	 			<?php } ?>
	 		</table>
	 	</div>
	 </div>

	<?php include"footer.php" ?>
</body>
</html>