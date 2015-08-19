<?php  
$grupo = array(
$contenido_fila = array("grupo"=>"a", "materia"=>"b", "horas"=>"c", "profesor"=>"d", "l"=>"1", "ma"=>"", "mi"=>"2", "j"=>"", "v"=>"", "lugar"=>"r"),
$contenido_fila2 = array("grupo"=>"a", "materia"=>"a", "horas"=>"c", "profesor"=>"d", "l"=>"", "ma"=>"3", "mi"=>"", "j"=>"", "v"=>"", "lugar"=>"r"),
$contenido_fila = array("grupo"=>"a", "materia"=>"f", "horas"=>"c", "profesor"=>"d", "l"=>"1", "ma"=>"", "mi"=>"2", "j"=>"", "v"=>"", "lugar"=>"r"),
$contenido_fila2 = array("grupo"=>"a", "materia"=>"b", "horas"=>"c", "profesor"=>"d", "l"=>"", "ma"=>"3", "mi"=>"", "j"=>"", "v"=>"", "lugar"=>"r"),
$contenido_fila = array("grupo"=>"a", "materia"=>"d", "horas"=>"c", "profesor"=>"d", "l"=>"1", "ma"=>"", "mi"=>"2", "j"=>"", "v"=>"", "lugar"=>"r"),
$contenido_fila2 = array("grupo"=>"a", "materia"=>"y", "horas"=>"c", "profesor"=>"d", "l"=>"", "ma"=>"3", "mi"=>"", "j"=>"", "v"=>"", "lugar"=>"r")

);

$bandera = false;
for ($j=0; $j < count($grupo); $j++) {

		for ($h=$j+1; $h < count($grupo); $h++) { 
			echo $j;
		 	if ($grupo[$j]["materia"] == $grupo[$h]["materia"]) {

				if ($grupo[$j]["l"] == "" && $grupo[$h]["l"] != "")
					$grupo[$j]["l"] = $grupo[$h]["l"]; $bandera = true;echo $grupo[$j]["materia"];echo $grupo[$h]["materia"];

				if ($grupo[$j]["ma"] == "" && $grupo[$h]["ma"] != "")
					$grupo[$j]["ma"] = $grupo[$h]["ma"]; $bandera = true;

				if ($grupo[$j]["mi"] == "" && $grupo[$h]["mi"] != "")
					$grupo[$j]["mi"] = $grupo[$h]["mi"]; $bandera = true;

				if ($grupo[$j]["j"] == "" && $grupo[$h]["j"] != "")
					$grupo[$j]["j"] = $grupo[$h]["j"]; $bandera = true;

				if ($grupo[$j]["v"] == "" && $grupo[$h]["v"] != "")
					$grupo[$j]["v"] = $grupo[$h]["v"]; $bandera = true;

				if ($bandera)
					array_splice($grupo, $h, 1);
			}
			
		 } 
	}
echo "<pre>";
var_dump($grupo);
//var_dump(array_diff_assoc($contenido_fila, $contenido_fila2));

echo "<pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistema de Horarios</title>
</head>

<body>

	<form action="" id="formUpload">
		<input type="file" name="file" id="file" onChange="ValidarFile(this)">
		<button id="btnUpload">Cargar</button>
	</form>


	<span id="anuncio_usuario"></span>
	
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/Upload.js"></script>
</body>
</html>