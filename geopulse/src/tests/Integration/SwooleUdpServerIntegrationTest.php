<?php

use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Pulse\Actions\EnqueuePacketAction;
use Pulse\Actions\SavePacketAction;
use Pulse\Server\EventHandler\SwooleUdpServerEventHandler;
use Pulse\Server\PacketParser\UdpPacketParser;
use Pulse\Services\BroadcastPacketService;
use Swoole\Server;

class SwooleUdpServerIntegrationTest extends TestCase
{
    public function setUp(): void
    {
        error_reporting(E_ALL);
    }

    public function testEndToEndDataFlow()
    {

        $serverStub = $this->getMockBuilder(Server::class)->disableOriginalConstructor()->getMock();
        $serverStub->method('task')
            ->willReturn(1);
        $udpPacketParser = new UdpPacketParser(false);
        $broadcastService = $this->createMock(BroadcastPacketService::class);
        $enqueuePacketAction = $this->createMock(EnqueuePacketAction::class);
        $savePacketAction = $this->createMock(SavePacketAction::class);
        $broadcastService->addAction($enqueuePacketAction);
        $broadcastService->addAction($savePacketAction);

        $appsDevicesTable = new Swoole\Table(1024);
        $appsDevicesTable->column('devicesKeys', Swoole\Table::TYPE_STRING, 1024);
        $appsDevicesTable->column('userId', Swoole\Table::TYPE_INT);
        $appsDevicesTable->create();
        $appsDevicesTable->set('app123', ['devicesKeys' => json_encode(['device123']), 'userId' => 1]);

        $usersQuotaTable = new Swoole\Table(1024);
        $usersQuotaTable->column('quota', Swoole\Table::TYPE_INT);
        $usersQuotaTable->column('used', Swoole\Table::TYPE_INT);
        $usersQuotaTable->column('left', Swoole\Table::TYPE_INT);
        $usersQuotaTable->create();
        $usersQuotaTable->set(1, [
            'quota' => 1000,
            'used' => 0,
            'left' => 1000,
        ]);

        $deviceAppsTable = new Swoole\Table(1024);
        $deviceAppsTable->column('appKey', Swoole\Table::TYPE_STRING, 36);
        $deviceAppsTable->column('userId', Swoole\Table::TYPE_INT);
        $deviceAppsTable->create();
        $deviceAppsTable->set("device123", ['appKey' => "app123", 'userId' => 1]);

        $logger = new Logger('test', [], []);

        $serverHandler = new SwooleUdpServerEventHandler(
            $udpPacketParser,
            $broadcastService,
            $appsDevicesTable,
            $usersQuotaTable,
            $deviceAppsTable,
            $logger
        );

        $time = time();

        $packetData = json_encode([
            'appId' => 'app123',
            'clientId' => 'device123',
            'data' => [
                'type' => 'Point',
                'coordinates' => [102.0, 0.5],
            ],
            'receivedAt' => $time
        ]);

        $broadcastService->expects($this->once())
            ->method('dropAndPopPacket');
        $result = $serverHandler->onPacket($serverStub, $packetData, ['address' => '127.0.0.1', 'port' => 12345]);
        $this->assertTrue($result);
        $packet = $udpPacketParser->fromString($packetData, $time);
        $this->assertNotNull($packet);
    }

    public function testServerVerifications(): void
    {
        $serverStub = $this->getMockBuilder(Server::class)->disableOriginalConstructor()->getMock();
        $serverStub->method('task')
            ->willReturn(1);
        $udpPacketParser = new UdpPacketParser(false);
        $broadcastService = $this->createMock(BroadcastPacketService::class);
        $enqueuePacketAction = $this->createMock(EnqueuePacketAction::class);
        $savePacketAction = $this->createMock(SavePacketAction::class);
        $broadcastService->addAction($enqueuePacketAction);
        $broadcastService->addAction($savePacketAction);

        $appsDevicesTable = new Swoole\Table(1024);
        $appsDevicesTable->column('devicesKeys', Swoole\Table::TYPE_STRING, 1024);
        $appsDevicesTable->column('userId', Swoole\Table::TYPE_INT);
        $appsDevicesTable->create();
        $appsDevicesTable->set('app123', ['devicesKeys' => json_encode(['device123']), 'userId' => 1]);

        $deviceAppsTable = new Swoole\Table(1024);
        $deviceAppsTable->column('appKey', Swoole\Table::TYPE_STRING, 36);
        $deviceAppsTable->column('userId', Swoole\Table::TYPE_INT);
        $deviceAppsTable->create();
        $deviceAppsTable->set("device123", ['appKey' => "app123", 'userId' => 1]);

        $usersQuotaTable = new Swoole\Table(1024);
        $usersQuotaTable->column('quota', Swoole\Table::TYPE_INT);
        $usersQuotaTable->column('used', Swoole\Table::TYPE_INT);
        $usersQuotaTable->column('left', Swoole\Table::TYPE_INT);
        $usersQuotaTable->create();
        $usersQuotaTable->set(1, [
            'quota' => 1000,
            'used' => 0,
            'left' => 1000,
        ]);

        $logger = new Logger('test', [], []);

        $serverHandler = new SwooleUdpServerEventHandler(
            $udpPacketParser,
            $broadcastService,
            $appsDevicesTable,
            $usersQuotaTable,
            $deviceAppsTable,
            $logger
        );
        $time = time();
        $packetData = json_encode([
            'appId' => 'app1234',
            'clientId' => 'device123',
            'data' => [
                'type' => 'Point',
                'coordinates' => [102.0, 0.5],
            ],
            'receivedAt' => $time
        ]);
        $result = $serverHandler->onPacket($serverStub, $packetData, ['address' => '127.0.0.1', 'port' => 12345]);
        $this->assertFalse($result);

        $packetData = json_encode([
            'appId' => 'app123',
            'clientId' => 'device1234',
            'data' => [
                'type' => 'Point',
                'coordinates' => [102.0, 0.5],
            ],
            'receivedAt' => $time
        ]);
        $result = $serverHandler->onPacket($serverStub, $packetData, ['address' => '127.0.0.1', 'port' => 12345]);
        $this->assertFalse($result);

        $usersQuotaTable->set(1, [
            'quota' => 1000,
            'used' => 1000,
            'left' => -1,
        ]);
        $packetData = json_encode([
            'appId' => 'app123',
            'clientId' => 'device123',
            'data' => [
                'type' => 'Point',
                'coordinates' => [102.0, 0.5],
            ],
            'receivedAt' => $time
        ]);
        $result = $serverHandler->onPacket($serverStub, $packetData, ['address' => '127.0.0.1', 'port' => 12345]);
        $this->assertTrue($result);

        $packetData = json_encode([
            'clientId' => 'device123',
            'data' => [
                'type' => 'Point',
                'coordinates' => [102.0, 0.5],
            ],
            'receivedAt' => $time
        ]);
        $result = $serverHandler->onPacket($serverStub, $packetData, ['address' => '127.0.0.1', 'port' => 12345]);
        $this->assertTrue($result);
    }
}
