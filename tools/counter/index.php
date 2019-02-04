<?php
	$tool = 'Counter';
	require_once('../tool-styles.php');
	
?>
<html>
<head>
	<meta charset="utf-8">
    <meta name="author" content="Ray Jaworski">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Countor</title>
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
				color: #4ef84e;
				text-align:center;
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
			button.manCount {
				height:90px;
				width:90px;
				color: #fff;
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
			button#up {
				font-family: sans-serif;
			}
			#labelCh {
				border-radius:0.8em;
				text-align:center;
				margin-top:41px;
				padding:4.5px;
				width:306px;
				height:108px;
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
			.confirm {
				background-color: green;
			}
			.danger {
				background-color: red;
			}
			div#editTool label,div#editTool select,div#editTool input {
				display:block;
			}
			div#editTool input,div#editTool select {
				width:99%;
			}
			div#editTool select,div#editTool select {
				font-family: 'apple_regular';
			}
			div#editTool label.inl-inp {
				margin-bottom:18px;
			}
			div#editTool label.inl-inp,div#editTool label.inl-inp input {
				display:inline-block;
			}
			div#editTool label.inl-inp input {
				width:27px;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<main>
	<h2>Counter</h2><br><br>
	<div id="counterCurrent">loading</div><br>
	<div id="counterInputArea">
	<div class="btn-container">
		<button class="manCount centre-elem confirm" id="up" onclick="countUp();">++</button>
		<button class="manCount centre-elem danger" onclick="resetCountor();">Reset</button>
	</div>
				<div id="labelCh">
				<sup style="display:block;">New label: </sup>
				<input name="countorLabel" id="countorLabel" type="text">
				<button class="labeller" onclick="changeLabel();">Change Label</button>
				</div>
		<p id="upInfo">--updates every 10 seconds--</p>
		<p id="userOutput">loading</p>
	</div>
	<sub class="useInfo">Use the link below as a Browser Source input in OBS</sub><br>
	<sub class="useInfo" style="color:yellow;"><?php  $path = $_SERVER['HTTP_HOST']; echo 'https://' . $path . '/streamBro/tools/counter/display.php'; ?></sub>
	<?php
		require_once('../edit-display.php');
	?>
</main>
	<script src="dspCountor.js"></script>
	<script src="counterControl.js"></script>
</body>
</html>