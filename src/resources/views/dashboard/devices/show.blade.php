@extends('dashboard.template')
@section('content')
    <div class="col m-5">
        <h3>Device {{ $device->name }}:</h3>
        <div class=" mt-5">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">App</th>
                        <th scope="col">Key</th>
                        <th scope="col">Type</th>
                        <th scope="col">Total messages</th>
                        <th scope="col">History</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            {{ $device->app->name }}
                        </th>
                        <td>
                            {{ $device->app->key }}
                        </td>
                        <td>
                            {{ $device->deviceType->name }}
                        </td>
                        <td>
                            {{ $device->locationsCounts->sum('messages_sent') }}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Date
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach($device->locations as $dateLocations)
                                        <li><a class="dropdown-item" href="{{url('dashboard/devices/'.$device->key."/$dateLocations->date")}}">{{$dateLocations->date}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
