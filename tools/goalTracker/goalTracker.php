<?php
	
	require_once('../connectvars.php');
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if (tableCheck($dbc)) {
		$query = "SELECT * FROM sb_goal_track";
		$results = mysqli_query($dbc,$query);
		
		/*foreach ($results as $result) {
			$wins = $result=>'ws';
			$losses = $result=>'ls';
			$inst = $result=>'inst';
		}	*/
		
		while ($cell = mysqli_fetch_array($results)) {
			$label = $cell['label'];
			$actual = $cell['actual'];
			$goal = $cell['goal'];
		}
		$outputStr = "$label $actual / $goal";
		//$outputStr .= " Instance: $inst";
		echo $outputStr;
		
		if (isset($_POST['counter'])){
			$caller = $_POST['counter'];
			if ($caller == 1) {
				$query = "SELECT actual FROM sb_goal_track";
				$results = mysqli_query($dbc,$query);
				while ($cell = mysqli_fetch_array($results)) {
					$actual = $cell['actual'];
				}
				$actual++;
				$query = "UPDATE sb_goal_track SET actual=$actual";
				mysqli_query($dbc,$query);
				$caller = 0;
			}
			if ($caller == 9) {
				$query = $query = "UPDATE sb_goal_track SET actual=0";
				mysqli_query($dbc,$query);
				$caller = 0;
			}
		}
		
		if (isset($_POST['goal'])) {
			$newGoal = $_POST['goal'];
			$query = "UPDATE sb_goal_track SET goal='$newGoal'";
			mysqli_query($dbc,$query);
		}
		
		if (isset($_POST['label'])){
		$newLabel = $_POST['label'];
			$query = "UPDATE sb_goal_track SET label='$newLabel'";
			mysqli_query($dbc,$query);
		}
		
		mysqli_close($dbc);
		//$countI = $_POST['counter'];
	}
	function tableCheck($conn) {
		$querycheck='SELECT 1 FROM sb_goal_track';
		$query_tbl=mysqli_query($conn,$querycheck);
		if ($query_tbl !== false) {
			return true;
		} 
		else	{
			$query = 'CREATE TABLE sb_goal_track (
							label	VARCHAR(16)	DEFAULT "Goal: ",
							actual	INT(4),
							goal	INT(4),
							inst	INT(3) NOT NULL AUTO_INCREMENT,
							primary key(inst)
							)';
			$query_cre = mysqli_query($conn,$query);
			$query = 'INSERT INTO sb_goal_track (goal,actual) VALUES (10,0)';
			$query_cre = mysqli_query($conn,$query);
			return true;
		}
	}
?>