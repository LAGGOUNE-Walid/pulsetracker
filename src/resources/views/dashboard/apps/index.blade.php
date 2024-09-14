@extends('dashboard.template')
@section('content')
    <div class="col m-5">
        <h3>My apps: <a href="{{url('dashboard/apps/create')}}" class="btn btn-success float-end @cannot('create', App\Models\App::class) disabled @endif">Create new app @cannot('create', App\Models\App::class) <br/><small>Upgrade your account </small> @endif</a></h3>
        <div class="table-responsive mt-5">
            <table class="table table-bordered rounded text-center">
                <thead>
                    <tr>
                        <th scope="col">App ID</th>
                        <th scope="col">Number of devices</th>
                        <th scope="col">Total messages this month</th>
                        <th scope="col">Visualize</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">c21e99ec-484e-49ba-8bf7-09b898eeb08f</th>
                        <td>20</td>
                        <td>300</td>
                        <td><a href="">Show devices in map</a></td>
                        <td>
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-danger">Update</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
