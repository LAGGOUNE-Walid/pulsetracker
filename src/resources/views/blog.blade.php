@extends('template')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <img src="{{ $blog->cover }}" class="card-img-top" alt="{{ $blog->cover_alt }}">
                <br/>
                <br/>
                {!! \Str::markdown($blog->content); !!}
                <br/>
                <small class="float-end">{{$blog->created_at}}</small>
            </div>
        </div>
    </div>
@endsection
