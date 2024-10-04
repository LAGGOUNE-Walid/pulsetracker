@extends('dashboard.template')
@section('content')
    <div class="col m-5">
        <h3>Settings:</h3>
        <form method="POST" action="{{ url('dashboard/settings/update') }}">

            @csrf
            <div class="form-group mt-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter email" value="{{ $user->email }}"
                    style="background: #16171C;border-style: solid;border-color: var(--bs-light);font-size: 24px;color: var(--bs-body-color);">
            </div>
            <div class="form-group mt-3">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>
            <br />
            <button type="submit" class="btn btn-primary float-end">Save modifications</button>
        </form>
        <br />
        <h3 class="mt-5">Your tokens</h3>
        <form action="{{ url('dashboard/settings/create-token') }}" method="POST">
            <div class="input-group mb-3">

                @csrf
                <label class="input-group-text" style="border: 1px solid white; color: white;"
                    for="inputGroupSelect01">Create new one</label>
                <input type="text" class="form-control" name="name" placeholder="Token name" aria-label="Token name"
                    aria-describedby="button-addon2">
                <button class="btn btn-outline-success" type="submit" id="button-addon2">Create</button>

            </div>
        </form>
        @if (session('createdToken'))
            <div class="alert alert-success" role="alert">
                Here is your token. Please store it securely. <b>{{ session('createdToken') }}</b>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Last used at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($user->tokens as $token)
                    <tr>
                        <th scope="row">{{ $token->name }}</th>
                        <td>{{ $token->created_at }}</td>
                        <td>{{ $token->last_used_at }}</td>
                        <td>
                            <form method="POST" action={{ url('dashboard/settings/delete-token') }}>
                                @csrf
                                <input type="hidden" name="token_id" value={{ $token->id }}>
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-5 mt-5" style="border: 1px solid #737272; border-radius: 10px;">
            <h3>Usage: &nbsp; <a class="btn btn-outline-success" role="button" style="color: white;"
                    href="{{ url('/#pricing') }}">Upgrade your account</a></h3>
            <div class="mt-5">
                <div class="row gy-5">
                    <div class="col col-6">
                        Current plan
                    </div>
                    <div class="col col-6">
                        <b>
                            @if ($user->subscribed('enterprise'))
                                ENTERPRISE
                                <?php $plan = config('paddle-subscriptions.plans.enterprise'); ?>
                            @elseif($user->subscribed('pro'))
                                PRO
                                <?php $plan = config('paddle-subscriptions.plans.pro'); ?>
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
                        {{ number_format($user->currentSubscription->messages_sent ?? 0) }}/{{ $plan['size']['messages_per_month'] ? number_format($plan['size']['messages_per_month']) : 'UNLIMITED' }}
                    </div>
                    <div class="col col-6">
                        <div class="progress">
                            @php
                                if (
                                    $plan['size']['messages_per_month'] and
                                    $user->currentSubscription->messages_sent
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
