<?php

/**
 *  Headers to enable cors and UTF-8 
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header ('Content-type: text/html; charset=UTF-8');

require_once './SendMail.php';

$sendmail = new SendMail;

if ($sendmail->send()) {
    echo "true";
} else {
    echo "false";
}
