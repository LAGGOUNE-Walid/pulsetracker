<?php

namespace Pulse\Traits;

use Swoole\Table;

trait CheckIfUserExistsInCache
{
    public function createUserIfNotExists(int $userId, Table $usersQuotaTable): void
    {
        if (! $usersQuotaTable->exists($userId)) {
            echo "User id not in cache so create it \n";
            $this->addUserToCache($userId, $usersQuotaTable);
        }
    }

    public function addUserToCache(int $userId, Table $usersQuotaTable): void
    {
        $config = require 'config/pulse.php';
        $httpClient = new \GuzzleHttp\Client(['verify' => false]);
        $response = $httpClient->request('GET', $config['api_server'].'/api/users/quota?'.http_build_query(['ids' => [$userId]]));
        if ($response->getStatusCode() == 200) {
            $usersQuotaResponse = json_decode($response->getBody(), true)['data'];
            foreach ($usersQuotaResponse as $userQuota) {
                echo 'Set user '.$userQuota['id']." quota to cache \n";
                print_r($userQuota);
                echo "\n";
                $usersQuotaTable->set($userQuota['id'], [
                    'quota' => $userQuota['quota'],
                    'used' => $userQuota['used'],
                    'left' => $userQuota['left'],
                ]);
            }
        }
    }

    public function refreshUserCache(int $userId, Table $usersQuotaTable): void
    {
        $this->addUserToCache($userId, $usersQuotaTable);
    }
}
