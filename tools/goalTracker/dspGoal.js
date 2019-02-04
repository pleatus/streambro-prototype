$(document).ready( function () {
	//following line removes all images, looks bad on obs if nayone is hosting on top of you
	$("img").css("display", "none");
	//$("#counterCurrent").css({"position":"relative","top":"-18px"});
	getCounter();
	if ($("body").data("title") == 'plgndsp') {
		var getCount = setInterval(getCounter,10000);
	}
});
window.onerror = function() {
	//comment out to debug, otherwise keep in so it doesnt throw known errors
	//return true;
}

function getCounter () {
	$.ajax({
		url:"goalTracker.php",
		type:"GET",
		success: function(result) {
			console.log(result);
			var countReturn = result;
			setCounter(countReturn);
			alertOutput('Data received');
		},
		error: function() {
			alertOutput('There was an error getting the counter data');
		}
	});
}
function setCounter(str) {
	$("#counterCurrent").html(str);
}