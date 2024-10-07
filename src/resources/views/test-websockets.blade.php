<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>
<script>

    var wsServer = 'wss://ws-tracking.pulsestracker.com';
    var websocket = new WebSocket(wsServer);
    const appId = '542bb636-1535-4523-a17e-8eac5721ff2a';
    const clientId = '13946096-58b7-42d8-8a46-d239b276568e';

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
</script>

</html>