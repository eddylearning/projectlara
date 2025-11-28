<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Payment;
use App\Models\PaymentLog;
use Exception;

class MpesaService
{
    private $shortcode;
    private $passkey;
    private $env;
    private $baseUrl;

    public function __construct()
    {
        $this->shortcode = config('mpesa.shortcode');
        $this->passkey   = config('mpesa.passkey');
        $this->env       = config('mpesa.env');
        $this->baseUrl   = config('mpesa.base_url')[$this->env];
    }

    /**
     * Log MPESA request/response
     */
    private function log($paymentId, $type, $statusCode = null, $message = null, $request = null, $response = null)
    {
        PaymentLog::create([
            'payment_id'     => $paymentId,
            'type'           => $type,
            'status_code'    => $statusCode,
            'status_message' => $message,
            'raw_request'    => $request,
            'raw_response'   => $response,
        ]);
    }

    /**
     * Get MPESA OAuth Token with error logging
     */
    public function token($payment = null)
    {
        $url = "{$this->baseUrl}/oauth/v1/generate?grant_type=client_credentials";

        try {
            $this->log(
                $payment?->id,
                'token_request',
                null,
                'Requesting OAuth token'
            );

            $response = Http::withBasicAuth(
                config('mpesa.consumer_key'),
                config('mpesa.consumer_secret')
            )->get($url);

            if (!$response->successful()) {
                $this->log(
                    $payment?->id,
                    'token_error',
                    $response->status(),
                    'Token request failed',
                    null,
                    $response->json()
                );
                return null;
            }

            return $response['access_token'] ?? null;

        } catch (Exception $e) {
            $this->log(
                $payment?->id,
                'system_error',
                null,
                'Exception during token request: ' . $e->getMessage()
            );
            return null;
        }
    }

    /**
     * Send STK Push request with full logging
     */
    public function stkPush(Payment $payment, $phone, $amount, $accountRef = 'Booking', $desc = 'Car Booking Payment')
    {
        $timestamp = now()->format('YmdHis');

        $password = base64_encode(
            $this->shortcode . $this->passkey . $timestamp
        );

        $url = "{$this->baseUrl}/mpesa/stkpush/v1/processrequest";

        $payload = [
            "BusinessShortCode" => $this->shortcode,
            "Password"          => $password,
            "Timestamp"         => $timestamp,
            "TransactionType"   => "CustomerPayBillOnline",
            "Amount"            => $amount,
            "PartyA"            => $phone,
            "PartyB"            => $this->shortcode,
            "PhoneNumber"       => $phone,
            "CallBackURL"       => config('app.url') . '/api/mpesa/callback',
            "AccountReference"  => $accountRef,
            "TransactionDesc"   => $desc,
        ];

        try {
            $response = Http::withToken($this->token($payment))->post($url, $payload);

            // Log stk request
            $this->log(
                $payment->id,
                'stk_request',
                $response->json()['ResponseCode'] ?? $response->status(),
                $response->json()['ResponseDescription'] ?? 'STK push initiated',
                $payload,
                $response->json()
            );

            // If MPESA shows failure
            if (($response->json()['ResponseCode'] ?? '') !== "0") {
                $this->log(
                    $payment->id,
                    'stk_error',
                    $response->json()['ResponseCode'] ?? null,
                    $response->json()['errorMessage'] ?? 'STK push failed',
                    $payload,
                    $response->json()
                );
            }

            return $response->json();

        } catch (Exception $e) {
            $this->log(
                $payment->id,
                'system_error',
                null,
                'Exception during STK push: ' . $e->getMessage(),
                $payload,
                null
            );
            return null;
        }
    }

    /**
     * Handle MPESA callback logging is done in CallbackController
     */
}
