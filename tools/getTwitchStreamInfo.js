//my id 140686783
var userToSearch = 'chillbrobagg1ns'
var getUrl = 'https://api.twitch.tv/kraken/channels/'
$.ajax({ 
		url:getUrl + userToSearch,
		type:"GET",
		headers: {
			'Client-ID':'dg57ggohohzi2wonuxsqsx716p7er3'
		},
		success: function(result) {
			console.log(result);
			storeChannelInfo(result);
		},
		error: function() {
			console.log('There was an error getting the counter data');
		}
});

function storeChannelInfo(res) {
		let channelID = res._id;
		console.log(channelID);
}