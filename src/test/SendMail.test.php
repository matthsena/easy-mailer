<?php


header('Access-Control-Allow-Origin: *');
header ('Content-type: text/html; charset=UTF-8');

use PHPUnit\Framework\TestCase;

require_once './SendMail.php';

class PDFText extends TestCase
{
    public function test_content() 
    {
        $sendmail = new SendMail;
        // $sendmail -> send();
        $this->assertEquals(false, $sendmail->send());
    }
}
