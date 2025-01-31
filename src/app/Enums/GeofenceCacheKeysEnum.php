<?php

namespace App\Enums;

enum GeofenceCacheKeysEnum: String
{
    case APP_KEY = 'app:{app_id}:geofences';
    case GEOFENCE_ID_KEY = 'geofence:id:{geofence_id}';
    case GEOFENCE_POLYGON_KEY = 'geofence:{geofence_id}:polygon';
    case DEVICE_GEOFENCES_STATE = 'device:{device_id}:geofences_stats';
}
