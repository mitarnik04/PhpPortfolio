<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/phpMailer/src/Exception.php';
require_once __DIR__ . '/phpMailer/src/PHPMailer.php';
require_once __DIR__ . '/phpMailer/src/SMTP.php';

require_once DIR_HELPERS . '/utils.php';
require_once __DIR__ . '/mail-template.php';

class Mailer
{

    public string $errorInfo;

    private function __construct(
        private PHPMailer $mail,
    ) {}

    public static function getGmailMailer(MailInformation $information): Mailer
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $information->username;
        $mail->Password = $information->password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        return new Mailer($mail);
    }

    public function sendFromTemplate(MailInformation $information, MailTemplate $template): bool
    {
        $mail = $this->mail;
        $mail->isHTML();
        $mail->setFrom($information->senderMail);
        foreach ($template->getRecipientEmails() as $recipientEmail) {
            $mail->addAddress($recipientEmail);
        }
        $mail->Subject = $template->getSubject();
        $mail->Body = $template->asHtml();
        if (!$mail->send()) {
            $this->errorInfo = $mail->ErrorInfo;
            return false;
        }
        return true;
    }

    // public function mockSendFromTemplate(MailInformation $information, MailTemplate $template): bool
    // {
    //     $mail = $this->mail;
    //     $mail->isHTML();
    //     $mail->setFrom($information->senderMail);
    //     foreach ($template->getRecipientEmails() as $recipientEmail) {
    //         $mail->addAddress($recipientEmail);
    //     }
    //     $mail->Subject = $template->getSubject();
    //     $mail->Body = $template->asHtml();
    //     print_r('This is the mock method:');
    //     print_r($mail->Body);
    //     return true;
    // }
}
