<?php
require_once('email_config.php');
require_once('stuff_for_mailer/Exception.php');
require_once('stuff_for_mailer/PHPMailer.php');
require_once('stuff_for_mailer/SMTP.php');

$mail = new PHPMailer\PHPMailer\PHPMailer;
$mail->SMTPDebug = 3;           // Enable verbose debug output. Change to 0 to disable debugging output.

$mail->isSMTP();                // Set mailer to use SMTP.
$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers.
$mail->SMTPAuth = true;         // Enable SMTP authentication


$mail->Username = 'omerfuterman@gmail.com';   // SMTP username
$mail->Password = 'ganit111';   // SMTP password
$mail->SMTPSecure = 'tls';      // Enable TLS encryption, `ssl` also accepted, but TLS is a newer more-secure encryption
$mail->Port = 587;              // TCP port to connect to
$options = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->smtpConnect($options);
$mail->From = $_POST['email'];  // sender's email address (shows in "From" field)
$mail->FromName = $_POST['name'];   // sender's name (shows in "From" field)
$mail->addAddress('omerfuterman@gmail.com', 'First Recipient\'s name');  // Add a recipient (name is optional)
//$mail->addAddress('ellen@example.com');                        // Add a second recipient
//$mail->addReplyTo('example@gmail.com');                          // Add a reply-to address
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $_POST['name'].' sent you an email from your website';
$mail->Body    = 'Phone: '.$_POST['phone'].'<br>Email: '.$_POST['email'].'<br><br>Message:<br>'.$_POST['message'];
$mail->AltBody = $_POST['message'];

if(!$mail->send()) {
    echo json_encode('Message could not be sent.');
    echo json_encode('Mailer Error: ' . $mail->ErrorInfo);
} else {
    echo json_encode('Message has been sent');
}
?>
