@extends('template')
@section('title', 'Pulsetracker blog')
@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 mb-5">
                    <div class="card h-100 p-1 rounded" style="background-color: #1c1c1c;">
                        <img src="{{ $blog->cover }}" class="card-img-top rounded" style="height: 60%;" alt="{{ $blog->cover_alt }}">
                        <div class="card-body" style="height: 40%;">
                            <h5><a href="{{url('blog/'.$blog->slug)}}" class="card-title" style="text-decoration: none;">{{ $blog->title }}</a></h5>
                            <h6><small class="float-end">{{$blog->created_at->format("Y-m-d")}}</small></h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $blogs->links() }}
    </div>

    
@endsection
