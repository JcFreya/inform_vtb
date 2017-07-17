<?php
require 'vendor/autoload.php';

 function sendemail($f,$s,$t,$m)
    {
    $from = new SendGrid\Email(null, $f);
    $subject = $s;
    $to = new SendGrid\Email(null, $t);
    $content = new SendGrid\Content("text/plain", $m);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

    // $apiKey = getenv('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');
    $apiKey = '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';
    $sg = new \SendGrid($apiKey);

    //General v3 Web API
    // $response = $sg->client->suppression()->bounces()->get();
    $response = $sg->client->mail()->send()->post($mail);
    
    // echo $response->statusCode();
    // echo $response->headers();
    // echo $response->body();	
    if ($response->statusCode()) {
    	return 1;
    }else{
    	return 0;
    }

    }

?>