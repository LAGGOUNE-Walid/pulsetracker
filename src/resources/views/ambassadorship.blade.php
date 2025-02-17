@extends('template')
@section('title', 'Ambassadorship')
@section('content')
    <div class="container py-5" style="margin-top: 10%;">
        <div class="row text-center">
            <div class="col">
                <h1 class="accent mb-4">PulseTracker Ambassador Program</h1>
                <h3>Earn Recurring Lifetime Commissions on Every Referral</h3>
            </div>
        </div>
        <div class="row py-5">
            <h2 class="accent text-center mb-5">Commission Structure</h2>
            <div class="col-md-4 mt-3">
                <div class="card pricing-card">
                    <div class="card-body text-center">
                        <h4 class="accent">Navigator</h4>
                        <h2>$9/mo</h2>
                        <h5>$2.25 per referral</h5>
                        <p>25% recurring commission</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card pricing-card">
                    <div class="card-body text-center">
                        <h4 class="accent">Pathfinder</h4>
                        <h2>$39/mo</h2>
                        <h5>$11.7 per referral</h5>
                        <p>30% recurring commission</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card pricing-card">
                    <div class="card-body text-center">
                        <h4 class="accent">Horizon</h4>
                        <h2>$149/mo</h2>
                        <h5>$74.5 per referral</h5>
                        <p>50% recurring commission</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Program Terms -->
        <div class="row py-5">
            <h2 class="accent text-center mb-5">Program Terms</h2>
            <div class="col">
                <div class="card p-3">
                    <div class="card-body">
                        <ul>
                            <li class="h5">Only approved ambassadors with an active account and valid referral link may participate.</li>
                            <li class="h5">All referrals are tracked using your unique ambassador code. It is your responsibility to share your personal link accurately.</li>
                            <li class="h5">Commissions are calculated on a monthly basis based on verified subscription payments. Payment is made via our chosen payout method.</li>
                            <li class="h5">Ambassadors must adhere to our branding guidelines and ethical promotion practices. Any fraudulent activity will result in immediate termination.</li>
                            <li class="h5">This Ambassador Program is operated solely by the PulseTracker creator as an individual developer, not a legal entity. All decisions regarding program structure, payouts, and participation are made at the sole discretion of the program operator.</li>
                            <li class="h5">This Ambassador Program is managed solely by an individual without a formal legal entity. There is no warranty or guarantee regarding the continuity, availability, or future evolution of the program. Participation is voluntary and at your own risk.</li>
                            <li class="h5">Ambassadors are not employees, agents, or legal partners of PulseTracker. You're responsible for: 
                                <ul>
                                    <li class="h5">Your own marketing costs</li>
                                    <li class="h5">Tax compliance in your jurisdiction</li>
                                    <li class="h5">Content legality in your region.</li>
                                </ul>
                            </li>
                            <li class="h5">You may promote competing products, but cannot: <ul> <li class="h5">Bundle PulseTracker with other offers without written approval</li> <li class="h5">Use 'official partnership' claims in marketing</li></ul></li>
                            <li class="h5">All commissions are gross payments. We do not: <ul> <li class="h5">Withhold taxes</li> <li class="h5">Provide 1099/W-8BEN forms </li> <li class="h5">Advise on tax obligations</li></ul></li>
                        </ul>
                        <div class="text-center mt-5">
                            <a href="https://forms.gle/5C83Vy68SHpB657L8" class="btn btn-success btn-lg">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
