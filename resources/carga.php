<?php 
/*session_start();
require('mysql.php');
$main = new mysql();*/

$msg="hola";

    $file = $_FILES["file"];
    $nombre = $file["name"];
    $type = $file["type"];
    $img_path = $file["tmp_name"];
    $size = $file["size"];
    $route = "/Applications/XAMPP/xamppfiles/htdocs/horarios/files/";
   /* $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "imagenes/";*/

    if($size > 1024*1024){

            $msg = "tamaño";

        }elseif ($type == "text/csv") {
       
            $img_data = file_get_contents($img_path);
            /*$base64 = base64_encode($img_data);

            $consult = "UPDATE respondents SET imagen_perfil = '$base64', 
                                               imagen_tipo = '$type' 
                                           WHERE id = '$id'";
                                           
            
            if($main->query($consult)){
                $msg = "success";
            }*/
            //$msg = $img_data;


            $file = $_FILES['file']['name'];
            if ($file && move_uploaded_file($_FILES['file']['tmp_name'],$route.$file))
                {
                   //sleep(3);//retrasamos la petición 3 segundos
                   //echo $file;//devolvemos el nombre del archivo para pintar la imagen
                   $msg = "success";
                }

            

         }else{

            $msg = "tipo";
        }

    echo $msg;


 ?>