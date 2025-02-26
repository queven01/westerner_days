// Gets map URL from ACF field 
var mapURL = document.getElementById('map_file').innerHTML;

//Start Map
var map = L.map('map').setView([52.2268371, -113.8054831], 16);

// L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', 
L.tileLayer('https://tile.openstreetmap.bzh/ca/{z}/{x}/{y}.png', {
    maxZoom: 18,
    minZoom: 16,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var geojsonFeature = mapURL;
var activeLayer;
var sidebarVisible = false;
let labelLayers = []; // Array to store tooltips so they can be hidden or shown

var jsonLayer = new L.geoJson( null, {
    style: function(feature) {
        return {
            color: "#24584b",
            weight: 2,
            opacity: 1
        };
    },
    onEachFeature: function(feature, layer) {
        if (feature.properties) {

            if (feature.properties.label) {      
                let tooltip = L.tooltip({
                    permanent: true,
                    direction: 'center',
                    className: 'geojson-label'
                }).setContent(feature.properties.label);
                if (map.getZoom() >= 17) {
                    layer.bindTooltip(tooltip);
                }
                // Store tooltip reference to toggle later
                labelLayers.push({ layer, tooltip });
            }

            layer.on('click', function(e) {
                // Stop propagation to prevent the map click event
                L.DomEvent.stopPropagation(e);

                // Reset the style of the previously active layer
                if (activeLayer) {
                    jsonLayer.resetStyle(activeLayer);
                }

                // Set the new active layer
                activeLayer = e.target;

                // Apply the active style
                activeLayer.setStyle({
                    color: '#2f85a1',
                    weight: 5,
                    opacity: 0.65
                });

                // Update the sidebar content
                var featureInfo = "";

                if (feature.properties.name || feature.properties.capacity || feature.properties.size) {
                    featureInfo += '<div class="feature_item">';
                    featureInfo += "<h3>" + feature.properties.name + "</h3>";  
                    if (feature.properties.capacity) { featureInfo += '<div class="info-line"><b>Capacity: </b><span>' + feature.properties.capacity + '</span></div>'; };  
                    if (feature.properties.size) { featureInfo += '<div class="info-line"><b>Size: </b><span>' + feature.properties.size + "</span></div>"; };  
                    if (feature.properties.ideal) { featureInfo += '<div class="info-line"><b>Ideal for: </b><span>' + feature.properties.ideal + "</span></div>"; };
                    featureInfo += '<div class="btn-container">';    
                    if (feature.properties.link) { featureInfo += '<a class="btn blue btn-small" href="'+ feature.properties.link +'">Learn More</a>'; };  
                    if (feature.properties.direction) { featureInfo += '<a class="btn blue btn-small" target="_blank" href="'+ feature.properties.direction +'">Directions</a>'; };  
                    featureInfo += '</div>';    
                    featureInfo += "</div>"; 
                }

                if (feature.properties.name2 || feature.properties.capacity2 || feature.properties.size2) {
                    featureInfo += '<div class="feature_item">';
                    featureInfo += "<h3>" + feature.properties.name2 + "</h3>";   
                    if (feature.properties.capacity2) { featureInfo += '<div class="info-line"><b>Capacity: </b><span>' + feature.properties.capacity2 + '</span></div>'; };  
                    if (feature.properties.size2) { featureInfo += '<div class="info-line"><b>Size: </b><span>' + feature.properties.size2 + "</span></div>"; };  
                    if (feature.properties.direction) { featureInfo += '<div class="info-line"><b>Ideal for: </b><span>' + feature.properties.ideal2 + "</span></div>"; };  
                    featureInfo += '<div class="btn-container">';    
                    if (feature.properties.link2) { featureInfo += '<a class="btn blue btn-small" href="'+ feature.properties.link2 +'">Learn More</a>'; };  
                    if (feature.properties.direction) { featureInfo += '<a class="btn blue btn-small" target="_blank" href="'+ feature.properties.direction +'">Directions</a>'; };  
                    featureInfo += '</div>';  
                    featureInfo += "</div>";
                }

                if (feature.properties.name3 || feature.properties.capacity3 || feature.properties.size3) {
                    featureInfo += '<div class="feature_item">';
                    featureInfo += "<h3>" + feature.properties.name3 + "</h3>";  
                    if (feature.properties.capacity3) { featureInfo += '<div class="info-line"><b>Capacity: </b><span>' + feature.properties.capacity3 + '</span></div>'; };  
                    if (feature.properties.size3) { featureInfo += '<div class="info-line"><b>Size: </b><span>' + feature.properties.size3 + "</span></div>"; };  
                    if (feature.properties.ideal3) { featureInfo += '<div class="info-line"><b>Ideal for: </b><span>' + feature.properties.ideal3 + "</span></div>"; };  
                    featureInfo += '<div class="btn-container">';    
                    if (feature.properties.link3) { featureInfo += '<a class="btn blue btn-small" href="'+ feature.properties.link3 +'">Learn More</a>'; };  
                    if (feature.properties.direction) { featureInfo += '<a class="btn blue btn-small" target="_blank" href="'+ feature.properties.direction +'">Directions</a>'; };  
                    featureInfo += '</div>';  
                    featureInfo += "</div>";
                }

                if (feature.properties.name4 || feature.properties.capacity4 || feature.properties.size4) {
                    featureInfo += '<div class="feature_item">';
                    featureInfo += "<h3>" + feature.properties.name4 + "</h3>";  
                    if (feature.properties.capacity4) { featureInfo += '<div class="info-line"><b>Capacity: </b><span>' + feature.properties.capacity4 + '</span></div>'; };  
                    if (feature.properties.size4) { featureInfo += '<div class="info-line"><b>Size: </b><span>' + feature.properties.size4 + "</span></div>"; };  
                    if (feature.properties.ideal4) { featureInfo += '<div class="info-line"><b>Ideal for: </b><span>' + feature.properties.ideal4 + "</span></div>"; };  
                    featureInfo += '<div class="btn-container">';    
                    if (feature.properties.link4) { featureInfo += '<a class="btn blue btn-small" href="'+ feature.properties.link4 +'">Learn More</a>'; };  
                    if (feature.properties.direction) { featureInfo += '<a class="btn blue btn-small" target="_blank" href="'+ feature.properties.direction +'">Directions</a>'; };  
                    featureInfo += '</div>';  
                    featureInfo += "</div>";
                }

                document.getElementById('feature-info').innerHTML = featureInfo;

                // Show the sidebar
                document.getElementById('sidebar').classList.add('visible');
                sidebarVisible = true;

                // Move the map to fit the bounds of the clicked feature
                fitBoundsResponsive(layer.getBounds());
            });
        }
    }
}).addTo(map);

// Listen to zoom changes to hide/show labels
map.on('zoomend', function() {
    if (map.getZoom() >= 17) {
        labelLayers.forEach(item => {
            if (!item.layer.getTooltip()) {
                item.layer.bindTooltip(item.tooltip);
            }
        });
    } else {
        labelLayers.forEach(item => item.layer.unbindTooltip());
    }
});


// Function to make fitBounds responsive with padding adjustment
function fitBoundsResponsive(bounds) {
    var sidebarHeight = document.getElementById('sidebar').offsetHeight;
    if(sidebarHeight == 350){
        var left = 10;
        var right = 10;
        var top = 10;
        var bottom = 400;
    } else {
        var left = 400;
        var right = 10;
        var top = 50;
        var bottom = 50;
    }
    map.fitBounds(bounds, {
        paddingTopLeft: [left, top], //[LEFT, TOP]
        paddingBottomRight: [right, bottom], //[RIGHT, BOTTOM]
    });
}

// Listen for window resize and reapply fitBounds when resized
window.addEventListener('resize', function() {
    if (activeLayer) {
        fitBoundsResponsive(activeLayer.getBounds());
    }
});

$.ajax({
  dataType: "json",
  url: geojsonFeature,
  success: function(data) {
        jsonLayer.addData(data);
  }
});

// Hide the sidebar when clicking outside of a feature
map.on('click', function() {
    if (sidebarVisible) {
        if (activeLayer) {
            jsonLayer.resetStyle(activeLayer);
            activeLayer = null;
        }
        document.getElementById('sidebar').classList.remove('visible');
        sidebarVisible = false;
    }
});

// Variables to track user location and control state
var userMarker, accuracyCircle;
var locationTracking = false;
var locationDenied = false;  // Track location denied status

// Function to start tracking user location (only when the button is clicked)
function startLocationTracking() {
    if (locationDenied) {
        alert("Location access was denied. Please check your browser settings.");
        return;
    }
    
    // Start locating
    map.locate({
        setView: true,
        maxZoom: 16,
        watch: true,  // Continuously update the position
        enableHighAccuracy: true  // Use GPS if available
    });
}

// Function to stop tracking user location
function stopLocationTracking() {
    map.stopLocate();
    if (userMarker) {
        map.removeLayer(userMarker);
        userMarker = null;  // Ensure we nullify the marker for future use
    }
    if (accuracyCircle) {
        map.removeLayer(accuracyCircle);
        accuracyCircle = null;  // Ensure we nullify the circle for future use
    }
}

// Handle location found event
map.on('locationfound', function(e) {
    var radius = e.accuracy / 2;
    if (!userMarker) {
        userMarker = L.marker(e.latlng).addTo(map)
            // .bindPopup("You are within " + radius + " meters from this point").openPopup();
        accuracyCircle = L.circle(e.latlng, radius).addTo(map);
    } else {
        userMarker.setLatLng(e.latlng)
            // .bindPopup("You are within " + radius + " meters from this point").openPopup();
        accuracyCircle.setLatLng(e.latlng).setRadius(radius);
    }
});

// Handle location error event (set locationDenied to true when denied)
map.on('locationerror', function(e) {
    locationDenied = true;
    alert("Location access denied. Please allow location access in your browser.");
});

// Custom control to toggle location tracking
L.Control.LocationControl = L.Control.extend({
    onAdd: function(map) {
        var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');
        container.style.backgroundColor = 'white';
        container.style.backgroundImage = 'url(../wp-content/themes/westerner-days/images/location-pin.png)';
        container.style.backgroundSize = '16px';
        container.style.backgroundRepeat = "no-repeat";
        container.style.backgroundPosition = "center";
        container.style.width = '34px';
        container.style.height = '34px';
        container.style.cursor = 'pointer';

        container.onclick = function() {
            if (locationTracking) {
                stopLocationTracking();
                container.style.backgroundImage = 'url(../wp-content/themes/westerner-days/images/location-pin.png)';  // Location off icon
                locationTracking = false;
            } else {
                startLocationTracking();
                container.style.backgroundImage = 'url(../wp-content/themes/westerner-days/images/green-location-pin.png)';  // Location on icon
                locationTracking = true;
            }
        };

        return container;
    },

    onRemove: function(map) {
        // Nothing to do here
    }
});

// Add the custom location control to the map
L.control.locationControl = function(opts) {
    return new L.Control.LocationControl(opts);
}

// Add the control to the map below the zoom controls
L.control.locationControl({ position: 'topleft' }).addTo(map);