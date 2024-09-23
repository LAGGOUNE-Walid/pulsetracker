<div>
    <h3>My devices: <a href="{{ url('dashboard/devices/create') }}"
            class="btn btn-success float-end @cannot('create', App\Models\Device::class) disabled @endif">Add new device
            @cannot('create', App\Models\Device::class) <br /><small>Upgrade your account </small> @endif</a>
    </h3>
    <div class="mt-5
            table-responsive" x-data="devices">
        <div class="mb-3">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Search by name"
                wire:model.live.debounce.250ms="search">
        </div>

        <table class="table table-bordered rounded text-center">
            <thead>
                <tr>
                    <th scope="col">App name</th>
                    <th scope="col">Device ID</th>
                    <th scope="col">Device name</th>
                    <th scope="col">Device type</th>
                    <th scope="col">Total messages this month</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($devices as $device)
                <tr>
                    <th scope="row">{{ $device->app->name }}</th>
                    <th scope="row">{{ $device->key }}</th>
                    <th scope="row">{{ $device->name }}</th>
                    <th scope="row">
                        @if ($device->deviceType)
                        <span class="badge text-bg-success">{{ $device->deviceType->name }} </span>
                        @else
                        <span class="badge text-bg-primary">Other</span>
                        @endif
                    </th>
                    <th scope="row">{{ $device->locationsCounts?->first()?->messages_sent ?? 0 }}
            </th>
            <td>
                <a class="btn
            btn-primary" href="{{ url('dashboard/devices/' . $device->key) }}">Detail</a>
                <button x-on:click="deleteDevice({{ $device->id }})" class="btn btn-danger mx-3">Delete</button>
            </td>
            </tr>
            @endforeach

            </tbody>
            </table>
            {{ $devices->links() }}
</div>
</div>
@push('scripts')
    <script>
        function devices() {
            return {
                deleteDevice(id) {
                    Swal.fire({
                        title: "Do you want to delete device?",
                        showCancelButton: true,
                        confirmButtonText: "Yes delete it",
                        customClass: {
                            confirmButton: "btn btn-danger",
                            cancelButton: "btn btn-primary",
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.deleteDevice(id)
                        }
                    });
                }
            }
        }
    </script>
@endpush
