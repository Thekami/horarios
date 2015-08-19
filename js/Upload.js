$(document).on('click', '#btnUpload', function(event){
    event.preventDefault();

    var success = "La archivo guardado correctamente"
    var tipo = "El tipo de archivo que selecciono no es valido (formatos permitidos: csv)";
    var tamaño = "El tamaño maximo de el archivo permitido es de 1Mb";
    var formData = new FormData($("#formUpload")[0]);

    $.ajax({
        url: "resources/carga.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos)
        {
            console.log(datos)
            switch(datos){
            case "tamaño":
                /*$('#anuncio_usuario').removeClass('verde');
                $('#anuncio_usuario').addClass('rojo');*/
                document.getElementById("anuncio_usuario").innerHTML = tamaño;
                break;

            case "tipo":
                /*$('#anuncio_usuario').removeClass('verde');
                $('#anuncio_usuario').addClass('rojo');*/
                document.getElementById("anuncio_usuario").innerHTML = tipo;
                break;

            case "success":
                /*$('#anuncio_usuario').removeClass('rojo');
                $('#anuncio_usuario').addClass('verde');*/
                document.getElementById("anuncio_usuario").innerHTML = success;
                $( "#btnUpload" ).prop( "disabled", true );
                /*$(".img-preview").css({
                        "opacity": "1"
                   })*/
                break;

            default :
                /*$('#anuncio_usuario').removeClass('verde');
                $('#anuncio_usuario').addClass('rojo');*/
                document.getElementById("anuncio_usuario").innerHTML = "Ocurrio un problema intentlo de nuevo";
                break;
           }
            /*$('#nada').load('perfil.php #nada');
            $('#nada2').load('perfil.php #nada2');
            $('.star_2').removeClass("estrella-no")
            $('.star_2').addClass("estrella-si")
            $('.star_2').attr( 'data-original-title', '' );*/
        }
    });

});

