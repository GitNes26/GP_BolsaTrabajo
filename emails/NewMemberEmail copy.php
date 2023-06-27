<?php
// include("../Administration/Configurations/globals.php");

// $name     = $_POST["input_name"];
$email    = $_POST["input_email"];
$password    = $_POST["input_password"];
$date    = $_POST["created_at"];

// echo "$name";
// echo "$email";
// echo "$date";

require_once("../plugins/PHPMailer/PHPMailerAutoload.php");
// use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer;
$mail->isSendmail();

// $mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'Smtpout.secureserver.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = ' info@gmail.com';                 // SMTP username
$mail->Password = 'Google.95';                           // SMTP password
$mail->SMTPSecure = 'none';                           // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;
$mail->IsHTML(true);
$mail->setFrom('info@gmail.com', 'Bolsa de trabajo GP');
// $mail->addAddress($email, 'Bienvenido a la Bolsa de Trabajo de Gomez Palacio');
$mail->addAddress('samuel.garza29@hotmail.com', 'Bolsa de Trabajo');
// $mail->addAddress('nestorpuentesin@gmail.com', 'DPN Stash');
$mail->Subject = 'Bolsa de Trabajo GP | nuevo usuario';

  $messageBody="
  <html>
  <head>
  </head>
  <body>
    <p style='font-family: sans-serif;'>
      Bienvenido a la Bolsa de Trabajo, te has registrado con el correo <b>$email</b> el dia <b>$date</b>.<br>
      Tu contraseña es: <b>$password</b>.<br>
      Por seguridad, te recomendamos que la cambien lo más pronto posible en el menu de 'Mi Perfil'.<br>
      <br>
    </p>
  </body>
  </html>
    ";
$mail->Body = $messageBody;

$exito = $mail->Send();
print_r($exito);

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
