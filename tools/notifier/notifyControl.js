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

function getTwitchFollows() {
	var cid = $('#cid').val();
	var uid = $('#uid').val();
	var getUrl = 'https://api.twitch.tv/kraken/channels/' + uid +  '/follows';
	$.ajax({ 
			url:getUrl,
			type:"GET",
			headers: {
				'Client-ID': cid,
				'Accept': 'application/vnd.twitchtv.v5+json'
			},
			success: function(result) {
				console.log(result);
				//a function to display will go here once the script is verified working
			},
			error: function() {
				console.log('There was an error getting the follower data');
			}
	});
}
function getTwitchSubs() {
	var cid = $('#cid').val();
	var uid = $('#uid').val();
	var toke = $('#toke').val();
	var getUrl = 'https://api.twitch.tv/kraken/channels/' + uid +  '/subscriptions';
	$.ajax({ 
			url:getUrl,
			type:"GET",
			headers: {
				'Client-ID': cid,
				'Accept': 'application/vnd.twitchtv.v5+json',
				'Authorization': 'OAuth ' + toke
			},
			success: function(result) {
				console.log(result);
				//a function to display will go here once the script is verified working
			},
			error: function() {
				console.log('There was an error getting the follower data');
			}
	});
}