// -21.208312, 46.262851

function createMap(elemId, centerLat, centerLng, zoom) {
    var map = new L.Map(elemId);

    // Data provider
    var osmUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    var osmAttrib = 'Map data � <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';

    // Layer
    var osmLayer = new L.TileLayer(osmUrl, {
        minZoom: 4,
        maxZoom: 20,
        attribution: osmAttrib
    });

    // Map
    map.setView(new L.LatLng(centerLat, centerLng), zoom);
    map.addLayer(osmLayer);
    return map;
}

function addMarker(map, latLng, onClick) {
    var marker = L.marker(latLng).addTo(map);
    if (onClick !== null) {
        marker.on('click', onClick);
    }
    return marker;
}

markersLatLng = [
    [22.3417389, 91.8355561]
];

document.addEventListener("DOMContentLoaded", function () {

    var markerInfos = document.getElementById("markerInfos");
    var map = createMap('map', 22.3417389, 91.8355561, 17);

    function onMarkerClick(e) {
        markerInfos.textContent = "Marker at " + e.latlng.toString() + " clicked!";
    }

    markersLatLng.forEach(function(latLng) {
        addMarker(map, latLng, onMarkerClick);
    });

    var popup = L.popup();
    map.on('click', function (e) {
        popup.setLatLng(e.latlng)
             .setContent("What's here: " + e.latlng.toString())
             .openOn(map);
    });

});