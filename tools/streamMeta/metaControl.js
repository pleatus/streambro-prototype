var passHeld = '1337';

function promptPass() {
	var passIn = prompt('Enter password to reset');
	if (passIn == passHeld && passIn != null) {
		return true;
	}
	else {
		alertOutput('Incorrect password!');
		return false;
	}
}
//will call changeLabel if enter key is pressed in input field 
/*$("#countorLabel").keyup( function (event) {
	if (event.which == 13) {
		changeInfo();
	}
});*/

function changeTitle () {
	var newTitle = $("#streamName").val();
	if (promptPass()) {
		postAjax("title=" + newTitle);
	}
}
function changeGame () {
	var newGame = $("#gameName").val();
	if (promptPass()) {
		postAjax("game=" + newGame);
	}
}
function updateToPlat() {
	let streamInfoDsp = document.getElementsByClassName('streamMetaLabel');
	let locStrTtl = streamInfoDsp[1].textContent;
	let locGameTtl = streamInfoDsp[3].textContent;
	let uid = $('#uid').val();
	let cid = $('#cid').val();
	let toke = $('#toke').val();
	console.log('title: ' + locStrTtl + " game: " + locGameTtl + " uid:" + uid + " cid:" + cid + " toke:" + toke);
	putToTwitch(locStrTtl,locGameTtl,uid,cid,toke);
}
function alertOutput(str) {
	$("#userOutput").html(str);
	setTimeout(function() {
		rdyStr = "Ready";
		$("#userOutput").html(rdyStr);
	},1500);
		
}

function postAjax(data) {
	var sendT = data;
	var sOut = "Success message not set!", fOut = "Error message not set!";
	$.ajax({
			url:"streamMeta.php",
			type:"POST",
			beforeSend: function (xhr) {
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			},
			data: sendT,
			success: function() {
				alertOutput(sOut);
				getMeta();
			},
			error: function() {
				alertOutput(fOut);
			}
		});
}

function putToTwitch(title,game,uid,cid,toke) {
	var channelID = uid;
	var clientID = cid;
	var oAuth = toke;
	var getUrl = 'https://api.twitch.tv/kraken/channels/';
	var status = title;
	var game = game;
	var channel = {
		channel: {
			status:status,
			game:game
		}
	};
	$.ajax({ 
			url:getUrl + channelID,
			type:"PUT",
			dataType:"json",
			headers: {
				'Client-ID': clientID,
				'Accept': 'application/vnd.twitchtv.v5+json',
				'Authorization': 'OAuth ' + oAuth
			},
			data:channel,
			success: function(result) {
				console.log(result);
				getTwitchMeta();
			},
			error: function() {
				console.log('There was an error getting the counter data');
			}
	});
}