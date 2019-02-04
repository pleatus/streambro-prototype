<?php
	
	require_once('../connectvars.php');
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if (tableCheck($dbc)) {
		$query = "SELECT * FROM sb_stream_meta";
		$results = mysqli_query($dbc,$query);
		
		/*foreach ($results as $result) {
			$wins = $result=>'ws';
			$losses = $result=>'ls';
			$inst = $result=>'inst';
		}	*/
		
		while ($cell = mysqli_fetch_array($results)) {
			$stream_title = $cell['title'];
			$game_title = $cell['game'];
		}
		$outputStr = "<div class='streamMetaCon'><div class='streamMetaLabel'>Stream Title:</div><div class='streamMetaLabel'>" . $stream_title . "</div><div class='streamMetaLabel'>Game Title:</div><div class='streamMetaLabel'>" . $game_title . "</div></div>";
		//$outputStr .= " Instance: $inst";
		echo $outputStr;
				
		if (isset($_POST['title'])){
			$newStTitle = $_POST['title'];
			$query = "UPDATE sb_stream_meta SET title='$newStTitle'";
			mysqli_query($dbc,$query);
		}
		if (isset($_POST['game'])){
			$newGaTitle = $_POST['game'];
			$query = "UPDATE sb_stream_meta SET game='$newGaTitle'";
			mysqli_query($dbc,$query);
		}
		
		mysqli_close($dbc);
		//$countI = $_POST['counter'];
	}
	function tableCheck($conn) {
		$querycheck='SELECT 1 FROM sb_stream_meta';
		$query_tbl=mysqli_query($conn,$querycheck);
		if ($query_tbl !== false) {
			return true;
		} 
		else	{
			$query = 'CREATE TABLE sb_stream_meta (
							title	VARCHAR(54)	DEFAULT "My Stream",
							game	VARCHAR(54)	DEFAULT "My New Game",
							inst	INT(3) NOT NULL AUTO_INCREMENT,
							primary key(inst)
							)';
			$query_cre = mysqli_query($conn,$query);
			$query = 'INSERT INTO sb_stream_meta (title) VALUES ("Streaming with streamBro")';
			$query_cre = mysqli_query($conn,$query);
			return true;
		}
	}
?>