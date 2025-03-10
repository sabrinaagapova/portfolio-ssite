<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "PHPMailer/src/Exception.php";
    require "PHPMailer/src/PHPMailer.php";

    $mail = new phpmailer(true);
	
    $mail->CharSet = "UTF-8";

    $mail->IsHTML(true);

    $name = $_POST["name"];
    $email = $_POST["email"];
	$phone = $_POST["phone"];
    $message = $_POST["message"];

	$email_template = "template_mail.html";


    $body = file_get_contents($email_template);
	$body = str_replace('%name%', $name, $body);
	$body = str_replace('%email%', $email, $body);
	$body = str_replace('%phone%', $phone, $body);
	$body = str_replace('%message%', $message, $body);

    $theme ="[Заявка с формы]";

    
    $mail->addAddress("agapova_kristina@bk.ru");

	$mail->setFrom($email);

    $mail->Subject = $theme;
    $mail->MsgHTML($body);



    if (!$mail->send()) {
        $message = "Ошибка отправки";
    } else {
        $message = "Данные отправлены!";
    }
	
	$response = ["message" => $message];

    header('Content-type: application/json');
    echo json_encode($response);


?>