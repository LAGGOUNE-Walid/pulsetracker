<div>
    <h3>My apps: <a href="{{ url('dashboard/apps/create') }}"
            class="btn btn-success float-end @cannot('create', App\Models\App::class) disabled @endif">Create new app @cannot('create', App\Models\App::class) <br/><small>Upgrade your account </small> @endif</a>
            </h3>
    <div class="mt-5
                table-responsive" x-data="apps">
                <div class="mb-3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Search by name"
                        wire:model.live.debounce.250ms="search">
                </div>

                <table class="table table-bordered rounded text-center">
                    <thead>
                        <tr>
                            <th scope="col">App ID</th>
                            <th scope="col">App name</th>
                            <th scope="col">Number of devices</th>
                            <th scope="col">Total messages this month</th>
                            <th scope="col">Visualize</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apps as $app)
                            <tr>
                                <th scope="row">{{ $app->key }}</th>
                                <th scope="row">{{ $app->name }}</th>
                                <td>{{$app->devices_count}}</td>
                                <td>{{$app->locationsCounts?->first()?->messages_sent ?? 0}}</td>
                                <td><a href="{{ url('dashboard/map/'.$app->key) }}">Show devices in map</a></td>
                                <td>
                                    <a href="{{ url('dashboard/devices?app='.$app->key) }}" class="btn btn-primary">Show devices</a>
                                    <button x-on:click="deleteApp({{ $app->id }})"
                                        class="btn btn-danger mx-3">Delete</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $apps->links() }}
    </div>
</div>
@push('scripts')
    <script>
        function apps() {
            return {
                deleteApp(id) {
                    Swal.fire({
                        title: "Do you want to delete app?",
                        showCancelButton: true,
                        confirmButtonText: "Yes delete it",
                        customClass: {
                            confirmButton: "btn btn-danger",
                            cancelButton: "btn btn-primary",
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.deleteApp(id)
                        }
                    });
                }
            }
        }
    </script>
@endpush
