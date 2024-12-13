<!DOCTYPE html>
<html data-bs-theme="light" lang="en"
    style="--bs-body-bg: black;--bs-body-font-size: 1.5rem;--bs-body-font-weight: 1000;--bs-dark: black;--bs-dark-rgb: 0,0,0;font-family: Alatsi, sans-serif !important;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="keywords"
        content="Pulsetracker, location tracking, real-time tracking, developer location API, UDP tracking, WebSocket tracking, GPS tracking backend, scalable tracking solution,real-time location tracking, location tracking software, GPS tracking solution, developer-friendly tracking tool, Pulsetracker app, real-time GPS updates, location tracking SDK alternative, track device movements, GPS tracking API, real-time geolocation, battery-efficient tracking app, location tracking for developers, GPS tracking integration, real-time location analytics, Pulsetracker API integration, custom location tracking backend, real-time geolocation updates, GPS location services, live location tracking, scalable tracking solutions, location monitoring tool, GPS location tracking system, remote GPS tracking, mobile device tracking, geofencing tool, real-time location data, GPS location updates, location tracking APIs, advanced location tracking system, lightweight tracking tool, mobile GPS tracker, live tracking software, location updates in real-time, GPS tracking for mobile apps, efficient location tracking, GPS-powered tracking app, customizable tracking software, live GPS location service, Pulsetracker for businesses, developer location tracking tools, real-time map updates, best GPS tracking system, accurate location tracking software, geolocation tracking app, GPS tracking device integration, real-time GPS mapping, location tracking technology, GPS tracking in apps, high-performance location tracking, easy GPS tracking solutions, GPS integration for developers, Pulsetracker location tracking API, fast GPS data tracking, real-time GPS device tracking, GPS app for location updates, location services SDK alternative, GPS backend solutions, GPS for app developers, location tracking library, live GPS app updates, GPS tracker with geofencing, Pulsetracker for real-time updates, tracking app backend integration, best location tracking API, real-time location services API, scalable GPS tracking tools, developer-first tracking software, lightweight geolocation tracking, mobile device location tracking, Pulsetracker real-time API, precise GPS tracking software, cloud-based GPS tracking solution, efficient geolocation services, real-time map tracking API, GPS software for app developers, live location tracking tools, GPS app development toolkit, real-time location tracker, advanced GPS solutions, GPS for mobile apps, Pulsetracker for GPS integration, high-accuracy location tracker, developer-friendly GPS APIs, GPS geolocation software, lightweight GPS SDK, GPS data tracking solutions, live device GPS tracking, GPS-powered mobile apps, Pulsetracker for geofencing, scalable real-time location services, GPS device integration API, accurate geolocation software, efficient GPS tracking backend, laravel time tracker, laravel echo server, laravel websockets, laravel udp, pulse tracking, puhser tracking, pusher location, laravel pusher, laravel echo, websocket python example, python redis client">
    @if (isset($blog))
        {!! seo()->for($blog) !!}
    @else
        {!! seo() !!}
    @endif
    <link rel="icon" type="image/jpeg" sizes="720x720"
        href="/assets/img/Circle_Brand_Identity__Copy_-removebg-preview.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/darkly/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="/assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="/assets/css/Banner-Heading-Image-images.css">
    <link rel="stylesheet" href="/assets/css/Navbar-Centered-Brand-Dark-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/dark.min.css">
    @cookieconsentscripts
    <script defer src="https://cloud.umami.is/script.js" data-website-id="06db6e2e-fb33-4581-8722-67ece940e18e"></script>
    <script src="https://js-de.sentry-cdn.com/0327f3ab8d27598ea7b92ce14ea13526.min.js" crossorigin="anonymous"></script>


    <!-- Brevo Conversations {literal} -->
    <script>
        (function(d, w, c) {
            w.BrevoConversationsID = '6497148c29662f296f1f0eac';
            w[c] = w[c] || function() {
                (w[c].q = w[c].q || []).push(arguments);
            };
            var s = d.createElement('script');
            s.async = true;
            s.src = 'https://conversations-widget.brevo.com/brevo-conversations.js';
            if (d.head) d.head.appendChild(s);
        })(document, window, 'BrevoConversations');
    </script>
    <!-- /Brevo Conversations {/literal} -->
</head>

<body style="background: var(--bs-emphasis-color);--bs-primary: #00498c;--bs-primary-rgb: 0,73,140;">
    <!-- Start: Navbar Centered Links -->
    <nav class="navbar navbar-expand-md py-3" style="background: var(--bs-black);margin-top: 15px;">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}"><span
                    class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"
                    style="background: rgba(0,73,140,0);"><img
                        src="{{ url('assets/img/Circle%20Brand%20Identity.jpeg') }}"
                        style="width: 50px;height: 50px;"></span><span
                    style="color: var(--bs-body-color);">Pulsetracker</span></a><button data-bs-toggle="collapse"
                class="navbar-toggler" data-bs-target="#navcol-3"><span class="visually-hidden">Toggle
                    navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-3" style="color: white;">
                <ul class="navbar-nav mx-auto" style="color: white;">
                    <li class="nav-item" style="color: white;margin-right: 15px;"><a class="nav-link active"
                            href="{{ url('blogs') }}" style="color: white;">Blog</a></li>
                    <li class="nav-item" style="color: white;margin-right: 15px;"><a class="nav-link active"
                            href="{{ url('about') }}" style="color: white;">About</a></li>
                    <li class="nav-item" style="color: white;"><a class="nav-link active" href="{{ url('https://docs.pulsestracker.com') }}"
                            style="color: white;margin-right: 15px;">Docs</a></li>
                    <li class="nav-item" style="color: white;"><a class="nav-link active" href="{{url('/#pricing')}}"
                            style="color: white;">Pricing</a></li>
                </ul>
                @auth
                    <a class="btn btn-success" role="button" href="{{ url('dashboard') }}">Dashboard</a>
                @endauth
                @guest
                    <a class="btn btn-primary" role="button" style="margin-right: 20px;"
                        href="{{ url('signin') }}">Login</a>
                    <a class="btn btn-primary" role="button" href="{{ url('signup') }}">Create account</a>
                @endguest
            </div>
        </div>
    </nav><!-- End: Navbar Centered Links -->
    @yield('content')
    @cookieconsentview

    <x-footer />
    <center>
        <div style="text-align:center;">
            <iframe src="https://status-pulsetracker.betteruptime.com/badge?theme=dark" width="200" height="50"
                frameborder="0" scrolling="no"></iframe>
        </div>
    </center>

    <!-- End: Footer Dark -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => hljs.highlightAll());
    </script>
</body>

</html>
