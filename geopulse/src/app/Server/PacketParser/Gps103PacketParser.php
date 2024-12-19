<?php

namespace Pulse\Server\PacketParser;

use GeoJson\GeoJson;
use GeoJson\Geometry\Point;
use Pulse\Contracts\PacketParser\Packet;
use Pulse\Enums\Gps103MessageType;

class Gps103PacketParser implements Packet
{
    private array $payload;

    private array $extraData;

    private string $appId;

    private string $clientId;

    private string $ip;

    private string $raw_message;

    private Gps103MessageType $type;

    private int $imei;

    private string $keyword;

    private ?string $time;

    private ?float $latitude;

    private ?string $latitude_direction;

    private ?float $longitude;

    private ?string $longitude_direction;

    private ?float $altitude;

    private ?float $speed;

    private ?string $direction;

    private ?float $oil_1;

    private ?float $oil_2;

    private ?float $temperature;

    private ?string $acc_state;

    private ?string $door_state;

    public function fromString(string $data, string $ip): ?Packet
    {
        $this->ip = $ip;
        // Split the message into parts
        $parts = explode(',', $data);
        $this->raw_message = $data;

        // Handle Logon request
        if (preg_match('/^##,imei:(\d{1,15}),A$/', trim($data), $loginMatch)) {
            $this->type = Gps103MessageType::LOGIN_REQUEST;
            $this->imei = $this->clientId = $loginMatch[1];

            return $this;
        }

        // Handle Heartbeat message (IMEI only, e.g., "359586015829802")
        if (preg_match('/^\d{1,15}$/', trim($data))) {
            $this->type = Gps103MessageType::HEARTBEAT;
            $this->imei = $this->clientId = trim($data);

            return $this;
        }

        // Check if it has a valid header with IMEI
        if (! preg_match('/^imei:(\d{1,15})/', $parts[0], $imeiMatch)) {
            $this->type = Gps103MessageType::ERROR;

            return $this;
        }

        // Extract IMEI
        $this->imei = $this->clientId = $imeiMatch[1];

        // Extract Keyword (2nd part of the message)
        $this->keyword = $parts[1] ?? null;

        // Determine message type
        if (count($parts) == 6 && $parts[4] === 'L') {
            // Single position with no GPS signal
            $this->type = Gps103MessageType::POSITION_NO_GPS;
        } elseif (count($parts) >= 11 && $parts[4] === 'F') {
            // Single or multiple positions with GPS signal
            $this->type = Gps103MessageType::POSITION_GPS;
            // Extract GPS-related fields
            $this->time = $parts[2] ?? null;
            $this->latitude = $parts[7] ?? null;
            $this->latitude_direction = $parts[8] ?? null;
            $this->longitude = $parts[9] ?? null;
            $this->longitude_direction = $parts[10] ?? null;

            // Extract optional fields
            $this->speed = $parts[11] ?? null;
            $this->direction = $parts[12] ?? null;
            $this->altitude = $parts[13] ?? null;
            $this->acc_state = $parts[14] ?? null;
            $this->door_state = $parts[15] ?? null;
            $this->oil_1 = $parts[16] ?? null;
            $this->oil_2 = $parts[17] ?? null;
            $this->temperature = $parts[18] ?? null;
        } else {
            // Unknown type
            $this->type = Gps103MessageType::UNKNOWN;
        }

        // Validate latitude and longitude for GPS messages
        if (
            $this->type === Gps103MessageType::POSITION_GPS &&
            (empty($this->latitude) || empty($this->longitude))
        ) {
            $this->type = Gps103MessageType::ERROR;
        }

        return $this;
    }

    public function dataIsValide(array $data = []): bool
    {
        return ! in_array($this->type, [Gps103MessageType::ERROR, Gps103MessageType::UNKNOWN, Gps103MessageType::POSITION_NO_GPS]);
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
            $longitude = $this->convertToDecimalDegrees($this->longitude, $this->longitude_direction);
            $latitude = $this->convertToDecimalDegrees($this->latitude, $this->longitude_direction);
            $point = GeoJson::jsonUnserialize(['type' => 'Point', 'coordinates' => [$longitude, $latitude]]);
        } catch (\Throwable $th) {
            return GeoJson::jsonUnserialize(['type' => 'Point', 'coordinates' => [0, 0]]);
        }

        if (! ($point instanceof Point)) {
            return GeoJson::jsonUnserialize(['type' => 'Point', 'coordinates' => [0, 0]]);
        }

        return $point;
    }

    public function convertToDecimalDegrees($coordinate, $hemisphere)
    {
        // Extract degrees (first part) and minutes (remaining part)
        $degrees = floor($coordinate / 100); // Extract degrees (e.g., 22 from 2234.4669)
        $minutes = $coordinate - ($degrees * 100); // Extract minutes (e.g., 34.4669 from 2234.4669)

        // Convert to decimal degrees
        $decimalDegrees = $degrees + ($minutes / 60);

        // Adjust for hemisphere
        if ($hemisphere === 'S' || $hemisphere === 'W') {
            $decimalDegrees = -$decimalDegrees; // South or West are negative
        }

        return $decimalDegrees;
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
        return [
            'raw_message' => $this->raw_message,
            'imei' => $this->imei,
            'time' => $this->time,
            'altitude' => $this->altitude,
            'speed' => $this->speed,
            'direction' => $this->direction,
            'oil_1' => $this->oil_1,
            'oil_2' => $this->oil_2,
            'temperature' => $this->temperature,
            'acc_state' => $this->acc_state,
            'door_state' => $this->door_state,
        ];
    }

    public function toArray(): array
    {
        return [
            'point' => $this->toPoint(),
            'appId' => $this->getAppId(),
            'clientId' => $this->getClientId(),
            'ip' => $this->ip,
            'extraData' => $this->getExtraData(),
        ];
    }

    public function getType(): Gps103MessageType
    {
        return $this->type;
    }

    public function setAppId(string $appId): void
    {
        $this->appId = $appId;
    }
}
