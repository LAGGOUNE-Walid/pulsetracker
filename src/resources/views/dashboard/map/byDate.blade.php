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
    <div class="col mt-5" x-data="map()" x-init="initMap({{ Js::from($locations) }})">
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
                initMap(locations) {
                    var randomFirstLocation = null;
                    _.each(locations, (location) => {
                        randomFirstLocation = location;
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
                    var markersClusters = L.markerClusterGroup();
                    this.addDeviceLocations(this.map, locations, markersClusters);
                    this.listenForWebsocketsLocationsUpdates();
                },
                addDeviceLocations(map, locations, markersClusters) {
                    _.each(locations, (location) => {
                        var marker = this.addLocation(location);
                        markersClusters.addLayer(marker);
                    });
                    this.map.addLayer(markersClusters)
                },
                addLocation(location) {
                    var div_circle = this.divCircle;
                    var marker;
                    return L.geoJSON(location, {
                        pointToLayer: function(feature, latlng) {
                            marker = L.marker(latlng, {
                                icon: div_circle
                            });
                            return marker;
                        }
                    });
                },
                listenForWebsocketsLocationsUpdates() {
                    {{-- Echo.private('apps.{{ $app->key }}').listen('DeviceLocationUpdated', (device) => {
                        if (_.has(this.devices, device.deviceKey)) {
                            this.moveMarker(this.map, this.devices[device.deviceKey]['marker'], device)
                        } else {
                            this.addDevice(device);
                        }
                    }) --}}
                },
                moveMarker(map, marker, device) {
                    var newCoordinates = device.point.coordinates;
                    var latlng = L.latLng(newCoordinates[1], newCoordinates[0]);
                    marker.setLatLng(latlng);
                }
            }

        }
    </script>
@endpush
