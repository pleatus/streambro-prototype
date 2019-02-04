<?php
	
	require_once('../connectvars.php');
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$rollLength = 16;
	if (tableCheck($dbc)) {
		$query = "SELECT * FROM sb_roll";
		$results = mysqli_query($dbc,$query);
				
		$getOps = array();
		
		while ($cell = mysqli_fetch_array($results)) {
			for ($i = 0; $i < $rollLength; $i++) {
				$getOps[$i] = $cell['op_' . $i . ''];
			}
		}
		
		$ops = array();
		
		for ($i = 0;$i < count($getOps);$i++) {
			if ($getOps[$i] != null) {
				$ops[$i] = $getOps[$i];
			}
		}
		
		$outputStr = implode(',',$ops);
		if ($outputStr == null) {
			$outputStr = 'all entries are null';
		}			

		echo $outputStr;
		
		if (isset($_POST['goal'])) {
			$newGoal = $_POST['goal'];
			$query = "UPDATE sb_roll SET goal='$newGoal'";
			mysqli_query($dbc,$query);
		}
		
		if (isset($_POST['upOp'])){
			if(nulVals($dbc)) {
				$opsC = array();
				$opNo = $_POST['upOp'];
				for ($i = 0;$i < $opNo;$i++) {
						$singOp = $_POST['op_' . $i . ''];
						$opsC[$i] = "op_$i='$singOp'";
				}
				$qValues = implode(',',$opsC);
				echo $qValues;
				$uQuery = "UPDATE sb_roll SET $qValues ";
				mysqli_query($dbc,$uQuery);
			}
		}
		
		mysqli_close($dbc);
		//$countI = $_POST['counter'];
	}
	function tableCheck($conn) {
		$querycheck='SELECT 1 FROM sb_roll';
		$query_tbl=mysqli_query($conn,$querycheck);
		if ($query_tbl !== false) {
			return true;
		} 
		else	{
			$query = 'CREATE TABLE sb_roll (
							op_0	VARCHAR(27),
							op_1	VARCHAR(27),
							op_2	VARCHAR(27),
							op_3	VARCHAR(27),
							op_4	VARCHAR(27),
							op_5	VARCHAR(27),
							op_6	VARCHAR(27),
							op_7	VARCHAR(27),
							op_8	VARCHAR(27),
							op_9	VARCHAR(27),
							op_10	VARCHAR(27),
							op_11	VARCHAR(27),
							op_12	VARCHAR(27),
							op_13	VARCHAR(27),
							op_14	VARCHAR(27),
							op_15	VARCHAR(27),
							s_var	INT(1),
							sp_var	INT(1),
							pick	INT(2),
							inst	INT(3) NOT NULL AUTO_INCREMENT,
							primary key(inst)
							)';
			$query_cre = mysqli_query($conn,$query);
			$query = 'INSERT INTO sb_roll (op_0,op_1,op_2,op_3,op_4,op_5,op_6,op_7,op_8,op_9,op_10,op_11,op_12,op_13,op_14,op_15) VALUES (null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null)';
			$query_cre = mysqli_query($conn,$query);
			return true;
		}
	}
	function nulVals($conn) {
		$query = 'UPDATE sb_roll SET op_0=null,op_1=null,op_2=null,op_3=null,op_4=null,op_5=null,op_6=null,op_7=null,op_8=null,op_9=null,op_10=null,op_11=null,op_12=null,op_13=null,op_14=null,op_15=null,s_var=1,sp_var=0,pick=null';
		$query_nul = mysqli_query($conn,$query);
		return true;
	}
?>