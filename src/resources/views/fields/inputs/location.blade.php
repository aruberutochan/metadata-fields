<div class="row">

    <div class="col-sm-12">
        <div class="form-group">
            <label for="autocomplete">{{$field->label}} </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text border-primary text-white bg-primary">
                        <span class="fa fa-map-marker"></span>
                    </div>
                </div>

                <input id="autocomplete" name="{{$field->name}}_address" class="form-control form-control-lg" placeholder="{{__('Nombre de la calle, ciudad, provincia')}}"
                    onFocus="geolocate()" type="text"></input>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label for="route" class="col-sm-2 col-form-label">{{__('Calle')}}</label>
            <div class="col-sm-10">
                <input class="field form-control" name="{{$field->name}}_route" id="route"></input>
            </div>
        </div>

        <div class="form-group row">
            <label for="street_number" class="col-sm-3 col-form-label">{{__('Nº, Piso, etc.')}}</label>
            <div class="col-sm-9">
                <input class="field form-control" name="{{$field->name}}_street_number" id="street_number"></input>
            </div>
        </div>

        <div class="form-group row">
            <label for="locality" class="col-sm-2 col-form-label">{{__('Ciudad')}}</label>
            <div class="col-sm-6">
                <input class="field form-control" name="{{$field->name}}_locality" id="locality"></input>
            </div>
            <label for="postal_code" class="col-sm-1 col-form-label">{{__('CP')}}</label>
            <div class="col-sm-3">
                <input class="field form-control" name="{{$field->name}}_postal_code" id="postal_code"></input>
            </div>
        </div>

        <div class="form-group row">
            <label for="country" class="col-sm-2 col-form-label">{{__('País')}}</label>
            <div class="col-sm-4">
                <input class="field form-control" name="{{$field->name}}_country" id="country"></input>
            </div>
            <label for="administrative_area_level_2" class="col-sm-2 col-form-label">{{__('Provincia')}}</label>
            <div class="col-sm-4">
                <input class="field form-control" type="hidden" name="{{$field->name}}_administrative_area_level_1" id="administrative_area_level_1"></input>
                <input class="field form-control" name="{{$field->name}}_administrative_area_level_2" id="administrative_area_level_2"></input>
            </div>
        </div>

        <div class="form-group row">
            <label for="city-lat" class="col-sm-2 col-form-label">{{__('Latitud')}}</label>
            <div class="col-sm-4">
                <input class="field form-control" name="{{$field->name}}_city_lat" id="city_lat" disabled="true"></input>
            </div>
            <label for="city-lng" class="col-sm-2 col-form-label">{{__('Longitud')}}</label>
            <div class="col-sm-4">
                <input class="field form-control" name="{{$field->name}}_city_lng" id="city_lng" disabled="true"></input>
            </div>
        </div>
    </div>


    <div class="col-sm-6">
        <div id="map-container" class="map-responsive">
            <div id="map"></div>
        </div>
    </div>
</div>
<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        administrative_area_level_2: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 40.4636,
                lng: -3.7492
            },
            zoom: 5
        });

        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete')), {
                types: ['geocode']
            });

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -33.8688,
                lng: 151.2195
            },
            zoom: 13
        });
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        ////
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true,

        });

        google.maps.event.addListener(marker, 'dragend', function (evt) {
            document.getElementById('city_lat').value = evt.latLng.lat();
            document.getElementById('city_lng').value = evt.latLng.lng();
        });



        marker.setVisible(false);
        if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17); // Why 17? Because it looks good.
        }

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        ////
        console.log(place);

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        document.getElementById('city_lat').value = place.geometry.location.lat();
        document.getElementById('city_lng').value = place.geometry.location.lng();

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GMAPS_API_JS', 'DefaultApi') }}&libraries=places&callback=initAutocomplete"
    async defer></script>

