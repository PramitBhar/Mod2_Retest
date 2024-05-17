<?php

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// Convert the email to lowercase.
$email = strtolower($email);
$mail = new PHPMailer(true);
try {
  // Server settings.
  $mail->isSMTP();
// Set the host of the SMPT server
  $mail->Host       = 'smtp.gmail.com;';
  $mail->SMTPAuth   = true;
  // Set the username of the SMPT server.
  $mail->Username   = 'rimobhar0426@gmail.com';
  // Set the password of the SMPT server.
  $mail->Password   = 'rpelcfhpvhujticz';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  // Set the port of the SMPT.
  $mail->Port       = 465;
  // Set the mail address from where mail will be sent.
  $mail->setFrom('rimobhar0426@gmail.com');
  $mail->addAddress('shuva.mallick@innoraft.com');
  $mail->isHTML(true);
  // Set the email subject.
  $mail->Subject = 'Customer Invoice';
  // Set the mail body.
  $mail->Body    = <<<END
  Customer Name : $name,
  Email of the customer = $email,
  Phone number of the customer = $phone,
  Total payable amount = $totalAmount
  END;
  $mail->AltBody = 'Body in plain text for non-HTML mail clients';
  $mail->send();
}
catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
