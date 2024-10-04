<?php

namespace Pulse\Server\PacketParser;

use GeoJson\GeoJson;
use GeoJson\Geometry\Point;
use Pulse\Contracts\PacketParser\Packet;

class WsPacketParser implements Packet
{
    /**
     * The raw payload data associated with the packet.
     *
     * @var array{
     *     type: string,
     *     coordinates: array<float>
     * }
     */
    private array $payload;

    private array $extraData;

    /**
     * The Application ID extracted from the packet data.
     */
    private string $appId;

    /**
     * The Client ID extracted from the packet data.
     */
    private string $clientId;

    /**
     * The Client ip
     */
    private string $ip;

    public function __construct(private bool $usingMsgPack) {}

    public function fromString(string $data, string $ip): ?Packet
    {
        try {
            if ($this->usingMsgPack) {
                $unpackedData = msgpack_unpack($data);
            } else {
                $unpackedData = json_decode($data, true);
            }
        } catch (\Throwable $th) {
            $unpackedData = [];
            \Sentry\captureException($th);
        }

        if ($unpackedData !== [] and $unpackedData !== null and is_array($unpackedData)) {
            if ($this->dataIsValide($unpackedData)) {
                $this->appId = $unpackedData['appId'];
                $this->clientId = $unpackedData['clientId'];
                $this->payload = $unpackedData['data'];
                $this->ip = $ip;
                if (array_key_exists('extra', $unpackedData)) {
                    $this->extraData = $unpackedData['extra'];
                } else {
                    $this->extraData = [];
                }

                return $this;
            }
        }

        return null;
    }

    public function dataIsValide(array $data): bool
    {
        return array_key_exists('appId', $data) and array_key_exists('clientId', $data) and array_key_exists('data', $data);
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function toPoint(): Point
    {
        try {
            $point = GeoJson::jsonUnserialize($this->payload);
        } catch (\Throwable $th) {
            return GeoJson::jsonUnserialize(['type' => 'Point', 'coordinates' => [0, 0]]);
        }

        if (! ($point instanceof Point)) {
            return GeoJson::jsonUnserialize(['type' => 'Point', 'coordinates' => [0, 0]]);
        }

        return $point;
    }

    public function toJson(): string
    {
        $json = json_encode($this->toArray());
        if (! $json) {
            return '{}';
        }

        return $json;
    }

    public function getExtraData(): array
    {
        return $this->extraData;
    }

    public function toArray(): array
    {
        return [
            'point' => $this->toPoint(),
            'appId' => $this->getAppId(),
            'clientId' => $this->getClientId(),
            'ip' => $this->ip,
            'extraData' => $this->extraData,
        ];
    }
}
