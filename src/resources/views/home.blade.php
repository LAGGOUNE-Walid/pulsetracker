@extends('template')
@section('title', 'Pulsetracker')
@section('content')
    <section class="text-primary py-4 py-xl-5">
        <!-- Start: 1 Row 2 Columns -->
        <div class="container">
            <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                <div class="row g-0 particle-network-animation">
                    <div class="col-md-12">
                        <div class="text-white p-4 p-md-5">
                            <center>
                                <h3 class="text-center fw-bold text-white mb-3" style="font-size: 2.5rem;">Real-Time
                                    Location
                                    Tracking for <br />
                                    Developers</h3>

                                <p class="mb-4 w-75" style="font-size: 1.1rem;color: var(--bs-gray-500);">Track and manage
                                    devices
                                    in
                                    real-time with lightning-fast protocols. Optimize battery usage, scale seamlessly
                                    while Pulsetracker handles the heavy lifting <br /> <span class="text-success">all in
                                        hours
                                        not
                                        months.</span>
                                </p>
                                @guest
                                    <div class="my-3">

                                        <a class="btn btn-success" role="button" href="{{ url('signup') }}">Start
                                            integrating</a>
                                        <a class="btn btn-primary" role="button" href="https://docs.pulsestracker.com">Read the
                                            docs</a>

                                    </div>
                                @endguest
                                <img src="{{ url('assets/img/UHBAB8LJEMEKOJACOELDR9DRB8E7-1730810808626.webp') }}"
                                    alt="Pulsetracker Real-time location tracking for developers dashboard map"
                                    style="width: 100%;border-radius: 10px; border: 2px solid #f3f3f3; "
                                    class="dashboard-preview">
                                <h4 class="text-center" style="color: var(--bs-gray-500);">
                                    Pulsetracker puts you in
                                    charge, offering complete control over how you track, manage, and dispatch location
                                    data.</h4>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End: 1 Row 2 Columns -->
    </section><!-- End: Banner Heading Image -->
    <section style="">

        <h1 style="text-align: center; margin-top: 8%;"><strong>The Problem with <span class="text-warning">Traditional</span> Location Tracking APIs</strong>
        </h1>
        <div class="container" style="margin-top: 3%;">
            <div class="row mt-5">
                <div class="col-md-12">
                    <table class="table table text-center h4">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" style="">Features</th>
                                <th scope="col" class="text-muted">Traditional Tracking APIs 😖</th>
                                <th scope="col">Pulsetracker 🚀</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Developer Happiness 😃</strong></td>
                                <td class="text-muted">Debugging tracking issues at 2 AM while questioning life choices.</td>
                                <td class="highlight-table"><strong>Simple, reliable, and built so you can sleep at night.</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Backend Setup</strong></td>
                                <td class="text-muted">Requires servers, databases, UDP, WebSockets, and scaling.</td>
                                <td class="highlight-table"><strong>No backend needed—just integrate and track.</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Real-Time Updates</strong></td>
                                <td class="text-muted">Often slow, uses polling, or has high latency.</td>
                                <td class="highlight-table"><strong>low latency with WebSockets & UDP.</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Ease of Integration</strong></td>
                                <td class="text-muted">Complicated SDKs, excessive setup.</td>
                                <td class="highlight-table"><strong>Lightweight, plug-and-play integration.</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Cost & Pricing</strong></td>
                                <td class="text-muted">Expensive, pay-per-request, unpredictable costs.</td>
                                <td class="highlight-table"><strong>Transparent pricing with a free tier.</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Privacy & Compliance</strong></td>
                                <td class="text-muted">Hard to handle user consent and security.</td>
                                <td class="highlight-table"><strong>Privacy-first with built-in user consent features.</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Customization</strong></td>
                                <td class="text-muted">Limited control over update frequency and API's.</td>
                                <td class="highlight-table"><strong>Fine-tuned settings for developers.</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Scalability</strong></td>
                                <td class="text-muted">Becomes costly and complex at scale.</td>
                                <td class="highlight-table"><strong>Scales effortlessly without extra infrastructure.</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div><!-- End: 1 Row 3 Columns -->
    </section>

    <section style="">

        <h1 style="text-align: center; margin-top: 8%;"><strong>Features</strong></h1>
        <div class="container" style="margin-top: 3%;">

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 col-md-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-radar" style="font-size: 10rem;margin-bottom: 15px;">
                                <path
                                    d="M6.634 1.135A7 7 0 0 1 15 8a.5.5 0 0 1-1 0 6 6 0 1 0-6.5 5.98v-1.005A5 5 0 1 1 13 8a.5.5 0 0 1-1 0 4 4 0 1 0-4.5 3.969v-1.011A2.999 2.999 0 1 1 11 8a.5.5 0 0 1-1 0 2 2 0 1 0-2.5 1.936v-1.07a1 1 0 1 1 1 0V15.5a.5.5 0 0 1-1 0v-.518a7 7 0 0 1-.866-13.847Z">
                                </path>
                            </svg>
                        </div>
                        <div class="col-12 col-md-6">
                            <h3>Real-time Location <span class="text-success">Tracking</span></h3>
                            <p style="color: var(--bs-gray-500);font-size: 20px;">Integrate effortlessly with Pulsetracker
                                to
                                send location updates every second using UDP or Websockets, ensuring real-Time transmission.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 col-md-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-pin-map" viewBox="0 0 16 16" style="font-size: 10rem;margin-bottom: 15px;">
                                <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z"/>
                                <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                              </svg>
                        </div>
                        <div class="col-12 col-md-6">
                            <h3>Geo<span class="text-success">fencing</span></h3>
                            <p style="color: var(--bs-gray-500);font-size: 20px;">Effortlessly set up geofencing with PulsesTracker to receive instant alerts when a device enters or leaves a designated area.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 col-md-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                class="bi bi-phone" viewBox="0 0 16 16" style="font-size: 10rem;margin-bottom: 15px;">>
                                <path
                                    d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                            </svg>
                        </div>
                        <div class="col-12 col-md-6">
                            <h3><span class="text-success">Mobile</span> app</h3>
                            <p style="color: var(--bs-gray-500);font-size: 20px;">Pulsetracker offers a free Android mobile
                                app for non-developers, <br /> making it easy to start using Pulsetracker and transform any
                                Android phone into a GPS tracker.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 col-md-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                class="bi bi-diagram-3" viewBox="0 0 16 16" style="font-size: 10rem;margin-bottom: 15px;">
                                <path fill-rule="evenodd"
                                    d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                            </svg>
                        </div>
                        <div class="col-12 col-md-6">
                            <h3>Real-Time <span class="text-success">Dispatching<span></h3>
                            <p style="color: var(--bs-gray-500);font-size: 20px;">Leverage WebSockets with the Pusher
                                protocol
                                or
                                our Redis Pub/Sub for seamless real-time updates. Stream live location data to your backend
                                or
                                to your application's map interface.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 col-md-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                class="bi bi-shield-check" viewBox="0 0 16 16"
                                style="font-size: 10rem;margin-bottom: 15px;">
                                <path
                                    d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                                <path
                                    d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                            </svg>
                        </div>
                        <div class="col-12 col-md-6">
                            <h3><span class="text-success">Privacy</span> Control</h3>
                            <p style="color: var(--bs-gray-500);font-size: 20px;">Choose where your data is stored. Opt to
                                save
                                location data in Pulsetracker's database or disable storage entirely for enhanced privacy
                                and
                                flexibility.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 col-md-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-tree" style="font-size: 10rem;margin-bottom: 15px;">
                                <path
                                    d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777l-3-4.5zM6.437 4.758A.5.5 0 0 0 6 4.5h-.066L8 1.401 10.066 4.5H10a.5.5 0 0 0-.424.765L11.598 8.5H11.5a.5.5 0 0 0-.447.724L12.69 12.5H3.309l1.638-3.276A.5.5 0 0 0 4.5 8.5h-.098l2.022-3.235a.5.5 0 0 0 .013-.507z">
                                </path>
                            </svg>
                        </div>
                        <div class="col-12 col-md-6">
                            <h3><span class="text-success">Eco-Friendly</span> Data Transmission</h3>
                            <p style="color: var(--bs-gray-500);font-size: 20px;">Benefit from the low-power consumption
                                of
                                UDP, making it ideal for mobile/Iot devices and reducing battery drain.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 col-md-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-code" style="font-size: 10rem;margin-bottom: 15px;">
                                <path
                                    d="M5.854 4.854a.5.5 0 1 0-.708-.708l-3.5 3.5a.5.5 0 0 0 0 .708l3.5 3.5a.5.5 0 0 0 .708-.708L2.707 8l3.147-3.146zm4.292 0a.5.5 0 0 1 .708-.708l3.5 3.5a.5.5 0 0 1 0 .708l-3.5 3.5a.5.5 0 0 1-.708-.708L13.293 8l-3.147-3.146z">
                                </path>
                            </svg>
                        </div>
                        <div class="col-12 col-md-6">
                            <h3><span class='text-success'>Flexible</span> Integration</h3>
                            <p style="color: var(--bs-gray-500);font-size: 20px;">Easy integration with your devices
                                &
                                backend
                                through API endpoints for creating device tokens and sending location data.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 col-md-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-file-zip" style="font-size: 10rem;margin-bottom: 15px;">
                                <path
                                    d="M6.5 7.5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.109 0l-.93-.62a1 1 0 0 1-.415-1.074l.4-1.599V7.5zm2 0h-1v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.93-.62-.4-1.598a1 1 0 0 1-.03-.243z">
                                </path>
                                <path
                                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm5.5-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9v1H8v1h1v1H8v1h1v1H7.5V5h-1V4h1V3h-1V2h1z">
                                </path>
                            </svg>
                        </div>
                        <div class="col-12 col-md-6">
                            <h3><span class="text-success">Compact</span> Format</h3>
                            <p style="color: var(--bs-gray-500);font-size: 20px;">Benefit from quick
                                serialization and
                                deserialization, enhancing data transfer speed and reducing latency with
                                MessagePack’s
                                compact
                                binary format. <small><span class="badge rounded-pill text-bg-light"
                                        style="color: black !important;">Soon</span></small></p>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- End: 1 Row 3 Columns -->
    </section>
    <section style="margin-top: 8%;">
        <!-- Start: 1 Row 1 Column -->
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-12">
                    <h1 class="text-center" style="--bs-body-font-weight: 1000;font-weight: bold;">Integrate <span
                            class="text-warning">this morning</span>
                    </h1>
                    <h4 class="text-center" style="color: var(--bs-gray-500);margin-top: 9px;padding-top: 20px;">
                        <strong>Step 1: Broadcast locations to Pulsetracker in just a few lines of code.</strong>
                    </h4>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <img src="/assets/img/Javascript-client-with-websockets-example.webp"
                                class="rounded img-fluid" alt="Real-time location tracking using javascript">
                        </div>
                        <div class="col-12 col-md-6">
                            <img src="/assets/img/Python-client-with-UDP-example.webp" class="rounded img-fluid"
                                alt="Real-time location tracking using python">
                        </div>
                    </div>
                    <h4 class="text-center" style="color: var(--bs-gray-500);margin-top: 9px;padding-top: 20px;">
                        <strong>Step 2: Listen for realtime location updates in your applications.</strong>
                    </h4>
                    <div class="row">
                        <div class="col-12 ">
                            <img src="/assets/img/Javascript-listener-with-Pusher-example.webp" class="rounded img-fluid"
                                alt="Real-time location tracking using javascript">
                        </div>
                        <h1 class="text-center">OR </h1>
                        <div class="col-12">
                            <img src="/assets/img/Listen-for-realtime-updates-with-our-redis-server.webp"
                                class="rounded img-fluid" alt="Real-time location tracking using python">
                        </div>
                        <div class="col-12">
                            <img src="/assets/img/Example-redis-subscriber-in-Laravel.webp" class="rounded img-fluid"
                                alt="Real-time location tracking using python">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End: 1 Row 1 Column -->
    </section>
    <section style="margin-top: 8%;">
        <h1 style="text-align: center;" id="pricing">Pricing</h1>
        <h6 style="text-align: center;">All prices are in USD</h6>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br />
                @endforeach
            </div>
        @endif

        <div class="container" style="margin-top: 3%;">
            <div class="row">
                @foreach ($subscriptions as $plan)
                    <div class="col-md-3 mt-3">
                        <div style="@if ($plan['name'] == 'pathfinder') border: 2px solid var(--bs-success); height: 103%; @else border: 2px solid var(--bs-dark-text-emphasis); @endif;padding: 5%;"
                            class="rounded-3">
                            <h5 class="text-center">{{ ucfirst($plan['name']) }}</h5>
                            <h3 class="text-center" style="margin-top: 5%;">${{ $plan['price'] }} / mo
                            </h3>
                            <hr>
                            <ul class="list-unstyled" style="font-size: 1.1rem;">
                                <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                        style="color: var(--bs-form-valid-color);">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                        </path>
                                        <path
                                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                        </path>
                                    </svg>&nbsp; Free mobile app
                                    <svg data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="If you are not a developer, pulsetracker offers a free android mobile app that works with our infrastructure."
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg>
                                </li>
                                <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                        style="color: var(--bs-form-valid-color);">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                        </path>
                                        <path
                                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                        </path>
                                    </svg>&nbsp;{{ $plan['size']['apps'] ?? 'Unlimited' }}
                                    app{{ !$plan['size']['apps'] ? 's' : '' }}
                                    <svg data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Organize your tracking by creating apps, each tailored to manage specific projects or groups of devices."
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg>
                                </li>
                                <li><span style="color: var(--bs-form-valid-color);"> </span><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                        style="color: var(--bs-form-valid-color);">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                        </path>
                                        <path
                                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                        </path>
                                    </svg>&nbsp;{{ $plan['size']['devices'] ?? 'Unlimited' }} Devices <svg
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Connect mobile applications or programmable devices to send real-time location data seamlessly."
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg></li>
                                <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                        style="color: var(--bs-form-valid-color);">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                        </path>
                                        <path
                                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                        </path>
                                    </svg>&nbsp;{{ $plan['size']['messages_per_month'] ? number_format($plan['size']['messages_per_month']) : 'Unlimited' }}
                                    locations/month <svg data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Monitor and track as many locations as needed without any monthly limits."
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg></li>
                                <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                        style="color: var(--bs-form-valid-color);">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                        </path>
                                        <path
                                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                        </path>
                                    </svg>&nbsp;{{ $plan['size']['data_retention_days'] }} Days data
                                    retention <svg data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Access and review recent location history, securely stored for a limited time."
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                    </svg>
                                </li>

                            </ul>
                            @guest
                                <a class="btn btn-outline-light btn-lg" role="button" style="width: 100%;color: white;"
                                    href="{{ url('signup') }}">Sign up</a>
                            @endguest
                            @auth
                                @if ($plan['name'] == 'free')
                                    @if (!auth()->user()->subscriptions()->active()->first()?->onGracePeriod())
                                        @if (auth()->user()->subscriptions()->active()->first() !== null)
                                            <a class="btn btn-outline-light btn" role="button"
                                                style="width: 100%;color: white;"
                                                href="{{ url('subscribe-plan-to-free') }}">Switch to this NOW</a>
                                        @else
                                            <a class="btn btn-outline-light btn-lg" role="button"
                                                style="width: 100%;color: white;"
                                                href="{{ url('subscribe-plan-to-free') }}">Subscribe</a>
                                        @endif
                                    @else
                                        <center>
                                            <small class="text-muted text-center" style="font-size: 13px;">subscriptions
                                                cannot be
                                                resumed after cancelations.</small>
                                        </center>
                                    @endif
                                @else
                                    @auth
                                        @if (!auth()->user()->subscriptions()->active()->first()?->onGracePeriod())
                                            @if (auth()->user()->subscribedToPrice($plan['price_id'], $plan['product_id']))
                                                <form action="{{ url('subscription-cancel/' . $plan['name']) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        style="width: 100%;">Cancel</button>
                                                </form>
                                            @else
                                                @if (auth()->user()->subscriptions()->active()->first() !== null)
                                                    <form action="{{ url('subscription-swap/' . $plan['name']) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-success"
                                                            style="width: 100%;">Switch to this NOW</button>
                                                        <center>
                                                            <small class=" text-muted" style="font-size: 13px;">This action will
                                                                charge
                                                                you again with the new price and cancel your previous plan</small>
                                                        </center>
                                                    </form>
                                                @else
                                                    <a href="{{ url('subscribe-to/' . $plan['name']) }}"
                                                        class="btn btn-outline-light btn-lg" style="width: 100%;color: white;">
                                                        Subscribe
                                                    </a>
                                                @endif
                                            @endif
                                        @else
                                            <center>
                                                <small class="text-muted text-center" style="font-size: 13px;">subscriptions
                                                    cannot be
                                                    resumed after cancelations.</small>
                                            </center>
                                        @endif
                                    @endauth
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach

                {{-- <div class="col-md-4 mt-3">
                    <div style="border: 1px solid var(--bs-dark-text-emphasis);padding: 5%;border-radius: 10px;">
                        <h5 class="text-center">Free</h5>
                        <h3 class="text-center" style="margin-top: 5%;">${{ $subscriptions['free']['price'] }} / mo
                        </h3>
                        <hr>
                        <ul class="list-unstyled">
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;{{ $subscriptions['free']['size']['apps'] }} app</li>
                            <li><span style="color: var(--bs-form-valid-color);"> </span><svg
                                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                    viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;{{ $subscriptions['free']['size']['devices'] }} Devices</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg><strong>&nbsp;{{ number_format($subscriptions['free']['size']['messages_per_month']) }}
                                    messages/month</strong></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg><strong>&nbsp;{{ $subscriptions['enterprise']['size']['wesockets_limits'] ?? 'Unlimited' }}
                                    websockets
                                    connections</strong></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;Unlimited concurrent connections</li>

                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;{{ $subscriptions['free']['size']['data_retention_days'] }} Days data
                                retention
                            </li>

                        </ul>
                        @guest
                            <a class="btn btn-outline-light btn-lg" role="button" style="width: 100%;color: white;"
                                href="{{ url('signup') }}">Sign up</a>
                        @endguest
                        @auth
                            @if (!auth()->user()->subscriptions()->active()->first()?->onGracePeriod())
                                @if (auth()->user()->subscriptions()->active()->first() !== null)
                                    <a class="btn btn-outline-light btn" role="button" style="width: 100%;color: white;"
                                        href="{{ url('subscribe-plan-to-free') }}">Switch to this NOW</a>
                                @else
                                    <a class="btn btn-outline-light btn-lg" role="button" style="width: 100%;color: white;"
                                        href="{{ url('subscribe-plan-to-free') }}">Subscribe</a>
                                @endif
                            @else
                                <center>
                                    <small class="text-muted text-center" style="font-size: 13px;">subscriptions cannot be
                                        resumed after cancelations.</small>
                                </center>
                            @endif
                        @endauth
                    </div>
                </div> --}}
                {{-- <div class="col-md-4 mt-3">
                    <div style="padding: 5%;border-radius: 10px;border: 2px solid var(--bs-link-hover-color) ;">
                        <h5 class="text-center">Pro</h5>
                        <h3 class="text-center" style="margin-top: 5%;">${{ $subscriptions['pro']['price'] }} / mo
                        </h3>
                        <hr>
                        <ul class="list-unstyled">
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;{{ $subscriptions['pro']['size']['apps'] }} apps</li>
                            <li><span style="color: var(--bs-form-valid-color);"> </span>&nbsp;<svg
                                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                    viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;{{ $subscriptions['pro']['size']['devices'] }} Device</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg><strong>&nbsp;{{ number_format($subscriptions['pro']['size']['messages_per_month']) }}
                                    messages/month</strong></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg><strong>&nbsp;{{ $subscriptions['pro']['size']['wesockets_limits'] ?? 'Unlimited' }}
                                    websockets connections</strong></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;Unlimited concurrent connections</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;{{ $subscriptions['pro']['size']['data_retention_days'] }} Days data
                                retention
                            </li>
                        </ul>
                        @guest
                            <a class="btn btn-outline-light btn-lg" role="button" style="width: 100%;color: white;"
                                href="{{ url('signup') }}">Sign up</a>
                        @endguest
                        @auth
                            @if (!auth()->user()->subscriptions()->active()->first()?->onGracePeriod())
                                @if (auth()->user()->subscribedToPrice(config('stripe-subscriptions.plans.pro.price_id'), config('stripe-subscriptions.plans.pro.product_id')))
                                    <form action="{{ url('subscription-cancel/pro') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger"
                                            style="width: 100%;">Cancel</button>
                                    </form>
                                @else
                                    @if (auth()->user()->subscriptions()->active()->first() !== null)
                                        <form action="{{ url('subscription-swap/pro') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success"
                                                style="width: 100%;">Switch to this NOW</button>
                                            <center>
                                                <small class=" text-muted" style="font-size: 13px;">This action will charge
                                                    you again with the new price and cancel your previous plan</small>
                                            </center>
                                        </form>
                                    @else
                                        <a href="{{ url('subscribe-to/pro') }}" class="btn btn-outline-light btn-lg"
                                            style="width: 100%;color: white;">
                                            Subscribe
                                        </a>
                                    @endif
                                @endif
                            @else
                                <center>
                                    <small class="text-muted text-center" style="font-size: 13px;">subscriptions cannot be
                                        resumed after cancelations.</small>
                                </center>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div style="border: 1px solid var(--bs-dark-text-emphasis);padding: 5%;border-radius: 10px;">
                        <h5 class="text-center">Enterprise</h5>
                        <h3 class="text-center" style="margin-top: 5%;">${{ $subscriptions['enterprise']['price'] }}
                            / mo</h3>
                        <hr>
                        <ul class="list-unstyled">
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;{{ $subscriptions['enterprise']['size']['apps'] ?? 'Unlimited' }} apps</li>
                            <li><span style="color: var(--bs-form-valid-color);"> </span>&nbsp;<svg
                                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                    viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;{{ $subscriptions['enterprise']['size']['devices'] }} Device</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg><strong>&nbsp;{{ number_format($subscriptions['enterprise']['size']['messages_per_month']) }}
                                    messages/month</strong></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg><strong>&nbsp;{{ $subscriptions['enterprise']['size']['wesockets_limits'] ?? 'Unlimited' }}
                                    websockets connections</strong></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;Unlimited concurrent connections</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;{{ $subscriptions['enterprise']['size']['data_retention_days'] }} Days data
                                retention
                            </li>
                        </ul>
                        @guest
                            <a class="btn btn-outline-light btn-lg" role="button" style="width: 100%;color: white;"
                                href="{{ url('signup') }}">Sign up</a>
                        @endguest
                        @auth
                            @if (!auth()->user()->subscriptions()->active()->first()?->onGracePeriod())
                                @if (auth()->user()->subscribedToPrice(config('stripe-subscriptions.plans.enterprise.price_id'), config('stripe-subscriptions.plans.enterprise.product_id')))
                                    <form action="{{ url('subscription-cancel/enterprise') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger"
                                            style="width: 100%;">Cancel</button>
                                    </form>
                                @else
                                    @if (auth()->user()->subscriptions()->active()->first() !== null)
                                        <form action="{{ url('subscription-swap/enterprise') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success"
                                                style="width: 100%;">Switch to this NOW</button>
                                            <center>
                                                <small class=" text-muted" style="font-size: 13px;">This actions will charge
                                                    you again with the new price and cancel your previous plan</small>
                                            </center>

                                        </form>
                                    @else
                                        <a href="{{ url('subscribe-to/enterprise') }}" class="btn btn-outline-light btn-lg"
                                            style="width: 100%;color: white;">
                                            Subscribe
                                        </a>
                                    @endif
                                @endif
                            @else
                                <center>
                                    <small class="text-muted text-center" style="font-size: 13px;">subscriptions cannot be
                                        resumed after cancelations.</small>
                                </center>
                            @endif
                        @endauth
                    </div>
                </div> --}}
            </div>
            <div class="row mt-5 p-3">
                <div class="col p-5 mt-3 bg-dark bg-gradient rounded-3">
                    <h2>Need More?</h2>
                    If you require additional features or a customized solution, we’re here to help! <br />
                    Contact us anytime at <a href="mailto:contact@pulsestracker.com">contact@pulsestracker.com</a>
                </div>
            </div>
        </div><!-- End: 1 Row 3 Columns -->
    </section><!-- Start: Footer Dark -->


@endsection
