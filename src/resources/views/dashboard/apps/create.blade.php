@extends('dashboard.template')
@section('content')
    <div class="col m-5">
        <h3>Create new App:</h3>
        <form class="mt-5" method="POST" action="{{ url('dashboard/apps/create') }}">
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
                <label for="exampleInputEmail1" class="form-label">App name</label>
                <input name="name" placeholder="My company tracker" required type="string" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-success float-end @cannot('create', App\Models\App::class) disabled @endif">Create</button>
        </form>
    </div>
@endsection
