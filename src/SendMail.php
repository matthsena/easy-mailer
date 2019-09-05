<?php

/**
 * PHP Mailer framework (https://github.com/PHPMailer/PHPMailer)
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Composer autoload
 */
require_once './vendor/autoload.php';
/**
 * Interface
 */
require_once './settings/interface.php';

class SendMail implements iMail
{
    private function check($data): bool
    {
        $undefined = 0;

        foreach ($data as $key => $value) {
            if (!$value) {
                $undefined++;
            }
        }

        if ($undefined != 0) {
            return false;
        } else {
            return true;
        }
    }

    public function send()
    {
        $requestedData = array(

            'host' => $_REQUEST['hostname'],
            'username' => $_REQUEST['username'],
            'password' => $_REQUEST['password'],
            'sender' => $_REQUEST['sender'],
            'senderName' => $_REQUEST['sendername'],
            'subject' => $_REQUEST['subject'],
            'message' => urldecode($_REQUEST['message']),
            'reciver' => $_REQUEST['reciver'],
            'reciverName' => (isset($_REQUEST['reciverName']) ? $_REQUEST['reciverName'] : '')
        );

        if ($this->check($requestedData)) {

            $mail = new PHPMailer(true);

            try {

                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = $requestedData['host'];
                $mail->SMTPAuth = true;
                $mail->Username = $requestedData['username'];
                $mail->Password = $requestedData['password'];
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom($requestedData['sender'], $requestedData['senderName']);
                $mail->addAddress($requestedData['reciver'], $requestedData['reciverName']);
                $mail->isHTML(true);
                $mail->Subject = $requestedData['subject'];
                $mail->Body    = $requestedData['message'];

                if ($mail->send()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        } else {
            return false;
        }
    }
}
