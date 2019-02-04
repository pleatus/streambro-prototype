<?php
	
	require_once('../connectvars.php');
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if (tableCheck($dbc)) {
		$query = "SELECT * FROM sb_notify";
		$results = mysqli_query($dbc,$query);
		
		/*foreach ($results as $result) {
			$wins = $result=>'ws';
			$losses = $result=>'ls';
			$inst = $result=>'inst';
		}	*/
		
		while ($cell = mysqli_fetch_array($results)) {
			$message_0 = $cell['message_con_0'];
			$message_1 = $cell['message_con_1'];
			$dsp_prof = $cell['dsp_profile'];
		}
		$username = "Chillbro";
		$outputStr = "<div class='notifyMessage'><span class='messageContent0'>" . $message_0 . "</span><span class='username'>" . $username . "</span><span class='messageContent1'>" . $message_1 . "</span></div>";
		//$outputStr .= " Instance: $inst";
		echo $outputStr;
		/*		
		if (isset($_POST['title'])){
			$newStTitle = $_POST['title'];
			$query = "UPDATE sb_notify SET title='$newStTitle'";
			mysqli_query($dbc,$query);
		}
		if (isset($_POST['game'])){
			$newGaTitle = $_POST['game'];
			$query = "UPDATE sb_notify SET game='$newGaTitle'";
			mysqli_query($dbc,$query);
		}
		*/
		mysqli_close($dbc);
		//$countI = $_POST['counter'];
	}
	function tableCheck($conn) {
		$querycheck='SELECT 1 FROM sb_notify';
		$query_tbl=mysqli_query($conn,$querycheck);
		if ($query_tbl !== false) {
			return true;
		} 
		else	{
			//notify types are 10 = test, 20 = follow, 30 = subscription
			/*				notify_type		INT(2),
							notify_time		TIMESTAMP,*/
			$query = 'CREATE TABLE sb_notify (
							message_con_0	VARCHAR(255),
							message_con_1	VARCHAR(255),
							dsp_profile		INT(3),
							inst	INT(3) NOT NULL AUTO_INCREMENT,
							primary key(inst)
							)';
			$query_cre = mysqli_query($conn,$query);
			$query = 'INSERT INTO sb_notify (message_con_0,message_con_1,dsp_profile) VALUES ("Whoa! "," is now following!!",1)';
			$query_cre = mysqli_query($conn,$query);
			return true;
		}
		mysqli_close($dbc);
	}
?>