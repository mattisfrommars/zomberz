/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Pusher.log = function(message) {
	if (window.console && window.console.log) window.console.log(message);
};

// Flash fallback logging - don't include this in production
WEB_SOCKET_DEBUG = true;

var pusher = new Pusher('9c295af0ff39b81a3ad1');
var channel = pusher.subscribe('zombies');
channel.bind('newZombie', function(data) {
	lat = data.lat;
	lng = data.lng;
	id = data.id;
	timestamp = data.reported_at;
	//distance = zombie.distance;
	console.log('new zombie('+id+') near '+lat+','+lng+' seen at '+timestamp);
});