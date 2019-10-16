<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnStore</title>

    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="script/bootbox.min.js"></script>
</head>
<style>
    #linklog {
        color: #ef9a9a;
    }
</style>

<body>

    <!--Nav-->
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center">Register</a>
        </div>
    </nav>

    <div class="login pushed-top">
        <div id="body_content" class="container">
            <div class="row .valign-wrapper">
                <form action="" id="user-form">
                    <div class="resultss">
                        <span id="result"></span>
                    </div>
                    <div class="input-field">
                        <input id="name" type="text" class="validate">
                        <label for="name">Company Name</label>
                    </div>

                    <div class="input-field">
                        <input id="cell" type="number" class="validate">
                        <label for="cell">Contact Number</label>
                    </div>
                    <div class="input-field">
                        <input id="email" type="text" class="validate">
                        <label for="email">Email Address</label>
                    </div>
                    <div class="input-field">
                        <input id="city" type="text" class="validate">
                        <label for="city">City</label>
                    </div>
                    <div class="pac-card" id="pac-card">
                        <div id="pac-container">
                            <div class="input-field">
                                <input id="address" type="text" class="validate">
                                <label for="address">Shop Address</label>
                            </div>
                        </div>
                    </div>
                            <div id="map"></div>
                            <div id="infowindow-content">
                                <img src="" width="5" height="5" id="place-icon">
                                <span id="place-name" class="title"></span><br>
                                <span id="place-address"></span>
                            </div>
                            <div class="input-field">
                                <input id="passW" type="password" class="validate">
                                <label for="passW">Enter Password</label>
                            </div>
                            <div class="input-field">
                                <input id="passW1" type="password" class="validate">
                                <label for="passW1">Enter Password</label>
                            </div>
                            <div class="input">
                                <button id="btn_reg" class="btn red lighten-2 btn-round waves-effect waves-dark col s12">Register</button>
                                <p class="text-center">Already have Registered? <a id="linklog" href="login.php">Login!</a></p>
                            </div>
                            <div class="fixed-action-btn">
                                <a class="btn red lighten-2 btn-round waves-effect waves-dark">
                                    <i class="large fa fa-info"></i>
                                </a>
                            </div>
                </form>
            </div>


            <!--footer-->
            <footer class="grey darken-4" style="position:fixed; bottom:0; width:100%;">
                <div class="">
                    <div class="container">

                    </div>
                </div>
            </footer>
        </div>
    </div>


    <!--scripts-->
    <script src="script/jquery.min.js"></script>
    <script src="script/materialize.min.js"></script>
    <script src="script/fontawesome.min.js"></script>
    <script src="script/all.min.js"></script>
    <script src="script/wow.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.fixed-action-btn').floatingActionButton();
            $('textarea#passW1, textarea#passW').characterCounter();

            $('#btn_reg').click(function(e) {
                e.preventDefault();

                var name = $('#name').val();

                var cell = $('#cell').val();
                var email = $('#email').val();
                var city = $('#city').val();
                var address = $('#address').val();
                var passW = $('#passW').val();
                var passW1 = $('#passW1').val();

                $.ajax({
                    type: "post",
                    url: "regCpu.php",
                    data: {
                        name: name,

                        cell: cell,
                        email: email,
                        city: city,
                        address: address,
                        passW: passW,
                        passW1: passW1
                    },
                    success: function(response) {
                        $('#result').html(response);
                    }
                });

            });


        });
    </script>

</body>

</html>

<script>
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAC4CXmlD1Zf0M8R1rYvJhDBWkNfKguCV8&libraries=places">

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -33.8688,
                lng: 151.2195
            },
            zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('address');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
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

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindowContent.children['place-icon'].src = place.icon;
            infowindowContent.children['place-name'].textContent = place.name;
            infowindowContent.children['place-address'].textContent = address;
            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
            var radioButton = document.getElementById(id);
            radioButton.addEventListener('click', function() {
                autocomplete.setTypes(types);
            });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
                console.log('Checkbox clicked! New state=' + this.checked);
                autocomplete.setOptions({
                    strictBounds: this.checked
                });
            });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAC4CXmlD1Zf0M8R1rYvJhDBWkNfKguCV8&libraries=places&callback=initMap" async defer>
</script>