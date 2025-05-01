<?php
// webhook.php

require __DIR__ . '/vendor/autoload.php';

use Twilio\TwiML\VoiceResponse;
use Twilio\Security\RequestValidator;
use Dotenv\Dotenv;

// Load hidden settings
$env = Dotenv::createImmutable(__DIR__);
$env->load();

// Twilio Auth Token from the .env file
$key = $_ENV['TWILIO_AUTH_TOKEN'];
$validator = new RequestValidator($key);

// Extract request details quietly
$signature = $_SERVER['HTTP_X_TWILIO_SIGNATURE'] ?? '';
$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$postParams = $_POST;

// Log incoming request data (for debugging)
error_log('Incoming Twilio Request: ' . print_r($_POST, true));

// Stealthy check to ensure the request is from Twilio
if (!$validator->validate($signature, $url, $postParams)) {
    header('Content-Type: text/plain');
    http_response_code(403);
     echo 'Invalid Twilio Signature';
     error_log("Invalid Twilio Signature received for URL: " . $url); // Log the error
    exit;
}


$websocketUrl = 'wss://devapi.ivoz.ai/llm-campaigns/ws/groq/?bot=ivoz';

// Log the call SID (if needed)
  error_log("Webhook received. Generating TwiML for WebSocket: " . $websocketUrl); // Log info

// Create TwiML response to stream call audio to the WebSocket
$r = new VoiceResponse();
$r->connect()->stream([
    'url' => $websocketUrl,
    'track' => 'inbound_track' // Define the track name
]);

// Set the response content type to XML (TwiML)
header('Content-Type: application/xml');
echo $r;

// Optionally, log the webhook response for debugging
error_log('My webhook Response: ' . $r);
?>
