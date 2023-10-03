<?php
    // Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    require_once 'C:\xampp\htdocs\payment\twilio-php\twilio-php-main\src\Twilio\autoload.php';
    use Twilio\Rest\Client;

    $sid    = "ACa7792d51081580155bc9e733b56cbe93";
    $token  = "7f9dcde3c29d065f3dad4d7b56d42ba3";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
      ->create("+919025682115", // to
        array(
          "from" => "+18506958102",
          "body" => "good evening"
        )
      );

print($message->sid);