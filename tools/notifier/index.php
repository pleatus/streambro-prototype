<?php
	require_once('../cid.php');
	require_once('../creds.php');
	$tool = 'Notifier';
	require_once('../tool-styles.php');
	
?>
<html>
<head>
	<meta charset="utf-8">
    <meta name="author" content="Ray Jaworski">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>StreamMeta</title>
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
	<h2>Notifier</h2><br><br>
	<div id="followDsp">
	</div>
	<button onclick="testFollow()">Test Follow</button>
	<button onclick="getTwitchFollows()">Get Follows</button>
	<button onclick="getTwitchSubs()">Get Subscribers</button>
	<div id="counterInputArea">

		<p id="upInfo">--updates every 10 seconds--</p>
		<p id="userOutput">loading</p>
	</div>
	<sub class="useInfo">Use the link below as a Browser Source input in OBS</sub><br>
	<sub class="useInfo" style="color:yellow;"><?php  $path = $_SERVER['HTTP_HOST']; echo 'https://' . $path . '/streamBro/tools/goalTracker/display.php'; ?></sub>
	<?php
		include_once('../edit-display.php');
	?>
</main>
	<input type="hidden" name="uid" id="uid" value="<?php echo APP_U_ID; ?>">
	<input type="hidden" name="cid" id="cid" value="<?php echo APP_CLIENT_ID; ?>">
	<input type="hidden" name="toke" id="toke" value="<?php echo APP_TOKE; ?>">
	<script src="dspNotes.js"></script>
	<script src="notifyControl.js"></script>
</body>
</html>