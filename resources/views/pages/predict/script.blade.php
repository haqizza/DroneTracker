<script>
    var map = new L.Map('map', {
        zoom: 12,
    //     center: new L.latLng(-6.967512300523178, 107.65906856904034)
    });
    map.invalidateSize()
    map.addLayer(new L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        minZoom: 4,
        noWrap: true,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    }));



    //vertex distances
    var points = [
        @foreach ($logs as $log)
            [{{ $log->latitude }}, {{ $log->longitude }}],
        @endforeach
    ]

    var vertexDistances = []

    let distMax = 0
    let distMin = 9999

    for (let i = 0; i < points.length; i++) {
        vertexDistances.push([])
        for (let j = 0; j < points.length; j++) {
            let dist = 0

            if (i == j) {
                vertexDistances[i].push(dist)
            }
            else {
                dist = map.distance(
                    L.latLng(points[i][0], points[i][1]),
                    L.latLng(points[j][0], points[j][1])
                )

                if (dist > distMax) {
                    distMax = dist
                }
                if (dist < distMin) {
                    distMin = dist
                }
                vertexDistances[i].push(dist)
            }
        }
    }
    // console.log('vd',vertexDistances)


    let edgeWeight = []

    for (let i = 0; i < vertexDistances.length; i++) {
        edgeWeight.push([])
        for (let j = 0; j < vertexDistances.length; j++) {
            let weight = 0
            if (i !== j) {
                weight = (vertexDistances[i][j] - distMin) / (distMax - distMin) //minmax
            }
            edgeWeight[i].push(weight)
        }
    }
    // console.log('e', edgeWeight)

    //pixel numbers
    var pixelNumbers = [
        @foreach ($logs as $log)
            {{ $log->pixel_number }},
        @endforeach
    ]

    let vertexWeight = []
    let pixMax = Math.max(...pixelNumbers)
    let pixMin = Math.min(...pixelNumbers)

    for (let i = 0; i < pixelNumbers.length; i++) {
        let weight = (pixMax - pixelNumbers[i]) / (pixMax - pixMin) //inverse minmax

        vertexWeight.push(weight)
    }
    // console.log('e',vertexWeight)

    // greedy TSP

    var n = 28
    var shortest = []
    var paths = []
    var cost = 0

    var visited = []
    for(let i = 0; i < n; i++) {
        visited.push(0)
    }

    function travellingsalesmanGreedy(point){
        var k
        var adj_vertex = 99
        var min = 99

        /* marking the vertices visited in an assigned array */
        visited[point] = 1;

        /* displaying the shortest path */
        // console.log(point);
        shortest.push(point);
        console.log(point, cost, shortest)

        /* checking the minimum cost edge in the graph */
        for(k = 0; k < n; k++) {
            if((vertexDistances[point][k] != 0) && (visited[k] == 0)) {
                let count_w = (edgeWeight[point][k] + vertexWeight[k]) / 2;
                // console.log("-%f ", count_w);
                if(count_w < min) {
                    min = count_w;
                    adj_vertex = k;
                }
            }
        }
        // console.log("\n");

        if(min != 99) {
            cost = cost + min;
        }
        if(adj_vertex == 99) {
            return;
        }
        // console.log(cost)
        travellingsalesmanGreedy(adj_vertex);
    }

    let maxPixel = 0
    let maxPixelIndex = 0
    pixelNumbers.forEach((num, i) => {
        if (num > maxPixel) {
            maxPixel = num
            maxPixelIndex = i
        }
    })

    travellingsalesmanGreedy(maxPixelIndex)

    // console.log('length', points.length)
    console.log('cost', cost)

//===========================
    //TSP Brute force
    // let routes = []
    // console.log(edgeWeight)
    // let bestRoute = []
    // let bestRouteWeight = 9999

    function travellingsalesmanBruteForce(point, path, cost) {
        // Add way point
        // path.append(node)
        path.push(point)

        // Calculate path length from current to last node
        if (path.length > 1) {
            // distance += cities[path[-2]][node]
            // console.log('qwe', edgeWeight[path.length - 1][point])
            cost += (0.5 * edgeWeight[path[path.length - 1]][point]) + (0.5 * vertexWeight[point])
        }


        // If path contains all cities and is not a dead end,
        // add path from last to first city and return.
        if (n === path.length) {
            // path.append(path[0])
            // distance += cities[path[-2]][path[0]]

            // routes.append([distance, path])
            // console.log(cost, path)
            routes.push([cost, path])
            if (cost < bestRouteWeight) {
                bestRoute = path
                bestRouteWeight = cost
            }

            return
        }
        // console.log('123', point, n === path.length)
        // Fork paths for all possible cities not yet used
        // for city in cities:
        //     if (city not in path) and (node in cities[city]):
        //         find_paths(city, dict(cities), list(path), distance)
        for (let i = 0; i < n; i++) {
            // console.log('i', point, i, path)
            if (!path.includes(i)){
                travellingsalesmanBruteForce(i, [...path], cost)
            }
        }
    }


    // travellingsalesmanBruteForce(maxPixelIndex, [], 0)

    // console.log("Routes:", routes)

    // let minCost = 9999
    // routes.forEach((route) => {
    //     if(route[0] < minCost) {
    //         shortest = route[1]
    //     }
    // })
    // console.log("Shortest route:", minCost, shortest)


    let shortestPathPoints = []
    let distanceInMeter = 0
    // console.log(shortest)
    shortest.forEach(value => {
        shortestPathPoints.push(points[value])
        distanceInMeter += parseInt(vertexDistances[value])
    })


    console.log(shortestPathPoints)
    console.log(distanceInMeter)


    // draw line
    var polyline = L.polyline(shortestPathPoints, {smoothFactor: 1, color: 'red', weight: 1}).addTo(map)

    shortestPathPoints.forEach(value => {
        L.circle(value, {radius: 0.2, color: 'grey'}).addTo(map);
    })

    L.circle([shortestPathPoints[0][0], shortestPathPoints[0][1]], {radius: 0.5, color: 'green'}).addTo(map);
    L.circle([shortestPathPoints[shortestPathPoints.length - 1][0], shortestPathPoints[shortestPathPoints.length - 1][1]], {radius: 0.5}).addTo(map);


    map.fitBounds(polyline.getBounds());

</script>

<!-- [ 8, 10, 9, 11, 12, 7, 6, 5, 4, 3, 2, 1, 0, 16, 15, 14, 13] -->

<!--
0.20187322951327957
0.4781732483489402
0.9601886981111514
1.4334671804291081
2.0008576639817344
2.4356173183458347
2.940858224949572
3.428118110798593
3.9177169540968344
4.41202307145619
4.91202307145619
5.401818437241641
5.838390670336713
6.2747557688017785
6.699619421395933
7.23005061494805
-->
