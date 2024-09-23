@extends('dashboard.template')
@section('content')
    <div class="col mt-5">
        <center>
            <div class="dropdown dropdown-center">
                <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Choose app to view
                </button>
                <ul class="dropdown-menu">
                    @foreach($apps as $app)
                    <li><a class="dropdown-item" href="{{url('dashboard/map/'.$app->key)}}">{{$app->name}} / {{$app->key}}</a></li>
                    @endforeach
                </ul>
            </div>
        </center>
    </div>
@endsection
