@extends('template')
@section('title', 'About Pulsetracker')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>What is it ? </h2>
                <p>Pulsetracker is a versatile real-time location tracking solution designed to help users track and manage
                    devices
                    effortlessly. It operates by using high-speed UDP and WebSocket protocols, providing live updates on
                    device
                    locations with minimal delay. With a focus on battery optimization, Pulsetracker ensures that tracking
                    does not
                    heavily impact device power, allowing users to keep devices monitored for longer periods.</p>
                <h2 class="mt-5">How It Works</h2>
                <p>Pulsetracker requires explicit user consent to start tracking, respecting
                    user privacy
                    and ensuring data is only used for approved purposes. After user consent, Pulsetracker begins
                    broadcasting live
                    location data to an authorized platform, which can be accessed by developers or individuals needing
                    real-time
                    location visibility. This makes it ideal for scalable realtime tracking solution as a backend.
                </p>
                <h2 class="mt-5">Use cases</h2>
                <ol>
                    <li><strong>Developers</strong> can integrate Pulsetracker into apps to provide location-based services,
                        adding
                        value for users seeking device tracking.</li>
                    <li><strong>Everyday Users</strong> can use it to track their personal devices or family members safely.
                    </li>
                    <li><strong>Businesses</strong> can monitor assets, logistics, or employee locations in real-time,
                        helping with
                        efficient operations and quick response.</li>
                </ol>
                <h2 class="mt-5">Why Use Pulsetracker</h2>
                <p>With robust security, low latency, and minimal battery impact,
                    Pulsetracker
                    stands out as a scalable and developer-friendly solution as a backend for location tracking. It
                    simplifies the
                    complexities of live
                    tracking, providing a seamless experience for developers, individuals, and businesses needing real-time
                    insights.
                </p>
                <section class="contact">
                    <h2 class="mt-5">Contact Us</h2>
                    <p>If you have any questions or would like to learn more about Pulsetracker, feel free to contact us at
                        <a href="mailto:contact@pulsestracker.com">contact@pulsestracker.com</a>.</p>
                </section>
            </div>
        </div>
    </div>


@endsection
