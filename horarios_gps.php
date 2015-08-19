<?php  

$nombre = "Horarios2014-4.csv";
$fila = 1;	

$csv = array(); // array utilizado para guardar la informacion del csv organizada

//declaro la estructura del array que guardara el contenido de cada fila del csv
$contenido_fila = array("grupo"=>"", "materia"=>"", "horas"=>"", "profesor"=>"", "l"=>"", "ma"=>"", "mi"=>"", "j"=>"", "v"=>"", "lugar"=>"");

//abro el archivo
if (($gestor = fopen("/Applications/XAMPP/xamppfiles/htdocs/imagen_becarios/images/".$nombre, "r")) !== FALSE) {
    
    //se recorre el archivo fila por fila
    while (($datos = fgetcsv($gestor, 0, ",")) !== FALSE) {

    	// inicializo el contenedor de la informacion del archivo
    	$contenido_fila = array("grupo"=>"", "materia"=>"", "horas"=>"", "profesor"=>"", "l"=>"", "ma"=>"", "mi"=>"", "j"=>"", "v"=>"", "lugar"=>"");

        $numero = count($datos)-2; // Numero de campos en la línea $fila

        $fila++; // numero de fila leida

        for ($c=0; $c < $numero; $c++) {

        	// de la fila 1 a la 4 no contienen nada importante a si que omitimos
        	// imprimir esa informacion y solo tomamos el contenido necesario
	    	if ($fila > 4) {

	    		// relleno la variable $contenido_fila con la informacion de cada fila
	    		switch ($c) {
	    			
	    			case 0:
	    				$contenido_fila["grupo"]=utf8_encode($datos[$c]);
	    				break;

	    			case 1:
	    				$contenido_fila["materia"]=utf8_encode($datos[$c]);
	    				break;

	    			case 2:
	    				$contenido_fila["horas"]=utf8_encode($datos[$c]);
	    				break;

	    			case 3:
	    				$contenido_fila["profesor"]=utf8_encode($datos[$c]);
	    				break;

	    			case 4:
	    				$contenido_fila["l"]=utf8_encode($datos[$c]);
	    				break;

	    			case 5:
	    				$contenido_fila["ma"]=utf8_encode($datos[$c]);
	    				break;

	    			case 6:
	    				$contenido_fila["mi"]=utf8_encode($datos[$c]);
	    				break;

	    			case 7:
	    				$contenido_fila["j"]=utf8_encode($datos[$c]);
	    				break;
	    			
	    			case 8:
	    				$contenido_fila["v"]=utf8_encode($datos[$c]);
	    				break;
	    			
	    			case 9:
	    				$contenido_fila["lugar"]=utf8_encode($datos[$c]);
	    				break;

	    		} // fin siwitch

	    	} //fin if

        } //fin for

        //relleno mi array solo con el contenido importante (de la fila 5 en adelante)
        if ($fila > 4)
        	array_push($csv, $contenido_fila);

        /* EL ARRAY CSV EN ESTE MOMENTO QUEDA LLENO CON TODA LA INFORMACION QUE CONTENIA 
           EL ARCHIVO ORIGINAL, PERO ORGANIZADA EN FORMA DE ARRAY ASOCIATIVO.
           A CONTINUACION ORGANIZAREMOS MEJOR EL ARRAY, SE AGRUPARAN CADA GRUPO (2A, 3C, 6H, ETC..)*/
        
    }

    // se cierra la lectura del archivo
    fclose($gestor);

}

/*echo "<pre>";
var_dump($csv);
echo "<pre>";*/

$grupo = array(); // array para comenzar a agrupar los registros por grado y grupo
$csv_organizado = array(); // array contenedor de toda la informacion organizada en los subgrupos mencionados

$cont = 0; // contador para agilizar las iteraciones en el ciclo for
$flag = true; //bandera para salir o entrar del ciclo while

for ($i=0; $i < count($csv); $i++) {  //recorro el array con el contenido del csv

	while($flag){
		if ($csv[$cont]["grupo"] == $csv[$cont+1]["grupo"]) { // si el grupo del primer registro es igual al del segundo registro
			array_push($grupo, $csv[$cont]); // entonces lo agrego en el grupo
			$cont++; // aumento el contador
		}else{ // de lo contrario, haré lo mismo...
			array_push($grupo, $csv[$cont]);
			$cont++;
			$flag = false; // pero mandare la bandera a FALSE para deja de contar y salir del while
		}

	}

	$bandera = false;
	for ($j=0; $j < count($grupo); $j++) {
	
		for ($h=$j+1; $h < count($grupo); $h++) { 

		 	if ($grupo[$j]["materia"] == $grupo[$h]["materia"]) {

				if ($grupo[$j]["l"] == "" && $grupo[$h]["l"] != "")
					$grupo[$j]["l"] = $grupo[$h]["l"]; $bandera = true;

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

	//$grupo = array($grupo[0]["grupo"] => "$grupo");
	// agrego al array final el contenido del grupo creado en el ciclo while
	array_push($csv_organizado, $grupo); 

	$i = $cont; // a la variable $i de doy el valor del contador del ciclo while, para optimizar las iteraciones en el ciclo for
	
	// inizializo las variables para poder crear el siguiente grupo de informacion
	$flag = true;
	$grupo = array();
} // fin for


//array con el nombre de los grupos
$nombres_gps = array();

for ($i=0; $i <count($csv_organizado); $i++) { 
	array_push($nombres_gps, $csv_organizado[$i][0]["grupo"]);
}

// variable con los options del select
$opts = "";

for ($i=0; $i < count($nombres_gps); $i++) { 
	$opts = $opts.'<option value="'.$i.'">'.$nombres_gps[$i].'</option>';
}

// imprimo el array final, ya organizado
/*echo "<pre>";
var_dump($nombres_gps);
echo "<pre>";*/

// defino la tabla de que grupo mostraré
$grupo = 0;

if(isset($_POST["gp"]))
	$grupo = $_POST["gp"];
	//echo $_POST["gp"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ver </title>
</head>
<style>
    table {
        border-collapse: collapse;
        /*text-align: center;*/
    }

    table, td, th {
        border: 1px solid black;
    }
</style>
<body>

	
    <h3><?php echo $csv_organizado[$grupo][0]["grupo"]; ?></h3>
	
	<form action="horarios_gps.php" method="post">
		<select name="gp" id="">
	    	<?php echo $opts; ?>
	    </select>
	    <input type="submit" value="ver">
	</form>
    
	<form action="resources/imprimir.php" method="post">
		<input type="text" name="html" id="txt_html"  style="display: none">
		<input type="submit" value="Imprimir" id="btnPrint">
	</form>
	
	<div id="container">
		<table syle="border-collapse: collapse; border: 1px solid black;">
			<thead>
				<tr>
					<th style="border: 1px solid black;"></th>
					<th style="border: 1px solid black;">Lunes</th>
					<th style="border: 1px solid black;">Martes</th>
					<th style="border: 1px solid black;">Miercoles</th>
					<th style="border: 1px solid black;">Jueves</th>
					<th style="border: 1px solid black;">Viernes</th>
				</tr>
			</thead>
			<tbody>
				
				<?php 
					
					for ($i=0; $i < count($csv_organizado[$grupo]); $i++) { 
						$reg = "<tr>
								 <td style='border: 1px solid black;'>".$csv_organizado[$grupo][$i]['materia']."</td>";

								if ($csv_organizado[$grupo][$i]['l'] == "") {
									$reg = $reg."<td style='border: 1px solid black;'></td>";
								}else{
									$reg = $reg."<td style='border: 1px solid black;'>".$csv_organizado[$grupo][$i]['l']."<br>".$csv_organizado[$grupo][$i]['lugar']."<br>".$csv_organizado[$grupo][$i]['profesor']."</td>";
								}

								if ($csv_organizado[$grupo][$i]['ma'] == "") {
									$reg = $reg."<td style='border: 1px solid black;'></td>";
								}else{
									$reg = $reg."<td style='border: 1px solid black;'>".$csv_organizado[$grupo][$i]['ma']."<br>".$csv_organizado[$grupo][$i]['lugar']."<br>".$csv_organizado[$grupo][$i]['profesor']."</td>";
								}

								if ($csv_organizado[$grupo][$i]['mi'] == "") {
									$reg = $reg."<td style='border: 1px solid black;'></td>";
								}else{
									$reg = $reg."<td style='border: 1px solid black;'>".$csv_organizado[$grupo][$i]['mi']."<br>".$csv_organizado[$grupo][$i]['lugar']."<br>".$csv_organizado[$grupo][$i]['profesor']."</td>";
								}

								if ($csv_organizado[$grupo][$i]['j'] == "") {
									$reg = $reg."<td style='border: 1px solid black;'></td>";
								}else{
									$reg = $reg."<td style='border: 1px solid black;'>".$csv_organizado[$grupo][$i]['j']."<br>".$csv_organizado[$grupo][$i]['lugar']."<br>".$csv_organizado[$grupo][$i]['profesor']."</td>";
								}

								if ($csv_organizado[$grupo][$i]['v'] == "") {
									$reg = $reg."<td style='border: 1px solid black;'></td>";
								}else{
									$reg = $reg."<td style='border: 1px solid black;'>".$csv_organizado[$grupo][$i]['v']."<br>".$csv_organizado[$grupo][$i]['lugar']."<br>".$csv_organizado[$grupo][$i]['profesor']."</td>";
								}

								$reg = $reg." </tr>";
							  	echo $reg;
					}
				?>
				
			</tbody>
		</table>
	</div>

<script src="js/jquery-1.11.2.min.js"></script>
<script>

	$(document).ready(function(){
		var html = $('#container').html()
		$('#txt_html').val(html)
	});
	

	/*$(document).on('click', '#btnPrint', function(e){
		e.preventDefault()

		$.ajax({
	        url: "resources/imprimir.php",
	        type: "POST",
	        data: {html: html},
	        success: function(datos)
	        {
	            console.log("chido")
	        }
	     
	    });
	});*/
</script>
</body>
</html>