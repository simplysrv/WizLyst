<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script>
function initialize() {
var mapOptions = {
  center: new google.maps.LatLng(-33.8688, 151.2195),
  zoom: 13,
  mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map = new google.maps.Map(document.getElementById('map-canvas'),
  mapOptions);

var input =(document.getElementById('searchTextField'));
var options = {
types: ['(regions)'],
componentRestrictions: {country: 'in'}
};

var autocomplete = new google.maps.places.Autocomplete(input,options);

autocomplete.bindTo('bounds', map);

var infowindow = new google.maps.InfoWindow();
var marker = new google.maps.Marker({
  map: map
});

google.maps.event.addListener(autocomplete, 'place_changed', function() {
  infowindow.close();
  marker.setVisible(false);
  input.className = '';
  var place = autocomplete.getPlace();
  if (!place.geometry) {
    input.className = 'notfound';
    return;
  }

  var address = '';
  if (place.address_components) {
    address = [
      (place.address_components[0] && place.address_components[0].short_name || ''),
      (place.address_components[1] && place.address_components[1].short_name || ''),
      (place.address_components[2] && place.address_components[2].short_name || '')
    ].join(' ');
  }

  infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
  infowindow.open(map, marker);
});
// Autocomplete.
function setupClickListener(id, types) {
  var textField= document.getElementById(id);
  google.maps.event.addDomListener(textField, 'click', function() {
    autocomplete.setTypes(types);
  });
}

setupClickListener('searchTextField', []);
}


</script>