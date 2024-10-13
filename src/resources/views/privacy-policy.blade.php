<!DOCTYPE html>
<html data-bs-theme="light" lang="en"
    style="--bs-body-bg: black;--bs-body-font-size: 1.5rem;--bs-body-font-weight: 1000;--bs-dark: black;--bs-dark-rgb: 0,0,0;font-family: Alatsi, sans-serif !important;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Privacy policy</title>
    <meta name="twitter:description"
        content="Pulsetracker, the cutting-edge solution for real-time location tracking designed for developers and businesses. Our eco-friendly service uses the efficient UDP protocol to minimize mobile power consumption while delivering accurate location updates. Pulsetracker offers seamless integration with WebSockets for real-time data dispatch, comprehensive API access, and robust tracking features. Whether you're building a new app or enhancing existing services, Pulsetracker's scalable solutions and flexible pricing plans ensure you get the most reliable and cost-effective location tracking. Start with our free plan and scale up as your needs grow. Try Pulsetracker today and experience unparalleled location tracking performance.">
    <meta name="twitter:image" content="assets/img/Circle%20Brand%20Identity.jpeg">
    <meta property="og:image" content="assets/img/Circle%20Brand%20Identity.jpeg">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Pulsetracker">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="description"
        content="Pulsetracker, the cutting-edge solution for real-time location tracking designed for developers and businesses. Our eco-friendly service uses the efficient UDP protocol to minimize mobile power consumption while delivering accurate location updates. Pulsetracker offers seamless integration with WebSockets for real-time data dispatch, comprehensive API access, and robust tracking features. Whether you're building a new app or enhancing existing services, Pulsetracker's scalable solutions and flexible pricing plans ensure you get the most reliable and cost-effective location tracking. Start with our free plan and scale up as your needs grow. Try Pulsetracker today and experience unparalleled location tracking performance.">
    <link rel="icon" type="image/jpeg" sizes="720x720"
        href="assets/img/Circle_Brand_Identity__Copy_-removebg-preview.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/darkly/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="/assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="/assets/css/Banner-Heading-Image-images.css">
    <link rel="stylesheet" href="/assets/css/Navbar-Centered-Brand-Dark-icons.css">
    @paddleJS
    <script defer src="https://cloud.umami.is/script.js" data-website-id="06db6e2e-fb33-4581-8722-67ece940e18e"></script>
</head>

<body style="background: var(--bs-emphasis-color);--bs-primary: #00498c;--bs-primary-rgb: 0,73,140;">
    <!-- Start: Navbar Centered Links -->
    <nav class="navbar navbar-expand-md py-3" style="background: var(--bs-black);margin-top: 15px;">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="{{url('/')}}"><span
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
                            href="{{ url('about') }}" style="color: white;">About</a></li>
                    <li class="nav-item" style="color: white;"><a class="nav-link active" href="{{ url('docs/api') }}"
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
                    <div class="col-md-12">
                        <div class="text-white p-4 p-md-5">
                            <h1>Pulsetracker Privacy Policy</h1>
                            <p><strong>Effective Date:</strong> 2024-10-04</p>

                            <h2>1. Introduction</h2>
                            <p>Pulsetracker ("we", "our", or "us") is committed to protecting your privacy. This Privacy
                                Policy explains how we collect, use, and disclose information about you when you use our
                                services. By using Pulsetracker, you agree to the collection and use of information in
                                accordance with this policy.</p>

                            <h2>2. Information We Collect</h2>
                            <ul>
                                <li><strong>Account Information:</strong> When you create an account, we collect your fullname, 
                                    email address and password.</li>
                                <li><strong>Device Information:</strong> We collect location data from devices linked to
                                    your account to provide the location tracking service.</li>
                                <li><strong>Analytics Information:</strong> We use umami, an open-source analytics
                                    platform, to collect non-personal information such as visitor sources and page
                                    interactions to improve our service.</li>
                            </ul>

                            <h2>3. How We Use Your Information</h2>
                            <p>We use your data to:</p>
                            <ul>
                                <li>Provide and maintain the Pulsetracker service.</li>
                                <li>Track and manage device locations as requested by users.</li>
                                <li>Improve service performance through basic analytics.</li>
                                <li>Communicate with you regarding updates to our services, including changes to this
                                    Privacy Policy.</li>
                            </ul>

                            <h2>4. Data Retention</h2>
                            <p>We retain personal data for as long as your account is active or as necessary to provide
                                you with our services. Device data, including location information, may also be stored
                                indefinitely unless you request deletion.</p>

                            <h2>5. Sharing Your Information</h2>
                            <p>We do not share your personal or device data with third parties, except when required by
                                law or in cases of harmful activity, such as terrorism or criminal behavior.</p>

                            <h2>6. Data Security</h2>
                            <p>We take data security seriously and employ reasonable measures to protect your
                                information from unauthorized access, alteration, or destruction. However, no method of
                                transmission or storage is 100% secure.</p>

                            <h2>7. Your Rights</h2>
                            <p>As a user, you have the right to access, modify, or delete your personal data. You may
                                also opt out of certain features or request data deletion by <a href="mailto:contact@pulsestracker.com">contacting us</a>. Please note
                                that requests may take up to 7 days to process.</p>

                            <h2>8. Cookies and Tracking Technologies</h2>
                            <p>We use umami, which is privacy-focused and does not use cookies or track personal
                                information for analytics. No other cookies or tracking technologies are used on
                                Pulsetracker at this time.</p>

                            <h2>9. Children's Privacy</h2>
                            <p>Pulsetracker is not intended for use by children under the age of 12, and we do
                                not knowingly collect data from children without parental consent. If you believe we
                                have collected such information, please contact us for removal.</p>

                            <h2>10. Changes to This Policy</h2>
                            <p>We may update this Privacy Policy from time to time to reflect changes in our practices
                                or for other operational, legal, or regulatory reasons. You will be notified via email
                                of any significant changes.</p>

                            <h2>11. Contact Information</h2>
                            <p>If you have any questions about this Privacy Policy or your data, please contact us at
                                <a href="mailto:contact@pulsestracker.com">contact@pulsestracker.com</a> .</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End: 1 Row 2 Columns -->
    </section><!-- End: Banner Heading Image -->
    <x-footer />
    <!-- End: Footer Dark -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
