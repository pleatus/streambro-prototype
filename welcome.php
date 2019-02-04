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
		<h3>Thanks for using streamBro! Please start by providing information to create your streamBro account.</h3>
		<!--<input type="hidden" name="auCode" id="auCode" value="<?php /*echo $code */?>">-->
		<label for="recEmail">Email (for recovery):
		<input type="email" class="signup" name="recEmail" id="recEmail"></label>
		<label for="sbUsername">streamBro Username:
		<input type="text" class="signup" name="sbUsername" id="sbUsername"></label>
		<label for="sbPass">streamBro Password:
		<input type="password" class="signup" name="sbPass" id="sbPass"></label>
		<label for="sbPassConfirm">Confirm streamBro Password:
		<input type="password" class="signup" name="sbPassConfirm" id="sbPassConfirm"></label>
		<label for="sbPin">streamBro PIN:
		<input type="number" class="signup" name="sbPin" id="sbPin"></label>
		<label for="sbPinConfirm">Confirm streamBro PIN:
		<input type="number" class="signup" name="sbPinConfirm" id="sbPinConfirm"></label>
		<button onclick="createNewAccount()">Create Account</button>
	</div>
</main>
	<script>
	function createNewAccount() {
		var sbPass = $('#sbPass').val();
		var sbPassConfirm = $('#sbPassConfirm').val();
		//check passwords to see if they match
		if (sbPass === sbPassConfirm) {
			var sbPin = $('#sbPin').val();
			var sbPinConfirm = $('#sbPinConfirm').val();
			if (sbPin === sbPinConfirm) {
				let recEmail = $('#recEmail').val();
				let sbUsername = $('#sbUsername').val();
				let pack = 'em=' + recEmail + '&usr=' + sbUsername + "&pass=" + sbPass + "&pin=" +sbPin;
				$.ajax({
					type:"POST",
					url:"/streamBro/tools/firstrun.php",
					data:pack,
					success: function(result) {
						console.log(result);
						window.location.href = "welcome2.php";
					},
					error: function() {
						console.log('there was an error creating ya shit');
					}
				});
			}
			else {
				//pins did not match, throw error
				alert("PINs did not match, please try again.");
			}
		}
		else {
			//pass did not match throw error
			alert("Passwords did not match, please try again.");
		}
	}
	</script>
</body>
</html>