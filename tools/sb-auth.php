<?php

	if(isset($_POST['userid'])) {
		$id = $_POST['userid'];
		//$id = "userid:" . $id . ",\n";
		$pOpen = "<?php \n";
		$dStart = "define('APP_U_ID','";
		$dEnd = "'); \n";
		$credFile = fopen("creds.php","w");
		fwrite($credFile,$pOpen);
		fwrite($credFile,$dStart);
		fwrite($credFile,$id);
		fwrite($credFile,$dEnd);
		fclose($credFile);
		echo "User ID saved to file.";
	}
	
	if(isset($_POST['toke'])) {
		$toke = $_POST['toke'];
		//$toke = "toke:" . $toke;
		$dStart = "define('APP_TOKE','";
		$dEnd = "'); \n";
		$pEnd = "?>";
		$credFile = fopen("creds.php","a");
		fwrite($credFile,$dStart);
		fwrite($credFile,$toke);
		fwrite($credFile,$dEnd);
		fwrite($credFile,$pEnd);
		fclose($credFile);
		echo "Access token saved to file.";
	}