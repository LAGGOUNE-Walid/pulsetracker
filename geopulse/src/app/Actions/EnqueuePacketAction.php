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
            $queueConnection::push('App\Jobs\PulseLocationUpdatedJob@handle', $packet->toArray(), 'geopulse');
            $this->queueConnectionsPool->put($queueConnection);
        } catch (\Throwable $th) {
            \Sentry\captureException($th);
        }
    }
}
