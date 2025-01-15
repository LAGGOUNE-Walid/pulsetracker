<?php

namespace App\Enums;

enum GeofenceCacheKeysEnum: String
{
    case APP_KEY = 'app:{app_id}:geofences';
    case GEOFENCE_KEY = 'geofence:{geofence_id}:polygon';
}
