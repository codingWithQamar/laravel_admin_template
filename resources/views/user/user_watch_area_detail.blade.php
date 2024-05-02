<x-front-layout>
{{--
	@inject('helpers', 'App\Classes\Helpers')
--}}
	<x-slot name="pageName">{{ $pageName }}</x-slot>
	<x-slot name="inPageCss">
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css" />
		<style>
			.map-container {
				height: 300px;
				border: 1px solid #ccc;
				border-radius: 8px;
				overflow: hidden;
			}

.mapPopupBox-container {
    background: #fff;
    box-shadow: 0px 0px 5px 0px #000;
    max-width: 500px;
    padding: 8px;
    border-radius: 8px;
	color: #333;
}
.mapPopupBox-image-container img {
	width: 100%;
    height: 95px;
    object-fit: cover;
}
.mapPopupBox-container .col-8 {
    padding-left: 0;
}
.mapPopupBox-content-container {
    font-weight: normal;
    font-size: 0.8rem;
}
.mapPopupBox-content-top-area {
    display: block;
    min-height: 24px;
}
.mapPopupBox-content-container .float-left {
    float: left;
    display: inline-block;
}
.mapPopupBox-content-middle-area {
    display: block;
    min-height: 50px;
}
.mapPopupBox-pricing-container span {
    font-size: 15px;
    font-weight: bold;
}
.mapPopupBox-content-container .float-right {
    float: right;
    display: inline-block;
}
.mapPopupBox-address-container {
    display: block;
    height: 26px;
    overflow: hidden;
    font-size: 16px;
}
.leaflet-popup-content {
	margin: 0 !important;
}
.leaflet-popup-content a{
	text-decoration: none;
}
		</style>
	</x-slot>
	<div class="container">
		
		<div class="row">
			<div class="col-12">
				<h2>My Watched Areas: Location Name</h2>
			</div>
		</div>
	</div>
	<div id="map-{{ $location->id }}" style="height: 500px;"></div>

	<x-slot name="inPageJs">
		<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
		<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
<script>
		var map = L.map('map-{{ $location->id }}').setView(["{{ $center['lat'] }}","{{ $center['lng'] }}"], 6);
			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 10,
		}).addTo(map);

		// Parse coordinates from the JSON response
		var response1 = {!! json_encode($location->coordinates) !!};
		var response = JSON.parse(response1);
		// alert(response);
		var coordinates = response.map(function(coord) {
			return [coord.lat, coord.lng];
		});
		
		// Create a polygon and fit the map view to the polygon's bounds
		var polygon = L.polygon(coordinates).addTo(map);
		map.fitBounds(polygon.getBounds());
		var markers = L.markerClusterGroup();
		var nearbyProperties = @json($nearbyProperties);
		nearbyProperties.forEach(function(property) {
			var latitude = property.latitude;
			var longitude = property.longitude;
			var price = property.listed_price.toFixed(2);
			var date = property.listed_date;
			var full_addres = property.full_address;
			var bed = property.bed;
			if(property.bed_extra > 0){
				bed += '+'+property.bed_extra;
			}
			var bath = property.bath;
			var garage = property.garage;
			var residance_family_type = 'Family Residence';
			var residance_type = (property.residence_type == 'Sale')?'For Sale':'For Rent';
			// Check if latitude and longitude are defined
			if (latitude !== undefined && longitude !== undefined) {
				var marker = L.marker([latitude, longitude]).bindPopup('<a target="_blank" href="'+baseUrl+'/property/'+property.Ml_num+'"><div class="mapPopupBox-container">\
					<div class="row">\
						<div class="col-4">\
							<div class="mapPopupBox-image-container">\
								<img class="img-fluid" src="https://cache08.housesigma.com/file/pix-itso/144625970/238bd_1.jpg" />\
							</div>\
						</div>\
						<div class="col-8">\
							<div class="mapPopupBox-content-container">\
								<div class="mapPopupBox-content-top-area">\
									<div class="float-left">\
										<div class="mapPopupBox-pricing-container">\
											Listed: <span>$'+price+'</span>\
										</div>\
									</div>\
									<div class="float-right">\
										<div class="mapPopupBox-date-container">\
											<small>'+date+'</small>\
										</div>\
									</div>\
								</div>\
								<div class="mapPopupBox-content-middle-area">\
									<div class="mapPopupBox-address-container">\
										<span>'+full_addres+'</span>\
									</div>\
									<div class="mapPopupBox-address-type-container">\
										<div class="float-left">\
										'+residance_family_type+'\
										</div>\
										<div class="float-right">\
											<div class="mapPopupBox-address-icons">\
												<span><i class="fas fa-bed"></i> '+bed+'</span>\
												<span><i class="fas fa-bath"></i> '+bath+'</span>\
												<span><i class="fas fa-car"></i> '+garage+'</span>\
											</div>\
										</div>\
									</div>\
								</div>\
								<div class="mapPopupBox-content-bottom-area">\
									<div class="mapPopupBox-sale-rent-container">\
										<span class="badge badge-success">'+residance_type+'</span>\
									</div>\
								</div>\
							</div>\
						</div>\
					</div>\
				</div></a>', {maxWidth: 500});
				markers.addLayer(marker);
			}
		});
		map.addLayer(markers);

</script>
	</x-slot>
</x-front-layout>