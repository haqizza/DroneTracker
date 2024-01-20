<script>
    var map = new L.Map('map', {
        zoom: 12,
        center: new L.latLng(-6.967512300523178, 107.65906856904034)
    });
    map.invalidateSize()
    map.addLayer(new L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        minZoom: 4,
        noWrap: true,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    }));

    var DroneIcon = L.Icon.extend({
        options: {
            iconUrl: "{{ asset('images/drone.png') }}",
            iconSize:     [30, 30]
        }
    });

    var droneIcon = new DroneIcon()

    var points = [
        @foreach ($logs as $log)
            [{{ $log->latitude }}, {{ $log->longitude }}],
        @endforeach
    ]

    var polyline = L.polyline([
		// [-7.141026, 107.514130],
        // [-7.140985, 107.514186],
        // [-7.140971, 107.514278],
        // [-7.141054, 107.514315],
        // [-7.141224, 107.514382],
        // [-7.141462, 107.514367],
        // [-7.141425, 107.514324],
        // [-7.141329, 107.514261],
        // [-7.141320, 107.514323],
        // [-7.141029, 107.514298],
        // [-7.141052, 107.514202],
        // [-7.141018, 107.514147],
        // [-7.141568, 107.514267],
        // [-7.141788, 107.514460],
        // [-7.141715, 107.514494],
        ...points
	], {color: 'red'}).addTo(map)


    @isset($latest)
    L.marker(
        [{{ $latest->latitude }}, {{ $latest->longitude }}]
    ,{ icon: droneIcon}).addTo(map);
    @endisset

    L.circle([points[0][0], points[0][1]], {radius: 0.5, color: 'green'}).addTo(map);


    map.fitBounds(polyline.getBounds());

    //travel distance
    var travelDistance = 0

    for (let i = 0; i < points.length - 1;i++) {
        travelDistance += map.distance(
            L.latLng(points[i][0], points[i][1]),
            L.latLng(points[i + 1][0], points[i + 1][1])
        )
    }

    document.getElementById('travelDistance').innerText = travelDistance.toFixed(4) + ' Meter'
</script>
