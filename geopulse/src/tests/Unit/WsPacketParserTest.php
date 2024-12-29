<?php

use GeoJson\Geometry\Point;
use PHPUnit\Framework\TestCase;
use Pulse\Server\PacketParser\WsPacketParser;

final class WsPacketParserTest extends TestCase
{
    public function setUp(): void
    {
        error_reporting(E_ALL);
    }

    public function testThatMsgPackedDataIsUnpacked(): void
    {
        $wsPacketParser = new WsPacketParser(true);
        $data = msgpack_pack(['appId' => 123, 'clientId' => 123, 'data' => []]);
        $packet = $wsPacketParser->fromString($data, '123');
        $this->assertEquals($packet->getAppId(), 123);
    }

    public function testThatMsgPackedDataIsNotUnpackedIfMsgpackDisabled(): void
    {
        $wsPacketParser = new WsPacketParser(false);
        $data = json_encode(['appId' => 123, 'clientId' => 123, 'data' => []]);
        $packet = $wsPacketParser->fromString($data, '123');
        $this->assertEquals($packet->getAppId(), 123);
    }

    public function testGettingAppId(): void
    {
        $wsPacketParser = new WsPacketParser(false);
        $data = '{"data":{"type":"Point","coordinates":[1,1]},"appId":"22f8e456-93f2-4173-8f2d-8a010abcceb1","clientId":"22f8e456-93f2-4173-8f2d-8a010abcceb1"}';
        $packet = $wsPacketParser->fromString($data, '123');
        $this->assertEquals('22f8e456-93f2-4173-8f2d-8a010abcceb1', $packet->getAppId());
    }

    public function testGettingPointFromData(): void
    {
        $wsPacketParser = new WsPacketParser(false);
        $data = '{"data":{"type":"Point","coordinates":[1,1]},"appId":"22f8e456-93f2-4173-8f2d-8a010abcceb1","clientId":"22f8e456-93f2-4173-8f2d-8a010abcceb1"}';
        $packet = $wsPacketParser->fromString($data, '123');
        $this->assertTrue($packet->toPoint() instanceof Point);
    }

    public function testGettingNullPointFromDataThatDosentHaveJson(): void
    {
        $wsPacketParser = new WsPacketParser(false);
        $data = '';
        $packet = $wsPacketParser->fromString($data, '123');
        $this->assertEquals(null, $packet);
    }

    public function testGettingNullPointFromData(): void
    {
        $wsPacketParser = new WsPacketParser(false);
        $data = '{"data":{},"appId":"22f8e456-93f2-4173-8f2d-8a010abcceb1","clientId":"22f8e456-93f2-4173-8f2d-8a010abcceb1"}';
        $packet = $wsPacketParser->fromString($data, '123');
        $this->assertEquals([0, 0], $packet->toPoint()->getCoordinates());
    }

    public function testGettingEmptyJsonOfNonValidePoint(): void
    {
        $wsPacketParser = new WsPacketParser(false);
        $data = '{"data":{"type":"Point"},"appId":"22f8e456-93f2-4173-8f2d-8a010abcceb1","clientId":"22f8e456-93f2-4173-8f2d-8a010abcceb1"}';
        $packet = $wsPacketParser->fromString($data, '123');
        $this->assertEquals($packet->toPoint()->getCoordinates(), [0, 0]);
        $this->assertEquals('{"point":{"type":"Point","coordinates":[0,0]},"appId":"22f8e456-93f2-4173-8f2d-8a010abcceb1","clientId":"22f8e456-93f2-4173-8f2d-8a010abcceb1","extraData":[]}', $packet->toJson());
    }
}
