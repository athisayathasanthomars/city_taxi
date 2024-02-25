<?php
require_once 'vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic("35118043", "rQAB9HxMhCMbSH3R");
$client = new \Vonage\Client($basic);

$response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS("94761164638",'Admin-Thomars', 'A testing text message sent using the Nexmo SMS API')
);

$message = $response->current();

if ($message->getStatus() == 0) {
    echo "The message was sent successfully\n";
} else {
    echo "The message failed with status: " . $message->getStatus() . "\n";
}

?>