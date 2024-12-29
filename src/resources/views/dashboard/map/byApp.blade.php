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
    <div class="col mt-5" x-data="map()" x-init="initMap({{ Js::from($devices) }})">
        <div id="map"></div>
    </div>
@endsection
@push('scripts')
    <script>
        function map() {
            return {
                map: null,
                devices: {},
                divCircle: L.divIcon({
                    className: 'circle'
                }),
                initMap(devices) {
                    var randomFirstLocation = null;
                    _.each(devices, (device) => {
                        randomFirstLocation = device.location;
                    });
                    if (randomFirstLocation) {
                        this.map = L.map('map').setView([randomFirstLocation.coordinates[1], randomFirstLocation
                            .coordinates[0]
                        ], 12);
                    } else {
                        this.map = L.map('map').setView([0, 0], 3);
                    }
                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            minZoom: 0,
                            maxZoom: 20,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                            ext: 'png'
                        }).addTo(this.map);
                    this.addLastDevices(this.map, devices);
                    this.listenForWebsocketsLocationsUpdates();
                },
                addLastDevices(map, devices) {
                    _.each(devices, (device) => {
                        this.addDevice(device);
                    });
                },
                addDevice(device) {
                    var div_circle = this.divCircle;
                    var marker;
                    L.geoJSON(device.location, {
                        pointToLayer: function(feature, latlng) {
                            marker = L.marker(latlng, {
                                icon: div_circle
                            });
                            marker.bindPopup(`${device.name}`);

                            return marker;
                        }
                    }).addTo(this.map);
                    {{-- marker.openPopup(); --}}
                    this.devices[device.key] = {
                        data: device,
                        marker: marker
                    };
                },
                listenForWebsocketsLocationsUpdates() {
                    Echo.private('apps.{{ $app->key }}').listen('DeviceLocationUpdated', (device) => {
                        if (_.has(this.devices, device.key)) {
                            this.moveMarker(this.map, this.devices[device.key]['marker'], device)
                        } else {
                            this.addDevice(device);
                        }
                    })
                },
                moveMarker(map, marker, device) {
                    var newCoordinates = device.location.coordinates;
                    var latlng = L.latLng(newCoordinates[1], newCoordinates[0]);
                    marker.setLatLng(latlng);
                }
            }

        }
    </script>
@endpush
