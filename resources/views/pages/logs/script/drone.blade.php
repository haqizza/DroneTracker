<script>
    var map = new L.Map('map', {
        zoom: 8,
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
    var startPoint = new droneIcon({
        iconUrl: '/images/start.svg'
    });
    var droneBlackIcon = new droneIcon({
        iconUrl: '/images/drone.png'
    });
    $(document).ready(function() {
        $('#drone').on('change', function() {
            var drone = $(this).val()
            if (drone) {
                $.ajax({
                    url: '/logs/drone/' + drone,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        if (res) {
                            $('#code').empty()
                            $.each(res.code, function(key, index) {
                                $('select[name="code"]').append('<option value="' +
                                    index.id + '">' + index.id + '</option>')
                            })
                            $('#logDrone').addClass('lebaran')
                            $('#droneimg').html('<img src="' + res.drone.image +
                                '" id="gambarDrone"/>')
                            $('#gambarDrone').animate({
                                width: '+=95%'
                            }, 200)

                            $('#code').on('change', function() {
                                var code = $(this).val()
                                let tanggal = []
                                let total_haversine = []
                                let koordinat = []
                                if (code) {
                                    $.ajax({
                                        url: '/logs/drone/flight/' + drone +
                                            '/' + code,
                                        type: 'GET',
                                        dataType: 'json',
                                        success: function(res) {
                                            if (res) {
                                                $.each(res, function(k,
                                                    i) {
                                                    tanggal
                                                        .push(i
                                                            .created_at
                                                        )
                                                    total_haversine
                                                        .push(i
                                                            .total_haversine
                                                        )
                                                    koordinat
                                                        .push([i.latitude,
                                                            i
                                                            .longitude
                                                        ])
                                                })
                                                $('#first_flight_time')
                                                    .html(new Date(
                                                            `${tanggal[0]}`
                                                        )
                                                        .toLocaleString(
                                                            'sv'))
                                                $('#last_flight_time')
                                                    .html(new Date(
                                                            `${tanggal.at(-1)}`
                                                        )
                                                        .toLocaleString(
                                                            'sv'))
                                                $('#total_haversine')
                                                    .html((total_haversine
                                                            .at(-1))
                                                        .toFixed(3) +
                                                        ' KM')
                                                if (koordinat.length >
                                                    1) {
                                                    marker = new L
                                                        .Marker(new L
                                                            .latLng(
                                                                koordinat[
                                                                    0]
                                                            ), {
                                                                title: 'Start Point',
                                                                icon: startPoint
                                                            });
                                                    var markersLayer =
                                                        new L
                                                        .LayerGroup();
                                                    map.addLayer(
                                                        markersLayer
                                                    );
                                                    markersLayer
                                                        .addLayer(
                                                            marker);
                                                    end = new L.Marker(
                                                        new L
                                                        .latLng(
                                                            koordinat
                                                            .at(-1)
                                                        ), {
                                                            icon: droneBlackIcon,
                                                            title: drone +
                                                                " Drone"
                                                        });
                                                    var endlayer = new L
                                                        .LayerGroup();
                                                    map.addLayer(
                                                        endlayer);
                                                    endlayer.addLayer(
                                                        end);
                                                    var polyline = L
                                                        .polyline(
                                                            koordinat, {
                                                                color: 'blue'
                                                            }).addTo(
                                                            map);
                                                    map.fitBounds(
                                                        polyline
                                                        .getBounds()
                                                    );
                                                    map.invalidateSize()
                                                }
                                            }
                                        }
                                    })
                                }
                            })
                        } else {
                            $('#code').empty()
                        }
                    }
                })
            } else {
                $('#code').empty()
            }
        })
    })
</script>
