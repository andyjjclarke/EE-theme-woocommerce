var showMap;
(function($) {

    showMap = function() {

        var location = new google.maps.LatLng(window.mapLocation[0], window.mapLocation[1]);
        var mapOptions = {
            zoom: 11,
            center: location,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById('acf-map'), mapOptions);

        var image = {
            url : '/wp-content/themes/ex/images/map-pin.png',
            anchor : new google.maps.Point(0,38),
        };
        var locationMarker = new google.maps.Marker({
            position: location,
            map: map,
            icon: image
        });

    };

    $(window).load(function() {

        var script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=showMap';
        document.body.appendChild(script);

    });


})(jQuery);