function ValidarImagen(obj){
	var uploadFile=obj.files[0];
	if(!window.FileReader){
		$( "#anuncio_usuario" ).text("Navegador no soporta lectura de archivos");		
		/*$( "#anuncio_usuario" ).removeClass( "verde" );
		$( "#anuncio_usuario" ).addClass( "rojo" );*/
		//regresamos a desabilitar el boton
			$( "#btnUpload" ).prop( "disabled", true );
			//regresamos el css del boton
			/*$('#btnUpload').css({
				"background":"white",
				"cursor":"no-drop",
				"color":"#ccc"
			});*/
	}
	if( !(/\.(csv)$/i).test(uploadFile.name) ){
		$( "#anuncio_usuario" ).text("No es una archivo valido");			
		/*$( "#anuncio_usuario" ).removeClass( "verde" );
		$( "#anuncio_usuario" ).addClass( "rojo" );*/
		//regresamos a desabilitar el boton
			//regresamos a desabilitar el boton
			$( "#btnUpload" ).prop( "disabled", true );
			//regresamos el css del boton
			/*$('#btnUpload').css({
				"background":"white",
				"cursor":"no-drop",
				"color":"#ccc"
			});*/
			

	}
	else{
		//1 mega=1048576 bytes(1024*1024)
		if(uploadFile.size<1048576){
			
			$( "#anuncio_usuario" ).text("Imagen correcta. Click en 'Guardar'");			
			/*$( "#anuncio_usuario" ).removeClass( "rojo" );
			$( "#anuncio_usuario" ).addClass( "verde" );
			$('#btnUpload').css({
				"background":"#e3576b",
				"cursor":"pointer",
				"color":"white"

			});*/
			//habilitamos el boton
			$( "#btnUpload" ).prop( "disabled", false );
		}
		else{
			
			$( "#anuncio_usuario" ).text("El tamaño máximo recomendable es de 1MB ");			
			/*$( "#anuncio_usuario" ).removeClass( "verde" );
			$( "#anuncio_usuario" ).addClass( "rojo" );*/
			//regresamos a desabilitar el boton			
			$( "#btnUpload" ).prop( "disabled", true );
			//regresamos el css del boton
			/*$('#btnUpload').css({
				"background":"white",
				"cursor":"no-drop",
				"color":"#ccc"
			});*/
		}
	}
}