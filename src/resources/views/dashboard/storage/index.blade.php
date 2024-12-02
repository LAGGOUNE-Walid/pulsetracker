@extends('dashboard.template')
@section('content')
    <div class="col m-5">
        <h3>Location Data Privacy Settings</h3>
        <form action="{{url('dashboard/storage/ldps')}}" method="POST" class="mt-5">
            @csrf
            <div class="alert alert-dark" role="alert">

                Enhance your privacy and flexibility with Pulsetracker's location data storage settings. Use this option to
                disable Pulsetracker from saving real-time location updates to our database. While disabled, you can still
                receive live updates by subscribing to our Redis server or Pusher channels—refer to the documentation for
                integration details.
                <br />
                <br />
                ⚠️ Note: Disabling data storage means the Devices Locations API will no longer provide up-to-date data, as
                Pulsetracker will not retain location records in its database.
                <div class="form-check form-switch mt-5">
                    <input class="form-check-input" name="save_locations_input" type="checkbox" role="switch"
                        id="flexSwitchCheckDefault" @if ($user->save_locations_enabled) checked @endif>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable or disable pulsestracker
                        storage</label>
                </div>
                <br />
                <button class="btn btn-success" type="submit">Save</button>
            </div>

        </form>
    </div>
@endsection
