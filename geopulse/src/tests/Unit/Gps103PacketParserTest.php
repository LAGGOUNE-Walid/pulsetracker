<?php

use PHPUnit\Framework\TestCase;
use Pulse\Enums\Gps103MessageType;
use Pulse\Server\PacketParser\Gps103PacketParser;

final class Gps103PacketParserTest extends TestCase
{
    public function setUp(): void
    {
        error_reporting(E_ALL);
    }

    public function testMessagesArePassedCorrectly(): void
    {
        $gps103PacketParser = new Gps103PacketParser;
        $packet = $gps103PacketParser->fromString('', '123');
        $this->assertEquals($packet->getType(), Gps103MessageType::ERROR);

        $packet = $gps103PacketParser->fromString('##,imei:359586015829802,A', '123');
        $this->assertEquals($packet->getType(), Gps103MessageType::LOGIN_REQUEST);

        $packet = $gps103PacketParser->fromString('359586015829802', '123');
        $this->assertEquals($packet->getType(), Gps103MessageType::HEARTBEAT);

        $packet = $gps103PacketParser->fromString('imei:359586015829802,tracker,0809231929,13554900601,F,112909.397,A,2234.4669,N,11354.3287,E,0.11,', '123');
        $this->assertEquals($packet->getType(), Gps103MessageType::POSITION_GPS);

        $packet = $gps103PacketParser->fromString('imei:359586015829802,move,000000000,13554900601,L,', '123');
        $this->assertEquals($packet->getType(), Gps103MessageType::POSITION_NO_GPS);

        $packet = $gps103PacketParser->fromString('imei:359586015829802,help me,000000000,13554900601,L,', '123');
        $this->assertEquals($packet->getType(), Gps103MessageType::POSITION_NO_GPS);

        $packet = $gps103PacketParser->fromString('imei:359586015829802,help me,0809231429,13554900601,F,062947.294,A,2234.4026,N,11354.3277,E,0.00,', '123');
        $this->assertEquals($packet->getType(), Gps103MessageType::POSITION_GPS);
        $this->assertTrue($packet->dataIsValide());

        $point = $packet->toPoint();
        $this->assertEquals([113.90546166666667, 22.573376666666665], $point->getCoordinates());

    }
}
