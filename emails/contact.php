<?php
// error_reporting(0);
// /*
//  * ------------------------------------
//  * Contact Form Configuration
//  * ------------------------------------
//  */
//
// $to    = "lmendoza@resosistemas.mx"; // <--- Your email ID here
//
// $server_email = '';  // Your server email to authenticate outgoing emails. eg: name@yourdomain.com
// /*
//  * ------------------------------------
//  * END CONFIGURATION
//  * ------------------------------------
//  */
//
// $name     = $_POST["fname"];
// $email    = $_POST["email"];
// $website  = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// $website = dirname($website);
// $website = dirname($website);
//
// if (isset($email) && isset($name)) {
//
// 	$subject  = "New Contact Message from $name"; // <--- Contact for Subject here.
//
// 	$msg      = 'Hello Admin, <br/> <br/> Here are the Message details:';
// 	$msg     .= ' <br/> <br/> <table border="1" cellpadding="6" cellspacing="0" style="border: 1px solid  #eeeeee;">';
// 	foreach ($_POST as $label => $value) {
// 	    $msg .= "<tr><td width='100'>". ucfirst($label) . "</td><td width='300'>" . $value . " </tr>";
// 	}
// 	$msg      .= " </table> <br> --- <br>This e-mail was sent from $website";
//
// /*
//  * ------------------------------------
//  * Send Mail via PHP Mailer
//  * ------------------------------------
//  */
//
// date_default_timezone_set('Etc/UTC');
//
// require 'phpmailer/PHPMailerAutoload.php';
// //Create a new PHPMailer instance
// $mail = new PHPMailer;
// //Set who the message is to be sent from
// $mail->setFrom('info@resosistemas.mx', $name);
// //Set an alternative reply-to address
// $mail->addReplyTo($email, $name);
// //Set who the message is to be sent to
// $mail->addAddress($to);
// //Set the HTML True
// $mail->isHTML(true);
//
// $mail->Subject = $subject;
// $mail->Body = $msg;
//
// //send the message, check for errors
// if (!$mail->send()) {
//     echo "Mailer Error: " . $mail->ErrorInfo;
// } else {
//     echo "success";
// }
//
// //echo "success";
//
// } // END isset

$name     = utf8_decode($_POST["name"]);
$email    = utf8_decode($_POST["email"]);
$message    = utf8_decode($_POST["message"]);
$phone    = utf8_decode($_POST["phone"]);

// echo "$name";
// echo "$email";
// echo "$message";
// echo "$phone";

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
$mail->setFrom('info@dpnstash.com', 'DPN Stash');
// $mail->addAddress('lmendoza@resosistemas.mx', 'DPN Stast');
// $mail->addAddress('support@dpnconnect.com', 'DPN Stash');
$mail->addAddress('support@dpnconnect.com', 'DPN Stash');
$mail->Subject = 'DPN Stash';

  $mensajeBody="
  <html>
  <head>
      <meta charset='UTF-8'>
      <style media='screen'>
        label{
          font-family: FreeMono, monospace;
          font-size: 30px;
          color:#6a6a6a;
          font-weight: bold;
        }
      </style>
  </head>
  <body>
  <hr>
    <br>
    <div style='text-align:left;'>
      <h3 style='font-family: sans-serif;'> $name(<strong>$email </strong>)</h3>
      <span style='font-family: sans-serif;'>Phone $phone</span>
      <br>
      <br>
      <h5 style='font-family: sans-serif;'>$message</h5>
  </body>
  </html>

    ";

$mail->Body = $mensajeBody;
if (!$mail->send())
{
  echo "0";
}
else
{
  echo "1";
}
