<?php

	if(isset($_GET['firstrun'])) {
		$firstRunCode = $_GET['firstrun'];
		if ($firstRunCode == 'check') {
			require_once('connectvars.php');
			$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			$chResult = tableCheck($dbc);
			if ($chResult == 'exists') {
				echo "exists";
			}
			else if ($chResult == 'created') {
				echo "created";
				createFontTable($dbc);
			}
			else {
				echo "error";
			}
			//$query = "SELECT * FROM sb_user";
			//$results = mysqli_query($dbc,$query);
		}
	}	
	
	if(isset($_POST['em'])) {
		if(isset($_POST['usr'])) {
			if(isset($_POST['pass'])) {
				if(isset($_POST['pin'])) {
					require_once('connectvars.php');
					$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
					$email = $_POST['em'];
					$user = $_POST['usr'];
					$pass = $_POST['pass'];
					$pin = $_POST['pin'];
					//connect to db and insert info into user table
					require_once('connectvars.php');
					$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
					$query = "UPDATE sb_user SET username='$user',rec_email='$email',password='$pass',pin=$pin";
					mysqli_query($dbc,$query);
					echo $query;
					mysqli_close($dbc);
				}
				else {
					echo "no PIN for streamBro was provided";
				}
			}
			else {
				echo "no password for streamBro was provided";
			}
		}
		else {
			echo "no username for streamBro was provided";
		}
	}
	
	function tableCheck($conn) {
		$querycheck='SELECT 1 FROM sb_user';
		$query_tbl=mysqli_query($conn,$querycheck);
		if ($query_tbl !== false) {
			return "exists";
		} 
		else	{
			$query = 'CREATE TABLE sb_user (
							username	VARCHAR(27),
							rec_email	VARCHAR(108),
							password	VARCHAR(255),
							pin			INT(4),
							inst	INT(3) NOT NULL AUTO_INCREMENT,
							primary key(inst)
							)';
			$query_cre = mysqli_query($conn,$query);
			$query = 'INSERT INTO sb_user (pin) VALUES (NULL)';
			$query_cre = mysqli_query($conn,$query);
			return "created";
		}
		mysqli_close($conn);
	}
	
	function createFontTable($conn) {
		$querycheck='SELECT 1 FROM sb_fonts';
		$query_tbl=mysqli_query($conn,$querycheck);
		if ($query_tbl !== false) {
			return;
		} 
		else	{
			$query = 'CREATE TABLE sb_fonts (
							font_name	VARCHAR(27),
							font_uri	VARCHAR(255),
							font_id	INT(3) NOT NULL AUTO_INCREMENT,
							primary key(font_id)
							)';
			$query_cre = mysqli_query($conn,$query);
			$queries = ["INSERT INTO sb_fonts (font_name) VALUES ('Arial')",
						"INSERT INTO sb_fonts (font_name,font_uri) VALUES ('Bangers','https://fonts.googleapis.com/css?family=Bangers')",
						"INSERT INTO sb_fonts (font_name,font_uri) VALUES ('Inconsolata','https://fonts.googleapis.com/css?family=Inconsolata')",
						"INSERT INTO sb_fonts (font_name,font_uri) VALUES ('Noto Sans','https://fonts.googleapis.com/css?family=Noto+Sans')",
						"INSERT INTO sb_fonts (font_name,font_uri) VALUES ('Noto Serif','https://fonts.googleapis.com/css?family=Noto+Serif')",
						"INSERT INTO sb_fonts (font_name,font_uri) VALUES ('Roboto','https://fonts.googleapis.com/css?family=Roboto')"];
			foreach ($queries as $query) {
				mysqli_query($conn,$query);
			}	
		}
		createStylesTable($conn);
	}
	
	function createStylesTable($conn) {
		$querycheck='SELECT 1 FROM sb_tool_styles';
		$query_tbl = mysqli_query($conn,$querycheck);
		if ($query_tbl !== false) {
			return;
		} 
		else	{
			$query = 'CREATE TABLE sb_tool_styles (
							font_size	VARCHAR(4),
							font_color	VARCHAR(7),
							stroke_color VARCHAR(7),
							font_id		INT(3),
							bg_color	VARCHAR(7),
							border_rad_tl	VARCHAR(7),
							border_rad_tr	VARCHAR(7),
							border_rad_bl	VARCHAR(7),
							border_rad_br	VARCHAR(7),
							ext_profile		INT(3),
							style_id	INT(3) NOT NULL AUTO_INCREMENT,
							primary key(style_id),
							foreign key(font_id) references sb_fonts(font_id)
							)';
			$query_cre = mysqli_query($conn,$query);
			$query = "INSERT INTO sb_tool_styles (font_size,font_color,stroke_color,font_id,bg_color,border_rad_tl,border_rad_tr,border_rad_bl,border_rad_br) VALUES ('3','#cccccc','#ffffff',1,NULL,0,0,0,0)";
			$query_cre = mysqli_query($conn,$query);
			$query = 'CREATE TABLE sb_styles_ext (
							message_0_col	VARCHAR(7)		DEFAULT "#cccccc",
							message_1_col	VARCHAR(7)		DEFAULT "#cccccc",
							message_0_s_col	VARCHAR(7),
							message_1_s_col	VARCHAR(7),
							message_0_fon	INT(3)		DEFAULT 1,
							message_1_fon	INT(3)		DEFAULT 1,
							ext_pro_id	INT(3) NOT NULL AUTO_INCREMENT,
							primary key(ext_pro_id)
							)';
			$query_cre = mysqli_query($conn,$query);
			$query = 'INSERT INTO sb_styles_ext (message_0_s_col,message_1_s_col) VALUES ("#ffffff","#ffffff")';
			$query_cre = mysqli_query($conn,$query);
			$query = 'ALTER TABLE sb_tool_styles ADD FOREIGN KEY (ext_profile) REFERENCES sb_styles_ext(ext_pro_id)';
			$query_cre = mysqli_query($conn,$query);
			$query = 'UPDATE sb_tool_styles SET ext_profile=LAST_INSERT_ID() LIMIT 1';
			$query_cre = mysqli_query($conn,$query);
		}
		mysqli_close($conn);
	}