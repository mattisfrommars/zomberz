$(document).ready(function(){
	var zombies = new Array();
	var zombie = {
		id:0,
		lat:0,
		lng:0,
		timestamp: 0
	};

	//get location
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition);
	}
	
	function showPosition(position)
	{	
		lat = position.coords.latitude;
		lng = position.coords.longitude;
	
		var latLng = new google.maps.LatLng(lat,lng);
	
		var marker = new google.maps.Marker({
			position: latLng,
			title: "You are here",
			icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
		});

		// To add the marker to the map, call setMap();
		marker.setMap(map);
		//users_create: lat, lng, name, phone
		$.post("/api?");
	}
  
	Pusher.log = function(message) {
		if (window.console && window.console.log) window.console.log(message);
	};

	// Flash fallback logging - don't include this in production
	WEB_SOCKET_DEBUG = true;

	var pusher = new Pusher('9c295af0ff39b81a3ad1');
	var channel = pusher.subscribe('zombies');
	channel.bind('newZombie', function(data) {
		console.log(data);
		var jsonData = data;//JSON.parse(data);
		console.log(jsonData);
		var lat = jsonData.lat,
		lng = jsonData.lng,
		id = jsonData.id,
		timestamp = jsonData.reported_at;
		//distance = zombie.distance;
		console.log('new zombie('+id+') near '+lat+','+lng+' seen at '+timestamp);
	
		var latLng = new google.maps.LatLng(lat,lng);
	
		var marker = new google.maps.Marker({
			position: latLng,
			title: id+' '+timestamp
		});

		// To add the marker to the map, call setMap();
		marker.setMap(map);
	
	//new zombie(id,lat,lng,timestamp);
	});
});