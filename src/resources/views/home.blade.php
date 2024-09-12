<!DOCTYPE html>
<html data-bs-theme="light" lang="en"
    style="--bs-body-bg: black;--bs-body-font-size: 1.5rem;--bs-body-font-weight: 1000;--bs-dark: black;--bs-dark-rgb: 0,0,0;font-family: Alatsi, sans-serif !important;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home page</title>
    <meta name="twitter:description"
        content="PulseTracker, the cutting-edge solution for real-time location tracking designed for developers and businesses. Our eco-friendly service uses the efficient UDP protocol to minimize mobile power consumption while delivering accurate location updates. PulseTracker offers seamless integration with WebSockets for real-time data dispatch, comprehensive API access, and robust tracking features. Whether you're building a new app or enhancing existing services, PulseTracker's scalable solutions and flexible pricing plans ensure you get the most reliable and cost-effective location tracking. Start with our free plan and scale up as your needs grow. Try PulseTracker today and experience unparalleled location tracking performance.">
    <meta name="twitter:image" content="assets/img/Circle%20Brand%20Identity.jpeg">
    <meta property="og:image" content="assets/img/Circle%20Brand%20Identity.jpeg">
    <meta property="og:type" content="website">
    <meta property="og:title" content="PulseTracker">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="description"
        content="PulseTracker, the cutting-edge solution for real-time location tracking designed for developers and businesses. Our eco-friendly service uses the efficient UDP protocol to minimize mobile power consumption while delivering accurate location updates. PulseTracker offers seamless integration with WebSockets for real-time data dispatch, comprehensive API access, and robust tracking features. Whether you're building a new app or enhancing existing services, PulseTracker's scalable solutions and flexible pricing plans ensure you get the most reliable and cost-effective location tracking. Start with our free plan and scale up as your needs grow. Try PulseTracker today and experience unparalleled location tracking performance.">
    <link rel="icon" type="image/jpeg" sizes="720x720" href="assets/img/Circle%20Brand%20Identity.jpeg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/darkly/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="{{ url('assets/css/bs-theme-overrides.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/Banner-Heading-Image-images.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/Navbar-Centered-Brand-Dark-icons.css') }}">
</head>

<body style="background: var(--bs-emphasis-color);--bs-primary: #00498c;--bs-primary-rgb: 0,73,140;">
    <!-- Start: Navbar Centered Links -->
    <nav class="navbar navbar-expand-md py-3" style="background: var(--bs-black);margin-top: 15px;">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span
                    class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"
                    style="background: rgba(0,73,140,0);"><img
                        src="{{ url('assets/img/Circle%20Brand%20Identity.jpeg') }}"
                        style="width: 50px;height: 50px;"></span><span
                    style="color: var(--bs-body-color);">PulseTracker</span></a><button data-bs-toggle="collapse"
                class="navbar-toggler" data-bs-target="#navcol-3"><span class="visually-hidden">Toggle
                    navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-3" style="color: white;">
                <ul class="navbar-nav mx-auto" style="color: white;">
                    <li class="nav-item" style="color: white;margin-right: 15px;"><a class="nav-link active"
                            href="{{ url('about') }}" style="color: white;">About</a></li>
                    <li class="nav-item" style="color: white;"><a class="nav-link active" href="{{ url('docs') }}"
                            style="color: white;margin-right: 15px;">Docs</a></li>
                    <li class="nav-item" style="color: white;"><a class="nav-link active" href="#pricing"
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
    <!-- Start: Banner Heading Image -->
    <section class="text-primary py-4 py-xl-5">
        <!-- Start: 1 Row 2 Columns -->
        <div class="container">
            <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="text-white p-4 p-md-5">
                            <h2 class="fw-bold text-white mb-3" style="font-size: 52px;">Real-Time Location Tracking.
                                Fast. Efficient. Eco-Friendly</h2>
                            <p class="mb-4" style="font-size: 18px;color: var(--bs-gray-500);">Track and manage mobile
                                devices with lightning-fast UDP technology. Minimize battery consumption, scale
                                effortlessly, and view locations in real-time or dispatch data to your preferred
                                systems.</p>
                            <div class="my-3">@guest <a class="btn btn-primary" role="button">Getting started</a> @endguest</div>
                        </div>
                    </div>
                    <div class="col-md-6 order-first order-md-last" style="min-height: 250px;"><img
                            class="w-100 h-100 fit-cover" src="{{ url('assets/img/ezgif-4-6c4552c94d.gif') }}"></div>
                </div>
            </div>
        </div><!-- End: 1 Row 2 Columns -->
    </section><!-- End: Banner Heading Image -->
    <section style="margin-top: 8%;">
        <!-- Start: 1 Row 1 Column -->
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 style="text-align: center;"><strong>Seamless Integration</strong></h1>
                </div>
            </div>
        </div><!-- End: 1 Row 1 Column -->
        <!-- Start: 1 Row 3 Columns -->
        <div class="container-fluid" style="margin-top: 3%;">
            <div class="row gy-5" style="margin-left: 1%;margin-right: 1%;">
                <div class="col-md-4" style="margin-right: 0px;padding: 0%;padding-right: 3%;"><svg
                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                        viewBox="0 0 16 16" class="bi bi-radar" style="font-size: 39px;margin-bottom: 15px;">
                        <path
                            d="M6.634 1.135A7 7 0 0 1 15 8a.5.5 0 0 1-1 0 6 6 0 1 0-6.5 5.98v-1.005A5 5 0 1 1 13 8a.5.5 0 0 1-1 0 4 4 0 1 0-4.5 3.969v-1.011A2.999 2.999 0 1 1 11 8a.5.5 0 0 1-1 0 2 2 0 1 0-2.5 1.936v-1.07a1 1 0 1 1 1 0V15.5a.5.5 0 0 1-1 0v-.518a7 7 0 0 1-.866-13.847Z">
                        </path>
                    </svg>
                    <h3>Real-time Location Tracking</h3>
                    <p style="color: var(--bs-gray-500);font-size: 20px;">Integrate effortlessly with PulseTracker to
                        send location updates every second using UDP, ensuring efficient data transmission.</p>
                </div>
                <div class="col-md-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-browser-chrome"
                        style="font-size: 39px;margin-bottom: 15px;">
                        <path fill-rule="evenodd"
                            d="M16 8a8.001 8.001 0 0 1-7.022 7.94l1.902-7.098a2.995 2.995 0 0 0 .05-1.492A2.977 2.977 0 0 0 10.237 6h5.511A8 8 0 0 1 16 8M0 8a8 8 0 0 0 7.927 8l1.426-5.321a2.978 2.978 0 0 1-.723.255 2.979 2.979 0 0 1-1.743-.147 2.986 2.986 0 0 1-1.043-.7L.633 4.876A7.975 7.975 0 0 0 0 8m5.004-.167L1.108 3.936A8.003 8.003 0 0 1 15.418 5H8.066a2.979 2.979 0 0 0-1.252.243 2.987 2.987 0 0 0-1.81 2.59ZM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4">
                        </path>
                    </svg>
                    <h3>WebSocket Dispatching</h3>
                    <p style="color: var(--bs-gray-500);font-size: 20px;">Utilize WebSockets with Pusher protocol for
                        instant updates and live tracking on your application’s map interface.</p>
                </div>
                <div class="col-md-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-file-zip"
                        style="font-size: 39px;margin-bottom: 15px;">
                        <path
                            d="M6.5 7.5a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.109 0l-.93-.62a1 1 0 0 1-.415-1.074l.4-1.599V7.5zm2 0h-1v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.93-.62-.4-1.598a1 1 0 0 1-.03-.243z">
                        </path>
                        <path
                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm5.5-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9v1H8v1h1v1H8v1h1v1H7.5V5h-1V4h1V3h-1V2h1z">
                        </path>
                    </svg>
                    <h3>Compact Format</h3>
                    <p style="color: var(--bs-gray-500);font-size: 20px;">Benefit from quick serialization and
                        deserialization, enhancing data transfer speed and reducing latency with MessagePack’s compact
                        binary format.</p>
                </div>
                <div class="col-md-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-tree"
                        style="font-size: 39px;margin-bottom: 15px;">
                        <path
                            d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777l-3-4.5zM6.437 4.758A.5.5 0 0 0 6 4.5h-.066L8 1.401 10.066 4.5H10a.5.5 0 0 0-.424.765L11.598 8.5H11.5a.5.5 0 0 0-.447.724L12.69 12.5H3.309l1.638-3.276A.5.5 0 0 0 4.5 8.5h-.098l2.022-3.235a.5.5 0 0 0 .013-.507z">
                        </path>
                    </svg>
                    <h3>Eco-Friendly Data Transmission</h3>
                    <p style="color: var(--bs-gray-500);font-size: 20px;">Benefit from the low-power consumption of
                        UDP, making it ideal for mobile devices and reducing battery drain.</p>
                </div>
                <div class="col-md-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-code"
                        style="font-size: 39px;margin-bottom: 15px;">
                        <path
                            d="M5.854 4.854a.5.5 0 1 0-.708-.708l-3.5 3.5a.5.5 0 0 0 0 .708l3.5 3.5a.5.5 0 0 0 .708-.708L2.707 8l3.147-3.146zm4.292 0a.5.5 0 0 1 .708-.708l3.5 3.5a.5.5 0 0 1 0 .708l-3.5 3.5a.5.5 0 0 1-.708-.708L13.293 8l-3.147-3.146z">
                        </path>
                    </svg>
                    <h3>Flexible Integration</h3>
                    <p style="color: var(--bs-gray-500);font-size: 20px;">Easy integration with mobile applications
                        through API endpoints for creating device tokens and sending location data.</p>
                </div>
                <div class="col-md-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-server"
                        style="font-size: 39px;margin-bottom: 15px;">
                        <path
                            d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z">
                        </path>
                        <path
                            d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z">
                        </path>
                        <path
                            d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667z">
                        </path>
                    </svg>
                    <h3>Scalable Architecture</h3>
                    <p style="color: var(--bs-gray-500);font-size: 20px;">Robust backend that handles high-frequency
                        data streams and supports large numbers of concurrent users.</p>
                </div>
            </div>
        </div><!-- End: 1 Row 3 Columns -->
    </section>
    <section style="margin-top: 8%;">
        <!-- Start: 1 Row 1 Column -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center" style="--bs-body-font-weight: 1000;font-weight: bold;">Integrate tonight
                    </h1>
                    <h4 style="color: var(--bs-gray-500);margin-top: 9px;padding-top: 20px;"><strong>Seamlessly
                            integrate with PulseTracker in just a few lines of code. Below are examples for popular
                            mobile programming languages to get you started.</strong></h4>
                </div>
            </div>
        </div><!-- End: 1 Row 1 Column -->
    </section>
    <section style="margin-top: 8%;">
        <!-- Start: 1 Row 1 Column -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center" style="font-weight: bold;">Everything in your control</h1>
                    <h4 style="color: var(--bs-gray-500);margin-top: 9px;padding-top: 20px;">PulseTracker puts you in
                        charge, offering complete control over how you track, manage, and dispatch location data.</h4>
                    <img src="{{ url('assets/img/Screenshot%202024-09-10%20at%2013-53-05%20CodePen%20-%20Leaflet%20Map%20-%20Dark%20Theme.webp') }}"
                        style="width: 100%;border-radius: 10px;margin-top: 3%;">
                </div>
            </div>
        </div><!-- End: 1 Row 1 Column -->
    </section>
    <section style="margin-top: 8%;">
        <h1 style="text-align: center;" id="pricing">Pricing</h1><!-- Start: 1 Row 3 Columns -->
        <div class="container" style="margin-top: 3%;">
            <div class="row">
                <div class="col-md-4">
                    <div style="border: 1px solid var(--bs-dark-text-emphasis);padding: 5%;border-radius: 10px;">
                        <h5 class="text-center">Free</h5>
                        <h3 class="text-center" style="margin-top: 5%;">$0 / mo</h3>
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
                                </svg>&nbsp;1 app</li>
                            <li><span style="color: var(--bs-form-valid-color);"> </span><svg
                                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;50 Devices</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg><strong>&nbsp;72000 messages per day</strong></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;Unlimited concurrent connections</li>
                        </ul><a class="btn btn-outline-light btn-lg" role="button" style="width: 100%;color: white;"
                            href="{url('signup')}">Sign up</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="padding: 5%;border-radius: 10px;border: 1px solid var(--bs-link-hover-color) ;">
                        <h5 class="text-center">Pro</h5>
                        <h3 class="text-center" style="margin-top: 5%;">$40 / mo</h3>
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
                                </svg>&nbsp;5 apps</li>
                            <li><span style="color: var(--bs-form-valid-color);"> </span>&nbsp;<svg
                                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;1000 Device</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg><strong>&nbsp;Unlimted messages per day</strong></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;Unlimited concurrent connections</li>
                        </ul><a class="btn btn-outline-light btn-lg" role="button" style="width: 100%;color: white;"
                            href="{url('signup')}">Sign up</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="border: 1px solid var(--bs-dark-text-emphasis);padding: 5%;border-radius: 10px;">
                        <h5 class="text-center">Enterprise</h5>
                        <h3 class="text-center" style="margin-top: 5%;">$99 / mo</h3>
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
                                </svg>&nbsp;Unlimited apps</li>
                            <li><span style="color: var(--bs-form-valid-color);"> </span><svg
                                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;Unlimited devices</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg><strong>&nbsp;Unlimted messages per day</strong></li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle"
                                    style="color: var(--bs-form-valid-color);">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                    </path>
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05">
                                    </path>
                                </svg>&nbsp;Unlimited concurrent connections</li>
                        </ul><a class="btn btn-outline-light btn-lg" role="button" style="width: 100%;color: white;"
                            href="{url('signup')}">Sign up</a>
                    </div>
                </div>
            </div>
        </div><!-- End: 1 Row 3 Columns -->
    </section><!-- Start: Footer Dark -->
    <footer class="text-center bg-dark" style="margin-top: 8%;">
        <div class="container text-white py-4 py-lg-5">
            <ul class="list-inline">
                <li class="list-inline-item me-4"><a class="link-light" href="#">Terms of Service</a></li>
                <li class="list-inline-item me-4"><a class="link-light" href="#">Privacy Policy</a></li>
                <li class="list-inline-item me-4"><a class="link-light" href="{{ url('docs') }}">API
                        Documentation</a></li>
                <li class="list-inline-item"><a class="link-light" href="#">Contact Us</a></li>
            </ul>
            <p class="text-muted mb-0">Copyright © 2024 PulseTracker</p>
        </div>
    </footer><!-- End: Footer Dark -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
