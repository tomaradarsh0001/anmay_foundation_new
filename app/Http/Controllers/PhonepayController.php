<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PhonepayController extends Controller
{
    // PhonePe sandbox credentials
    private $clientId = 'M23EAVEL66U6Q_2602091652';
    private $clientSecret = 'YjVjNGVkNDctZDk0Ny00ODIwLTk5ZDAtNjhlMWU1MDJkY2Q3';
    private $clientVersion = '1';

    // Get access token
    private function getAccessToken()
    {
        try {
            $response = Http::asForm()->post('https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token', [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'client_version' => $this->clientVersion,
                'grant_type' => 'client_credentials'
            ]);

            Log::info('Token Response', ['response' => $response->body()]);

            $data = $response->json();

            if (isset($data['access_token'])) {
                return $data['access_token'];
            }

            throw new \Exception('Access token not received: ' . $response->body());
        } catch (\Exception $e) {
            Log::error('Failed to get access token', ['error' => $e->getMessage()]);
            return null;
        }
    }

    // Initiate payment
    public function initiatePayment(Request $request)
    {
        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get access token'
            ]);
        }

        // Convert amount to paise
        $amountPaise = intval($request->amount) * 100;

        // Unique order ID
        $merchantOrderId = 'ORDER' . time();

        $payload = [
    'merchantOrderId' => 'ORDER' . time(),
    'amount' => $amountPaise,
    'expireAfter' => 1200,
    'metaInfo' => [
        'udf1' => $request->fullName,
        'udf2' => $request->email,
        'udf3' => $request->phone,
        'udf4' => 'Donation',
        'udf5' => 'Ref1'
    ],
    'paymentFlow' => [
        'type' => 'PG_CHECKOUT',
        'message' => 'Donation Payment',
        'merchantUrls' => [
            'redirectUrl' => 'https://abc123.ngrok.io/donation-success' // must be public
        ]
    ]
];


        Log::info('Payment Payload', ['payload' => $payload]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken
        ])->post('https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/pay', $payload);

        Log::info('Payment Response', ['response' => $response->body()]);

        $data = $response->json();

        if (isset($data['redirectUrl'])) {
            // Redirect to PhonePe payment page
            return redirect($data['redirectUrl']);
        }

        return response()->json([
            'success' => false,
            'message' => 'Payment URL not received',
            'debug' => $data
        ]);
    }

    // Payment success page
    public function paymentSuccess(Request $request)
    {
        return view('donation-success');
    }
}
