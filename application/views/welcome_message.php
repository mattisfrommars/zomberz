<!doctype html>
<html>
	<!DOCTYPE html>
	<head>
		<title>Pusher Test</title>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<!-- pusher JS -->
		<script src="http://js.pusher.com/1.12/pusher.min.js" type="text/javascript"></script>
		<script src="/assets/js/main.js" type="text/javascript"></script>
		<!-- google maps -->
		<script>
			var map;
			function initialize() {
				var mapOptions = {
					zoom: 8,
					center: new google.maps.LatLng(51, 0),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				map = new google.maps.Map(document.getElementById('map_canvas'),
				mapOptions);
			}

			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		<style>
			html,body {
				width: 100%;
				height: 100%;
			}
			#map_canvas {
				margin: 0;
				padding: 0;
				height: 100%;
				width: 80%;
				float: left;
			}
			
			#panel {
				height: 100%;
				width: 20%;
				float: left;
			}
		</style>
	</head>
	<body>

		<div id="map_canvas"></div>
		<div id="panel">
			<form id="personalInfo">
				<input name="name" id="piName" placeholder="Name" />
				<input name="phone" id="piPhone" placeholder="Phone" />
				<input type="submit" />
			</form>
		</div>
	</body>
</html>