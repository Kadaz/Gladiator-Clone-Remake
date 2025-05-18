<html> 
<head> 
<title>Documento no encontrado</title> 
</head> 
<body> 
El documento: <b><?=$_SERVER['REQUEST_URI'];?></b> 
no ha sido encontrado en nuestro servidor.<br> 
El error ha sido comunicado al administrador del sitio. Disculpe las molestias 
ocasionadas.
        

<?
//Indicamos la fecha y hora del suceso.
$fecha = date('d-m-Y H:i:s');
$para='webmaster@misitio.com';
$asunto='Documento no encontrado.';
$mensaje='El documento: ' . $_SERVER['REQUEST_URI'] . ' no ha sido encontrado en el sitio: ' .$_SERVER['SERVER_NAME']. ' al tratar de ser accedido el ' . $fecha . ' desde la dirección ' . $_SERVER['HTTP_REFERER'];


        

mail($para, $asunto, $mensaje);
?>
<!--
Todo sea por el IE
xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx --> 
</body>
</html>