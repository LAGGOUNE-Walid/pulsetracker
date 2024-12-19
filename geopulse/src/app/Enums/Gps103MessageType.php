<?php

namespace Pulse\Enums;

enum Gps103MessageType
{
    case ERROR;
    case UNKNOWN;
    case LOGIN_REQUEST;
    case HEARTBEAT;
    case POSITION_NO_GPS;
    case POSITION_GPS;
}
