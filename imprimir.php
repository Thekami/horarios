<?php
require_once("dompdf/dompdf_config.inc.php");

//$nombre = $_GET["var"];
$nombre = "Horarios2014-4.csv";

$fila = 1;
$tabla = "<table>
            <thead>
                <tr>";
$td = "";
$th = "";
$nombre_tabla = "";

if (($gestor = fopen("/Applications/XAMPP/xamppfiles/htdocs/imagen_becarios/images/".$nombre, "r")) !== FALSE) {
    
    while (($datos = fgetcsv($gestor, 0, ",")) !== FALSE) {

        $numero = count($datos)-2; // Numero de campos en la línea $fila
        //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
        $fila++; // numero de fila leida

        for ($c=0; $c < $numero; $c++) {

            if ($fila == 3) {
                $nombre_tabla = $datos[0];
            }


            if ($fila == 4) {
                if ($c == ($numero - 1)) {
                    $th = $th."<th>".utf8_encode($datos[$c])."</th></thead></tr>";
                }else{
                    $th = $th."<th>".utf8_encode($datos[$c])."</th>";
                }
                
            }

            if ($fila > 4) {

                if ($c == ($numero-1)) {
                    $td = $td."<td>".utf8_encode($datos[$c])."</td></tr>";
                }elseif($c == 0){
                    $td = $td."<tr><td>".utf8_encode($datos[$c])."</td>";
                }else{
                    $td = $td."<td>".utf8_encode($datos[$c])."</td>";
                }

            }
                               
            
            //echo utf8_encode($datos[$c]) . "<br />\n";

        }
$table = $tabla.$th.$td."</table>";
        
    }
    fclose($gestor);

    $html = '<!DOCTYPE html>
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
                    <h3>'.trim($nombre_tabla).'</h3><br>
                    
                    '.$table.'

                    


                </body>
                </html>';

    
    //$table = $tabla.$th.$td;
}

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("sample.pdf");

?>
