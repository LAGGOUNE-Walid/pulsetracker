# Client (Device) configuration
| Key | UDP | Websocekts |
|-----|------|---------|
|  IP/Domain  |    udp-tracking.pulsestracker.com   |   wss://ws-tracking.pulsestracker.com     |
|   Port  |    9506   |    /    |

> **Note**: If your quota is exceeded, the server will respond with an `"ERR_QUOTA"` message to your client.
#### UDP Dart example
```dart
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

    websocket.onopen = function (evt) {
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

    websocket.onclose = function (evt) {
        console.log("Disconnected");
    };

    websocket.onmessage = function (evt) {
        if (event.data === 'Pong') {
            console.log('Received Pong from server');
        } else {
            // Handle other messages
            console.log('Received:', event.data);
        }
    };

    websocket.onerror = function (evt, e) {
        console.log('Error occurred: ' + evt.data);
    };
```
<hr/>

# Pusher Listeners Integration (Listen for events)

To receive real-time location updates on the client side, connect to our Pusher server at the following address:

- **Server Address**: `pusher.pulsestracker.com`
- **Server APP KEY**: `92OHYPuG0KB2IPv8`
- **Channel Name**: `private-apps.YOUR_APP_KEY`
- **Event Name**: `App\Events\DeviceLocationUpdated`
- **Auth endpoint**: `https://www.pulsestracker.com/api/broadcasting/auth`
- **Auth headers**: `Authorization: Bearer <token>`

This WebSocket server uses the **Pusher protocol**, chosen for its compatibility with a wide range of existing applications. For detailed integration guidelines and additional information, please refer to the official [Pusher documentation](https://pusher.com/docs/channels/).

<br/>


## Example using Pusher Javascript SDK
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
    client.subscribe('private-apps.YOUR_APP_ID').bind('App\\Events\\DeviceLocationUpdated', (message) => {
        console.log(message);
    });
```

## Example using Pusher Javascript SDK with laravel echo 

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