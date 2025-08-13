
<?php
session_start();
if($_SESSION["ok"]==true && $_SESSION["sadmin"]==true){

$usuariosess=$_SESSION["user"];
$nombresess=$_SESSION["name"];
$apellidosess=$_SESSION["apellido"];
	
include_once('bas/conn.php');

$idresidente=$_REQUEST['idresidente'];

mysqli_set_charset($con,"utf8");
	
$result1=mysqli_query($con,"select residentes.documentor as cedular,residentes.expedicionr as expedidor,residentes.fechanacimiento as fechanr,residentes.nombresr as nombrer,residentes.apellidosr as apellidosr, residentes.telefono as telefonor,residentes.celular as celularr,residentes.profesion as profesionr,residentes.email as emailr,residentes.direccionf as direccionr,residentes.ciudad as ciudadr,residentes.estudios as estudios,residentes.estadocivil as estadocr,residentes.conyuge as conyuger,residentes.tipodocumento as tipodr,residentes.eps as eps,residentes.padre as padrer,residentes.madre as madrer,asociacion.parentesco as parentescou,usuarios.nombres as nombreu,usuarios.apellidos as apellidou,usuarios.telefono as telefonou,usuarios.email as emailu,usuarios.documento 
as docu,usuarios.expedicion as expedidou,usuarios.autorizacion as autorizacion,historial.fechaingreso as fechaih,historial.motivoi as motivoi,historial.tiempoadiccion as tiempoah,historial.medidatiempo as 
canth,historial.drogasusadas as drogash,historial.problemas as problh,historial.carcel as carcelh,historial.fundaciones as fundh,historial.motivos as moth,historial.referido as referido,historial.orientador as orientador,historial.cedorientador as cedorientador,historialm.enfermedades as enfermhm,historialm.fechaexamen as fechaehm,historialm.estadosalud as estadoshm,historialm.vacunas as vacunas,historialm.diagnosis as diagnosis,historialm.medicamentos as medichm,historialm.alergias as alergias,historialm.hospitalizado as hosphm,historialm.descripcion as descrhmh from residentes join asociacion on asociacion.idresidentes=residentes.idresidentes join usuarios on asociacion.idusuarios=usuarios.idusuarios join historial on historial.idresidentes=residentes.idresidentes join historialm on historialm.idresidentes=residentes.idresidentes where residentes.idresidentes='$idresidente'");

while ($resultx = mysqli_fetch_array($result1)) {
$cedular=$resultx['cedular'];
$expedidor=$resultx['expedidor'];
$fechanr=$resultx['fechanr'];
$nombrer=$resultx['nombrer'];
$apellidosr=$resultx['apellidosr'];
$telefonor=$resultx['telefonor'];
$celularr=$resultx['celularr'];
$profesionr=$resultx['profesionr'];
$emailr=$resultx['emailr'];
$direccionr=$resultx['direccionr'];
$ciudadr=$resultx['ciudadr'];
$estudios=$resultx['estudios'];
$estadocr=$resultx['estadocr'];
$conyuger=$resultx['conyuger'];
$tipodr=$resultx['tipodr'];
$eps=$resultx['eps'];
$padrer=$resultx['padrer'];
$madrer=$resultx['madrer'];
$parentescou=$resultx['parentescou'];
$nombreu=$resultx['nombreu'];
$apellidou=$resultx['apellidou'];
$telefonou=$resultx['telefonou'];
$emailu=$resultx['emailu'];
$docu=$resultx['docu'];
$expedidou=$resultx['expedidou'];
$autorizacion=$resultx['autorizacion'];
$fechaih=$resultx['fechaih'];
$motivoi=$resultx['motivoi'];
$tiempoah=$resultx['tiempoah'];
$canth=$resultx['canth'];
$drogash=$resultx['drogash'];
$problh=$resultx['problh'];
$carcelh=$resultx['carcelh'];
$fundh=$resultx['fundh'];
$moth=$resultx['moth'];
$referido=$resultx['referido'];
$orientador=$resultx['orientador'];
$cedorientador=$resultx['cedorientador'];
$enfermhm=$resultx['enfermhm'];
$fechaehm=$resultx['fechaehm'];
$estadoshm=$resultx['estadoshm'];
$vacunas=$resultx['vacunas'];
$diagnosis=$resultx['diagnosis'];
$medichm=$resultx['medichm'];
$alergias=$resultx['alergias'];
$hosphm=$resultx['hosphm'];
$descrhmh=$resultx['descrhmh'];
}

require('tfpdf.php');
class PDF extends tFPDF
{
// Cabecera de página
function Header()
{
    // Logo
	$this->Image('images/jemr.png',0,1,216);
}

// Pie de página
function Footer()
{
$this->Image('images/jemr.jpg',0,265,216);	  	
}
}

$pdf = new PDF();

$pdf->AddPage('P','Letter');
// Arial bold 15
$pdf->SetFont('Arial','B',16);
// Movernos a la derecha
$pdf->Cell(35);
// Título
$pdf->Cell(0,15,'FORMULARIO DE INGRESO DEL RESIDENTE');
// Salto de línea
$pdf->Ln(20);
$pdf->SetFont('Arial','',12);
$html = 'Bienvenido a nuestra FUNDACIÓN JESÚS ES MI ROCA; por favor llene este formulario de manera precisa, es muy importante para nosotros tener esta información para poder brindar el mejor cuidado posible para usted o para su familiar. Su privacidad es importante para nosotros. La información que comparte con nosotros permanecerá estrictamente confidencial.';
$pdf->Write(5,utf8_decode($html),'');
$pdf->Ln(10);
$pdf->Cell(65);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,utf8_decode('Información personal'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',10);
$pdf->Cell(110,10,utf8_decode('Fecha de ingreso: '.$fechaih));
$pdf->Cell(40,10,utf8_decode('Ingresa a: '.$motivoi));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Nombre: '.$nombrer.' '.$apellidosr));
$pdf->Cell(40,10,utf8_decode('Documento: '.$tipodr.' '.$cedular));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Fecha de nacimiento: '.$fechanr));
$pdf->Cell(40,10,utf8_decode('Seguro social: '.$eps));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Dirección: '.$direccionr));
$pdf->Cell(40,10,utf8_decode('Ciudad: '.$ciudadr));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Teléfono fijo: '.$telefonor));
$pdf->Cell(40,10,utf8_decode('Celular: '.$celularr));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Estado civil: '.$estadocr));
$pdf->Cell(90,10,utf8_decode('Nombre del cónyuge: '.$conyuger));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Estudios: '.$estudios));
$pdf->Cell(90,10,utf8_decode('Profesión u oficio: '.$profesionr));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Correo electrónico: '.$emailr));
$pdf->Cell(90,10,utf8_decode('Acudiente: '.$nombreu.' '.$apellidou));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Nombre del padre: '.$padrer));
$pdf->Cell(90,10,utf8_decode('Nombre de la madre: '.$madrer));
$pdf->Ln(15);
$pdf->Cell(110,10,utf8_decode('En caso de emergencia, ¿a quien podemos llamar?'));
$pdf->Ln(15);
$pdf->Cell(110,10,utf8_decode('Nombre del acudiente: '.$nombreu.' '.$apellidou));
$pdf->Cell(90,10,utf8_decode('Relación con el paciente: '.$parentescou));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Teléfono de contacto: '.$telefonou));
$pdf->Cell(90,10,utf8_decode('Correo de contacto: '.$emailu));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Tiempo en la adicción: '.$tiempoah.' '.$canth));
$pdf->Cell(90,10,utf8_decode('Drogas usadas: '.$drogash));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Problemas con la justicia: '.$problh));
$pdf->Cell(90,10,utf8_decode('Ha estado preso: '.$carcelh));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Fundaciones en las que ha estado: '.$fundh));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Motivos del retiro: '.$moth));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Cómo se enteró de nosotros: '.$referido));
$pdf->Ln(10);

$pdf->AddPage('P','Letter');
$pdf->Cell(70);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('ESTADO FÍSICO'));
$pdf->Ln(20);
$pdf->SetFont('Arial','',10);
$pdf->Cell(110,10,utf8_decode('¿Padece alguna enfermedad? : '.$enfermhm));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Fecha de su último exámen físico : '.$fechaehm));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('¿Cómo calificaría su estado de salud en general? : '.$estadoshm));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('¿Tiene sus vacunas al día? : '.$vacunas));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Diagnóstico por el médico : '.$diagnosis));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('¿Toma algún medicamento? : '.$medichm));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('¿Tiene alergias? : '.$alergias));
$pdf->Ln(10);
$pdf->Cell(90,10,utf8_decode('¿Alguna vez ha estado hospitalizado? : '.$hosphm));
$pdf->Ln(10);
$pdf->Cell(110,10,utf8_decode('Si ha estado hospitalizado describa : '.$descrhmh));
$pdf->Ln(70);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,170,70,'C');
}
else{
$pdf->Cell(10,10);	
}
$picf2 = "firmas/$cedular.png";
if(file_exists($picf2)){
$pdf->Image($picf2,115,170,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,80,200,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic2 = "huellas/$cedular.png";
if(file_exists($pic2)){
$pdf->Image($pic2,180,200,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('FIRMA PADRE O ACUDIENTE'));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL RESIDENTE'));
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('C.C'.' '.$docu.' de '.$expedidou));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode($tipodr.' '.$cedular.' de '.$expedidor));
$pdf->Ln(10);

$pdf->AddPage('P','Letter');
$pdf->Cell(35);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('AUTORIZACIÓN PARA LA PUBLICACIÓN DE'));
$pdf->Ln(10);
$pdf->Cell(35);
$pdf->Cell(0,15,utf8_decode('IMÁGENES Y VIDEOS DE LOS RESIDENTES'));
$pdf->Ln(10);
$pdf->Cell(50);
$pdf->Cell(0,15,utf8_decode('FUNDACIÓN JESÚS ES MI ROCA'));
$pdf->Ln(20);
$pdf->SetFont('Arial','',12);
$html2 = 'La FUNDACIÓN JESÚS ES MI ROCA, en el desarrollo de sus actividades terapéuticas, educativas, culturales, espirituales y recreativas, genera registros fotográficos y audiovisuales con fines institucionales. Estas imágenes pueden ser utilizadas para mostrar el avance de los procesos de rehabilitación, fortalecer el vínculo con las familias, promover los servicios ofrecidos por la Fundación y visibilizar su labor ante entidades públicas o privadas aliadas. 

El uso de la imagen está regulado por el derecho fundamental al buen nombre, la intimidad y la protección de datos personales, conforme a la Constitución Política de Colombia, la Ley 1581 de 2012 y demás normas complementarias. Por ello, la Fundación solicita autorización formal para publicar o abstenerse de publicar dichas imágenes, respetando siempre la dignidad de los residentes.';
$pdf->Write(5,utf8_decode($html2),'');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(65);
$pdf->Cell(0,15,utf8_decode('AUTORIZACIÓN:'));
$pdf->Ln(12);
$pdf->SetFont('Arial','',11);
$html3="Yo, $nombreu $apellidou identificad(o/a) con Cédula de Ciudadanía: $docu de $expedidou en calidad de padre/acudiente legal del Residente $nombrer $apellidosr, autorizo de manera previa, expresa, voluntaria, informada e inequívoca a la FUNDACIÓN JESÚS ES MI ROCA, para el uso de su imagen y voz, captadas mediante fotografías y/o videos, tomadas durante las actividades terapéuticas, educativas, lúdicas, espirituales o institucionales que se realicen dentro o fuera de las instalaciones de la Fundación.";
$pdf->Write(5,utf8_decode($html3),'');
$pdf->Ln(10);
$html4="Esta autorización se otorga exclusivamente para los siguientes fines:";
$pdf->Write(5,utf8_decode($html4),'');
$pdf->Ln(10);
$html6="- Difusión institucional a través de la página web oficial de la Fundación.
- Publicaciones en redes sociales institucionales (Facebook, Instagram, WhatsApp).
- Material didáctico, promocional, informativo o documental relacionado con el proceso terapéutico.
- Presentaciones de informe de resultados a entidades públicas o privadas.";
$pdf->Write(5,utf8_decode($html6),'');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(45);
$pdf->Cell(0,15,utf8_decode('CONSIDERACIONES LEGALES'));
$pdf->Ln(12);
$pdf->SetFont('Arial','',11);
$html7="- Esta autorización no concede derechos comerciales, y la Fundación se compromete a proteger el buen nombre, la dignidad y la integridad del residente.
- En cumplimiento del artículo 15 de la Constitución Política de Colombia, la Ley 1581 de 2012 y el Decreto 1377 de 2013, esta autorización podrá ser revocada en cualquier momento mediante solicitud escrita presentada ante la Fundación.
- La imagen será utilizada únicamente en el marco de las finalidades señaladas, y no se transferirá a terceros sin consentimiento adicional.
- La Fundación se abstendrá de publicar imágenes que puedan vulnerar la dignidad, intimidad o seguridad del residente.";
$pdf->Write(5,utf8_decode($html7),'');
$pdf->Ln(10);

$pdf->AddPage('P','Letter');
$pdf->SetFont('Arial','B',16);
$pdf->Ln(20);
$html8="DECLARO QUE HE LEÍDO, COMPRENDIDO Y ACEPTADO PLENAMENTE EL CONTENIDO DE ESTE DOCUMENTO.";
$pdf->Write(5,utf8_decode($html8),'');
$pdf->Ln(12);
$pdf->SetFont('Arial','',11);
$html5="Lugar y fecha: Mesa de los santos, $fechaih.";
$pdf->Write(5,utf8_decode($html5),'');
$pdf->Ln(40);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,190,70,'C');
}
else{
$pdf->Cell(10,10);	
}
$picf2 = "firmas/$cedular.png";
if(file_exists($picf2)){
$pdf->Image($picf2,115,190,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,80,220,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic2 = "huellas/$cedular.png";
if(file_exists($pic2)){
$pdf->Image($pic2,180,220,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('FIRMA DE QUIEN AUTORIZA'));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL RESIDENTE'));
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('C.C'.' '.$docu.' de '.$expedidou));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode($tipodr.' '.$cedular.' de '.$expedidor));
$pdf->Ln(10);


$pdf->AddPage('P','Letter');
$pdf->Cell(45);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('AUTORIZACIÓN PARA EL MANEJO'));
$pdf->Ln(10);
$pdf->Cell(58);
$pdf->Cell(0,15,utf8_decode('DE DATOS PERSONALES'));
$pdf->Ln(20);
$pdf->SetFont('Arial','',11);
$html9="La FUNDACIÓN JESÚS ES MI ROCA, en cumplimiento de lo dispuesto en la Ley 1581 de 2012, el Decreto 1377 de 2013 y demás normas que regulan la protección de datos personales en Colombia, informa a todos los acudientes, residentes, empleados, proveedores y demás personas naturales relacionadas con su quehacer institucional, que los datos personales suministrados serán recolectados, almacenados, usados y tratados conforme a los principios de legalidad, finalidad, libertad, veracidad, seguridad, confidencialidad y transparencia. Esta autorización busca garantizar el respeto por el derecho fundamental al habeas data, establecido en el artículo 15 de la Constitución Política de Colombia, y asegurar que el tratamiento de la información personal se realice de manera responsable, segura y conforme a las finalidades legítimas del objeto social de la Fundación.";
$pdf->Write(5,utf8_decode($html9),'');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(65);
$pdf->Cell(0,15,utf8_decode('AUTORIZACIÓN:'));
$pdf->Ln(12);
$pdf->SetFont('Arial','',11);
$html6="Yo $nombreu $apellidou, identificado(a) con la cédula de ciudadanía No. $docu expedida en $expedidou, en mi calidad de acudiente del residente vinculado a la FUNDACIÓN JESÚS ES MI ROCA, manifiesto que he sido informado(a), de manera clara, suficiente y comprensible, sobre la política de tratamiento de datos personales adoptada por la Fundación.
Autorizo de forma previa, expresa, informada, voluntaria e inequívoca a la FUNDACIÓN JESÚS ES MI ROCA, para que recolecte, almacene, administre, consulte, use, procese, actualice, suprima o circule mis datos personales y los del residente a mi cargo, única y exclusivamente para los fines relacionados con el desarrollo de su objeto social, dentro de los cuales se incluyen:
- La gestión administrativa, médica y terapéutica del proceso de rehabilitación.
- La organización de eventos institucionales, espirituales y/o formativos.
- La emisión de informes requeridos por entidades gubernamentales, de salud o educativas.
- La promoción de actividades, programas o servicios relacionados con la Fundación.
- La conservación de registros administrativos, estadísticos y contractuales.
- La comunicación con familiares o acudientes respecto al proceso del residente.
- Los datos personales serán incorporados a una base de datos custodiada bajo criterios de seguridad, confidencialidad y respeto a los derechos fundamentales, y no serán compartidos con terceros sin mi autorización, salvo obligación legal o requerimiento de autoridad competente.";
$pdf->Write(5,utf8_decode($html6),'');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(50);
$pdf->Cell(0,15,utf8_decode('DERECHOS DEL TITULAR:'));
$pdf->Ln(12);
$pdf->SetFont('Arial','',11);
$html10="Declaro que me fueron informados los derechos que me asisten como titular de la información, los cuales podré ejercer en cualquier momento, incluyendo:
- Conocer, actualizar y rectificar mis datos personales frente a la Fundación.
- Solicitar prueba de esta autorización en cualquier momento.
- Ser informado sobre el uso que se le ha dado a mis datos.
- Presentar consultas o reclamos ante la Fundación y, si no se resuelven, ante la Superintendencia de Industria y Comercio.
- Revocar la autorización y/o solicitar la supresión de los datos, cuando no exista un deber legal o contractual de mantenerlos.
- Para ejercer estos derechos, podré comunicarme al correo electrónico: admon@fundacionjesusesmiroca.org o dirigirme directamente a las instalaciones de la Fundación.";
$pdf->Write(5,utf8_decode($html10),'');
$pdf->Ln(10);

$pdf->AddPage('P','Letter');
$pdf->SetFont('Arial','',11);
$pdf->Ln(20);
$html11="La presente autorización se suscribe en Piedecuesta, a $fechaih.";
$pdf->Write(5,utf8_decode($html11),'');
$pdf->Ln(12);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,190,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,95,210,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode($nombreu.' '.$apellidou));
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode('C.C'.' '.$docu.' de '.$expedidou));

$pdf->AddPage('P','Letter');
$pdf->Cell(45);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('AUTORIZACIÓN PARA EL MANEJO'));
$pdf->Ln(10);
$pdf->Cell(58);
$pdf->Cell(0,15,utf8_decode('DE DATOS PERSONALES'));
$pdf->Ln(20);
$pdf->SetFont('Arial','',11);
$html7="Yo $nombrer $apellidosr, identificado(a) con $tipodr No. $cedular expedida en $expedidor, manifiesto que he sido debidamente informado por la FUNDACIÓN JESÚS ES MI ROCA sobre el tratamiento que se dará a mis datos personales, en cumplimiento de lo establecido por la Ley 1581 de 2012, el Decreto 1377 de 2013, y demás normas relacionadas con la protección de la información personal en Colombia.

Autorizo de forma previa, expresa, voluntaria, inequívoca e informada a la FUNDACIÓN JESÚS ES MI ROCA, para que recolecte, almacene, administre, consulte, utilice, comparta y procese mis datos personales, única y exclusivamente con el fin de:

- Ejecutar actividades relacionadas con mi proceso terapéutico y de rehabilitación.
- Cumplir con obligaciones contractuales, legales y administrativas derivadas de mi permanencia en la Fundación.
- Mantenerme informado sobre actividades institucionales, eventos, reuniones, campañas y otros asuntos relacionados con mi estadía.
- Elaborar estadísticas, informes y registros internos requeridos para la operación legal y profesional de la Fundación.
- Responder requerimientos de autoridades competentes cuando así lo exija la ley.

Los datos personales autorizados serán incorporados en la base de datos institucional, bajo custodia segura y con acceso restringido, garantizando su confidencialidad, integridad y uso responsable.

Asimismo, declaro que me fueron explicados mis derechos como titular de la información personal, los cuales podré ejercer en cualquier momento, tales como conocer, actualizar y rectificar mis datos; solicitar información sobre el uso que se les ha dado; requerir prueba de esta autorización; presentar consultas o reclamos ante la Fundación y, en caso de no obtener respuesta satisfactoria, ante la Superintendencia de Industria y Comercio; así como revocar esta autorización o solicitar la supresión de mis datos cuando no exista un deber legal o contractual que lo impida.

Para ejercer estos derechos, podré comunicarme a través del correo electrónico institucional admon@fundacionjesusesmiroca.org o de manera presencial en la sede de la Fundación. 

Declaro que comprendo plenamente el alcance y los fines de esta autorización, y firmo en señal de aceptación. La presente autorización se suscribe en Piedecuesta, a $fechaih.";
$pdf->Write(5,utf8_decode($html7),'');
$pdf->Ln(10);
//firmas
$picf2 = "firmas/$cedular.png";
if(file_exists($picf2)){
$pdf->Image($picf2,5,190,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic2 = "huellas/$cedular.png";
if(file_exists($pic2)){
$pdf->Image($pic2,95,210,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode($nombrer.' '.$apellidosr));
$pdf->Ln(10);
$pdf->Cell(95,10,utf8_decode($tipodr.' '.$cedular.' de '.$expedidor));

$pdf->AddPage('P','Letter');
$pdf->Cell(50);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,15,utf8_decode('DECLARACION DE INDEMNIDAD'));
$pdf->Ln(10);
$pdf->Cell(65);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,15,utf8_decode('DATOS DE IDENTIFICACIÓN'));
$pdf->Ln(15);
$pdf->SetFont('Arial','',11);
$pdf->Cell(196,7,utf8_decode('Nombre del residente: '.$nombrer.' '.$apellidosr),1,1,'C');
$pdf->Cell(196,7,utf8_decode('Identificación: '.$tipodr.'      Numero: '.$cedular.'      Lugar de Expedición: '.$expedidor),1,1,'C');
$pdf->Ln(3);
$pdf->Cell(40);
$pdf->Cell(0,5,utf8_decode('1. DECLARACIÓN DE LA FUNDACIÓN JESÚS ES MI ROCA'));
$pdf->Ln(7);
$pdf->MultiCell(196,5,utf8_decode('La FUNDACIÓN JESÚS ES MI ROCA declara que actúa como una entidad privada sin ánimo de lucro dedicada a la atención terapéutica, formativa y espiritual de personas con consumo problemático de sustancias psicoactivas, de conformidad con lo dispuesto en la Ley 1566 de 2012 y demás normativas aplicables.
La Fundación se compromete a actuar con la debida diligencia y responsabilidad, conforme a los principios del derecho a la salud, la vida digna y el respeto por los derechos humanos. Sin embargo, informa que no podrá asumir responsabilidad por hechos que:
a. Provengan de actos dolosos, imprudentes o contrarios a la ley, cometidos por el residente dentro o fuera de la institución.
b. Escapen del control razonable de la Fundación, pese a la adopción de medidas preventivas.
c. Deriven de condiciones médicas o psiquiátricas preexistentes que no hayan sido informadas al momento del ingreso.'),1);
$pdf->Ln(2);
$pdf->Cell(60);
$pdf->Cell(0,10,utf8_decode('2. DECLARACIÓN DEL RESIDENTE'));
$pdf->Ln(10);
$pdf->MultiCell(196,5,utf8_decode('a. Reconozco y acepto que el éxito del tratamiento depende de mi disposición, voluntad, disciplina y permanencia en el proceso.
b. Exonero de manera parcial a la Fundación de responsabilidad civil o penal por las consecuencias derivadas de actos cometidos por mí, cuando estos escapen de su capacidad de control o vigilancia.
c. En caso de fuga, abandono voluntario o retiro anticipado del proceso, asumo plena responsabilidad por los riesgos asociados, incluyendo cualquier afectación personal, familiar o legal.
d. Comprendo que la Fundación no se hace responsable por autolesiones o intentos de suicidio, salvo que haya existido negligencia, omisión o falta de intervención razonable de su parte.
e. Autorizo que los objetos personales dejados en la Fundación, y no reclamados dentro de los ocho (8) días siguientes a mi egreso o retiro, podrán ser dispuestos libremente por la entidad.
f. La colchoneta y demás implementos entregados a la Fundación al ingreso serán considerados donados, salvo manifestación contraria por escrito.
g. En caso de retiro voluntario, fuga o abandono del proceso, renuncio expresamente a la devolución de cualquier suma de dinero pagada, al ser estos recursos destinados desde el momento del ingreso a cubrir costos operativos, terapéuticos y logísticos.
Esta declaración se realiza bajo los principios de autonomía de la voluntad, según el artículo 1602 del Código Civil Colombiano, y no limita el derecho del residente a interponer acciones en caso de negligencia, omisión grave o vulneración de derechos fundamentales.'),1);
$pdf->Ln(4);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,200,70,'C');
}
else{
$pdf->Cell(10,10);	
}
$picf2 = "firmas/$cedular.png";
if(file_exists($picf2)){
$pdf->Image($picf2,115,200,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,75,230,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic2 = "huellas/$cedular.png";
if(file_exists($pic2)){
$pdf->Image($pic2,175,230,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(5);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL ACUDIENTE'));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL RESIDENTE'));
$pdf->Ln(5);
$pdf->Cell(95,10,utf8_decode('C.C'.' '.$docu.' de '.$expedidou));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode($tipodr.' '.$cedular.' de '.$expedidor));
$pdf->Ln(10);

$pdf->AddPage('P','Letter');
$pdf->Ln(10);
$pdf->SetFont('Arial','',11);
$pdf->Cell(70);
$pdf->Cell(0,5,utf8_decode('3. DECLARACION FAMILIAR'));
$pdf->Ln(7);
$pdf->MultiCell(196,5,utf8_decode('a. Declaro que he entendido y acatado lo anterior expuesto, sin embargo, doy pleno consentimiento.
b. Acudiente o familiar: '.$nombreu.' '.$apellidou),1);
$pdf->Ln(4);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,45,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->Cell(5,10,utf8_decode('FIRMA: '));
$pdf->Cell(60,10);
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,100,45,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(50,10,utf8_decode('PARENTESCO: '.$parentescou));
$pdf->Cell(65,10,utf8_decode('No C.C'.' '.$docu.' de '.$expedidou));
$pdf->Ln(15);
$pdf->Cell(60);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,utf8_decode('CONSENTIMIENTO INFORMADO'));
$pdf->Ln(5);
$pdf->SetFont('Arial','',11);
$pdf->Cell(65);
$pdf->Cell(0,10,utf8_decode('4. DATOS DE IDENTIFICACIÓN'));
$pdf->Ln(7);
$pdf->Cell(196,7,utf8_decode('Nombre del usuario: '.$nombrer.' '.$apellidosr),1,1,'C');
$pdf->Cell(196,7,utf8_decode('Identificación: '.$tipodr.'      Numero: '.$cedular.'      Lugar de Expedición: '.$expedidor),1,1,'C');
$pdf->MultiCell(196,5,utf8_decode('Nombre Técnico del tratamiento que se va a implementar al usuario: Proceso de Rehabilitación a través de Tratamiento psicoterapéutico y talleres de formación espiritual para prevenir el consumo y ayuda profesional para reinsertarse de nuevo a la sociedad.'),1);
$pdf->Ln(4);
$pdf->Cell(65);
$pdf->Cell(0,10,utf8_decode('5. DECLARACIÓN DEL USUARIO'));
$pdf->Ln(7);
$pdf->MultiCell(196,5,utf8_decode('a. Me ha sido explicada de manera clara, suficiente y comprensible la naturaleza, el propósito y los alcances del tratamiento terapéutico ofrecido por la institución, incluyendo las restricciones aplicables durante el proceso, el reglamento interno, los posibles riesgos y beneficios, así como las alternativas disponibles a dicho tratamiento. Reconozco que no existen garantías absolutas respecto al resultado final, ya que este dependerá en gran medida de mi compromiso, fuerza de voluntad y participación activa en el proceso. También he sido informado de que tengo el derecho a revocar este consentimiento en cualquier momento, sin que ello implique sanciones o represalias, salvo las consecuencias naturales del retiro.
b. Por lo tanto, autorizo y doy mi consentimiento libre, voluntario e informado para la implementación del tratamiento descrito, así como para la realización de los procedimientos complementarios que, a juicio del equipo interdisciplinario de la FUNDACIÓN JESÚS ES MI ROCA, resulten necesarios o convenientes en el marco de mi atención integral.
c. En todo momento solicito y exijo que se me respeten mis derechos humanos, mis derechos como usuario de servicios terapéuticos, mis convicciones personales y la confidencialidad de la información que entregue durante el proceso, conforme a lo establecido en la Constitución Política de Colombia, la Ley 23 de 1981, la Ley 1090 de 2006, la Ley 1566 de 2012 y la Ley 1751 de 2015 (Estatutaria de Salud).
d. Si acepto de manera expresa cada uno de los puntos anteriores, dejo constancia con mi firma al final del presente documento.'),1);
$pdf->Ln(20);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,210,70,'C');
}
else{
$pdf->Cell(10,10);	
}
$picf2 = "firmas/$cedular.png";
if(file_exists($picf2)){
$pdf->Image($picf2,115,210,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,80,240,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('____________________________'));
$pic2 = "huellas/$cedular.png";
if(file_exists($pic2)){
$pdf->Image($pic2,180,240,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(5);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL TUTOR LEGAL'));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode('FIRMA DEL RESIDENTE'));
$pdf->Ln(5);
$pdf->Cell(95,10,utf8_decode('C.C'.' '.$docu.' de '.$expedidou));
$pdf->Cell(10,10);
$pdf->Cell(95,10,utf8_decode($tipodr.' '.$cedular.' de '.$expedidor));
$pdf->Ln(10);

$pdf->AddPage('P','Letter');
$pdf->Ln(10);
$pdf->Cell(60);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,utf8_decode('6. DECLARACIONES Y FIRMAS'));
$pdf->Ln(10);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,5,utf8_decode('a. Orientador responsable: '.$orientador));
$pdf->Ln(10);
$pdf->MultiCell(196,5,utf8_decode('He informado al usuario del propósito y naturaleza del tratamiento descrito anteriormente, de otras alternativas, posibles riesgos y beneficios, así como los resultados que se esperan.
'),0);
$pdf->Ln(30);
$pic3 = "firmas/$cedorientador.png";
if(file_exists($pic3)){
$pdf->Image($pic3,1,50,90,'C'); //valor x, valor y, ancho
}
else{
$pdf->Cell(10,10);	
}
$pdf->Cell(55,10,utf8_decode('FIRMA DEL ORIENTADOR: '));
$pdf->Cell(65,10,utf8_decode('No C.C'.' '.$cedorientador));
$pdf->Ln(20);
$pdf->MultiCell(196,5,utf8_decode('b. Tutor legal o familiar.

Sé que el usuario en mención; ha sido considerado incapaz de tomar por sí mismo la decisión de aceptar o rechazar el tratamiento descrito anteriormente. El orientador me ha explicado de forma satisfactoria que es, como se hace y para qué sirve el tratamiento.  También me ha explicado sus riesgos y beneficios. He comprendido lo anterior perfectamente y por ello doy mi consentimiento para que el equipo de profesionales implemente el tratamiento bajo la asesoría del cuerpo administrativo de la FUNDACIÓN JESÚS ES MI ROCA.

c. Así mismo la afiliación a salud, gastos médicos, traslado a centros asistenciales, medicamentos y demás tratamientos en cuestión de salud, los gastos de los mismos correrán por cuenta del tutor legal o familiar. 

d. Dicha documentación debe ser autenticada ante la respectiva notaria local para su legalidad.

Firma Acudiente o familiar.'),0);
$pdf->Ln(30);
//firmas
$picf = "firmas/$docu.png";
if(file_exists($picf)){
$pdf->Image($picf,5,190,70,'C');
}
else{
$pdf->Cell(10,10);	
}
//firmas
$pdf->Ln(10);
$pdf->Cell(5,10,utf8_decode('FIRMA: '));
$pdf->Cell(70,10);
$pic = "huellas/$docu.png";
if(file_exists($pic)){
$pdf->Image($pic,100,225,20,'C');
}
else{
$pdf->Cell(10,10);	
}
$pdf->Ln(10);
$pdf->Cell(50,10,utf8_decode('PARENTESCO: '.$parentescou));
$pdf->Ln(10);
$pdf->Cell(65,10,utf8_decode('No C.C'.' '.$docu.' de '.$expedidou));

$pdf->Output();
}
else {
header("Location:index.php");
}
?>