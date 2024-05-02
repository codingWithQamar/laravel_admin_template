<x-front-layout>
    {{--
	@inject('helpers', 'App\Classes\Helpers')
--}}
    <x-slot name="pageName">{{ $pageName }}</x-slot>
    <x-slot name="inPageCss">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.css" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/MarkerCluster.Default.css" />
        <!-- Include the Leaflet Draw CSS and JavaScript -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
        <style>
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

            .leaflet-popup-content a {
                text-decoration: none;
            }
        </style>
    </x-slot>
    <x-slot name="inPageJs">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
        <script>
            var map = L.map('map').setView([51.9467508, -84.6544609], 6);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 10,
            }).addTo(map);

            var markers = L.markerClusterGroup();
            var drawControl;
            var losAngelesLocations = {!! $properties !!};
            var markers = L.markerClusterGroup();

            // Loop through the dynamic losAngelesLocations array
            for (var i = 0; i < losAngelesLocations.length; i++) {
                var latitude = losAngelesLocations[i].latitude;
                var longitude = losAngelesLocations[i].longitude;
                var price = losAngelesLocations[i].listed_price.toFixed(2);
                var date = losAngelesLocations[i].listed_date;
                var full_addres = losAngelesLocations[i].full_address;
                var bed = losAngelesLocations[i].bed;
                if (losAngelesLocations[i].bed_extra > 0) {
                    bed += '+' + losAngelesLocations[i].bed_extra;
                }
                var bath = losAngelesLocations[i].bath;
                var garage = losAngelesLocations[i].garage;
                var residance_family_type = 'Family Residence';
                var residance_type = (losAngelesLocations[i].residence_type == 'Sale') ? 'For Sale' : 'For Rent';
                var marker = L.marker([latitude, longitude]).bindPopup('<a target="_blank" href="' + baseUrl + '/property/' +
                    losAngelesLocations[i].Ml_num + '"><div class="mapPopupBox-container">\
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
        							Listed: <span>$' + price + '</span>\
        						</div>\
        					</div>\
        					<div class="float-right">\
        						<div class="mapPopupBox-date-container">\
        							<small>' + date + '</small>\
        						</div>\
        					</div>\
        				</div>\
        				<div class="mapPopupBox-content-middle-area">\
        					<div class="mapPopupBox-address-container">\
        						<span>' + full_addres + '</span>\
        					</div>\
        					<div class="mapPopupBox-address-type-container">\
        						<div class="float-left">\
        						' + residance_family_type + '\
        						</div>\
        						<div class="float-right">\
        							<div class="mapPopupBox-address-icons">\
        								<span><i class="fas fa-bed"></i> ' + bed + '</span>\
        								<span><i class="fas fa-bath"></i> ' + bath + '</span>\
        								<span><i class="fas fa-car"></i> ' + garage + '</span>\
        							</div>\
        						</div>\
        					</div>\
        				</div>\
        				<div class="mapPopupBox-content-bottom-area">\
        					<div class="mapPopupBox-sale-rent-container">\
        						<span class="badge badge-success">' + residance_type + '</span>\
        					</div>\
        				</div>\
        			</div>\
        		</div>\
        	</div>\
        </div></a>', {
                        maxWidth: 500
                    });
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
            var coordinates;
            map.on('draw:created', function(e) {
                if (!isPolygonDrawn) {
                    var layer = e.layer;
                    coordinates = layer.getLatLngs(); // Get the coordinates of the drawn polygon
                    isPolygonDrawn = true; // Set the flag to true to indicate a polygon has been drawn

                    $('#watch-area-name-button').trigger('click');
                } else {
                    alert('You can only draw one polygon.');
                }
            });

            var drawnItems = new L.FeatureGroup();
            resetControlsOnMap();

            function resetControlsOnMap() {
                drawnItems.clearLayers();
                map.addLayer(drawnItems);
                drawControl = new L.Control.Draw({
                    draw: {
                        polygon: true, // Enable polygon drawing
                        polyline: false,
                        circle: false,
                        circlemarker: false,
                        marker: false,
                        rectangle: false,
                    },
                    edit: {
                        featureGroup: drawnItems,
                        edit: false
                    },
                });

                map.addControl(drawControl);
                map.on('draw:created', onDrawCreated);
            }
        </script>
        <script>
            $(document).on('click', '#watch-area-save-button', function() {
                var area_name = $('#watch-area-name').val();
                if (area_name != '') {
                    if (area_name.length > 2) {
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('/') }}/save-watch-area",
                            data: {
                                'area_name': area_name,
                                'coordinates': JSON.stringify(coordinates),
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                // alert('Polygon coordinates saved successfully!');
                                openPopup('success', response.message);
                                $('#watch-area-name').val('');
                                $('#watch-area-name-modal').modal('hide');
                                // Handle success response from the server
                                resetControlsOnMap();
                            },
                            error: function(xhr, status, error) {
                                var result = jQuery.parseJSON(xhr.responseText);
                                var msg = '';
                                if (result.message == 'Unauthenticated.') {
                                    msg = 'Please Login to add watch area!';
                                } else if (result.message != '') {
                                    msg = result.message;
                                } else {
                                    msg = 'Something went wrong. Please try again!';
                                }
                                openPopup('error', msg);
                                resetControlsOnMap();
                            }
                        });
                    } else {
                        openPopup('warning', 'Please type more then 2 characters!');
                        //---error name should be more then 2 characters
                    }
                } else {
                    openPopup('warning', 'Please type area name!');
                    //---error name should not be empty
                }
            });
            $(document).on('click', '#watch-area-cancel-button', function() {
                isPolygonDrawn = false;
                resetControlsOnMap();
            });

            function openPopup(icon = null, message = null) {
                Swal.fire({
                    // title: "The Internet?",
                    text: message,
                    icon: icon,
                    allowOutsideClick: false
                });
            }
        </script>
    </x-slot>
    <!-- Main Content -->
    <div id="map" style="width: 100%; height: 500px;"></div>
    <!-- /Main Content -->
    <!-- Button trigger modal -->
    <button type="button" id="watch-area-name-button" data-mdb-ripple-init data-mdb-modal-init
        data-mdb-target="#watch-area-name-modal" style="display: none;"></button>
    <!-- Modal -->
    <div class="modal fade" id="watch-area-name-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-mdb-modal-non-invasive="true" data-mdb-backdrop="static" data-mdb-keyboard="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <!--<div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">Define Watch Area</h5>
   <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
   </div>-->
                <div class="modal-body">
                    <div class="form-group">
                        <label class="label">Watch Area Name</label>
                        <input type="text" id="watch-area-name" class="form-control"
                            placeholder="Enter Watch Area Name..." value="" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="watch-area-cancel-button" class="btn btn-default" data-mdb-ripple-init
                        data-mdb-dismiss="modal">Cancel</button>
                    <button type="button" id="watch-area-save-button" class="btn btn-primary" data-mdb-ripple-init>Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

</x-front-layout>
