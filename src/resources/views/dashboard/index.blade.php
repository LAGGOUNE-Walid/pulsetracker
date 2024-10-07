@extends('dashboard.template')
@section('content')
    <div class="col m-5">
        <div class="p-5 mt-5" style="border: 1px solid #737272; border-radius: 10px;">
            <h3>Usage: &nbsp; <a class="btn btn-outline-success" role="button" style="color: white;"
                    href="{{url('/#pricing')}}">Upgrade your account</a></h3>
            <div class="mt-5">
                <div class="row gy-5">
                    <div class="col col-6">
                        Current plan
                    </div>
                    <div class="col col-6">
                        <b>
                            @if ($user->subscribed('pro'))
                                PRO
                                <?php $plan = config('paddle-subscriptions.plans.pro'); ?>
                            @elseif($user->subscribed('enterprise'))
                                ENTERPRISE
                                <?php $plan = config('paddle-subscriptions.plans.enterprise'); ?>
                            @else
                                FREE
                                <?php $plan = config('paddle-subscriptions.plans.free'); ?>
                            @endif
                        </b>
                    </div>
                    <div class="col col-6">
                        Applications {{ $user->apps_count }}/{{ $plan['size']['apps'] ?? 'UNLIMITED' }}
                    </div>
                    <div class="col col-6">
                        <div class="progress">
                            @php
                                if ($plan['size']['apps']) {
                                    $plansPercentage = ($user->apps_count / $plan['size']['apps']) * 100;
                                } else {
                                    $plansPercentage = 0;
                                }

                            @endphp
                            <div class="progress-bar" role="progressbar" style="width: {{ $plansPercentage }}%"
                                aria-valuenow="{{ $plansPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col col-6">
                        Devices {{ $user->devices_count }}/{{ $plan['size']['devices'] ?? 'UNLIMITED' }}
                    </div>
                    <div class="col col-6">
                        <div class="progress">
                            @php
                                if ($plan['size']['devices']) {
                                    $devicesPercentage = ($user->devices_count / $plan['size']['devices']) * 100;
                                } else {
                                    $devicesPercentage = 0;
                                }
                            @endphp
                            <div class="progress-bar" role="progressbar" style="width: {{ $devicesPercentage }}%"
                                aria-valuenow="{{ $devicesPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col col-6">
                        Messages this month
                        {{ number_format($user->currentUsage->messages_sent ?? 0) }}/{{ $plan['size']['messages_per_month'] ? number_format($plan['size']['messages_per_month']) : 'UNLIMITED' }}
                    </div>
                    <div class="col col-6">
                        <div class="progress">
                            @php
                                if (
                                    $plan['size']['messages_per_month'] and
                                    $user->currentUsage->messages_sent
                                ) {
                                    $messagesPercentage =
                                        ($user->locationsCounts->first()->messages_sent /
                                            $plan['size']['messages_per_month']) *
                                        100;
                                } else {
                                    $messagesPercentage = 0;
                                }
                            @endphp
                            <div class="progress-bar" role="progressbar" style="width: {{ $messagesPercentage }}%"
                                aria-valuenow="{{ $messagesPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
