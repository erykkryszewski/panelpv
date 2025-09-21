import $ from 'jquery';

(function($) {
  function initMap($el) {
    var $markers = $el.find('.map-snazzy__marker');
    window.markers_url = $el.data('marker-url');
    var mapArgs={zoom:$el.data("zoom")||11,mapTypeId:google.maps.MapTypeId.ROADMAP,styles:[{"featureType":"all","elementType":"all","stylers":[{"hue":"#008eff"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"0"},{"lightness":"0"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-60"},{"lightness":"-20"}]}]};
    
    var map = new google.maps.Map($el[0], mapArgs);

    map.markers = [];
    $markers.each(function() {
      initMarker($(this), map);
    });

    centerMap(map);

    return map;
  }

  function initMarker($marker, map) {
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');
    var latLng = {
      lat: parseFloat(lat),
      lng: parseFloat(lng)
    };

    var marker = new google.maps.Marker({
      position: latLng,
      map: map,
      icon: {
        url: window.markers_url,
        scaledSize: new google.maps.Size(40, 40)
      }
    });

    map.markers.push(marker);

    if ($marker.html()) {
      var infowindow = new google.maps.InfoWindow({
        content: $marker.html()
      });

      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
      });
    }
  }

  function centerMap(map) {
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function(marker) {
      bounds.extend({
        lat: marker.position.lat(),
        lng: marker.position.lng()
      });
    });

    if (map.markers.length == 1) {
      map.setCenter(bounds.getCenter());
    } else {
      map.fitBounds(bounds);
    }
  }

  $(document).ready(function() {
    let maps = $('.map-snazzy');
    maps.each(function() {
      var map = initMap($(this));
    });
  });
})(jQuery);