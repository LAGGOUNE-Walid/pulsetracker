<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

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
    <link rel="icon" type="image/jpeg" sizes="720x720" href="assets/img/Circle_Brand_Identity__Copy_-removebg-preview.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/darkly/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/Banner-Heading-Image-images.css">
    <link rel="stylesheet" href="assets/css/Navbar-Centered-Brand-Dark-icons.css">
    <script defer src="https://cloud.umami.is/script.js" data-website-id="06db6e2e-fb33-4581-8722-67ece940e18e"></script>
</head>

<body style="background: black;">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}"><svg
                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                    viewBox="0 0 16 16" class="bi bi-arrow-left">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8">
                    </path>
                </svg>Home</a></li>
    </ul><!-- Start: 1 Row 1 Column -->
    <div class="container" style="margin-top: 5%;">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6"><img
                    src="assets/img/Circle%20Brand%20Identity.jpeg" width="111" height="101"
                    style="width: 70px;height: 70px;">
                <h1 style="margin-top: 5%;">Login to Pulsetracker</h1>
                <h4 style="color: var(--bs-gray-500);margin-top: 5%;">Don't have an account? <a
                        href="{{ url('signup') }}">Sign up</a>.</h4>
                <form style="margin-top: 8%;" method="POST" action="{{ url('account/login') }}">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="input-group"><input class="form-control" type="email"
                            style="background: #16171C;border-style: solid;border-color: var(--bs-light);font-size: 24px;color: var(--bs-body-color);"
                            placeholder="Email" name="email" required></div>
                    <div class="input-group"><input class="form-control" type="password"
                            style="background: #16171C;border-style: solid;border-color: var(--bs-light);font-size: 24px;color: var(--bs-body-color);margin-top: 3%;"
                            placeholder="Password" name="password" required></div><button class="btn btn-outline-success btn-lg" type="submit"
                        style="margin-top: 5%;width: 100%;">Continue</button>
                </form>
                <hr style="margin-top: 5%;">
                <div class="row text-center">
                    <div class="col"><a class="btn btn-dark btn-lg" type="button" href="{{ url('login/github') }}"
                            style="margin-top: 5%;"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-github">
                                <path
                                    d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8">
                                </path>
                            </svg>&nbsp;Login with Github</a></div>
                    <div class="col"><a class="btn btn-dark btn-lg" type="button" href="{{ url('login/google') }}"
                            style="margin-top: 5%;"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-google">
                                <path
                                    d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z">
                                </path>
                            </svg>&nbsp;Login with Google</a></div>
                </div>
                <h5 style="margin-top: 5%;color: var(--bs-gray-500);">By signing in, you agree to our <a
                        href="{{url('terms-of-use')}}" target="_blank">terms</a>, <a
                        href="{{url('privacy-policy')}}" target="_blank">privacy policy</a>.</h5>
            </div>
        </div>
    </div><!-- End: 1 Row 1 Column -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
