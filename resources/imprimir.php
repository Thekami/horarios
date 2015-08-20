<?php 
require_once("../dompdf/dompdf_config.inc.php");

$html = $_POST["html"];

$go = '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Imprimir</title>
</head>

<style>
.container {
  position: relative;
  width: 100%;
  max-width: 960px;
  margin: 3% auto;
  padding: 0 20px;
  box-sizing: border-box; }

  th,
td {
  padding: 12px 15px;
  text-align: left;
  border: 1px solid #E1E1E1; }
th:first-child,
td:first-child {
  padding-left: 0; }
th:last-child,
td:last-child {
  padding-right: 0; }
.table-hover > tbody > tr:hover {
  background-color: #f5f5f5;
}
.table-striped > tbody > tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}
</style>

<body>
<div class="container">
	'.$html.'
</div>
</body>
</html>';


//echo $go;

$dompdf = new DOMPDF();
$dompdf->load_html($go);
$dompdf->render();
$dompdf->stream("sample.pdf");

?>

