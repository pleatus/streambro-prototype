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
$("#countorLabel").keyup( function (event) {
	if (event.which == 13) {
		changeLabel();
	}
});
$("#goalLabel").keyup( function (event) {
	if (event.which == 13) {
		changeGoal();
	}
});

function countUp() {
	postAjax("counter=1");
}
function resetCountor() {
	if (promptPass()) {
		postAjax("counter=9");
	}
}
function changeLabel () {
	var newLabel = $("#countorLabel").val();
	if (promptPass()) {
		postAjax("label=",newLabel);
	}
}
function changeGoal () {
	var newGoal = $("#goalLabel").val();
	if (promptPass()) {
		postAjax("goal=",newGoal);
	}
}
function alertOutput(str) {
	$("#userOutput").html(str);
	setTimeout(function() {
		rdyStr = "Ready";
		$("#userOutput").html(rdyStr);
	},1500);
		
}

function postAjax(data,label) {
	var sendT = data;
	var sOut = "Success message not set!", fOut = "Error message not set!";
	if (data == "counter=1") {
		sOut = 'Progress increased by one', fOut = 'There was an error setting the goal data';
	}
	if (data == "counter=9") {
		sOut = 'Progress reset to zero', fOut = 'There was an error resetting the goal data';
	}
	if (label != null) {
		sendT += label;
		sOut = 'Goal label changed to ' + label, fOut = 'There was an error setting the goal label';
		if (isNaN(label)) {
			sOut = 'Goal changed to ' + label, fOut = 'There was an error setting goal';
		}		
	}
	$.ajax({
			url:"goalTracker.php",
			type:"POST",
			beforeSend: function (xhr) {
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			},
			data: sendT,
			success: function() {
				alertOutput(sOut);
				getCounter();
			},
			error: function() {
				alertOutput(fOut);
			}
		});
}