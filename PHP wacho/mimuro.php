<?php if(!session_id()){session_start();}
include "autenticador.php";
 $autenticador= new autenticador();
	try{
		$autenticador->autenticado();
	}catch(Exception $e){
		$_SESSION["error"]= $e->getMessage();
		header("location:index.php");
		exit;
	} 
?>
<!DOCTYPE html>
<html>
	<?php include "head.php"; ?>
	<script type="text/javascript" src="validacion-mensaje.js"></script> 

<body>
		<?php include "modelo.php" ;?> 
		<?php include "header.php"; ?>
		<div class="buscador">
			<form action="listadoamigos.php" method="POST">		
				<input type="text" name="buscar" id="buscar" placeholder="Buscar usuario" value="" ><button type="submit" title="Buscar"></button>
			</form>
		</div>
		<?php include"mimenu.php" ?>
		<div class="text-area"><!-- text area para escribir el post y subir fotos-->
			<div class="mensaje">
			<form name="Postear" action="validar-mensajes.php" enctype="multipart/form-data" method="POST" onsubmit="return validarMensaje();">
  				<textarea name="contenido" id="contenido" placeholder="Comparte tus historias"></textarea>
  				<br>
  				<input type="HIDDEN" name="redireccion" id="redireccion" value="true" >
  				<input type="file" id="foto" name="foto">
  				<input type="submit">
			</form>
		</div>
		</div>
  		<?php
  			$cantidad_de_resultados=10;
			if(empty($_GET['pagina'])){
				$pagina=1;
			}else{
				$pagina=$_GET['pagina'];
			}
		$miId=$_SESSION['usuario']['id'];
		$empezar_desde=($pagina-1)*$cantidad_de_resultados;
		$query="select m.id, m.texto, m.imagen_contenido, m.imagen_tipo, m.usuarios_id, m.fechayhora, u.nombreusuario, u.foto_contenido, u.foto_tipo, count(mg.mensaje_id) as cantmg
				from mensaje m
				inner join usuarios u on(m.usuarios_id= u.id)
				left join me_gusta mg on (mg.mensaje_id=m.id)
				where m.usuarios_id='$miId' or m.usuarios_id in (select s.usuarioseguido_id
										from siguiendo s 
										where s.usuarios_id='$miId')
				group by m.id, m.texto, m.imagen_contenido, m.imagen_tipo, m.usuarios_id, m.fechayhora, u.nombreusuario, u.foto_contenido, u.foto_tipo
				order by m.fechayhora desc";
		$link=conexion();
		$consulta=mysqli_query($link,$query);
		$resultado=mysqli_num_rows($consulta);
		$total_pagina=ceil($resultado / $cantidad_de_resultados);
		$variable=mysqli_query($link,"$query limit $empezar_desde,$cantidad_de_resultados");
  		?> 
		<!--  post ya publicados-->
		<div class="dialogo">
		<legend> Noticias!</legend>
		<hr> 
		<?php
		//$result=mensajes($_SESSION['usuario']['id']);
		while($row=mysqli_fetch_array($variable)) { ?>
		<div class="logo-post">		
			<div class="chat">
				<div>
					<p class="nombre-usuario-post"><?php echo $row['nombreusuario']; ?></p>
					<br>
					<p class="fecha-post"><?php echo date("d-m-Y H:i:s",strtotime( $row['fechayhora'])); ?></p>
				</div>			    
				<div class="foto">
					<?php if($row['usuarios_id']!=$_SESSION['usuario']['id']){ ?>
						<a href="superfil.php?id=<?php echo $row['usuarios_id']; ?>"><img src="fotos.php?id=<?php echo $row['usuarios_id'];?>"></a>
					<?php }else{ ?>
							<a href="miperfil.php"><img src="fotos.php?id=<?php echo $row['usuarios_id'];?>"></a>
					<?php } ?>
				</div> 
				<p class="conversar"><?php echo $row['texto']; ?></p>
			</div>
			<?php if($row['imagen_contenido']){ ?>
				<img class="imagen-de-post" src="fotosmensajes.php?id=<?php echo $row['id'];?>">
			<?php } ?>
			<hr>
			<!--botones de like dislike y eliminar el post --> 
			<div class="imagenes-like-dislike">
			<div><label>Likes:</label><?php echo $row['cantmg']; ?></div>
			<?php $result=like($row['id']);?>
				<?php if($like=mysqli_num_rows($result)==0){?>
					
					<a href="validar-megusta.php?id=<?php echo $row['id']; ?>&pagina=1"><img src="corazon.svg" title="Like" ></a>
				<?php }else { ?>
					<a href="validar-dislike.php?id=<?php echo $row['id']; ?>&pagina=1" ><img src="aversion.svg" title="Dislike"></a>
				<?php } ?>
				<?php if($row['usuarios_id']== $_SESSION['usuario']['id']) {?>
				<div class="imagen-eliminar"><a href="validar-borrar-mensaje.php?id=<?php echo $row['id'];?>&pagina=1"><img  id="eliminarMensaje"src="eliminar.svg" title="Eliminar" onclick=" return confirm('¿Desea eliminar el mensaje?');"></a></div>
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
