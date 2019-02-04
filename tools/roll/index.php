<html>
<head>
	<meta charset="utf-8">
    <meta name="author" content="Ray Jaworski">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Roll</title>
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
				position:relative;
			}
			.centre-elem {
				margin-left:auto;
				margin-right:auto;
				text-align: center;
			}
			div.btn-container {
				margin-top: 54px;
				width: 100%;
				text-align: center;
			}
			button.manCount {
				display:inline-block;
				height:90px;
				width:90px;
				border-radius: 0.8em;
			}
			button.reset {
				display:block;
				margin-top:9px;
				height: 90px;
				width: 198px;
				border-radius: 0.8em;
			}
			button.labeller {
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
			#labelCh {
				border-radius:0.8em;
				text-align:right;
				margin-top:41px;
				padding:4.5px;
				width:306px;
				height:63px;
				background-color:#a1a1a1;
				border:2px dotted gray;
			}
			#labelCh>sup, #labelCh>input, #labelCh>button {
				color:#090909;
			}
			#userOutput {
				color: #4ef84e;
				font-size: 0.8em;
			}
			.useInfo {
				font-size:.5em;
			}
			.caution {
				background-color: yellow;
				color:#090909;
			}
			.confirm {
				background-color: green;
				color:#fff;
				font-size: 0.8em;
			}
			.danger {
				background-color: red;
				color:#fff;
			}
			div.plaqBod {
				position:absolute;
				top:0px;
				left:0px;
				display:inline-block;
				width:300px;
				height: 63px;
				margin: 1px;
				text-align:center;
				background-color: #090909;			
			}
			p.plaqTxt {
				margin:auto;
			}
			button:disabled {
				background-color:#696969;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<main>
	<h2>Roll</h2><br><br>
	<div id="counterCurrent">loading</div><br>
	<div id="counterInputArea">
	<div class="btn-container">
	<button class="manCount centre-elem caution" id="startRoll">Start</button>
	<button class="manCount centre-elem confirm" id="pickWin">Result</button>
	<button class="reset centre-elem danger" id="stopRoll">Reset/Stop</button>
	</div>
	<div id="labelCh">
		<input type="number" max="16" min ="2" name="optionAmount" value="4" id="optionAmount"><button id="popOptions">Fill options</button>
	</div>
		<p id="upInfo">--in development--</p>
		<p id="userOutput">loading</p>
	</div>
	<sub class="useInfo">Use the link below as a Browser Source input in OBS</sub><br>
	<sub class="useInfo" style="color:yellow;"><?php  $path = $_SERVER['HTTP_HOST']; echo 'https://' . $path . '/streamBro/tools/roll/display.php'; ?></sub>
</main>
	<script src="dspRoll.js"></script>
	<script src="rollControl.js"></script>
</body>
</html>