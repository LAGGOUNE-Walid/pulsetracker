# PulseTracker
Real-time location tracking SaaS platform designed for developers. Hosts a fast, protocol-agnostic backend and scalable infrastructure—built with Laravel, Swoole, Redis, and MariaDB.

Rectifies vendor lock-in by enabling clients to integrate via TCP, UDP, WebSocket, HTTP, or Redis Pub/Sub without relying on proprietary SDKs ([dev.to][1], [github.com][2]).

---

## Table of Contents

1. [Core Features](#core-features)
2. [Architecture Overview](#architecture-overview)
3. [Protocol Interfaces](#protocol-interfaces)
4. [Geofencing & Webhooks](#geofencing--webhooks)
5. [Quickstart – Local Docker Setup](#quickstart--local-docker-setup)
6. [Client Integration Guidelines](#client-integration-guidelines)
7. [Extending & Contributing](#extending--contributing)
8. [Deployment & Scaling](#deployment--scaling)
9. [Security & Compliance](#security--compliance)
10. [License & Author](#license--author)

---

## Core Features

* **Multi-protocol ingestion**: Supports TCP, UDP, HTTP POST, WebSocket, and Redis Pub/Sub.
* **Geofencing**: Define zones—polygonal or circular—with events for entry/exit via webhooks or Redis ([linkedin.com][3], [dev.to][4]).
* **Scalable queuing**: Uses Redis for ingestion buffers and Laravel queues for reliable processing.
* **Designed for microservices**: Clients can subscribe to a Redis channel and forward events to custom handlers .
* **Dashboard**: Provides UI to monitor active devices, zones, tokens, and events.
* **Containerization**: Built for Docker Compose and Kubernetes with environment-based services.

---

## Architecture Overview

```
┌── Clients ──> [TCP/UDP/WebSocket/HTTP] ──┐
│                                        ↓
│                         Swoole-based Protocol Servers
│                                        ↓
│                             Redis ingestion queues
│                                        ↓
│                         Laravel queue workers
│                                        ↓
│                          MariaDB (event storage)
│                                        ↓
│                         Dashboard / API / Webhooks
└──────────────────────────────────────────────┘
```

---

## Protocol Interfaces

### 1. TCP / UDP

Devices connect over TCP/UDP on configured ports. Example packet format:

```json
{
  "device_id": "abc123",
  "lat": 36.75,
  "lng": 3.06,
  "timestamp": 1710000000
}
```

Laravel’s `SwooleListener` wraps these into jobs targeting Redis queues for asynchronous handling.

### 2. WebSocket

Clients initiate persistent WS connections:

```js
const ws = new WebSocket("ws://host:port");
ws.onopen = () => {
  ws.send(JSON.stringify({ device_id: "abc123", lat: 36.75, lng: 3.06 }));
};
```

The server broadcasts `DeviceLocationUpdated` events channelled through Redis ([dev.to][1]).

### 3. HTTP POST

HTTP API endpoints allow `POST /api/track` with similar JSON payloads for quick integrations and testing.

### 4. Redis Pub/Sub (Backend Subscribers)

A backend listener—e.g., written in Python—subscribes to Pulsetracker channels:

```python
def channel_callback(data):
    redis.rpush("pulsetracker_database_queues:geopulse", job_json)
```

This decouples real-time ingestion from event processing ([dev.to][1]).

---

## Geofencing & Webhooks

Define geofence zones via dashboard or programmatically:

```php
Http::withToken('API_KEY')
    ->post('https://www.pulsestracker.com/api/geofences', [
      'name' => 'Warehouse Zone',
      'app_id' => 12345,
      'webhook_url' => 'https://yourapp.com/webhook/geofence',
      'geometry' => json_encode([
          'type' => 'Polygon',
          'coordinates' => [[[1,1],[1,2],[2,2],[2,1],[1,1]]]
      ])
    ]);
```

Pulsetracker emits events via POST to your webhook:

```json
{
  "event": "inside",
  "point": { "type":"Point","coordinates":[1.5,1.5] },
  "device_id": 42,
  "geofence_id": 123,
  "location_received_at": 1700000000,
  "event_sent_at": 1700000005
}
```

Secure webhook handling in Laravel:

```php
class VerifyPulsetrackerSignature
{
    public function handle(Request $req, Closure $next)
    {
        $sig = $req->header('p-signature');
        $secret = config('pulsetracker.webhook_secret');
        if (!hash_equals(hash_hmac('sha256', json_encode($req->all()), $secret), $sig)) {
            return response()->json(['error' => 'Invalid signature'], 403);
        }
        return $next($req);
    }
}
```

Then register route:

```php
Route::post('/webhook/geofence', [GeofenceWebhookController::class, 'handle'])
     ->middleware('verify.pulsetracker');
```

Controller logs or dispatches the event internally ([dev.to][4]).

---

## Quickstart – Local Docker Setup

Prereqs: Docker, Docker Compose

```bash
git clone https://github.com/LAGGOUNE-Walid/pulsetracker.git
cd pulsetracker
cp .env.example .env
# Set REDIS_PASSWORD and PULSET_TRACKER_API_KEY
docker-compose up -d --build
docker-compose exec php php artisan migrate --seed
```

Access services:

* API / Dashboard: `http://localhost:8080`
* TCP listener: port 9000 (default)
* WebSocket: port 1215
* Redis: default 6379 (auth via env)

Run queue workers:

```bash
docker-compose exec php php artisan queue:work --queue=geopulse,default
```

---

## Client Integration Guidelines

### Python Listener Example

Connect to real-time channels and push into Redis queue:

```python
pusher = pysher.Pusher(key=APP_KEY, auth_endpoint=..., custom_host="pusher.pulsestracker.com")
def on_update(data):
    redis.rpush("pulsetracker_database_queues:geopulse", job_payload)
```

Queue names follow `pulsetracker_database_queues:<queue>` convention ([dev.to][1]).

### Laravel Subscriber Job

```php
class PulseLocationUpdatedJob implements ShouldQueue
{
    public function handle($job, array $data)
    {
        DeviceLocation::create([
            'device_id' => $data['device_id'],
            'latitude' => $data['lat'],
            'longitude' => $data['lng'],
            'timestamp' => $data['timestamp']
        ]);
        $job->delete();
    }
}
```

Dispatch this in `queue:work` for reliable persistence.

---

## Extending & Contributing

* **Fork and PR**: Follow Git flow with feature branches.
* **Testing**: `phpunit` inside container.
* **New protocols**: Add Swoole listener and box JSON to queue.
* **Geofence enhancements**: Support circles, dynamic membership via dashboard.
* **Client SDKs**: Add Node.js, Go, or mobile wrappers.

---

## Deployment & Scaling

* **Docker Compose** works for small to mid-scale use.
* For higher scale:

  * Deploy Swoole servers behind load balancers
  * Use Redis cluster
  * Configure Laravel queue workers with Horizon or Supervisor
* **Monitoring**:

  * Check `jobs:failed`, `redis:monitor`, and Swoole metrics.
* **Security**:

  * TLS for HTTP/WS
  * Enforce TLS between services
  * Secure Redis with ACL or password

---

## Security & Compliance

* TLS authentication on protocols
* Webhooks validated via HMAC headers
* Sensitive data in env (`.env`) or secrets manager
* Follow OWASP and PCI DSS practices as needed

---

## License & Author

MIT License – see `LICENSE`.

Developed and maintained by **Walid Laggoune** – Backend Engineer and Founder of PulseTracker. Based in Algiers, Algeria ([dev.to][1], [github.com][2], [linkedin.com][5], [dev.to][4], [laggoune-walid.github.io][6]).

---

## Resources & Tutorials

* Python + Laravel real-time listener guide&#x20;
* Laravel geofencing integration example ([dev.to][4])
* Node.js Redis Pub/Sub backend use case ([linkedin.com][3])

---

[1]: https://dev.to/l_walid/building-a-real-time-location-tracking-solution-with-pulsetracker-laravel-and-python-b08?utm_source=chatgpt.com "Building a Real-Time Location Tracking Solution with Pulsetracker ..."
[2]: https://github.com/LAGGOUNE-Walid?utm_source=chatgpt.com "LAGGOUNE-Walid - GitHub"
[3]: https://www.linkedin.com/posts/walid-laggoune-295ab824a_real-time-location-tracking-with-nodejs-activity-7271566629472292864-9J3_?utm_source=chatgpt.com "Real-Time Location Tracking with Node.js and Pulsetracker's Redis ..."
[4]: https://dev.to/l_walid/pulsetracker-geofencing-with-laravel-14h5?utm_source=chatgpt.com "Geofencing with Laravel - DEV Community"
[5]: https://www.linkedin.com/posts/kaushikrishi_async-pressure-activity-7276547657634914305-Mqu2?utm_source=chatgpt.com "Kaushik Rishi - Async Pressure - LinkedIn"
[6]: https://laggoune-walid.github.io/portfolio/?utm_source=chatgpt.com "LAGGOUNE Walid portfolio"
