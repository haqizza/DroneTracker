<script>
    document.querySelector('.toggle input').addEventListener('click', function() {
        document.querySelector('.nav').classList.toggle('expand');
    })

    var map = new L.Map('map', {
        zoom: 12,
        center: new L.latLng(-6.967512300523178, 107.65906856904034)
    });

    map.addLayer(new L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        minZoom: 4,
        noWrap: true,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    }));
    var droneIcon = L.Icon.extend({
        options: {
            iconSize: [30, 30],
        }
    });

    var droneBlackIcon = new droneIcon({
        iconUrl: '/images/drone.png'
    });
    var startPoint = new droneIcon({
        iconUrl: '/images/start.svg'
    });


    @isset($latest)
        end = new L.Marker(new L.latLng([{{ $latest->latitude }}, {{ $latest->longitude }}]), {
            icon: droneBlackIcon,
            title: "{{ $data->name }} Drone"
        });
        var endlayer = new L.LayerGroup();
        map.addLayer(endlayer);
        endlayer.addLayer(end);
    @endisset



    var array = [
        @foreach ($all as $item)
            [{{ $item->latitude }}, {{ $item->longitude }}],
        @endforeach
    ];


    function ganti() {
        document.getElementById('header').classList.toggle('switch')
        let jumlah = 0;
        array.forEach((item, index, arr) => {
            if (index == arr.length - 1) {
                return jumlah;
            }
            let asu = arr[index]
            let latlng2 = arr[index + 1]
            let latitude1 = asu[0]
            let latitude2 = latlng2[0]
            let longitude1 = asu[1]
            let longitude2 = latlng2[1]

            jumlah += Math.acos(Math.sin(latitude1 * (Math.PI / 180)) * Math.sin(latitude2 * (Math.PI /
                    180)) +
                Math.cos(latitude1 * (Math.PI / 180)) * Math.cos(latitude2 * (Math.PI / 180)) * Math
                .cos((
                    longitude1 * (Math.PI / 180)) - (longitude2 * (Math.PI / 180)))) * 6371;
            if (document.getElementById('header').classList.contains('switch')) {
                document.getElementById('hasil').innerHTML = jumlah.toFixed(3) * 1000 + " M";
            } else {
                document.getElementById('hasil').innerHTML = jumlah.toFixed(3) + " KM";
            }
        });

    }

    kalkulasi(array);

    function kalkulasi(arr) {
        let jumlah = 0;
        array.forEach((item, index, arr) => {
            if (index == arr.length - 1) {
                return jumlah;
            }
            let asu = arr[index]
            let latlng2 = arr[index + 1]
            let latitude1 = asu[0]
            let latitude2 = latlng2[0]
            let longitude1 = asu[1]
            let longitude2 = latlng2[1]

            jumlah += Math.acos(Math.sin(latitude1 * (Math.PI / 180)) * Math.sin(latitude2 * (Math.PI / 180)) +
                Math.cos(latitude1 * (Math.PI / 180)) * Math.cos(latitude2 * (Math.PI / 180)) * Math.cos((
                    longitude1 * (Math.PI / 180)) - (longitude2 * (Math.PI / 180)))) * 6371;
            if (document.getElementById('header').classList.contains('switch')) {
                document.getElementById('hasil').innerHTML = jumlah.toFixed(3) * 1000 + " KM";
            } else {
                document.getElementById('hasil').innerHTML = jumlah.toFixed(3) + " KM";
            }
        });
    }

    window.Echo.channel('Tracker').listen('Tracker', (res) => {
        document.getElementById('latend').innerHTML = res.data.latitude;
        document.getElementById('lngend').innerHTML = res.data.longitude;
        latlngs.push(
            [
                res.data.latitude, res.data.longitude
            ],
        );
        var polyline = L.polyline(latlngs, {
            color: 'blue'
        }).addTo(map);
        @if (isset($latest))
            end.setLatLng([res.data.latitude, res.data.longitude]);
        @else
            marker = new L.Marker(new L.latLng([res.data.latitude, res.data.longitude]), {
                title: 'Start Point',
                icon: startPoint
            });
            var markersLayer = new L.LayerGroup();
            map.addLayer(markersLayer);
            markersLayer.addLayer(marker);
            location.reload();
            console.log('success');
        @endif
        array.push(
            [res.data.latitude, res.data.longitude],
        )
        kalkulasi(array);

        function kalkulasi(arr) {
            let jumlah = 0;
            array.forEach((item, index, arr) => {
                if (index == arr.length - 1) {
                    return jumlah;
                }
                let asu = arr[index]
                let latlng2 = arr[index + 1]
                let latitude1 = asu[0]
                let latitude2 = latlng2[0]
                let longitude1 = asu[1]
                let longitude2 = latlng2[1]

                jumlah += Math.acos(Math.sin(latitude1 * (Math.PI / 180)) * Math.sin(latitude2 * (Math
                        .PI / 180)) +
                    Math.cos(latitude1 * (Math.PI / 180)) * Math.cos(latitude2 * (Math.PI / 180)) *
                    Math.cos((
                        longitude1 * (Math.PI / 180)) - (longitude2 * (Math.PI / 180)))) * 6371;

                if (document.getElementById('header').classList.contains('switch')) {
                    document.getElementById('hasil').innerHTML = jumlah.toFixed(3) * 1000 + " M";
                } else {
                    document.getElementById('hasil').innerHTML = jumlah.toFixed(3) + " KM";
                }
            });
        }
    });
    @if (isset($all))
        var latlngs = [
            @foreach ($all as $item)
                [
                    {{ $item->latitude }},
                    {{ $item->longitude }}
                ],
            @endforeach
        ];
        var polyline = L.polyline(latlngs, {
            color: 'blue'
        }).addTo(map);
        map.fitBounds(polyline.getBounds());
    @else
        console.log('gak ada')
    @endif

    marker = new L.Marker(new L.latLng([{{ $oldest->latitude ?? $data->latitude }},
        {{ $oldest->longitude ?? $data->latitude }}
    ]), {
        title: 'Start Point',
        icon: startPoint
    });
    var markersLayer = new L.LayerGroup();
    map.addLayer(markersLayer);
    markersLayer.addLayer(marker);
</script>
