@extends('template')
@section('title', 'Terms of service')
@section('content')
    <section class="text-primary py-4 py-xl-5">
        <!-- Start: 1 Row 2 Columns -->
        <div class="container">
            <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="text-white p-4 p-md-5">
                            <h1 class="mt-5">Pulsetracker Terms of Service</h1>
                            <small>Last Updated: October 12, 2024</small>

                            <p>Welcome to Pulsetracker! By using our service, you agree to comply with the following
                                terms and conditions. If you do not agree, you should not use Pulsetracker.</p>

                            <h1 class="mt-5">1. Account Registration</h1>
                            <p>Anyone, whether an individual or a company, can create an account. Users can create an
                                account using google or github providers OR provide an
                                email address and password, and are responsible for safeguarding their credentials.</p>

                            <h1 class="mt-5">2. Subscription Plans and Payment</h1>
                            <p>Pulsetracker offers Free, Pro, and Enterprise plans, billed monthly through <a
                                    href="https://stripe.com">Stripe</a>.
                                <br />
                                When you upgrade or downgrade your plan, you’ll be charged immediately, and your quota
                                limits will adjust according to the new plan’s maximums. However, the usage won’t reset to
                                zero.
                                <br />
                                Quotas reset at the beginning of each billing period. Canceled subscriptions remain
                                active until the end
                                of the billing period.
                            </p>
                            <h1 class="mt-5">3.Refunds</h1>
                            <p>
                                At Pulsetracker, we strive to deliver a high-quality service that meets your needs.
                                Given the nature of our real-time tracking and subscription-based service, we do not
                                offer refunds for any subscription payments.
                                <br />
                                <br />
                                This includes cases where a user consumes their account quota early or within a short
                                period of time. Once a subscription is initiated, it will remain active until the end of
                                the billing period, but no refunds will be processed under any circumstances.
                                <br />
                                <br />
                                In the event of billing errors, please contact our support team at <a
                                    href="mailto:contact@pulsestracker.com">contact@pulsestracker.com</a>. We will
                                review the issue and make any necessary corrections.
                            </p>
                            <h1 class="mt-5">4.Fee Changes</h1>
                            <p>
                                Pulsetracker, in its sole discretion and at any time, may modify Subscription
                                fees for the Subscriptions. Any Subscription fee change will become effective at the end
                                of the then-current Billing Cycle.
                                <br />
                                <br />
                                Pulsetracker, will provide you with a reasonable prior notice of any change in
                                Subscription fees to give you an opportunity to terminate your Subscription before such
                                change becomes effective.
                                <br />
                                <br />
                                Your continued use of Service after Subscription fee change comes into effect
                                constitutes your agreement to pay the modified Subscription fee amount.
                            </p>
                            <h1 class="mt-5">5. Data Privacy and Security</h1>
                            <p>Pulsetracker collects and stores user data, including email address, password, and name,
                                and device data such as IP address, latitude, longitude, app ID, client ID, and any
                                additional data specified by the developer using the service.
                                <br />
                                <br />
                                We use data hosting service providers in the EU to host the information we collect, and
                                we use technical measures to secure your data.
                                <br />
                                <br />
                                While we implement safeguards designed to
                                protect your information, no security system is impenetrable and due to the inherent
                                nature of the Internet, we cannot guarantee that data, during transmission through the
                                Internet or while stored on our systems or otherwise in our care, is absolutely safe
                                from intrusion by others. We will respond to requests about this within a reasonable
                                timeframe.
                                <br />
                                <br />
                                Sensitive and private data exchange for our Services happen over an SSL secured
                                communication channel and is encrypted and protected with digital signatures.
                                <br />
                                <br />
                                We never store passwords in our database; they are always encrypted and hashed .
                                <br />
                                <br />
                                Pulsetracker does not share user data with any third parties unless
                                required by law in cases where users or their devices are linked to harmful activities
                                such as terrorism or criminal behavior.
                                <br />
                                <br />
                                Pulsetracker uses Umami, an open-source analytics service, to collect anonymous usage
                                data to improve the service. For more information on Umami's privacy policy, please
                                visit <a href="https://umami.is/privacy">Umami's privacy policy</a>.
                            </p>

                            <h1 class="mt-5">6. User Responsibilities</h1>
                            <p>Users must use Pulsetracker in compliance with all applicable laws and regulations. You
                                are responsible for any activity that occurs under your account, including ensuring that
                                the tracked devices belong to you or that you have permission to track them. Users must
                                not exploit the platform for illegal activities, including tracking devices associated
                                with criminal or terrorist activities. Users are solely responsible for the accuracy of
                                the GPS data collected from devices and acknowledge that Pulsetracker does not guarantee
                                the accuracy of this data.</p>

                            <h1 class="mt-5">7. Limitation of Liability</h1>
                            <p>Pulsetracker provides real-time location tracking and data storage, broadcasting services
                                as a backend, but we do not guarantee uninterrupted or error-free service.
                                <br />
                                <br />
                                Pulsetracker is not liable for any inaccuracies in the location data or for any harm or
                                loss
                                resulting from service outages, data delays, or unauthorized access.
                                <br />
                                <br />
                                Pulsetracker
                                disclaims all warranties of any kind, whether express or implied.
                            </p>

                            <h1 class="mt-5">8. Intellectual Property</h1>
                            <p>All Pulsetracker software, branding, and technology are the intellectual property of
                                Pulsetracker and its licensors. You are granted a limited, non-transferable license to
                                use the service under these terms.</p>

                            <h1 class="mt-5">9. Account Termination</h1>
                            <p>We may terminate or suspend your account with 5 days' notice via email if you violate
                                these terms. Reasons for termination include, but are not limited to, non-payment,
                                misuse of the service, or use linked to criminal activity.</p>

                            <h1 class="mt-5">10. Governing Law</h1>
                            <p>These terms are governed by the laws of Europe, where Pulsetracker servers are hosted. If
                                you reside outside Europe, local laws may also apply.</p>

                            <h1 class="mt-5">11. Dispute Resolution</h1>
                            <p>Any disputes arising from the use of Pulsetracker will be resolved through binding
                                arbitration in accordance with Europe law. Users waive the right to participate in
                                class-action lawsuits.</p>

                            <h1 class="mt-5">12. Changes to the Terms</h1>
                            <p>Pulsetracker may update these terms at any time, with changes taking effect immediately
                                upon posting to the website. Continued use of the service after updates constitutes
                                acceptance.</p>

                            <h1 class="mt-5">13. Contact Information</h1>
                            <p>For questions or concerns, please contact us at <strong><a
                                        href="mailto:contact@pulsestracker.com">contact@pulsestracker.com</a></strong>.
                            </p>


                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End: 1 Row 2 Columns -->
    </section><!-- End: Banner Heading Image -->
@endsection
