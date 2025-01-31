<?php

use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Pulse\Actions\EnqueuePacketAction;
use Pulse\Actions\SavePacketAction;
use Pulse\Server\EventHandler\SwooleWsServerEventHandler;
use Pulse\Server\PacketParser\WsPacketParser;
use Pulse\Services\BroadcastPacketService;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

class SwooleWsServerIntegrationTest extends TestCase
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
        $wsPacketParser = new WsPacketParser(false);
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

        $logger = new Logger('test', [], []);

        $serverHandler = new SwooleWsServerEventHandler(
            $wsPacketParser,
            $broadcastService,
            $appsDevicesTable,
            $usersQuotaTable,
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
        $frame = new Frame;
        $frame->data = $packetData;
        $result = $serverHandler->onMessage($serverStub, $frame);
        $this->assertTrue($result);
        $packet = $wsPacketParser->fromString($packetData, $time);
        $this->assertNotNull($packet);
    }
}
