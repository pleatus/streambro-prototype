<?php
	
	require_once('../connectvars.php');
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if (tableCheck($dbc)) {
		$query = "SELECT * FROM sb_countor";
		$results = mysqli_query($dbc,$query);
		
		/*foreach ($results as $result) {
			$wins = $result=>'ws';
			$losses = $result=>'ls';
			$inst = $result=>'inst';
		}	*/
		
		while ($cell = mysqli_fetch_array($results)) {
			$label = $cell['label'];
			$wins = $cell['ws'];
			$inst = $cell['inst'];
		}
		$outputStr = "$label $wins";
		//$outputStr .= " Instance: $inst";
		echo $outputStr;
		
		if (isset($_POST['counter'])){
			$caller = $_POST['counter'];
			if ($caller == 1) {
				$query = "SELECT ws FROM sb_countor";
				$results = mysqli_query($dbc,$query);
				while ($cell = mysqli_fetch_array($results)) {
					$wins = $cell['ws'];
				}
				$wins++;
				$query = "UPDATE sb_countor SET ws=$wins";
				mysqli_query($dbc,$query);
				$caller = 0;
			}
			if ($caller == 9) {
				$query = $query = "UPDATE sb_countor SET ws=0";
				mysqli_query($dbc,$query);
				$caller = 0;
			}
		}
		
			if (isset($_POST['label'])){
			$newLabel = $_POST['label'];
				$query = "UPDATE sb_countor SET label='$newLabel'";
				mysqli_query($dbc,$query);
		}
		
		mysqli_close($dbc);
		//$countI = $_POST['counter'];
	}
	
	function tableCheck($conn) {
		$querycheck='SELECT 1 FROM sb_countor';
		$query_tbl=mysqli_query($conn,$querycheck);
		if ($query_tbl !== false) {
			return true;
		} 
		else	{
			$query = 'CREATE TABLE sb_countor (
							label	VARCHAR(16)	DEFAULT "Count: ",
							ws	INT(4),
							dsp_profile	INT(3) DEFAULT 1,
							inst	INT(3) NOT NULL AUTO_INCREMENT,
							primary key(inst),
							foreign key (dsp_profile) references sb_tool_styles(style_id) 
							)';
			$query_cre = mysqli_query($conn,$query);
			$query = 'INSERT INTO sb_countor (ws) VALUES (0)';
			$query_cre = mysqli_query($conn,$query);
			return true;
		}
	}
?>