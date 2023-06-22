<?php
// include("../Administration/Configurations/globals.php");

// $name     = $_POST["input_name"];
$email    = $_POST["input_email"];
$password    = $_POST["input_password"];
$date    = $_POST["created_at"];

// echo "$name";
// echo "$email";
// echo "$date";
require_once('../plugins/PHPMailer/src/Exception.php');
require_once('../plugins/PHPMailer/src/PHPMailer.php');
require_once('../plugins/PHPMailer/src/SMTP.php');

// require_once("../plugins/PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer(true);
// print_r($mail);

try {
  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host       = 'secure.emailsrvr.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = 'info@gomezpalacio.gob.mx';                     //SMTP username
  $mail->Password   = 'Informes@r4gp';                               //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
  $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->setFrom('info@gomezpalacio.gob.mx', 'BOLSA DE TRABAJO GP');
  $mail->addAddress('nestorpuentesin@gmail.com', 'Nuevo Usuario');     //Add a recipient

  //Content
  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Bolsa de Trabajo GP | ya eres parte de nosotros';
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

  $mail->send();
  //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho
  //para intentar enviar el mensaje, cada intento se hara 5 segundos despues
  //del anterior, para ello se usa la funcion sleep
  // $intentos=1;
  // while ((!$exito) && ($intentos < 5)) {
  //   sleep(5);
  //   //echo $mail->ErrorInfo;
  //   $exito = $mail->Send();
  //   $intentos=$intentos+1;
  // }
  // if (!$exito) {
  //   echo "Problemas enviando correo electrónico";
  //   echo "<br/>.$mail->ErrorInfo";
  // } else {
  //   echo "Mensaje enviado correctamente en el intento $intentos";
  // }
} catch (Exception $e) {
  echo "Problemas enviando correo electrónico";
  echo "<br/>.$mail->ErrorInfo";
}
