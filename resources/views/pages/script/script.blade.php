<script>
    var compas = new RadialGauge({
        renderTo: 'compas',
        minValue: 0,
        height: 225,
        width: 175,
        maxValue: 360,
        majorTicks: [
            "N",
            "NE",
            "E",
            "SE",
            "S",
            "SW",
            "W",
            "NW",
            "N"
        ],
        minorTicks: 22,
        ticksAngle: 360,
        startAngle: 180,
        strokeTicks: false,
        highlights: false,
        colorPlate: "#000000",
        colorMajorTicks: "#9eabec",
        colorMinorTicks: "#ddd",
        colorNumbers: "#ccc",
        colorNeedle: "#121c47",
        colorNeedleEnd: "#9eabec",
        valueBox: false,
        valueTextShadow: false,
        colorCircleInner: "#fff",
        colorNeedleCircleOuter: "#ccc",
        needleCircleSize: 15,
        needleCircleOuter: false,
        animationRule: "linear",
        needleType: "arrow",
        needleStart: 30,
        needleEnd: 50,
        needleWidth: 3,
        borders: true,
        borderInnerWidth: 0,
        borderMiddleWidth: 0,
        borderOuterWidth: 10,
        colorBorderOuter: "#ccc",
        colorBorderOuterEnd: "#ccc",
        colorNeedleShadowDown: "#222",
        borderShadowWidth: 0,
        animationTarget: "plate",
        animationDuration: 1500,
        value: 0,
        animateOnInit: true
    }).draw();
    var acl = new RadialGauge({
        renderTo: 'acl',
        minValue: 0,
        maxValue: 8,
        height: 225,
        width: 175,
        majorTicks: [
            "3",
            "4",
            "5",
            "-2",
            "-1",
            "0",
            "1",
            "2",
            "3"
        ],
        minorTicks: 5,
        ticksAngle: 360,
        startAngle: 180,
        strokeTicks: false,
        highlights: false,
        colorPlate: "#000000",
        colorMajorTicks: "#f5f5f5",
        colorMinorTicks: "#ddd",
        colorNumbers: "#ccc",
        colorNeedle: "#121c47",
        colorNeedleEnd: "#9eabec",
        valueBox: false,
        valueTextShadow: false,
        colorCircleInner: "#fff",
        colorNeedleCircleOuter: "#ccc",
        needleCircleSize: 15,
        needleCircleOuter: false,
        animationRule: "linear",
        needleType: "arrow",
        needleStart: 30,
        needleEnd: 50,
        needleWidth: 3,
        borders: true,
        borderInnerWidth: 0,
        borderMiddleWidth: 0,
        borderOuterWidth: 10,
        colorBorderOuter: "#ccc",
        colorBorderOuterEnd: "#ccc",
        colorNeedleShadowDown: "#222",
        borderShadowWidth: 0,
        animationDuration: 1500,
        value: 0 + 5,
        animateOnInit: true
    }).draw();
    var altmeter = new LinearGauge({
        renderTo: 'altmeter',
        width: 125,
        minValue: 0,
        maxValue: 400,
        borders: false,
        majorTicks: [
            "0",
            "100",
            "200",
            "300",
            "400",
        ],
        colorPlate: '#000000',
        colorNumbers: "#FFFFFF",
        colorNeedle: "#9eabec",
        colorNeedleEnd: "#9eabec",
        height: 225,
    }).draw();
    var gauge = new RadialGauge({
        renderTo: 'speedo',
        width: 175,
        height: 225,
        units: "Km/h",
        minValue: 0,
        maxValue: 220,
        majorTicks: [
            "0",
            "20",
            "40",
            "60",
            "80",
            "100",
            "120",
            "140",
            "160",
            "180",
            "200",
            "220"
        ],
        minorTicks: 5,
        strokeTicks: true,
        colorPlate: "#000000",
        colorMajorTicks: "#FFFFFF",
        colorMinorTicks: "#FFFFFF",
        colorNumbers: "#FFFFFF",
        borderShadowWidth: 0,
        colorNeedle: "#121c47",
        colorNeedleEnd: "#9eabec",
        borders: false,
        needleType: "arrow",
        needleWidth: 4,
        needleCircleSize: 7,
        needleCircleOuter: true,
        needleCircleInner: false,
        animationDuration: 1500,
        animationRule: "dequint",
        animatedValue: true,
        animateOnInit: true
    }).draw();

    gauge.value = "{{ $latest->speed ?? 0 }}";
    altmeter.value = "{{ $latest->altitude ?? 0 }}";


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


    function ganti() {
        document.getElementById('header').classList.toggle('switch')
        if (document.getElementById('header').classList.contains('switch')) {
            document.getElementById('hasil').innerHTML = ({{ number_format($counted ?? 0, 3, '.', '.') }}) *
                1000 + " M";
        } else {
            document.getElementById('hasil').innerHTML = {{ number_format($counted ?? 0, 3, '.', '.') }} +
                " KM";
        }
    }

    function change() {
        document.getElementById('header').classList.toggle('switch')
        if (document.getElementById('header').classList.contains('switch')) {
            document.getElementById('haversine').innerHTML = ({{ number_format($starttoend ?? 0, 3, '.', '.') }}) *
                1000 + " M";
        } else {
            document.getElementById('haversine').innerHTML = {{ number_format($starttoend ?? 0, 3, '.', '.') }} +
                " KM";
        }
    }

    Echo.channel('Tracker').listen('Tracker', (res) => {
        gauge.value = res.data.speed;
        altmeter.value = res.data.altitude;
        attitude.updateRoll(res.data.g_roll);
        attitude.updatePitch(res.data.g_pitch)

        var x = new Date(res.data.created_at)
        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
        var DD = days[x.getDay()];
        var y = x.getFullYear();
        var m = ("00" + (x.getMonth() + 1)).slice(-2);
        var mm = monthNames[x.getMonth()];
        var d = ("00" + x.getDate()).slice(-2);
        var h = ("00" + x.getHours()).slice(-2);
        var i = ("00" + x.getMinutes()).slice(-2);
        var s = ("00" + x.getSeconds()).slice(-2);
        document.getElementById('waktu_akhir').innerHTML = DD + ", " + d + " " + mm + " " + y + " " + h + ":" +
            i + ":" + s;

        let startsecond = Date.parse("{{ $waktustart->created_at ?? 0 }}") / 1000;
        let endsecond = Date.parse(res.data.created_at) / 1000;
        var waktu = endsecond - startsecond;
        if (waktu >= 60) {
            document.getElementById('waktu').innerHTML = (waktu / 60).toFixed(2) + " Menit";
        } else if (waktu >= 3600) {
            document.getElementById('waktu').innerHTML = (waktu / 3600).toFixed(2) + " Jam";
        } else {
            document.getElementById('waktu').innerHTML = waktu.toFixed(2) + " Detik";
        }

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

        const R = 6371;
        const φ1 = {{ $oldest->latitude ?? 0 }} * Math.PI / 180;
        const φ2 = res.data.latitude * Math.PI / 180;
        const Δφ = (res.data.latitude - {{ $oldest->latitude ?? 0 }}) * Math.PI / 180;
        const Δλ = (res.data.longitude - {{ $oldest->longitude ?? 0 }}) * Math.PI / 180;

        const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
            Math.cos(φ1) * Math.cos(φ2) *
            Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        const starttoend = R * c;

        document.getElementById('haversine').innerHTML = starttoend.toFixed(3) + " KM";
        document.getElementById('hasil').innerHTML = (res.data.haversine + {{ $counted ?? 0 }}).toFixed(3) +
            " KM";
        document.getElementById('latend').innerHTML = res.data.latitude;
        console.log(res.data.latitude);
        document.getElementById('lngend').innerHTML = res.data.longitude;
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
        console.log('null')
    @endif
    @isset($oldest)
        marker = new L.Marker(new L.latLng([{{ $oldest->latitude }},
            {{ $oldest->longitude }}
        ]), {
            title: 'Start Point',
            icon: startPoint
        });
        var markersLayer = new L.LayerGroup();
        map.addLayer(markersLayer);
        markersLayer.addLayer(marker);
    @endisset
</script>
