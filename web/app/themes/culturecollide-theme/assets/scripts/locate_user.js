jQuery(function($){
	$('.travel__navigation__button').click(function () {
    navigator.geolocation.getCurrentPosition(success, error);
		$.post(ajax_object.ajaxurl, {
			action: 'ajax_action',
			post_id: $(this).find('input.post_id').attr('value')
		}, function(data) {
			alert(data); // alerts 'ajax submitted'
		});
	});
});

function success(position) {
  var latitude  = position.coords.latitude;
  var longitude = position.coords.longitude;

  output = 'Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°';

  console.log(output);
}

function error() {
  console.warn("Unable to retrieve your location");
}
