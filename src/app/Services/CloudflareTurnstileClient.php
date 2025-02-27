<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Services\CloudflareTurnstileResponse;

class CloudflareTurnstileClient
{
    private const TURNSTILE_VERIFY_ENDPOINT = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    private const RETRY_ATTEMPTS = 3;
    private const RETRY_DELAY = 100;

    public function siteVerify(string $response): CloudflareTurnstileResponse
    {
        $verificationResponse = $this->sendTurnstileVerificationRequest($response);

        return $this->parseVerificationResponse($verificationResponse);
    }

    private function sendTurnstileVerificationRequest(string $response): Response
    {
        return Http::retry(self::RETRY_ATTEMPTS, self::RETRY_DELAY)
                   ->asForm()
                   ->acceptJson()
                   ->post(self::TURNSTILE_VERIFY_ENDPOINT, [
                       'secret'   => config('services.cloudflare.turnstile.site_secret'),
                       'response' => $response,
                   ]);
    }

    private function parseVerificationResponse(Response $response): CloudflareTurnstileResponse
    {
        if (!$response->ok()) {
            return new CloudflareTurnstileResponse(success: false, errorCodes: []);
        }

        return new CloudflareTurnstileResponse(
            success: $response->json('success'),
            errorCodes: $response->json('error-codes')
        );
    }
}