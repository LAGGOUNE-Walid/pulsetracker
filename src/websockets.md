# Client (Device) configuration
| Key | UDP | Websocekts |
|-----|------|---------|
|  IP/Domain  |    192.277.21.21   |   192.277.21.21     |
|   Port  |    9001   |    9001    |

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
    }
}

# Convert the data to a JSON string
json_data = json.dumps(data)

# Create a UDP socket
sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)

# Define the host and port
host = 'IP_ADDRESS'
port = 'THE_PORT'

# Send the data
sock.sendto(json_data.encode('utf-8'), (host, port))
print(f"Location sent: {json_data}")

# Close the socket
sock.close()
```

<hr/>

# Pusher Listeners Integration (Listen for events)

To receive real-time location updates on the client side, connect to our Pusher server at the following address:

- **Server Address**: `pusher.pulse.com`
- **Server Port**: `6001`
- **Channel Name**: `private-apps.APP_KEY`
- **Event Name**: `App\Events\DeviceLocationUpdated`
- **Auth endpoint**: `pulse.com/broadcasting/auth`

This WebSocket server uses the **Pusher protocol**, chosen for its compatibility with a wide range of existing applications. For detailed integration guidelines and additional information, please refer to the official [Pusher documentation](https://pusher.com/docs/channels/).

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
    wsPort: import.meta.env.VITE_PUSHER_PORT,
    wssPort: import.meta.env.VITE_PUSHER_PORT,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    disableStats: true,
});

Echo.private('apps.YOUR_APP_KEY').listen('DeviceLocationUpdated', (device) => {
    // location update
    console.log(device);
})
```