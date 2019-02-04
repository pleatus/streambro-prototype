$(document).ready(function (){
	firstRunCheck();
	init();
	checkView();
	$(window).resize(checkView);
	$("#smAppLabel").hover(
		function () {
			if ($(".appListSm").is(":hidden")) {
				$(this).text('Tools ˅');
			}
			else {
				$(this).text('Tools ^');
			}
		},
		function () {
			if ($(".appListSm").is(":hidden")) {
				$(this).text('Tools');
			}
			else {
			$(this).text('Tools ^');
			}
		});
		$('#smAppLabel').click( function() {
				//$(".appListSm").prev('div').show();
				$(".appListSm").prev('div').slideToggle('fast', function () {
						$("#smAppLabel").text('Tools ^');
						if ($(this).is(":hidden")) {
							$('.mobile-menu').hide();
							$("#smAppLabel").text('Tools');
						}
					});
				});
		$('.localAppList').click(function() {
			$('.intAppList').next('.appListLg').hide();
			$(this).next('.appListLg').slideToggle('fast', function () {
				console.log('menu local collapsed');
			});
			$(this).next('.appListSm').slideToggle('fast', function () {
				console.log('mobile menu local collapsed');
			});
		});
		$('.intAppList').click(function() {
			$('.localAppList').next('.appListLg').hide();
			$(this).next('.appListLg').slideToggle('fast', function () {
				console.log('menu local collapsed');
			});
			$(this).next('.appListSm').slideToggle('fast', function () {
				console.log('mobile menu local collapsed');
			});
		});
		$('#topText').click(function() {
			init();
		});
	});
//init function loads the main splash page
function init() {
	$("#toolHolder").attr('src','tools/splash.html');
}
//if being run for the first time this function will guide the user through the process of creating an account and authorizing the app with twitch api
function firstRunCheck() {
	$.ajax({
			type:"GET",
			url:'/streamBro/tools/firstrun.php',
			data:'firstrun=check',
			success: function(result) {
				console.log(result);
				firstRunResult(result);
			},
			error: function() {
				console.log('there was an error authorizing ya shit');
			}
		});
}
function firstRunResult(res) {
	if (res == 'exists') {
		//start streamBro
		init();
	}
	else if (res == 'created') {
		//continue sign up
		console.log('sb_user table has been created, continue to next step');
		window.location.replace('welcome.php');
		//goto welcome.php
	}
	else if (res == 'error') {
		console.log('there was an error creating your user account');
		init();
	}
}
function hideSecMenu() {
	$('.intAppList').next('.appListLg').hide();
	$('.intAppList').next('.appListSm').hide();
}
function checkView() {
	if ($("#viewCheck").css("float") == "none" ) {
		//mobile view
		//set-up the mobile view
		$('.localAppList').css({'height':'28px','font-size':'1em'});
		$('.intAppList').css({'height':'28px','font-size':'1em'});
		$('#toolNav').css('padding-bottom','4px');
		$('.appListLg').prev('div').hide();
		$('.appListLg').hide();
		$("#header h1").css('font-size','.6em');
		$("#footer p").css('font-size','.6em');
		$(".appListSm").prev('div').hide();
		$(".appListSm").hide();
		$("#smAppLabel").show();
		$("#smAppLabel").text('Tools ˅');
		hideSecMenu();
		}
	if ($("#viewCheck").css("float") == "left" ) {
		//full view
		//set-up the full view
		$('.localAppList').css({'height':'44px','font-size':'1.4em'});
		$('.intAppList').css({'height':'44px','font-size':'1.4em'});
		$('#toolNav').css('padding-bottom','0px');
		$('.appListLg').prev('div').show();
		$('.appListLg').show();
		$("#header h1").css('font-size','1.6em');
		$("#footer p").css('font-size','1em');
		$("#smAppLabel").hide();
		$(".appListSm").prev('div').hide();
		$(".appListSm").hide();
		hideSecMenu();
	}
}
//following functions load each tool into the tool pane when it's button is clicked
function loadCounter() {
	$("#toolHolder").attr('src','tools/counter/index.php');
	/*$("#counter-btn").click(function() {
		$(this).addClass('selected');
	});*/
}
function loadTracker() {
	$("#toolHolder").attr('src','tools/recordTracker/index.html');
}
function loadGoalTracker() {
	$("#toolHolder").attr('src','tools/goalTracker/index.php');
}
function loadRoll() {
	$("#toolHolder").attr('src','tools/roll/index.php');
}
function loadSpinner() {
	$("#toolHolder").attr('src','tools/spinner/spinner.html');
}
function loadStreamMeta () {
	$("#toolHolder").attr('src','tools/streamMeta/index.php');
}
function loadNotifier() {
	$("#toolHolder").attr('src','tools/notifier/index.php');
}