$(document).ready( function () {
	//following line removes all images, looks bad on obs if nayone is hosting on top of you
	console.log('dspnotes is going');
	$("img").css("display", "none");
	//$("#counterCurrent").css({"position":"relative","top":"-18px"});
	getNotifications();
	if ($("body").data("title") == 'plgndsp') {
		var getCount = setInterval(function() {getCounter();},10000);
	}
});
window.onerror = function() {
	//comment out to debug, otherwise keep in so it doesnt throw known errors
	//return true;
}
function getNotifications () {
	console.log('getnotifications has been called from dspnotes');
	$.ajax({
		url:"streamNotes.php",
		type:"GET",
		success: function(result) {
			var noteReturn = result;
			setNotifier(noteReturn);
			alertOutput('Data received');
		},
		error: function() {
			alertOutput('There was an error getting the counter data');
		}
	});
}
function setNotifier(str) {
	$("#followDsp").html(str);
}