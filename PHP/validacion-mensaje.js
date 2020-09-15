 function validarMensaje(){
	var message = document.getElementById("contenido").value,
		foto = document.getElementById("foto").value,
		cant = 0;
	if((!message)&&(!foto)) {
			cant ++;
		}
	if( message.length > 140 ){
		cant++;
	}
	if(cant > 0){
		alert("El mensaje debe tener entre 1 y 140 caracteres!");
		return false;

	}	
}