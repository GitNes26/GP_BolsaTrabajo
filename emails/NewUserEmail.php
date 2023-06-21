<?php
$name = $_POST["input_name"];
$email    = $_POST["input_correo"];
$fecha    = $_POST["creado"];

// echo "$name";
// echo "$email";
// echo "$fecha";

require_once("PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer;
$mail->isSendmail();

// $mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'Smtpout.secureserver.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@dpnstash.com';                 // SMTP username
$mail->Password = 'Inf@dpn2022';                           // SMTP password
$mail->SMTPSecure = 'none';                           // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;
$mail->IsHTML(true);
$mail->setFrom('info@dpnstash.com', 'DPN Stash Info');
$mail->addAddress('support@dpnconnect.com', 'DPN Stash');
// $mail->addAddress('nestorpuentesin@gmail.com', 'DPN Stash');
$mail->Subject = 'DPN Stash | new member';

  $mensajeBody="
  <html>
  <head>
  </head>
  <body>
    <p style='font-family: sans-serif;'>
      User <b>$name</b> has registered to your dpn stash system with email <b>$email</b> on day <b>$fecha</b>.
    </p>
  </body>
  </html>
    ";
$mail->Body = $mensajeBody;

$exito = $mail->Send();

//Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho
//para intentar enviar el mensaje, cada intento se hara 5 segundos despues
//del anterior, para ello se usa la funcion sleep
$intentos=1;
while ((!$exito) && ($intentos < 5)) {
  sleep(5);
 	//echo $mail->ErrorInfo;
 	$exito = $mail->Send();
 	$intentos=$intentos+1;
}

if (!$exito)
{
  echo "Problemas enviando correo electrónico";
  echo "<br/>.$mail->ErrorInfo";
}
else
{
  echo "Mensaje enviado correctamente en el intento $intentos";
}
