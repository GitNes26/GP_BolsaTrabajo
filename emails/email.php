<?php
$name     = "Nestor"; #$_POST["input_name"];
$email    = "nestorpuentesin@gmail.com"; #$_POST["input_correo"];
$fecha    = "2023-08-04 10:10:10"; #$_POST["creado"];
$contenido = "este es el contenido \n intentando un /n ---- intentando un <br> br ";


$para = "nestorpuentesin@gmail.com";
$titulo = $name . " quiere ponerse en contacto.";
$mensaje = "
   <html>
      <head>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <title></title>
      </head>
      <body>
         <h3>Nombre completo:</h3>
         <p>" . $name . "</p>
         <h3>email:</h3>
         <p> " . $email . "</p>
         <h3>Fecha:</h3>
         <p>" . $fecha . "</p>
         <h3>Mensaje:</h3>
         <p>" . ucfirst($contenido) . "</p>
      </body>
  </html>";

$cabeceras = "MIME-Version: 1.0" . "\r\n";
$cabeceras .= "Content-type: text/html; charset=UTF-8" . "\r\n";

$cabeceras .= "Para: <$email>" . "\r\n";
$cabeceras .= "From: " . $name . "\r\n";

$sent = mail($para, utf8_decode($titulo), utf8_decode($mensaje), $cabeceras);
echo json_encode("enviado");
