<?php

namespace App\Rules;

use Closure;
use App\Services\CloudflareTurnstileClient;
use App\Services\CloudflareTurnstileResponse;
use Illuminate\Contracts\Validation\ValidationRule;

class CloudflareTurnstile implements ValidationRule
{
    private CloudflareTurnstileClient $turnstileClient;

    public function __construct()
    {
        $this->turnstileClient = app(CloudflareTurnstileClient::class);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = $this->turnstileClient->siteVerify($value);

        if (!$response->isSuccess()) {
            $this->handleErrorCodes($response, $fail);
        }
    }

    private function handleErrorCodes(CloudflareTurnstileResponse $response, Closure $fail): void
    {
        foreach ($response->getErrorCodes() as $errorCode) {
            $fail($this->mapErrorCodeToMessage($errorCode));
        }
    }

    private function mapErrorCodeToMessage(string $code): string
    {
        return match ($code) {
            'missing-input-secret' => 'The secret parameter was not passed.',
            'invalid-input-secret' => 'The secret parameter was invalid or did not exist.',
            'missing-input-response' => 'The response parameter was not passed.',
            'invalid-input-response' => 'The response parameter is invalid or has expired.',
            'bad-request' => 'The request was rejected because it was malformed.',
            'timeout-or-duplicate' => 'The response parameter has already been validated before.',
            'internal-error' => 'An internal error happened while validating the response.',
            default => 'An unexpected error occurred.',
        };
    }
}
