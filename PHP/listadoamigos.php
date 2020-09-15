<?php if(!session_id()){session_start();}
include "autenticador.php";
 $autenticador= new autenticador();
	try{
		$autenticador->autenticado();
	}catch(Exception $e){
		$_SESSION["error"]= $e->getMessage();
		header("location:index.php");
		exit;
	} ?>
<!DOCTYPE html>
<html>
<?php include "head.php"; ?>
<body>
	<?php include"header.php" ?>
	<div class="buscador">
			<form action="listadoamigos.php" method="POST">		
				<input type="text" name="buscar" id="buscar" placeholder="Buscar usuario"  value='<?php if(!empty( $_POST['buscar'])){
					echo $_POST['buscar'];
					}else if(!empty($_GET['buscar'])){
						echo $_GET['buscar'];
					}else {
						echo "";
					}?>'><button type="submit" title="Buscar"></button>
			</form>
		</div>
	 <?php include "mimenu.php" ?>
	 <?php include"modelo.php" ;?>
	 <div class="tabla-conteiner">
	 	<p>Coincidencias de la Busqueda</p>
	 	<hr>
	 	<div>
	 		<table>
	 			<tr>
	 				<th><legend>Nombre y Apellido </legend> </th>
	 				<th> <legend> Usuario </legend></th>
	 				<th> <legend> Email </legend></th>
	 				<th><img src="reanudar.svg"></th>
	 				<th><img src="seguidores.svg"></th>
	 			</tr>	
	 			<?php
	 			$idUser=$_SESSION['usuario']['id'];
	 			if(!empty($_POST['buscar'])){
	 				$cadena=$_POST['buscar'];
	 			}else if(!empty($_GET['buscar'])){
	 				$cadena=$_GET['buscar'];
	 			}else
	 				$cadena='';
	 			
	 			$coincidencias=buscarUsers($cadena);
	 			while($row=mysqli_fetch_array($coincidencias)){?>		
	 			<tr>
	 				<td><?php echo $row['nombre']; echo $row['apellido']; ?></td>
	 				<td><?php echo $row['nombreusuario']; ?></td>
	 				<td><?php echo $row['email']; ?></td>
	 				<?php if($row['id']==$_SESSION['usuario']['id']){ ?>
	 					<td><a href="miperfil.php?id=<?php echo $row['id'];?>" type="image"><img class="imagen-boton" src="adelante.svg" title="Visitar Perfil"></a></td>
	 				<?php }else{ ?>
	 						<td><a href="superfil.php?id=<?php echo $row['id'];?>" type="image"><img class="imagen-boton" src="adelante.svg" title="Visitar Perfil"></a></td>
	 					<?php } ?>
	 				<?php  
	 				$result=follow($row['id']); 
					if(mysqli_num_rows($result)==0){	 ?>
					<td><a href="seguirAmigo.php?id=<?php echo $row['id']; ?>&ok=0&cadena=<?php echo $cadena ?>"><img class="imagen-boton" src="seguir.svg" title="Seguir Usuario"></a></td>
					<?php }else{ ?>
						<td><a href="eliminarAmigo.php?id=<?php echo $row['id']; ?>&ok=0&cadena=<?php echo $cadena ?>"><img class="imagen-boton" src="usuario.svg" title="Eliminar Usuario"></a></td>
					<?php } ?>					
	 			<?php } ?>
	 		</table>
	 	</div>
	 </div>

	<?php include"footer.php" ?>

</body>
</html>