<?php

namespace Pulse\Server\PacketParser;

use GeoJson\GeoJson;
use GeoJson\Geometry\Point;
use Pulse\Contracts\PacketParser\Packet;

class UdpPacketParser implements Packet
{
    private array $payload;
    private array $extraData;
    private ?string $appId = null;
    private string $clientId;

    public function __construct(private bool $usingMsgPack) {}

    public function fromString(string $data): ?Packet
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
                if (array_key_exists("appId", $unpackedData)) {
                    $this->appId = $unpackedData['appId'];
                }

                $this->clientId = $unpackedData['clientId'];
                $this->payload = $unpackedData['data'];
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

    public function dataIsValide(array $data = []): bool
    {
        return array_key_exists('clientId', $data) and array_key_exists('data', $data);
    }

    public function setAppId(string $appId): void
    {
        $this->appId = $appId;
    }

    public function getAppId(): ?string
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
            'extraData' => $this->extraData,
        ];
    }
}
