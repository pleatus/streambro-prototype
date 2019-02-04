$(document).ready( function () {
	//following line removes all images, looks bad on obs if nayone is hosting on top of you
	$("img").css("display", "none");
	//$("#counterCurrent").css({"position":"relative","top":"-18px"});
	getMeta();
	getTwitchMeta();
	if ($("body").data("title") == 'plgndsp') {
		var getM = setInterval(getMeta,10000);
	}
});
window.onerror = function() {
	//comment out to debug, otherwise keep in so it doesnt throw known errors
	//return true;
}
function getMeta () {
	$.ajax({
		url:"streamMeta.php",
		type:"GET",
		success: function(result) {
			console.log(result);
			var metaReturn = result;
			setLocalMeta(metaReturn);
			alertOutput('Data received');
		},
		error: function() {
			alertOutput('There was an error getting the locally stored stream meta');
		}
	});
}
function getTwitchMeta() {
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
			var metaReturn = result;
			setTwitchMeta(metaReturn);
			alertOutput('Data received from Twitch');
		},
		error: function() {
			console.log('There was an error getting the stream meta from Twitch');
		}
	});
}
function setLocalMeta(str) {
	$("#savedStreamInfo").html(str);
}
function setTwitchMeta(data) {
	let streamTitle = data.status;
	let gameTitle = data.game;
	let pData = "<div class='streamMetaCon'><div class='streamMetaLabel'>Stream Title:</div><div class='streamMetaLabel'>" + streamTitle +  "</div><div class='streamMetaLabel'>Game Title:</div><div class='streamMetaLabel'>" + gameTitle + "</div></div>"
	console.log(pData);
	$("#twitchStreamInfo").html(pData);
}