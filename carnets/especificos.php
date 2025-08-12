<?php
include_once('bas/conn.php');

mysqli_set_charset($con,"utf8");

if (isset($_POST['enviar'])) {
    if (is_array($_POST['countries'])) {
        $selected = '';
        $num_countries = count($_POST['countries']);
        $current = 0;
        foreach ($_POST['countries'] as $key => $value) {
            if ($current != $num_countries-1)
                $selected .= "'".$value."',";
            else
                $selected .= "'".$value."'";
            $current++;
        }
    }
    else {
	
    }
}  

$query="SELECT r.idresidentes,r.documentor,upper(concat(r.nombresr,' ',r.apellidosr)) as nombre,r.fechanacimiento,r.eps,
r.nomfund, h.fechaingreso,(year(now())-year(r.fechanacimiento)) as edad,upper(concat(u.nombres,' ',u.apellidos)) as acudiente 
from residentes r join historial h on r.idresidentes=h.idresidentes join asociacion a on r.idresidentes=a.idresidentes 
join usuarios u on a.idusuarios=u.idusuarios where r.idresidentes IN($selected) order by r.nombresr";

$html = '
<html>
<head>
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">
<style>
body {font-family: Roboto;
	font-size: 10pt;
}
table.items {
	font-size: 10pt;
	border-collapse: collapse;
	border: 1px;
}
td { vertical-align: top;
}
@font-face {
    font-family: Roboto;
    src: url("fonts/Roboto-Regulat.ttf");
}
</style>
</head>
<body>
';

$result=mysqli_query($con,$query);

$ordinal=0;

	while ($resultc = mysqli_fetch_array($result)) {
		$documento=$resultc['documentor'];
		$nombre=$resultc['nombre'];
		$nomfund=$resultc['nomfund'];
		$edad=$resultc['edad'];
		$eps=$resultc['eps'];
		$fechan=$resultc['fechanacimiento'];
		$fechai=$resultc['fechaingreso'];
		$acudiente=$resultc['acudiente'];

$product_code_128 = "<img src='barcode.php?codetype=Code128&size=73&text=$documento&print=true'/>";

$html.='
<table class="items" width="100%" height="100%" cellpadding="8" border="0">
<thead>
<tr>'
;

if($nomfund==='CENTRO JOREC'){
$html.='
<td width="85mm"><img src="images/jorech.png" width="85mm" height="6mm"></td>
<td width="85mm"><img src="images/jorech.png" width="85mm" "height="6mm"></td>'
;
}
else{
$html.='
<td width="85mm"><img src="images/jemr.png" width="85mm" height="6mm"></td>
<td width="85mm"><img src="images/jemr.png" width="85mm" "height="6mm"></td>'
;
}

$html.='
</tr>
</thead>
<tfoot>
<tr>'
;

if($nomfund==='CENTRO JOREC'){
$html.='
<td width="85mm"><img src="images/jorech.jpg" width="85mm" height="6mm"></td>
<td width="85mm"><img src="images/jorech.jpg" width="85mm" "height="6mm"></td>'
;
}
else{
$html.='
<td width="85mm"><img src="images/jemr.jpg" width="85mm" height="6mm"></td>
<td width="85mm"><img src="images/jemr.jpg" width="85mm" "height="6mm"></td>'
;
}

$html.='
</tr>
</tfoot>
<tbody>
<tr>

<td width="85mm" height="49mm">
<h3>'.$nombre.'</h3><br>
<h5>Eps: '.$eps.'</h5><br>
'.$product_code_128.'
</td>

<td width="85mm" height="49mm">
<h5>Fecha nacimiento: '.$fechan.'</h5><br>
<h5>Fecha Ingreso: '.$fechai.'</h5><br>
<h5>Acudiente: '.$acudiente.'</h5><br>
<h5><b>Finca los pinos 1.5 kms después del peaje La Punta via Mesa de los Santos</b></h5><br>
<h5><b><i>318 360 49 13/ 316 460 76 43</i></b></h5><br>

</td>

</tr>
</tbody>
</table>
<br/>'
;
		}

$html.='

<br/>

</body>
</html>
';

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
	'margin_left' => 20,
	'margin_right' => 15,
	'margin_top' => 25,
	'margin_bottom' => 25,
	'margin_header' => 10,
	'margin_footer' => 10,
	'showBarcodeNumbers' => FALSE
]);

try {

	$mpdf->WriteHTML($html);

} catch (\Mpdf\MpdfException $e) {

	die ($e->getMessage());

}

$mpdf->Output();
/**/