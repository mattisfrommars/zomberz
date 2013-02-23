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
				width: 100%;
				float: left;
			}
			
			#panel {
				position: absolute;
				height: 80%;
				width: 60%;
				top: 10%;
				left: 20%;
				background-color: #ed1c24;
				border-radius: 5px;
				border: 5px solid black;
				text-align: center;
				font-family: Arial, sans-serif;


				background-image: url(/images/massiveZombie.png);
				background-position: bottom left;
				background-repeat: no-repeat;
				background-size: 330px auto;
			}
			#panel img {
				width: 90%;
				margin: 5%;
				height: auto;
			}
			#panel input[type=text] {
				margin: 0;
				padding: 0;
				display: block;
				width: 40%;
				margin: 20px 30%;
				height: 25px;
				border: 2px solid black;
				border-radius: 5px;
				padding: 5px 2%;
				font-family: 'Arial Black';
			}
			#panel input[type=submit] {
				font-size: 30px;
				display: inline-block;
				padding: 4px 12px;
				margin-bottom: 0;
				font-size: 14px;
				line-height: 20px;
				color: #333333;
				text-align: center;
				text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
				vertical-align: middle;
				cursor: pointer;
				background-color: #f5f5f5;
				background-image: -webkit-gradient(linear, 0 100%, 0 0, from(#ffffff), to(#e6e6e6));
				background-image: -webkit-linear-gradient(#ffffff, #e6e6e6);
				background-image: -moz-linear-gradient(#ffffff, #e6e6e6);
				background-image: -o-linear-gradient(#ffffff, #e6e6e6);
				background-image: linear-gradient(#ffffff, #e6e6e6);
				background-repeat: repeat-x;
				border: 2px solid #000;
				-webkit-border-radius: 4px;
				-moz-border-radius: 4px;
				border-radius: 4px;
				filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
				filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
				-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
				-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
				box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
			}
			#panel p {
				padding: 0 20%;
			}
			@media only screen and (max-width: 900px) {
				#panel {
					height: 60%;
					top: 20%;
					background-size: 240px auto;
				}
			}
			@media only screen and (max-width: 768px) {
				#panel {
					width: 80%;
					left: 10%;
				}
			}
		</style>
	</head>
	<body>

		<div id="map_canvas"></div>
		<div id="panel">
			<img src="/images/header.png">
			<form id="personalInfo">
				<p>The zombies are here! Register your safe house here to receive a warning if the undead come within 10 miles!</p>
				<input type="text" name="name" id="piName" placeholder="Name" />
				<input type="text" name="phone" id="piPhone" placeholder="Phone" />
				<input type="submit" />
			</form>
		</div>
	</body>
</html>