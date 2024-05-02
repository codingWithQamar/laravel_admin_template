<x-front-layout>
{{--
	@inject('helpers', 'App\Classes\Helpers')
--}}
	<x-slot name="pageName">{{ $pageName }}</x-slot>
	<x-slot name="inPageCss">
		<style>
			.card {
				margin-bottom: 20px;
				box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
				transition: all 0.3s ease;
			}

			.card:hover {
				box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
			}

			.card-body {
				padding: 20px;
			}

			.map-container {
				height: 300px;
				border: 1px solid #ccc;
				border-radius: 8px;
				overflow: hidden;
			}
		</style>
	</x-slot>
	<div class="container">
		<h2>My Watched Areas</h2>
		<div class="row">
			@foreach($locations as $key => $polygon)
				<div class="col-md-4">
					<a href="{{route('watched_area_summary_detail',$polygon->id)}}">
					<div class="card">
						<div class="map-container" id="map-{{ $polygon->id }}"></div>
						<div class="card-body">
							<h5 class="card-title">{{ ucwords($polygon->title) }}</h5>
							<p class="card-text">
								{{-- <!-- Loop through the decoded coordinates and display them -->
								@foreach(json_decode($polygon->coordinates, true) as $coordinate)
									Lat: {{ $coordinate['lat'] }}, Lng: {{ $coordinate['lng'] }}<br>
								@endforeach --}}
							</p>
						</div>
					</div>
				</a>
				</div>
			@endforeach
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
	<x-slot name="inPageJs">
	<script>
		@foreach($locations as $key => $polygon)
			var map{{ $polygon->id }} = L.map('map-{{ $polygon->id }}').setView([51.9467508,-84.6544609], 6);
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				maxZoom: 10,
			}).addTo(map{{ $polygon->id }});

			var coordinates{{ $polygon->id }} = {!! $polygon->coordinates !!}; // Parse coordinates from the PHP variable
			
			// Create a polygon and fit the map view to the polygon's bounds
			var polygon{{ $polygon->id }} = L.polygon(coordinates{{ $polygon->id }}).addTo(map{{ $polygon->id }});
			map{{ $polygon->id }}.fitBounds(polygon{{ $polygon->id }}.getBounds());
		@endforeach
	</script>
	</x-slot>
</x-front-layout>