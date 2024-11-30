<?php

namespace Pulse\Actions;

use Pulse\Contracts\Action\PacketActionContract;
use Pulse\Contracts\PacketParser\Packet;
use Swoole\ConnectionPool;

class EnqueuePacketAction implements PacketActionContract
{
    public function __construct(private ConnectionPool $queueConnectionsPool) {}

    public function handle(Packet $packet): void
    {
        try {
            $queueConnection = $this->queueConnectionsPool->get();
            // Push to laravel
            $queueConnection::push('App\Jobs\PulseLocationUpdatedJob@handle', $packet->toArray(), 'geopulse');
            // Push for our internal redis subscribe server can get location updates
            $queueConnection::push('ExampleJob', $packet->toArray(), 'geopulse-redis-pubsub');

            $this->queueConnectionsPool->put($queueConnection);
        } catch (\Throwable $th) {
            \Sentry\captureException($th);
        }
    }
}
