<?php

namespace Pulse\Actions;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Connection;
use Illuminate\Database\PostgresConnection;
use Pulse\Contracts\Action\PacketActionContract;
use Pulse\Contracts\PacketParser\Packet;
use Swoole\ConnectionPool;

class SavePacketAction implements PacketActionContract
{
    public function __construct(private ConnectionPool $databaseConnectionsPool, public string $table) {}

    public function handle(Packet $packet): void
    {
        try {
            $db = $this->databaseConnectionsPool->get();

            $db->table($this->table)->insert([
                'appId' => $packet->getAppId(),
                'clientId' => $packet->getClientId(),
                'coordinate' => DB::raw($this->buildInsertPointQuery($packet->toPoint()->getCoordinates(), $db)),
            ]);
            $this->databaseConnectionsPool->put($db);
        } catch (\Throwable $th) {
            \Sentry\captureException($th);
        }
    }

    public function buildInsertPointQuery(array $point, Connection $connection): string
    {
        if ($connection instanceof PostgresConnection) {
            return "ST_GeomFromText('POINT(".implode(' ', $point).")')::POINT";
        }

        return "ST_GeomFromText('POINT(".implode(' ', $point).")')";
    }
}
