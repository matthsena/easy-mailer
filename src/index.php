<?php

/**
 *  Headers to enable cors and return json  
 */
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

require_once './SendMail.php';

$sendmail = new SendMail;

if ($sendmail->send()) {
    echo "true";
} else {
    echo "false";
}
