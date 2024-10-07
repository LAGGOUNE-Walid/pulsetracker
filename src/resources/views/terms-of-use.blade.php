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
                            <h1 id="pulsetracker-terms-of-service">PulseTracker Terms of Service</h1>
                            <h3 id="last-updated-insert-date-">Last Updated: 2024-10-04</h3>
                            <p>Welcome to PulseTracker! By using our service, you agree to comply with and be bound by
                                the following terms and conditions. Please review them carefully. If you do not agree to
                                these terms, you should not use PulseTracker.</p>
                            <h3 id="1-account-registration-">1. <strong>Account Registration</strong></h3>
                            <ul>
                                <li>Anyone, whether an individual or a company, may create an account to track devices.
                                </li>
                                <li>To create an account, users must provide an email address and a password.</li>
                                <li>It is the user&#39;s responsibility to maintain the confidentiality of their account
                                    credentials.</li>
                            </ul>
                            <h3 id="2-subscription-plans-and-payment-">2. <strong>Subscription Plans and
                                    Payment</strong></h3>
                            <ul>
                                <li>PulseTracker offers three subscription plans: Free, Pro, and Enterprise.</li>
                                <li>Subscription plans are billed on a monthly basis.</li>
                                <li>Changing your subscription plan (upgrade/downgrade) will result in an immediate
                                    charge for the new plan, but your used quota will not be reset—only the limit will
                                    be updated.</li>
                                <li>At the beginning of each new billing period, your used quota will reset to zero.
                                </li>
                                <li>Subscription cancellations take effect at the end of the current billing period, and
                                    canceled subscriptions cannot be resumed. There is no proration for plan changes or
                                    cancellations.</li>
                            </ul>
                            <h3 id="3-data-privacy-and-security-">3. <strong>Data Privacy and Security</strong></h3>
                            <ul>
                                <li>PulseTracker does not share your data, including device location data, with third
                                    parties unless required by law in cases where users or their devices are linked to
                                    harmful activities such as terrorism or criminal behavior.</li>
                                <li>All user data is stored securely, and we take necessary steps to protect it.</li>
                            </ul>
                            <h3 id="4-user-responsibilities-">4. <strong>User Responsibilities</strong></h3>
                            <ul>
                                <li>Users must use PulseTracker in compliance with all applicable laws and regulations.
                                </li>
                                <li>You are responsible for any activity that occurs under your account, including
                                    ensuring that the tracked devices belong to you or that you have permission to track
                                    them.</li>
                                <li>Users must not exploit the platform for illegal activities, including tracking
                                    devices associated with criminal or terrorist activities.</li>
                            </ul>
                            <h3 id="5-limitation-of-liability-">5. <strong>Limitation of Liability</strong></h3>
                            <ul>
                                <li>PulseTracker provides real-time location tracking and data storage services, but we
                                    do not guarantee uninterrupted or error-free service.</li>
                                <li>PulseTracker is not liable for any inaccuracies in the location data or for any harm
                                    or loss resulting from service outages, data delays, or unauthorized access.</li>
                                <li>PulseTracker disclaims all warranties of any kind, whether express or implied.</li>
                            </ul>
                            <h3 id="6-account-termination-">6. <strong>Account Termination</strong></h3>
                            <ul>
                                <li>PulseTracker reserves the right to terminate or suspend your account without prior
                                    notice if you breach these Terms or for any other reason, including but not limited
                                    to:<ul>
                                        <li>Using the service to manipulate or attack PulseTracker servers.</li>
                                        <li>Using the service in association with criminal or terrorist organizations.
                                        </li>
                                    </ul>
                                </li>
                                <li>Upon termination, your access to the service will cease immediately, and
                                    PulseTracker is not liable for any data loss associated with the termination.</li>
                            </ul>
                            <h3 id="7-governing-law-">7. <strong>Governing Law</strong></h3>
                            <ul>
                                <li>These Terms of Service shall be governed by and construed in accordance with the
                                    laws applicable to the user’s region. PulseTracker operates globally and strives to
                                    comply with international standards.</li>
                            </ul>
                            <h3 id="8-changes-to-the-terms-">8. <strong>Changes to the Terms</strong></h3>
                            <ul>
                                <li>PulseTracker reserves the right to modify these Terms at any time. Changes will be
                                    effective immediately upon posting to our website. Your continued use of
                                    PulseTracker after any changes to these Terms constitutes acceptance of the revised
                                    Terms.</li>
                            </ul>
                            <h3 id="9-third-party-services-">9. <strong>Third-Party Services</strong></h3>
                            <ul>
                                <li>PulseTracker may integrate with third-party services for mapping, data analysis, and
                                    communications. However, we are not responsible for the practices or terms of these
                                    third-party providers.</li>
                            </ul>
                            <h3 id="10-contact-information-">10. <strong>Contact Information</strong></h3>
                            <ul>
                                <li>If you have any questions about these Terms, please contact us at [Insert Contact
                                    Information].</li>
                            </ul>

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
