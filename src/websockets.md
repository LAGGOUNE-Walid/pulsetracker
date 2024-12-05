## Client (Device) configuration
| Key | UDP | Websocekts |
|-----|------|---------|
|  HOST/URI  |    udp-tracking.pulsestracker.com   |   wss://ws-tracking.pulsestracker.com     |
|   Port  |    9506   |    /    |

> **Note**: If your quota is exceeded, the server will respond with an `"ERR_QUOTA"` message to your clients (Both UDP & Websockes).
#### UDP Python example
```python
import json
import socket

# Data to be sent
data = {
    "appId": "YOUR_APP_KEY",
    "clientId": "CLIENT_KEY",
    # GeoJSON format with type "Point" and coordinates [longitude, latitude]
    "data": {
        "type": "Point",
        "coordinates": [-14.80665, -140.22159]
    },
    'extra' : {
        'speed' : 100,
    },
}

# Convert the data to a JSON string
json_data = json.dumps(data)

# Create a UDP socket
sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)

# Define the host and port

# Send the data
sock.sendto(json_data.encode('utf-8'), (host, port))
print(f"Location sent: {json_data}")

# Close the socket
sock.close()
```

#### Javascript websockets example
```javascript
var wsServer = 'wss://ws-tracking.pulsestracker.com';
var websocket = new WebSocket(wsServer);
const appId = 'YOUR_APP_KEY';
const clientId = 'YOUR_CLIENT_KEY';

websocket.onopen = function(evt) {
    console.log("Connected to WebSocket server.");
    // Send location every 2 seconds
    setInterval(() => {
        if (websocket.readyState === WebSocket.OPEN) {
            navigator.geolocation.getCurrentPosition((position) => {
                console.log(position);
                const locationData = {
                    appId: appId,
                    clientId: clientId,
                    data: {
                        type: "Point",
                        coordinates: [position.coords.longitude, position.coords.latitude]
                    },
                    extra: {
                        key: "value"
                    }
                };


                // Send location data as JSON
                websocket.send(JSON.stringify(locationData));
                console.log('Location sent:', locationData);
            }, (error) => {
                console.error('Error getting location:', error);
            });
        }
    }, 3000); // Every 2 seconds
};

websocket.onclose = function(evt) {
    console.log("Disconnected");
};

websocket.onmessage = function(evt) {
    if (event.data === 'Pong') {
        console.log('Received Pong from server');
    } else {
        // Handle other messages
        console.log('Received:', event.data);
    }
};

websocket.onerror = function(evt, e) {
    console.log('Error occurred: ' + evt.data);
};
```
<br/>
<hr/>
<br/>

## Backend listeners

|  | Pusher server | Redis server |
|-----|------|---------|
|  Host/URI  |    pusher.pulsestracker.com   |   redis://redis-sub.pulsestracker.com:6378     |

> The WebSocket server uses the **Pusher protocol**, and the redis server uses **Redis RESP protocol** chosen for its compatibility with a wide range of existing applications. For detailed integration guidelines and additional information, please refer to the official [Pusher documentation](https://pusher.com/docs/channels/) | [Redis documentation](https://redis.io/docs/latest/develop/reference/protocol-spec/). 



### Pusher Listeners Configuration

To receive real-time location updates on the client side using our pusher server:

- **Server Address**: `pusher.pulsestracker.com`
- **Server APP KEY**: `92OHYPuG0KB2IPv8`
- **Channel Name**: `private-apps.YOUR_APP_KEY`
- **Event Name**: `App\Events\DeviceLocationUpdated`
- **Auth endpoint**: `https://www.pulsestracker.com/api/broadcasting/auth`
- **Auth headers**: `Authorization: Bearer <token>`
#### Example using Pusher Javascript SDK
```javascript
let client = new Pusher('SERVER_APP_KEY', {
    wsHost: 'pusher.pulsestracker.com',
    wssPort: 443,
    forceTLS: true,
    disableStats: true,
    cluster: "",
    enabledTransports: ['wss', 'ws'],
    authEndpoint: 'https://www.pulsestracker.com/api/broadcasting/auth',
    auth: {
        headers: {
            Authorization: 'Bearer YOUR_TOKEN',
        }
    }
});
client.subscribe('private-apps.YOUR_APP_KEY').bind('App\\Events\\DeviceLocationUpdated', (message) => {
    console.log(message);
});
```
#### Example using Pusher Javascript SDK with laravel echo 
```javascript
import Echo from 'laravel-echo';
 
import Pusher from 'pusher-js';
window.Pusher = Pusher;
 
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: import.meta.env.VITE_PUSHER_HOST,
    wssHost: import.meta.env.VITE_PUSHER_HOST,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    disableStats: true,
});

Echo.private('apps.YOUR_APP_KEY').listen('DeviceLocationUpdated', (device) => {
    // location update
    console.log(device);
})
```

#### Example using redis and python
```python
import redis
import hashlib
import hmac

def generate_signature(app_key: str, token: str) -> str:
    # Validate token format
    if '|' not in token:
        raise ValueError('Invalid token format')

    # Extract the secret part of the token (after '|')
    secret = token.split('|', 1)[1]
    
    # Generate the signature
    hashed_secret = hashlib.sha256(secret.encode()).hexdigest()
    signature = hmac.new(hashed_secret.encode(), app_key.encode(), hashlib.sha256).hexdigest()
    
    return signature

app_key = "YOUR_APP_KEY"
token = "YOUR_TOKEN"

signature = generate_signature(app_key, token)
channel = f"app:{app_key}.{signature}"

redis_client = redis.from_url("redis://redis-sub.pulsestracker.com:6378")
pubsub = redis_client.pubsub()
pubsub.subscribe(channel)

print(f"Subscribed to {channel}. Waiting for messages...")
for message in pubsub.listen():
    if message['type'] == 'message':
        print(f"Received: {message['data'].decode('utf-8')}")

```

#### Example using laravel redis
```php
<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class PulsetrackerSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pulsetracker:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to pulsetracker redis server and get real time location updates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appKey = 'YOUR_APP_KEY';
        $token = 'YOUR_TOKEN'; 
        $signature = $this->generateSignature($appKey, $token);
        // Add this to config/database.php 
        //  'redis' => [ 
        //      'pulsetracker' => [
        //          'url' => env('PULSETRACKER_REDIS_URI')
        //      ],
        //  ]
        Redis::connection('pulsetracker')->subscribe(["app:$appKey.$signature"], function (string $message) {
            echo $message . "\n";
        });
    }

    public function generateSignature(string $appKey, string $token): string
    {
        if (! str_contains($token, '|')) {
            throw new Exception('Invalid token format');
        }

        return hash_hmac('sha256', $appKey, hash('sha256', Str::after($token, '|')));
    }
}

```