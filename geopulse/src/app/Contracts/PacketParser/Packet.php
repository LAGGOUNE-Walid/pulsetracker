<?php

namespace Pulse\Contracts\PacketParser;

use GeoJson\Geometry\Point;

interface Packet
{
    public function fromString(string $data): ?Packet;

    public function dataIsValide(array $data = []): bool;

    public function setAppId(string $appId): void;

    public function getAppId(): ?string;

    public function getClientId(): string;

    public function toPoint(): Point;

    public function toJson(): string;

    public function toArray(): array;

    public function getExtraData(): array;
}
