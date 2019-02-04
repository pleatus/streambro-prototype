//my id 140686783
var userToSearch = 'chillbrobagg1ns'
var getUrl = 'https://api.twitch.tv/helix/users?login='
$.ajax({ 
		url:getUrl + userToSearch,
		type:"GET",
		headers: {
			'Client-ID':'dg57ggohohzi2wonuxsqsx716p7er3'
		},
		success: function(result) {
			console.log(result);
		},
		error: function() {
			console.log('There was an error getting the counter data');
		}
	});