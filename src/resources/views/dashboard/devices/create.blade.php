@extends('dashboard.template')
@section('content')
    <div class="col m-5">
        <h3>Add new device:</h3>
        <form class="mt-5" method="POST" action="{{ url('dashboard/devices/create') }}">
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
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Device name</label>
                <input name="name" placeholder="My drone" required type="string" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Device type</label>
                <select name="device_type" class="form-select" aria-label="Default select example">
                    @foreach ($deviceTypes as $deviceType)
                        <option value="{{ $deviceType->id }}">{{ $deviceType->name }} </option>
                    @endforeach
                    <option value="-1">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">App ID</label>
                <select name="app_id" class="form-select" aria-label="Default select example">
                    @foreach ($apps as $app)
                        <option value="{{ $app->id }}">{{ $app->name }} {{$app->key}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
                class="btn btn-success float-end @cannot('create', App\Models\Device::class) disabled @endif">Create</button>
        </form>
    </div>
@endsection
