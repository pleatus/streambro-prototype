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





function postAjax(data,label) {
	var sendT = data;
	var sOut = "Success message not set!", fOut = "Error message not set!";
	if (data.substr(0,5) == "upOp=") {
		sOut = data.substr(6) + 'options set', fOut = 'Error setting options';
	}
	$.ajax({
			url:"roll.php",
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

$(document).ready(function() {
	resetOpField();
});

function createOpList(x) {
	var opInputs = '';
	for (var i = 0;i < x;i++) {
		opInputs += '<label for="op' + i + '">' + (i + 1) + '<input value="Option ' + (i + 1) + '" class="opLabels" type="text" style="width:81%;" name="op' + i + '" id="op' + i + '"></label><br>';
	}
	opInputs += '<button id="commitOps">Update</button>';
	$('#labelCh').height((45 * x) + 30);
	$('#labelCh').html(opInputs);
	$('#commitOps').click(function () {
		if (promptPass()) {
			prepareOptions(x);
		}
		else {
			resetOpField();
		}
	});
}

function prepareOptions(x) {
	var labels = new Array();
	for (var j = 0;j < x;j++) {
		var label = $('#op' + j + '').val();
		labels.push(label);
	}	
	console.log(labels);
	var qAr = new Array;
	qAr.push('upOp=' + x);
	for (var i = 0;i < labels.length;i++) {
		qAr.push("op_" + i + "=" + labels[i] +"");
	}
	var qString = qAr.join('&');
	console.log(qString);
	postAjax(qString);
	resetOpField();
}

function resetOpField() {
	$('#labelCh').html('');
	$('#labelCh').html('<input type="number" max="16" min ="2" name="optionAmount" value="4" id="optionAmount"><button id="popOptions">Fill options</button>');
	$('#labelCh').height(63);
	$('#popOptions').click(function() {
		var totalOps = $('#optionAmount').val();
		createOpList(totalOps);
	});
}