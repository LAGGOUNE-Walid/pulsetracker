<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="twitter:description"
        content="PulseTracker, the cutting-edge solution for real-time location tracking designed for developers and businesses. Our eco-friendly service uses the efficient UDP protocol to minimize mobile power consumption while delivering accurate location updates. PulseTracker offers seamless integration with WebSockets for real-time data dispatch, comprehensive API access, and robust tracking features. Whether you're building a new app or enhancing existing services, PulseTracker's scalable solutions and flexible pricing plans ensure you get the most reliable and cost-effective location tracking. Start with our free plan and scale up as your needs grow. Try PulseTracker today and experience unparalleled location tracking performance.">
    <meta name="twitter:image" content="{{ url('assets/img/Circle%20Brand%20Identity.jpeg') }}">
    <meta property="og:image" content="{{ url('assets/img/Circle%20Brand%20Identity.jpeg') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="PulseTracker">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="description"
        content="PulseTracker, the cutting-edge solution for real-time location tracking designed for developers and businesses. Our eco-friendly service uses the efficient UDP protocol to minimize mobile power consumption while delivering accurate location updates. PulseTracker offers seamless integration with WebSockets for real-time data dispatch, comprehensive API access, and robust tracking features. Whether you're building a new app or enhancing existing services, PulseTracker's scalable solutions and flexible pricing plans ensure you get the most reliable and cost-effective location tracking. Start with our free plan and scale up as your needs grow. Try PulseTracker today and experience unparalleled location tracking performance.">
    <link rel="icon" type="image/jpeg" sizes="720x720"
        href="{{ url('assets/img/Circle%20Brand%20Identity.jpeg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/darkly/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="{{ url('assets/css/bs-theme-overrides.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/Banner-Heading-Image-images.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/Navbar-Centered-Brand-Dark-icons.css') }}">
</head>

<body style="--bs-body-bg: black;">
    <!-- Start: 1 Row 1 Column -->
    <div class="container" style="margin-top: 5%;">
        <div class="row justify-content-center">
            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <h3><img src="{{ url('assets/img/Circle%20Brand%20Identity.jpeg') }}" width="70" height="70"
                        style="width: 70px;height: 70px;">Pulsetracker</h3>
                <hr style="margin-top: 5%;">
                @yield('content')
                <hr style="margin-top: 5%;">
            </div>
        </div>
    </div><!-- End: 1 Row 1 Column -->
    <x-footer/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
