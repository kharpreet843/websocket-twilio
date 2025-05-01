# Twilio Webhook Integration

## 🚀 Setup Instructions

1. **Clone the repository:**

```bash
git clone https://github.com/kharpreet843/websocket-twilio.git
cd websocket-twilio

Run composer install
Create Environment File

TWILIO_AUTH_TOKEN=your_twilio_auth_token_here
Start PHP Development Server

php -S 0.0.0.0:8000

Expose Localhost with Ngrok

ngrok http 8000

 Configure Twilio Webhook
 Log in to the Twilio Console

Navigate to:
Phone Numbers → Manage → Active Numbers → +1 (934) 253-0570

Under Voice & Fax, set:

A CALL COMES IN: Webhook

URL: https://test.ngrok.io/webhook.php

Method: HTTP POST

Click Save

or alternatively you can also pass twilio accountSid and authtoken in request.php and place a call withit.

Call the Twilio number: +1 (934) 253-0570

Observe the terminal logs (the webhook will generate TwiML with WebSocket stream)

Verify that the WebSocket server receives the audio stream