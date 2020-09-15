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
	<script type="text/javascript" src="validar-mensaje.js"></script> 

<body>
		<?php include "modelo.php" ;?> 
		<?php include "header.php"; ?>
		<?php $suId=$_GET['id']; ?>
		<?php $PerfilAmigo=getPerfilAmigo($_GET['id']);
		$row=mysqli_fetch_array($PerfilAmigo);?>

		<div class="navigation">
		 	<input type="checkbox" name="">
		 	<span></span>
		 	<label>Menu: </label>
		 	<span></span>
		 	<ul class="menu">
		 		<li><a href="miperfil.php">Mi Perfil</a></li>
		 		<li><a href="mimuro.php">Mi Muro</a></li>
		 		<li><a href="cerrarSesion.php">Cerrar sesion</a></li>
			</ul>
	</div>
	<aside class="conteiner-miperfil">
			<p> Perfil de</p>
			<?php if(empty($row['foto_contenido'])) {?>
				<img src="perfil-vacio.jpg">
			<?php }else{?>
				<img  src="fotos.php?id=<?php echo $row['id'];?>">
			<?php } ?>
			<div class="datos-perfil">		
				<ul>
					<li type="disc"><p>Nombre:<?php echo $row['nombre']; ?></p></li>
					<li type="disc"><p>Apellido: <?php echo $row['apellido']; ?></p></li>
					<li type="disc"><p><?php echo $row['email']; ?></p></li>
					<?php
					$result=follow($row['id']); 
					if(mysqli_num_rows($result)==0){ ?>
					<li><button class="Boton" onclick="location.href='seguirAmigo.php?id=<?php echo $row['id']; ?>&ok=1'">Seguir</button></li>
					<?php }else{ ?>
					<li><button class="Boton" onclick="location.href='eliminarAmigo.php?id=<?php echo $row['id']; ?>&ok=1'">Dejar de Seguir</button></li>
					<?php } ?>
				</ul>								
			</div>
	</aside>
	<?php
  			$cantidad_de_resultados=10;
			if(empty($_GET['pagina'])){
				$pagina=1;
			}else{
				$pagina=$_GET['pagina'];
			}
		$miId=$row['id'];
		$empezar_desde=($pagina-1)*$cantidad_de_resultados;
		$query="select m.id, m.texto, m.imagen_contenido, m.imagen_tipo, m.usuarios_id, m.fechayhora, u.nombreusuario, u.foto_contenido, u.foto_tipo, count(mg.mensaje_id) as cantmg
				from mensaje m
				inner join usuarios u on(m.usuarios_id=u.id)
				left join me_gusta mg on (mg.mensaje_id=m.id)
				where u.id='$miId'
				group by m.id, m.texto, m.imagen_contenido, m.imagen_tipo, m.usuarios_id, m.fechayhora, u.nombreusuario, u.foto_contenido, u.foto_tipo
				order by m.fechayhora desc";
		$link=conexion();
		$consulta=mysqli_query($link,$query);
		$resultado=mysqli_num_rows($consulta);
		$total_pagina=ceil($resultado / $cantidad_de_resultados);
		$variable=mysqli_query($link,"$query limit $empezar_desde,$cantidad_de_resultados");
  		?> 
		<div class="dialogo2">
		<legend> Sus Mensajes</legend>
		<hr> 
		<?php  
		$PerfilAmigo2=mensajesPerfilAmigo($_GET['id']);
		while($mensaje=mysqli_fetch_array($PerfilAmigo2)) { ?>
		<div class="logo-post">		
			<div class="chat">
				<div>
					<p class="nombre-usuario-post"><?php echo $mensaje['nombreusuario']; ?></p>
					<br>
					<p class="fecha-post"><?php echo date("d-m-Y H:i:s",strtotime( $mensaje['fechayhora'])); ?></p>
				</div>			    
				<div class="foto"><a href="superfil.php?id=<?php echo $mensaje['userID']; ?>"><img src="fotos.php?id=<?php echo $mensaje['usuarios_id'];?>"></a></div> 
				<p class="conversar"><?php echo $mensaje['texto']; ?></p>
			</div>
			<?php if($mensaje['imagen_contenido']){ ?>
				<img class="imagen-de-post" src="fotosmensajes.php?id=<?php echo $mensaje['id'];?>">
			<?php } ?>
			<hr>
			<!--botones de like dislike y eliminar el post --> 
			<div class="imagenes-like-dislike">
			<div><label>Likes:</label><?php echo $mensaje['cantmg']; ?></div>
				<?php $result=like($row['id']);?>
				<?php if($like=mysqli_num_rows($result)==0){?>
				<a href="validar-megusta.php?id=<?php echo $mensaje['id']; ?>&pagina=1"><img src="corazon.svg" title="Like" ></a>
				<?php }else { ?>
				<a href="validar-dislike.php?id=<?php echo $mensaje['id']; ?>&pagina=1" ><img src="aversion.svg" title="Dislike"></a>
			<?php } ?> 
				<?php if($mensaje['usuarios_id']== $_SESSION['usuario']['id']) {?>
				<div class="imagen-eliminar"><a href="validar-borrar-mensaje.php?id=<?php echo $mensaje['id'];?>&pagina=1" ><img src="eliminar.svg" title="Eliminar"></a></div>
				<?php } ?> <!--FIN DEL IF --> 
			</div>
		</div>
	<?php } ?> <!--FIN DEL WHILE --> 
	<?php for ($i=1; $i<=$total_pagina; $i++) { 
		echo "<a href='?pagina=".$i."'>".$i."</a> | ";
	} ; ?>    
	</div>
<?php include "footer.php" ?>
</body>
</html>