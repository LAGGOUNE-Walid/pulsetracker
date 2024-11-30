<?php

namespace Pulse\Traits;

trait SwooleRedisServerSubscriberAuth
{
    public function check(array $data): ?string
    {
        if (! array_key_exists(0, $data)) {
            return null;
        }
        [$appKey, $signature] = $this->getAppkeyAndSignature($data);
        if ($appKey === null or $signature === null) {
            return null;
        }
        if (! $this->appsDevicesTable->exists($appKey)) {
            return null;
        }

        if (! $this->hasValideSignature($appKey, $signature)) {
            return null;
        }

        return $appKey;
    }

    public function getAppkeyAndSignature(array $data): ?array
    {
        $data = explode(':', $data[0]);
        if (count($data) !== 2) {
            return null;
        }

        $data = $data[1];

        $data = explode('.', $data);
        if (count($data) !== 2) {
            return null;
        }

        return [$data[0], $data[1]];
    }

    public function hasValideSignature(string $appKey, string $signature): bool
    {
        $appDataInCache = $this->appsDevicesTable->get($appKey);
        $userId = $appDataInCache['userId'];
        $userTokens = $this->db->table('personal_access_tokens')->where('tokenable_type', 'App\Models\User')->where('tokenable_id', $userId)->get();

        $authenticated = false;
        foreach ($userTokens as $tokenModel) {
            if (
                hash_equals(
                    hash_hmac('sha256', $appKey, $tokenModel->token),
                    $signature,
                )
            ) {
                $authenticated = true;
            }
        }

        return $authenticated;
    }
}
