@extends('dashboard.template')
@section('content')
    <div class="col m-5">
        <x-user-quota-detail-in-dashboard :user="$user" />
    </div>
@endsection
