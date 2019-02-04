<?php
require_once('connectvars.php');
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$query = "SELECT pick FROM sb_roll";
$result = mysqli_query($dbc,$query);

while ($cell = mysqli_fetch_array($result)) {
	$pick = $cell['pick'];
}

if (isset($_POST['pick'])) {
	$pick = $_POST['pick'];
	$query = "UPDATE sb_roll SET pick=$pick";
	$updateS = mysqli_query($dbc,$query);
}

echo $pick;

?>