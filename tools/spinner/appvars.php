<?php
require_once('connectvars.php');
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$query = "SELECT s_var,sp_var FROM sb_roll";
$result = mysqli_query($dbc,$query);

while ($cell = mysqli_fetch_array($result)) {
	$refreshState = $cell['s_var'];
	$rollState = $cell['sp_var'];
}

if (isset($_POST['rState'])) {
	$rState = $_POST['rState'];
	$query = "UPDATE sb_roll SET s_var=$rState";
	$updateS = mysqli_query($dbc,$query);
}
if (isset($_POST['sState'])) {
	$sState = $_POST['sState'];
	$query = "UPDATE sb_roll SET sp_var=$sState";
	$updateS = mysqli_query($dbc,$query);
}

echo $refreshState . '' . $rollState;

?>