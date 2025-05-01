<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

$accountSid = 'yoursid';  // Your Twilio Account SID
$authToken = 'yourtoken';    // Your Twilio Auth Token

// Initialize the Twilio client
$client = new Client($accountSid, $authToken);

// Your Twilio number
$twilioNumber = 'your number';  // Your Twilio phone number
//error_log("This is a test error message");
// Number you want to call
$toNumber = 'your number';  // The phone number to call

// TwiML URL for the call (Optional, this is the URL that Twilio will hit to get instructions on how to handle the call)
$twiMLUrl = 'https://63f7-103-52-138-167.ngrok-free.app/webhook.php';  // Replace with your TwiML URL

// Initiate the call
$call = $client->calls->create(
    $toNumber,      // The number to call
    $twilioNumber,  // Your Twilio number
    [
        'url' => $twiMLUrl  // This is the URL that Twilio will hit for the call instructions
    ]
);
error_log('TwiML Response: ' . $call);
echo "Call initiated: " . $call->sid;
?>
