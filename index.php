<!doctype html>
<html lang ="en">
	<head>
	<meta charset="utf-8">
	<title>streamBro prototype Demo || Stream Tools</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="wrapper fluid-container">
	<div class="row" id="header">
		<div class="col-md-12">
			<h1>streamBro prototype Demo || Stream Tools</h1>
			<div id="topText"><p>chillbrobagg1ns</p></div>
		</div>
	</div>

	<div class="row">
		<div id="toolNav" class="col-md-4">
		<div id="appSmSr">
			<p id="smAppLabel">Tools</p>
		</div>
		<div class="localAppList mobile-menu">Local</div>
			<ul class="appListSm mobile-menu">
				<a onclick="loadCounter()" title="Counter"><li>Counter</li></a>
				<a onclick="loadSubGoal()" title="Goal Tracker"><li>Goal Tracker</li></a>
				<a onclick="loadRoll()" title="Roll"><li>Roll</li></a>
				<a onclick="loadSpinner()" title="Spinner*"><li>Spinner*</li></a>
				<a onclick="loadTracker()" title="Wins/Losses*"><li>Wins/Losses*</li></a>
			</ul>
		<div class="intAppList mobile-menu">Integrated</div>
			<ul class="appListSm mobile-menu">
				<a onclick="loadStreamMeta()" title="Stream Meta"><li>Stream Meta*</li></a>
				<a onclick="loadNotifier()" title="Notifier"><li>Notifier*</li></a>
			</ul>
		<div class="localAppList">Local</div>
				<ul class="appListLg">
					<li><button id="counter-btn" class="app-btn" onclick="loadCounter()" title="Counter">Counter</button></li>
					<li><button id="goal-btn" class="app-btn" onclick="loadGoalTracker()" title="Goal Tracker">Goal Tracker</button></li>
					<li><button id="roll-btn" class="app-btn" onclick="loadRoll()" title="Roll">Roll</button></li>
					<li><button id="spinner-btn" class="app-btn" onclick="loadSpinner()" title="Spinner*">Spinner*</button></li>
					<li><button id="tracker-btn" class="app-btn" onclick="loadTracker()" title="Wins/Losses*">Wins/Losses*</button></li>
				</ul>
		<div class="intAppList">Integrated</div>
				<ul class="appListLg">
					<li><button id="stream-meta-btn" class="app-btn" onclick="loadStreamMeta()" title="Stream Meta">Stream Meta*</button></li>
					<li><button id="notifier-btn" class="app-btn" onclick="loadNotifier()" title="Notifier">Notifier*</button></li>
				</ul>
		</div>
		<div id="activeTool" class="col-md-8">
			<iframe id="toolHolder">loading</iframe>
		</div>
	</div>
	<span id="viewCheck"></span>
<div class="row" id="footer">
<div class="col-md-12">
<p>All elements of this page, including images, and source code are Copyright <a href="https://twoson.000webhostapp.com" target="about_blank" title="rj media"><img class="copyImg" src="rjmedialogo.gif" width="19px" height="19px"></a> &copy; <span id="copyDate"></span> Designed and created in Winnipeg, Canada.</p>
</div>
</div>
</div>
<script src="js/getdate.js"></script>
<script src="js/control.js"></script>
</body>
</html>