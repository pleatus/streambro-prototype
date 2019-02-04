<?php
require_once('cid.php');

if(isset($_GET['code'])) {
	$code = $_GET['code'];
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
			div#counterCurrent {
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
	<h2>streamBro Authorization</h2><br><br>
	<div id="counterInputArea">
		<h3>Click the button below to authorize streamBro to make changes on your behalf (change channel title, game title)</h3>
		<input type="hidden" name="auCode" id="auCode" value="<?php echo $code ?>">
		<input type="hidden" name="cid" id="cid" value="<?php echo APP_CLIENT_ID; ?>">
		<input type="hidden" name="sec" id="sec" value="<?php echo APP_CLIENT_SEC; ?>">
		<button onclick="authorizesB()">Authorize!</button>
	</div>
</main>
	<script>
	function authorizesB() {
		var cid = $('#cid').val();
		var sec = $('#sec').val();
		var auCode = $('#auCode').val();
		var redUrl = "https://id.twitch.tv/oauth2/token?client_id=" + cid + "&client_secret=" + sec + "&code=" + auCode + "&grant_type=authorization_code&redirect_uri=http://localhost/streamBro/tools/auth.php";
		console.log(redUrl);
		$.ajax({
			type:"POST",
			url:redUrl,
			success: function(result) {
				console.log(result);
				storeToke(result);
			},
			error: function() {
				console.log('there was an error authorizing ya shit');
			}
		});
	}
	//function gets token from api return and sends it to php file so it can be written to file
	function storeToke(res){
		var toke = res.access_token;
		var toke = "toke=" + toke;
		$.ajax({ 
			url:'sb-auth.php',
			type:"POST",
			data:toke,
			success: function(result) {
				console.log(result);
			},
			error: function() {
				console.log('There was an error saving your access token locally');
			}
		});
	}
	</script>
	<?php
		}
		else {
			echo 'something is wong';
		}
	?>
</body>
</html>