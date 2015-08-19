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

			}
			/*if ($bandera)
				array_splice($grupo, $h, $h);*/

		 } 
	}

	// agrego al array final el contenido del grupo creado en el ciclo while
	array_push($csv_organizado, $grupo); 

	$i = $cont; // a la variable $i de doy el valor del contador del ciclo while, para optimizar las iteraciones en el ciclo for
	
	// inizializo las variables para poder crear el siguiente grupo de informacion
	$flag = true;
	$grupo = array();
} // fin for


// imprimo el array final, ya organizado
echo "<pre>";
var_dump($csv_organizado);
echo "<pre>";

// defino la tabla de que grupo mostraré
$grupo = 0;

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
    <h3><?php echo $csv_organizado[$grupo][0]["grupo"]; ?></h3><br>
	
	<table>
		<thead>
			<tr>
				<th></th>
				<th>Lunes</th>
				<th>Martes</th>
				<th>Miercoles</th>
				<th>Jueves</th>
				<th>Viernes</th>
			</tr>
		</thead>
		<tbody>
			
			<?php 
				
				for ($i=0; $i < count($csv_organizado[$grupo]); $i++) { 
					$reg = "<tr>
							 <td>".$csv_organizado[$grupo][$i]['materia']."</td>";

							if ($csv_organizado[$grupo][$i]['l'] == "") {
								$reg = $reg."<td></td>";
							}else{
								$reg = $reg."<td>".$csv_organizado[$grupo][$i]['l']."<br>".$csv_organizado[$grupo][$i]['lugar']."<br>".$csv_organizado[$grupo][$i]['profesor']."</td>";
							}

							if ($csv_organizado[$grupo][$i]['ma'] == "") {
								$reg = $reg."<td></td>";
							}else{
								$reg = $reg."<td>".$csv_organizado[$grupo][$i]['ma']."<br>".$csv_organizado[$grupo][$i]['lugar']."<br>".$csv_organizado[$grupo][$i]['profesor']."</td>";
							}

							if ($csv_organizado[$grupo][$i]['mi'] == "") {
								$reg = $reg."<td></td>";
							}else{
								$reg = $reg."<td>".$csv_organizado[$grupo][$i]['mi']."<br>".$csv_organizado[$grupo][$i]['lugar']."<br>".$csv_organizado[$grupo][$i]['profesor']."</td>";
							}

							if ($csv_organizado[$grupo][$i]['j'] == "") {
								$reg = $reg."<td></td>";
							}else{
								$reg = $reg."<td>".$csv_organizado[$grupo][$i]['j']."<br>".$csv_organizado[$grupo][$i]['lugar']."<br>".$csv_organizado[$grupo][$i]['profesor']."</td>";
							}

							if ($csv_organizado[$grupo][$i]['v'] == "") {
								$reg = $reg."<td></td>";
							}else{
								$reg = $reg."<td>".$csv_organizado[$grupo][$i]['v']."<br>".$csv_organizado[$grupo][$i]['lugar']."<br>".$csv_organizado[$grupo][$i]['profesor']."</td>";
							}

							$reg = $reg." </tr>";
						  	echo $reg;
				}
			?>
			
		</tbody>
	</table>


</body>
</html>