//my id 140686783
var userToSearch = 'chillbrobagg1ns'
var getUrl = 'https://id.twitch.tv/oauth2/authorize?client_id=dg57ggohohzi2wonuxsqsx716p7er3&redirect_uri=http://localhost/streamBro/tools/auth.php&response_type=code&scope=user:edit+user:edit:broadcast+channel_editor'
$.ajax({ 
		url:getUrl,
		type:"GET",
		success: function(result) {
			console.log(result);
		},
		error: function() {
			console.log('There was an error getting the counter data');
		}
	});