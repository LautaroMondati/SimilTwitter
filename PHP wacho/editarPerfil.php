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
	<?php include "head.php" ;?>
<body>
	<?php include "header.php"; ?>
	<hr>
	<?php include "mimenu.php";  ?>
	<?php include"modelo.php"; ?>
	<?php
	 $id=$_SESSION['usuario']['id'];
	 $result=getUser($id);
	 $row=mysqli_fetch_array($result);

	  ?>
<div class="form-editar-perfil">
			<form  action="validar-cambios.php" enctype="multipart/form-data" method="POST" onsubmit="return validarCambios();">
				<legend><h1>Editar Perfil</h1></legend>
				<hr>
				<div class="contenedor-editar-perfil" id="tabla">
			<?php if(!empty($_SESSION['error'])){
				echo $_SESSION['error'];
				unset($_SESSION['error']);} ?>
				
					<input type="text" value="<?php echo $row['nombre'];?>" id="nombre" name="nombre" placeholder="Nombre">
					<div class="error" id="nameid" >
					</div>
					<?php if(!empty($_SESSION['nombre'])){
					echo $_SESSION['nombre'];
					unset($_SESSION['nombre']);
					} ?>
					<input type="text" value="<?php echo $row['apellido']; ?>" id="apellido" name="apellido" placeholder="Apellido">
					<div  class="error" id="lastnameid" >
					</div>
					<?php if(!empty($_SESSION['apellido'])){
					echo $_SESSION['apellido'];
					unset($_SESSION['apellido']);
					} ?>
					<input type="text" value="<?php echo $row['email']; ?>" id="email" name="email" placeholder="Email">
					<div class="error" id="emailid" >
					</div>
					<?php if(!empty($_SESSION['email'])){
					echo $_SESSION['email'];
					unset($_SESSION['email']);
					} ?>
					<input type="file" value="" id="foto" name="foto" placeholder="foto">
					<div class="error" id="fotoid" >
					</div>
					<?php if(!empty($_SESSION['foto'])){
					echo $_SESSION['foto'];
					unset($_SESSION['foto']);
					} ?>
					<input type="submit" name="registrarse" value="Guardar cambios">
					</div>				
					 	
				</div>
			</form>
	
		<div class="form-editar-perfil">

			<form name="registro" action="validar-cambiopass.php"  method="POST" onsubmit="return validarClave()">
				<legend><h1>Cambiar Contraseña</h1></legend>
				<hr>
				<div class="contenedor-editar-perfil" id="tabla">
					<?php if(!empty($_SESSION['error2'])){
				echo $_SESSION['error2'];
				unset($_SESSION['error2']);			} ?>
					<input type="password" id="contraseña-vieja"  name="contraseña-vieja" placeholder="Contraseña actual">
					<div class="error" id="pass-viejaid">
					</div>
				
					<input type="password" id="contraseña" name="contraseña" placeholder="Contraseña">
					<div class="error" id="passid">
					</div>
				
				
					<input type="password" id="re-contraseña" name="re-contraseña" placeholder="Repita Contraseña" >
					<div class="error" id="re-passid">
					</div>				
					<input type="submit" name="cambiar pass" value="Guardar cambios"> 
					
				</div>
			</form>
		</div>
	<?php include "footer.php"; ?>

</body>
</html>