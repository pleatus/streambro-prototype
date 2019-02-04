$(document).ready( function () {
	//following line removes all images, looks bad on obs if nayone is hosting on top of you
	$("img").css("display", "none");
	$('#pickWin').prop('disabled', true);
	setCode10();
	//$("#counterCurrent").css({"position":"relative","top":"-18px"});
	var getVars = setInterval(function() {getVarCode();},2160);
	getCounter();
	$('#startRoll').click(function() { setCode21(); });
	//setInterval(getCounter,10000);
});
window.onerror = function() {
	//comment out to debug, otherwise keep in so it doesnt throw known errors
	//return true;
}

function alertOutput(str) {
	if ($("body").data("title") != 'plgndsp') {
		$("#userOutput").html(str);
		setTimeout(function() {
			rdyStr = "Ready";
			$("#userOutput").html(rdyStr);
		},1500);
	}
	else {
		return false;
	}
}

function getVarCode () {
	$.ajax({
		url:"appvars.php",
		type:"GET",
		success: function(result) {
			var varCode = result;
			storeVarCode(varCode);
			alertOutput('Code received')
		},
		error: function() {
			alertOutput('Error getting op code');
		}
	});
}
function changeVarCode(x,code) {
	var sendV = code + '' + x;
		$.ajax({
			url:"appvars.php",
			type:"POST",
			beforeSend: function (xhr) {
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			},
			data: sendV,
			success: function() {
				alertOutput('Op code changed');
			},
			error: function() {
				alertOutput('Error changing op code');
			}
		});
}

var lastCode = '00';

function storeVarCode(code) {
	if(code != lastCode) {
		if(code == 10) {
			//default start state
			//console.log("code set to 10");
			$('#startRoll').prop('disabled', false);
			showAllPlq();
			$('#pickWin').prop('disabled', true);
		}
		if(code == 20) {
			//default static state
			//console.log("code set to 10");
			clearInterval(plaqAn);
			$('#startRoll').prop('disabled', false);
			$('.plaqBod').stop();
			total = plaqRunIntTot;
			showAllPlq();
			$('#pickWin').prop('disabled', true);
		}
		if(code == 11) {
			//spin down/result
			setTimeout(function () {
				$('#pickWin').prop('disabled', true);
				$('#startRoll').prop('disabled', true);
				clearInterval(plaqAn);
				$('.plaqBod').stop();
				finale();
			},
			3300);
			//console.log("code set to 11");
		}
		if(code == 21) {
			//spinning mode
			$('#startRoll').prop('disabled', true);
			$('#pickWin').prop('disabled', false);
			$('#pickWin').click(function() {
				$(this).prop('disabled', true);
			});
			plaqRunIntTot = totalPlaq();
			total = plaqRunIntTot;
			plaqAn = setInterval(runPlaques,300);
			//console.log("code set to 21");
		}
		lastCode = code;
	}
	//console.log("code: " + code);
}
function setCode10() {
	changeVarCode(1,'rState=');
	changeVarCode(0,'sState=');
}
function setCode11() {
	changeVarCode(1,'rState=');
	changeVarCode(1,'sState=');
}
function setCode20() {
	changeVarCode(2,'rState=');
	changeVarCode(0,'sState=');
}
function setCode21() {
	changeVarCode(2,'rState=');
	changeVarCode(1,'sState=');
}
function getCounter () {
	$.ajax({
		url:"roll.php",
		type:"GET",
		success: function(result) {
			var rollOps = result;
			setOptions(rollOps);
			alertOutput('Options data received');
		},
		error: function() {
			alertOutput('Error getting options data');
		}
	});
}
function setOptions(str) {
	$("#counterCurrent").html(str);
	var opLabels = str.split(',');
	buildPlaque(opLabels);
	//console.log(opLabels);
}
function buildPlaque(ops) {
	var plaqHolder = new Array();
	for (var i = 0; i < ops.length; i++) {
		var plaqBod = "<div z-index='" + i + "05' id='op_" + i + "' class='plaqBod'><p class='plaqTxt'>"
		plaqBod += ops[i] + "</p></div>";
		plaqHolder.push(plaqBod);
	}
	dispPlaque(plaqHolder);
}

function dispPlaque(holder) {
	var dspAr = document.getElementById("counterCurrent");
	dspAr.innerHTML = "";
	for (var i = 0; i < holder.length;i++) {
		dspAr.innerHTML += holder[i];
	}
	$('#stopRoll').click(function() { setCode20(); });
	$('#pickWin').click(function() { setCode11(); });
}

function totalPlaq() {
	var allPl = document.getElementsByClassName('plaqBod');
	var x = allPl.length;
	//console.log('i frome totalplaq ' + x);
	return x - 1;
}

function runPlaques() {
	//console.log(total + " total from runPl");
	$('#op_' + total + '').fadeOut(200);


	//console.log(plaqRunIntTot);
	total--;
	if (total < 0) {
		total = plaqRunIntTot;
		showAllPlq();
	}
}
function showAllPlq() {
	$('.plaqBod').fadeIn(200);
}
function finale() {
	selectWinner();
}
function selectWinner() {
	console.log('selectwinner call both pages');
	if ($("body").data("title") != 'plgndsp') {
		console.log('selectwinner call from control page ONLY');
		var entries = plaqRunIntTot;
		var ranWin = Math.floor(Math.random() * entries);
		var sendP = "pick=" + ranWin;
		$.ajax({
			url:"result.php",
			type:"POST",
			beforeSend: function (xhr) {
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			},
			data: sendP,
			success: function() {
				alertOutput('Result set');
				//console.log('result set');
				getWinner();
				//getCounter();
			},
			error: function() {
				alertOutput('Error setting result');
				//console.log('error setting result');
			}
		});
	}
	else {
		setTimeout(function(){
			getWinner();
		},1000);
	}
	
}

function getWinner() {
		$.ajax({
		url:"result.php",
		type:"GET",
		success: function(result) {
			winner = result;
			alertOutput('Winner: ' + (parseInt(winner) + 1));
			showWinner(winner);
			//console.log('winner recorded:' + winner);
		},
		error: function() {
			alertOutput('Error getting the winner');
			//console.log('error recording winner');
		}
	});
}

function showWinner(w) {
	console.log('the winner from showwinner is: ' + w);
	$('.plaqBod').hide();
	$('#op_' + w + '').fadeIn(400);
}