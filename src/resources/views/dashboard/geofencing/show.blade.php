@extends('dashboard.template')
@section('content')
    <style>
        .circle {
            background: #f22e2e;
            border-radius: 50%;
            /* see http://www.w3schools.com/css/css3_shadows.asp */
        }

        .leaflet-layer,
        .leaflet-control-zoom-in,
        .leaflet-control-zoom-out,
        .leaflet-control-attribution {
            filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
        }
    </style>
    <div class="col m-5">
        <h3>Add new geofence:</h3>
        <form class="mt-5" method="POST" action="{{ url('dashboard/geofencing/update') }}">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Geofence name</label>
                <input type="hidden" name="id" value="{{ $geofence->id }}">
                <input name="name" placeholder="Area name" required type="string" value="{{ $geofence->name }}"
                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">App ID</label>
                <select name="app_id" class="form-select" aria-label="Default select example">
                    @foreach ($apps as $app)
                        <option value="{{ $app->id }}" @if ($app->id === $geofence->app_id) selected @endif>
                            {{ $app->name }} {{ $app->key }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3" id="map">
            </div>
            <input type="hidden" name="geometry" id="geometry">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Webhook URL</label>
                <input name="webhook_url" placeholder="https://" value="{{ $geofence->webhook_url }}" type="url"
                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-success float-end">Update</button>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
    var polygonCoords = @json(json_decode($geofence->geometry->toJson(), true));
    var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        osm = L.tileLayer(osmUrl, {
            maxZoom: 18,
            attribution: osmAttrib
        }),
        map = new L.Map('map', {
            center: new L.LatLng(51.505, -0.04),
            zoom: 13
        }),
        drawnItems = L.featureGroup().addTo(map);

    // Add the existing polygon to the map and drawnItems
    var polygon = L.geoJSON(polygonCoords).addTo(drawnItems);
    map.fitBounds(polygon.getBounds());

    L.control.layers({
        'osm': osm.addTo(map),
    }, {
        'drawlayer': drawnItems
    }, {
        position: 'topleft',
        collapsed: false
    });

    var drawControl = new L.Control.Draw({
        edit: {
            featureGroup: drawnItems, // Allows editing of polygons in this group
            poly: {
                allowIntersection: true
            }
        },
        draw: {
            marker: false,
            polygon: {
                allowIntersection: true,
                showArea: true
            },
            polyline: false,
            rectangle: false,
            circle: false,
            circlemarker: false
        }
    });

    map.addControl(drawControl);

    map.on(L.Draw.Event.CREATED, function(event) {
        var layer = event.layer;
        drawnItems.addLayer(layer);
        document.getElementById('geometry').value = JSON.stringify(layer.toGeoJSON());
    });

    map.on(L.Draw.Event.EDITED, function(event) {
        var layers = event.layers;
        layers.eachLayer(function(layer) {
            document.getElementById('geometry').value = JSON.stringify(layer.toGeoJSON());
        });
    });

    map.on(L.Draw.Event.DELETED, function(event) {
        document.getElementById('geometry').value = '';
    });
</script>

@endpush
