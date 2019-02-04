//my id 140686783
//my access token 16dhcr9kijibpa4v30y7c5ci1fdvga
var channelID = 140686783;
var userToSearch = 'chillbrobagg1ns';
var getUrl = 'https://api.twitch.tv/kraken/channels/';
var status = 'testing title only';
var game = "Radical Heights";
var channel = {
	channel: {
		status:status
	}
};
console.log(JSON.stringify(channel));
$.ajax({ 
		url:getUrl + channelID,
		type:"PUT",
		dataType:"json",
		headers: {
			'Client-ID':'dg57ggohohzi2wonuxsqsx716p7er3',
			'Accept': 'application/vnd.twitchtv.v5+json',
			'Authorization': 'OAuth 16dhcr9kijibpa4v30y7c5ci1fdvga'
		},
		data:channel,
		success: function(result) {
			console.log(result);
		},
		error: function() {
			console.log('There was an error getting the counter data');
		}
	});