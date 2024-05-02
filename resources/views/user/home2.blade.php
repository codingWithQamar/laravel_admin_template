<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.css"
/>
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css"
/>
<!-- Include the Leaflet Draw CSS and JavaScript -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<main class="py-4">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">
			{{ config('app.name', 'Laravel') }}
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav me-auto">

			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ms-auto">
				<!-- Authentication Links -->
				@guest
					@if (Route::has('login'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
					@endif

					@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
						</li>
					@endif
				@else
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }}
						</a>

						<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('watched_area_summary') }}">
								{{ __('Watched Area') }}
							</a>
							<a class="dropdown-item" href="{{ route('logout') }}"
							   onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</div>
						
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>
</main>
<div id="map" style="width: 100%; height: 100%;"></div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	var map = L.map('map').setView([51.9467508,-84.6544609], 12);
  
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	  maxZoom: 25,
	}).addTo(map);
  
	var markers = L.markerClusterGroup();
	var drawControl;
  
	var losAngelesLocations = {!! json_encode($properties->toArray()) !!};
  	
	var markers = L.markerClusterGroup();

// Loop through the dynamic losAngelesLocations array
for (var i = 0; i < losAngelesLocations.length; i++) {
    var latitude = losAngelesLocations[i].latitude;
    var longitude = losAngelesLocations[i].longitude;
    var marker = L.marker([latitude, longitude]).bindPopup('Location ' + (i + 1));
    markers.addLayer(marker);
}
  
	map.addLayer(markers);
  
	function onDrawCreated(e) {
	  var layer = e.layer;
	  drawnItems.clearLayers(); // Clear previously drawn polygons
	  drawnItems.addLayer(layer);
	  map.removeControl(drawControl); // Remove the draw control
	}

	var isPolygonDrawn = false; // Flag to track if a polygon has been drawn

  map.on('draw:created', function (e) {
    if (!isPolygonDrawn) {
      var layer = e.layer;
      var coordinates = layer.getLatLngs(); // Get the coordinates of the drawn polygon
      isPolygonDrawn = true; // Set the flag to true to indicate a polygon has been drawn

      var areaName = prompt('Please enter the name of your area:');

        // If user clicks OK in the prompt
        if (areaName) {
            // Send area name and polygon coordinates to the server using AJAX
            $.ajax({
                type: 'POST',
                url: '/save-area',
                data: {
                    areaName: areaName,
                    coordinates: JSON.stringify(coordinates),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Polygon coordinates saved successfully!');
                    // Handle success response from the server
                },
                error: function(error) {
                    console.error(error);
                    // Handle error response from the server
                }
            });
        } else {
            // If user clicks Cancel in the prompt
            isPolygonDrawn = false; // Reset the flag to allow drawing another polygon
        }
    } else {
      alert('You can only draw one polygon.');
    }
  });
  
	var drawnItems = new L.FeatureGroup();
	map.addLayer(drawnItems);
  
	drawControl = new L.Control.Draw({
	  draw: {
		polygon: true, // Enable polygon drawing
		polyline: false,
		circle: false,
		marker: false,
	  },
	  edit: {
		featureGroup: drawnItems,
	  },
	});
  
	map.addControl(drawControl);
  
	map.on('draw:created', onDrawCreated);
  </script>