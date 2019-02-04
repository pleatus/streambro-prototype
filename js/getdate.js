$(document).ready(function (){
	var d = new Date();
	var year = d.getFullYear();
	checkDate(year);
});

function checkDate(y) {
	$("#copyDate").text(y);
}