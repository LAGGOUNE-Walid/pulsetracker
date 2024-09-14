@extends('dashboard.template')
@section('content')
    <div class="col m-5">
        <h3>Settings:</h3>
        <form method="POST" action="{{url('dashboard/settings/update')}}">

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
                    placeholder="Enter email" value="{{ auth()->user()->email }}"
                    style="background: #16171C;border-style: solid;border-color: var(--bs-light);font-size: 24px;color: var(--bs-body-color);">
            </div>
            <div class="form-group mt-3">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <br />
            <button type="submit" class="btn btn-primary float-end">Save modifications</button>
        </form>
        <br />
        <div class="p-5 mt-5" style="border: 1px solid #737272; border-radius: 10px;">
            <h3>Usage: &nbsp; <a class="btn btn-outline-success" role="button" style="color: white;"
                    href="http://localhost:83/#pricing">Upgrade your account</a></h3>
            <div class="mt-5">
                <div class="row gy-5">
                    <div class="col col-6">
                        Current plan
                    </div>
                    <div class="col col-6">
                        <b>
                            @if (auth()->user()->subscribed('pro'))
                                PRO
                            @elseif(auth()->user()->subscribed('enterprise'))
                                ENTERPRISE
                            @else
                                FREE
                            @endif
                        </b>
                    </div>
                    <div class="col col-6">
                        Applications 1/4
                    </div>
                    <div class="col col-6">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="10"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col col-6">
                        Dwevices 30/50
                    </div>
                    <div class="col col-6">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="70"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col col-6">
                        Messages 30/10000
                    </div>
                    <div class="col col-6">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
