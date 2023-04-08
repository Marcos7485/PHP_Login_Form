<?php 


namespace core\classes; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EnviarEmail{
    

    // ================================================
    public function send_email_new_user($email_cliente, $purl){


        // Envia um email para o novo cliente, para confirmar um email.
        
        // constroi o purl (link para validação do email)
        $link = BASE_URL.'?a=email_confirm&purl='.$purl;

        $mail = new PHPMailer(true);

        try {
            // opções do servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_SMTP;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet    = 'UTF-8';

            //Emisor e recetor
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient

            // assunto
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - ' . 'Confirmação de email.';
            // mensagem
            $html = '<p>Ooohh Come on!!! what the worst that could happen?!</p>';
            $html .= '<p>Confirm your email for activate your account ;).</p>';
            $html .= '<p><a href="'.$link.'">Confirmar seu e-mail</a></p>';
            $mail->Body = $html;

            $mail->send();
        
            return true;
        } catch (Exception $e) {
            return false;
        }
    }    
}