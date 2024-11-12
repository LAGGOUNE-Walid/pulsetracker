@extends('template')
@section('title', 'About Pulsetracker')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>What is it ? </h2>
                <p>
                    Pulsetracker is a real-time location tracking platform built for developers who need high-frequency,
                    flexible location updates without the constraints of traditional SDKs or backend dependencies. It allows
                    developers to build their own custom client SDKs using UDP or WebSockets, empowering them to stream live
                    location data from Pulsetracker to their backends effortlessly.
                    <br />
                    <br />
                    The platform handles heavy location traffic, processing updates from thousands of devices per second, so
                    developers don’t have to worry about infrastructure scaling. Pulsetracker also provides a simple
                    interface for users who prefer to store or visualize location data directly on the platform's dashboard,
                    making it versatile for a wide range of use cases.
                </p>
                <h2 class="mt-5">How It Works</h2>
                <p>Pulsetracker requires explicit user consent to start tracking, respecting
                    user privacy
                    and ensuring data is only used for approved purposes. After user consent, Pulsetracker works by acting
                    as a middleware server that receives, processes, and distributes real-time location data from client
                    applications to developer backends. Here’s how it operates step-by-step:
                    <br />
                    <br />
                    1. Client SDK Integration: Developers integrate Pulsetracker by implementing a custom client-side
                    SDK. This SDK can use either UDP or WebSocket protocols, which are lightweight and efficient for
                    real-time tracking.
                    <br />
                    <br />
                    2. Location Data Transmission: The client SDK sends location updates directly to the Pulsetracker
                    server. Data is transmitted every few seconds, allowing for continuous, real-time tracking.
                    <br />
                    <br />
                    3. Backend Delivery: Pulsetracker forwards location data in real-time to the developer’s backend or
                    stores it on the Pulsetracker dashboard. This option allows for flexible access: developers can retrieve
                    data from Pulsetracker’s servers or have it directly streamed to their own backend infrastructure.
                    <br />
                    <br />
                    4. Data Management and Display: Through the Pulsetracker dashboard, developers can visualize and
                    manage location data, view movement patterns, or monitor device updates.
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
                <p>Here’s why developers and companies should consider using Pulsetracker:
                    <br/>
                    <br/>
                    1. Control Over Tracking Data: Pulsetracker allows developers to create custom SDKs for client-side
                    tracking, offering flexibility in how they collect and manage location data without being restricted to
                    a specific backend.
                    <br/>
                    <br/>
                    2. Real-Time Location Updates: With Pulsetracker, location updates are streamed in real time,
                    providing immediate access to data for services that depend on up-to-the-minute accuracy.
                    <br/>
                    <br/>
                    3. Scalable Infrastructure: Pulsetracker manages high traffic and complex data handling, so
                    developers don’t need to build or scale backend systems to process location updates.
                    <br/>
                    <br/>
                    4. Efficient Protocols: Pulsetracker uses UDP or WebSocket protocols for fast, efficient
                    communication that minimizes battery and data usage on client devices.
                    <br/>
                    <br/>
                    5. Privacy and Security: Pulsetracker ensures data is securely transmitted and offers developers
                    control over data storage, aligning with privacy requirements.
                    <br/>
                    <br/>
                </p>
                <section class="contact">
                    <h2 class="mt-5">Contact Us</h2>
                    <p>If you have any questions or would like to learn more about Pulsetracker, feel free to contact us at
                        <a href="mailto:contact@pulsestracker.com">contact@pulsestracker.com</a>.
                    </p>
                </section>
            </div>
        </div>
    </div>


@endsection
