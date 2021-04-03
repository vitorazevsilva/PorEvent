<?php

        require '../config/PHPMailer/PHPMailer.php';
        require '../config/PHPMailer/SMTP.php';
        require '../config/PHPMailer/Exception.php';
        require '../config/PHPMailer/POP3.php';

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        use PHPMailer\PHPMailer\POP3;


        global $erros;
        //Config. do Servidor de Email
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host="smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "porevent2020@gmail.com";
        $mail->Password = "";

        //Config. da Mensagem
        $mail->setFrom($mail->Username,'PorEvent');
        $mail->addAddress($email);
        $mail->Subject = $assunto;
        $mail->IsHTML(true);
        $mail->Body = $mensagem;
        if(!$mail->Send())
            $erros['Developer'] = "Error 475 - Problemas com o Email, Contacte o Suporte para Ajuda";
        $mail->smtpClose();
