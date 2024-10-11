<!DOCTYPE html>
<html data-bs-theme="light" lang="en"
    style="--bs-body-bg: black;--bs-body-font-size: 1.5rem;--bs-body-font-weight: 1000;--bs-dark: black;--bs-dark-rgb: 0,0,0;font-family: Alatsi, sans-serif !important;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Terms of use</title>
    <meta name="twitter:description"
        content="PulseTracker, the cutting-edge solution for real-time location tracking designed for developers and businesses. Our eco-friendly service uses the efficient UDP protocol to minimize mobile power consumption while delivering accurate location updates. PulseTracker offers seamless integration with WebSockets for real-time data dispatch, comprehensive API access, and robust tracking features. Whether you're building a new app or enhancing existing services, PulseTracker's scalable solutions and flexible pricing plans ensure you get the most reliable and cost-effective location tracking. Start with our free plan and scale up as your needs grow. Try PulseTracker today and experience unparalleled location tracking performance.">
    <meta name="twitter:image" content="assets/img/Circle%20Brand%20Identity.jpeg">
    <meta property="og:image" content="assets/img/Circle%20Brand%20Identity.jpeg">
    <meta property="og:type" content="website">
    <meta property="og:title" content="PulseTracker">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="description"
        content="PulseTracker, the cutting-edge solution for real-time location tracking designed for developers and businesses. Our eco-friendly service uses the efficient UDP protocol to minimize mobile power consumption while delivering accurate location updates. PulseTracker offers seamless integration with WebSockets for real-time data dispatch, comprehensive API access, and robust tracking features. Whether you're building a new app or enhancing existing services, PulseTracker's scalable solutions and flexible pricing plans ensure you get the most reliable and cost-effective location tracking. Start with our free plan and scale up as your needs grow. Try PulseTracker today and experience unparalleled location tracking performance.">
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
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}"><span
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
                            <h1>PulseTracker Terms of Service</h1>
                            <small>Last Updated: October 9, 2024</small>

                            <p>Welcome to PulseTracker! By using our service, you agree to comply with the following
                                terms and conditions. If you do not agree, you should not use PulseTracker.</p>

                            <h1>1. Account Registration</h1>
                            <p>Anyone, whether an individual or a company, can create an account. Users must provide an
                                email address and password, and are responsible for safeguarding their credentials.</p>

                            <h1>2. Subscription Plans and Payment</h1>
                            <p>PulseTracker offers Free, Pro, and Enterprise plans, billed monthly through Paddle. In
                                most cases
                                , payments for Pulsetracker subscriptions and services aren't refundable, If you have an
                                issue with your account, or think there has been an error in billing, please contact us
                                by mail <a href="mailto:contact@pulsestracker.com">contact@pulsestracker.com</a>. If you
                                upgrade or downgrade your plan, an
                                immediate charge will occur, but your quota max limits will only change, not reset.
                                Quotas reset at
                                the beginning of each billing period. Canceled subscriptions remain active until the end
                                of the billing period. Payment methods include Visa, Mastercard, and PayPal.</p>

                            <h1>3. Data Privacy and Security</h1>
                            <p>PulseTracker collects and stores user data, including email address, password, and name,
                                and device data such as IP address, latitude, longitude, app ID, client ID, and any
                                additional data specified by the developer using the service.
                                We use data hosting service providers in the EU to host the information we collect, and
                                we use technical measures to secure your data. While we implement safeguards designed to
                                protect your information, no security system is impenetrable and due to the inherent
                                nature of the Internet, we cannot guarantee that data, during transmission through the
                                Internet or while stored on our systems or otherwise in our care, is absolutely safe
                                from intrusion by others. We will respond to requests about this within a reasonable
                                timeframe.

                                Sensitive and private data exchange for our Services happen over an SSL secured
                                communication channel and is encrypted and protected with digital signatures.

                                We never store passwords in our database; they are always encrypted and hashed with
                                individual salts. PulseTracker does not share user data with any third parties unless
                                required by law in cases where users or their devices are linked to harmful activities
                                such as terrorism or criminal behavior.
                                <br/>
                                <br/>
                                PulseTracker uses Umami, an open-source analytics service, to collect anonymous usage
                                data to improve the service. For more information on Umami's privacy policy, please
                                visit <a href="https://umami.is/privacy">Umami's privacy policy</a>.</p>

                            <h1>4. User Responsibilities</h1>
                            <p>Users must use PulseTracker in compliance with all applicable laws and regulations. You
                                are responsible for any activity that occurs under your account, including ensuring that
                                the tracked devices belong to you or that you have permission to track them. Users must
                                not exploit the platform for illegal activities, including tracking devices associated
                                with criminal or terrorist activities. Users are solely responsible for the accuracy of
                                the GPS data collected from devices and acknowledge that PulseTracker does not guarantee
                                the accuracy of this data.</p>

                            <h1>5. Limitation of Liability</h1>
                            <p>PulseTracker provides real-time location tracking and data storage, broadcasting services
                                as a backend, but we do not guarantee uninterrupted or error-free service. PulseTracker
                                is not liable for any inaccuracies in the location data or for any harm or loss
                                resulting from service outages, data delays, or unauthorized access. PulseTracker
                                disclaims all warranties of any kind, whether express or implied.</p>

                            <h1>6. Intellectual Property</h1>
                            <p>All PulseTracker software, branding, and technology are the intellectual property of
                                PulseTracker and its licensors. You are granted a limited, non-transferable license to
                                use the service under these terms.</p>

                            <h1>7. Account Termination</h1>
                            <p>We may terminate or suspend your account with 5 days' notice via email if you violate
                                these terms. Reasons for termination include, but are not limited to, non-payment,
                                misuse of the service, or use linked to criminal activity.</p>

                            <h1>8. Governing Law</h1>
                            <p>These terms are governed by the laws of Europe, where PulseTracker servers are hosted. If
                                you reside outside Europe, local laws may also apply.</p>

                            <h1>9. Dispute Resolution</h1>
                            <p>Any disputes arising from the use of PulseTracker will be resolved through binding
                                arbitration in accordance with French law. Users waive the right to participate in
                                class-action lawsuits.</p>

                            <h1>10. Changes to the Terms</h1>
                            <p>PulseTracker may update these terms at any time, with changes taking effect immediately
                                upon posting to the website. Continued use of the service after updates constitutes
                                acceptance.</p>

                            <h1>11. Contact Information</h1>
                            <p>For questions or concerns, please contact us at <strong><a
                                        href="mailto:contact@pulsestracker.com">contact@pulsestracker.com</a></strong>.
                            </p>


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
