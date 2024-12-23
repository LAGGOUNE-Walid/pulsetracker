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
        
        <x-user-quota-detail-in-dashboard :user="$user" />
    </div>
@endsection
