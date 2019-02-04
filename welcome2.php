<?php
	require_once('tools/cid.php');
?>
<html>
<head>
	<meta charset="utf-8">
    <meta name="author" content="Ray Jaworski">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>streamBro Authorization</title>
		<link rel="stylesheet" type="text/css" href="../../fonts/apple.css">
		<style>
			body {
				font-family: 'apple_regular';
				background-color: #090909;
				color: #eee;
			}				
			main {
				width:315px;
				margin-right: auto;
				margin-left: auto;
			}
			h2 {
				font-style: italic;
				text-align:center;
				color: #4ef84e;
			}
			p#upInfo {
				text-align:center;
				font-size: 0.7em;
				color: #999999;
			}
			div#signUpArea {
				text-align:center;
				color: #4ef84e;
			}
			.centre-elem {
				margin-left:auto;
				margin-right:auto;
				text-align: center;
			}
			div.btn-container {
				width: 100%;
				text-align: center;
			}
			button.infoer {
				display:block;
				height:45px;
				width:108px;
				background-color: lightblue;
				border-radius: 0.8em;
			}
			input {
				font-family: 'apple_regular';
				min-height: 45px;
				min-width: 315px;
			}
			input.signup {
				display:block;
			}
			button {
				font-family: 'apple_regular';
			}
			button#up {
				font-family: sans-serif;
			}
			.streamMetaLabel {
				display:block;
			}
			#streamInfo {
				border-radius:0.8em;
				text-align:center;
				margin-top:41px;
				padding:4.5px;
				width:306px;
				height:180px;
				background-color:#a1a1a1;
				border:2px dotted gray;
			}
			#streamInfo>sup, #streamInfo>input, #streamInfo>button {
				color:#090909;
			}
			#userOutput {
				color: #4ef84e;
				font-size: 0.8em;
			}
			.useInfo {
				font-size:.5em;
			}
			.confirm {
				background-color: green;
			}
			.danger {
				background-color: red;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<main>
	<h2>Welcome to streamBro</h2><br><br>
	<div id="signUpArea">
		<h3>Your account has been created. Provide your twitch username/channel name here if you wish to use streamBro's Twitch integration and begin the authorizatin procedure.</h3>
		<!--<input type="hidden" name="auCode" id="auCode" value="<?php /*echo $code */?>">-->
		<label for="twitchUser">Twitch username/channel name:
		<input type="text" class="signup" name="twitchUser" id="twitchUser"></label>
		<input type="hidden" name="cid" id="cid" value="<?php echo APP_CLIENT_ID; ?>">
		<button onclick="getTwitchChannelID()">Connect Twitch Account</button>
	</div>
</main>
	<script>
	function getTwitchChannelID() {
		var userToSearch = $('#twitchUser').val();
		var getUrl = 'https://api.twitch.tv/kraken/channels/';
		let clientID = $('#cid').val();
		$.ajax({ 
			url:getUrl + userToSearch,
			type:"GET",
			headers: {
				'Client-ID':clientID
			},
			success: function(result) {
				console.log(result);
				storeChannelInfo(result);
			},
			error: function() {
				console.log('There was an error getting the channel id from Twitch');
			}
		});
	}
	function storeChannelInfo(res) {
		let channelID = "userid=" + res._id;
		let clientID = $('#cid').val();
		console.log(channelID);
		//once we have the channel ID we can store it in creds.php using sb-auth.php
		$.ajax({ 
			url:'tools/sb-auth.php',
			type:"POST",
			data:channelID,
			success: function(result) {
				console.log(result);
				//when the channel ID has been stored, redirect user to twitch Auth
				window.location.replace('https://id.twitch.tv/oauth2/authorize?client_id=' + clientID + '&redirect_uri=http://localhost/streamBro/tools/auth.php&response_type=code&scope=user:edit+user:edit:broadcast+channel_editor+channel_subscriptions');
			},
			error: function() {
				console.log('There was an error saving your channel ID locally');
			}
		});
	}
	</script>
</body>
</html>