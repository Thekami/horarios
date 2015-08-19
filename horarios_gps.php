<?php  

$nombre = "Horarios2014-4.csv";
$fila = 1;
$tabla = "<table>
			<thead>
				<tr>";
$td = "";
$th = "";
$nombre_tabla = "";
$array = array();
$data = array("grupo"=>"", "materia"=>"", "horas"=>"", "profesor"=>"", "l"=>"", "ma"=>"", "mi"=>"", "j"=>"", "v"=>"", "lugar"=>"");

if (($gestor = fopen("/Applications/XAMPP/xamppfiles/htdocs/imagen_becarios/images/".$nombre, "r")) !== FALSE) {
    
    while (($datos = fgetcsv($gestor, 0, ",")) !== FALSE) {

    	$data = array("grupo"=>"", "materia"=>"", "horas"=>"", "profesor"=>"", "l"=>"", "ma"=>"", "mi"=>"", "j"=>"", "v"=>"", "lugar"=>"");

        $numero = count($datos)-2; // Numero de campos en la línea $fila
        //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
        $fila++; // numero de fila leida

        for ($c=0; $c < $numero; $c++) {

            if ($fila == 3) // HORARIOS SEMESTRE ENERO 2014 - JULIO 2014
                $nombre_tabla = $datos[0];

	    	if ($fila > 4) {

	    		switch ($c) {
	    			
	    			case 0:
	    				$data["grupo"]=utf8_encode($datos[$c]);
	    				break;

	    			case 1:
	    				$data["materia"]=utf8_encode($datos[$c]);
	    				break;

	    			case 2:
	    				$data["horas"]=utf8_encode($datos[$c]);
	    				break;

	    			case 3:
	    				$data["profesor"]=utf8_encode($datos[$c]);
	    				break;

	    			case 4:
	    				$data["l"]=utf8_encode($datos[$c]);
	    				break;

	    			case 5:
	    				$data["ma"]=utf8_encode($datos[$c]);
	    				break;

	    			case 6:
	    				$data["mi"]=utf8_encode($datos[$c]);
	    				break;

	    			case 7:
	    				$data["j"]=utf8_encode($datos[$c]);
	    				break;
	    			
	    			case 8:
	    				$data["v"]=utf8_encode($datos[$c]);
	    				break;
	    			
	    			case 9:
	    				$data["lugar"]=utf8_encode($datos[$c]);
	    				break;

	    		} // fin siwotch

	    		//array_push($data, utf8_encode($datos[$c]));

	            if ($c == ($numero-1)) {
	                $td = $td."<td>".utf8_encode($datos[$c])."</td></tr>";
	            }elseif($c == 0){
	                $td = $td."<tr><td>".utf8_encode($datos[$c])."</td>";
	            }else{
	                $td = $td."<td>".utf8_encode($datos[$c])."</td>";
	            }

	    	} //fin if

			
            //echo utf8_encode($datos[$c]) . "<br />\n";

        } //fin for

        if ($fila > 4)
        	array_push($array, $data);
        
    }

    fclose($gestor);

}

/*echo "<pre>";
var_dump($array);
echo "<pre>";*/

$final = array();
$otro = array();
$cont = 0;
$flag = true;

for ($i=0; $i < count($array); $i++) { 

	while($flag){
		if ($array[$cont]["grupo"] == $array[$cont+1]["grupo"]) {
			array_push($final, $array[$cont]);
			$cont++;
		}else{
			array_push($final, $array[$cont]);
			$cont++;
			$flag = false;
		}

	}
	array_push($otro, $final);
	$i = $cont;
	$flag = true;
	$final = array();
}

echo $cont;

echo "<pre>";
var_dump($otro);
echo "<pre>";

$grupo = 15;

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
    <h3><?php echo $otro[$grupo][0]["grupo"]; ?></h3><br>
	
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
				
				for ($i=0; $i < count($otro[$grupo]); $i++) { 
					$reg = "<tr>
							 <td>".$otro[$grupo][$i]['materia']."</td>";

							if ($otro[$grupo][$i]['l'] == "") {
								$reg = $reg."<td></td>";
							}else{
								$reg = $reg."<td>".$otro[$grupo][$i]['l']."<br>".$otro[$grupo][$i]['lugar']."<br>".$otro[$grupo][$i]['profesor']."</td>";
							}

							if ($otro[$grupo][$i]['ma'] == "") {
								$reg = $reg."<td></td>";
							}else{
								$reg = $reg."<td>".$otro[$grupo][$i]['ma']."<br>".$otro[$grupo][$i]['lugar']."<br>".$otro[$grupo][$i]['profesor']."</td>";
							}

							if ($otro[$grupo][$i]['mi'] == "") {
								$reg = $reg."<td></td>";
							}else{
								$reg = $reg."<td>".$otro[$grupo][$i]['mi']."<br>".$otro[$grupo][$i]['lugar']."<br>".$otro[$grupo][$i]['profesor']."</td>";
							}

							if ($otro[$grupo][$i]['j'] == "") {
								$reg = $reg."<td></td>";
							}else{
								$reg = $reg."<td>".$otro[$grupo][$i]['j']."<br>".$otro[$grupo][$i]['lugar']."<br>".$otro[$grupo][$i]['profesor']."</td>";
							}

							if ($otro[$grupo][$i]['v'] == "") {
								$reg = $reg."<td></td>";
							}else{
								$reg = $reg."<td>".$otro[$grupo][$i]['v']."<br>".$otro[$grupo][$i]['lugar']."<br>".$otro[$grupo][$i]['profesor']."</td>";
							}

							$reg = $reg." </tr>";
						  	echo $reg;
				}
			?>
			
		</tbody>
	</table>


</body>
</html>