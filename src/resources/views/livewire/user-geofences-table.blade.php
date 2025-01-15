<div>
    <h3>My geofences: <a href="{{ url('dashboard/geofencing/create') }}" class="btn btn-success float-end">Add new
            geofence</a>
    </h3>
    <div class="mt-5
            table-responsive" x-data="geofences">
        <div class="mb-3">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Search by name"
                wire:model.live.debounce.250ms="search">
        </div>

        <table class="table table-bordered rounded text-center">
            <thead>
                <tr>
                    <th scope="col">App name</th>
                    <th scope="col">Geofence name</th>
                    <th scope="col">Webhook URL</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($geofences as $geofence)
                    <tr>
                        <th scope="row">{{ $geofence->app->name }}</th>
                        <th scope="row">{{ $geofence->name }}</th>
                        <th scope="row">{{ $geofence->webhook_url }}</th>
                        <td>
                            <a class="btn btn-primary" href="{{ url('dashboard/geofencing/' . $geofence->id) }}">Preview</a>
                            <button x-on:click="deleteGeofence({{ $geofence->id }})"
                                class="btn btn-danger mx-3">Delete</button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $geofences->links() }}
    </div>
</div>
@push('scripts')
    <script>
        function geofences() {
            return {
                deleteGeofence(id) {
                    Swal.fire({
                        title: "Do you want to delete this geofence?",
                        showCancelButton: true,
                        confirmButtonText: "Yes delete it",
                        customClass: {
                            confirmButton: "btn btn-danger",
                            cancelButton: "btn btn-primary",
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.deleteGeofence(id)
                        }
                    });
                }
            }
        }
    </script>
@endpush
