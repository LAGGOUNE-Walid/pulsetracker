<?php

namespace App\Enums;

enum PointStatusInGeofence: String
{
    case INSIDE = 'inside';
    case OUTSIDE = 'outside';
}
