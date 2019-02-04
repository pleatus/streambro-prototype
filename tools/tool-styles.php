<?php

require_once('connectvars.php');
	
	if (isset($_POST['update_style'])){
		$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$lastDspProf = $_POST['curDspProf'];
		$font_size = $_POST['fontSize'];
		$stroke_color = $_POST['fontStroke'];
		$font_color = $_POST['fontColor'];
		$fontId = $_POST['fontName'];
		$bg_color = $_POST['bgColor'];
		$bRadTl = $_POST['brtl'];
		$bRadTr = $_POST['brtr'];
		$bRadBl = $_POST['brbl'];
		$bRadBr = $_POST['brbr'];
		//if bgcolor is not null, include quotes around it for insert
		if(!empty($_POST['noBgColor']) || !empty($_POST['noStroke'])) {
			if(!empty($_POST['noBgColor']) && !empty($_POST['noStroke'])) {
				$query = "INSERT INTO sb_tool_styles (font_size,font_color,stroke_color,font_id,bg_color,border_rad_tl,border_rad_tr,border_rad_bl,border_rad_br) VALUES ($font_size,'$font_color',NULL,$fontId,NULL,'$bRadTl','$bRadTr','$bRadBl','$bRadBr')";
			}
			else if(!empty($_POST['noStroke'])) {
				$query = "INSERT INTO sb_tool_styles (font_size,font_color,stroke_color,font_id,bg_color,border_rad_tl,border_rad_tr,border_rad_bl,border_rad_br) VALUES ($font_size,'$font_color',NULL,$fontId,'$bg_color','$bRadTl','$bRadTr','$bRadBl','$bRadBr')";
			}
			else if(!empty($_POST['noBgColor'])) {
				$query = "INSERT INTO sb_tool_styles (font_size,font_color,stroke_color,font_id,bg_color,border_rad_tl,border_rad_tr,border_rad_bl,border_rad_br) VALUES ($font_size,'$font_color','$stroke_color',$fontId,NULL,'$bRadTl','$bRadTr','$bRadBl','$bRadBr')";
			}
		}
		else {
			$query = "INSERT INTO sb_tool_styles (font_size,font_color,stroke_color,font_id,bg_color,border_rad_tl,border_rad_tr,border_rad_bl,border_rad_br) VALUES ($font_size,'$font_color','$stroke_color',$fontId,'$bg_color','$bRadTl','$bRadTr','$bRadBl','$bRadBr')";
		}
		$result = mysqli_query($dbc,$query);
		$query = "UPDATE sb_countor SET dsp_profile=LAST_INSERT_ID() WHERE inst=1";
		$result = mysqli_query($dbc,$query);
		if($lastDspProf != 1) {
			$query = "DELETE FROM sb_tool_styles WHERE style_id=$lastDspProf LIMIT 1";
			$result = mysqli_query($dbc,$query);
		}
		mysqli_close($dbc);
	}
	
	if($tool = 'Counter') {
		$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$query = "SELECT dsp_profile FROM sb_countor WHERE inst=1";
		$result = mysqli_query($dbc,$query);
		$resArr = mysqli_fetch_array($result);
		/*if($result == NULL) {
			$query = "SELECT * FROM sb_tool_styles WHERE style_id=1";
			$result = mysqli_query($dbc,$query);
			$resArr = mysqli_fetch_array($result);
			$font_size = $resArr['font_size'];
			$font_color = $resArr['font_color'];
			//$bg_color = $resArr['bg_color'];
			$bRadTl = $resArr['border_rad_tl'];
			$bRadTr = $resArr['border_rad_tr'];
			$bRadBl = $resArr['border_rad_bl'];
			$bRadBr = $resArr['border_rad_br'];
			$fontId = $resArr['font_id'];
			$query = "SELECT font_name, font_uri FROM sb_fonts WHERE font_id=$fontId";
			$result = mysqli_query($dbc,$query);
			$resArr = mysqli_fetch_array($result);
			$font_name = $resArr['font_name'];
			//$fontUri = $resArr['font_uri'];		
		}*/
			$curDspProf = $resArr['dsp_profile'];
			$query = "SELECT * FROM sb_tool_styles WHERE style_id=$curDspProf";
			$result = mysqli_query($dbc,$query);
			$resArr = mysqli_fetch_array($result);
			$font_size = $resArr['font_size'];
			$font_color = $resArr['font_color'];
			$stroke_color = $resArr['stroke_color'];
			$bg_color = $resArr['bg_color'];
			$bRadTl = $resArr['border_rad_tl'];
			$bRadTr = $resArr['border_rad_tr'];
			$bRadBl = $resArr['border_rad_bl'];
			$bRadBr = $resArr['border_rad_br'];
			$fontId = $resArr['font_id'];
			$query = "SELECT font_name, font_uri FROM sb_fonts WHERE font_id=$fontId";
			$result = mysqli_query($dbc,$query);
			$resArr = mysqli_fetch_array($result);
			$font_name = $resArr['font_name'];
			$font_uri = $resArr['font_uri'];

		mysqli_close($dbc);
	}
	if($tool = 'Notifier') {
		$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$query = "SELECT dsp_profile FROM sb_notify WHERE inst=1";
		$result = mysqli_query($dbc,$query);
		$resArr = mysqli_fetch_array($result);
		$curDspProf = $resArr['dsp_profile'];
		$query = "SELECT * FROM sb_tool_styles WHERE style_id=$curDspProf";
		$result = mysqli_query($dbc,$query);
		$resArr = mysqli_fetch_array($result);
		$extDspProf = $resArr['ext_profile'];
		$font_size = $resArr['font_size'];
		$font_color = $resArr['font_color'];
		$stroke_color = $resArr['stroke_color'];
		$bg_color = $resArr['bg_color'];
		$bRadTl = $resArr['border_rad_tl'];
		$bRadTr = $resArr['border_rad_tr'];
		$bRadBl = $resArr['border_rad_bl'];
		$bRadBr = $resArr['border_rad_br'];
		$fontId = $resArr['font_id'];
		$query = "SELECT font_name, font_uri FROM sb_fonts WHERE font_id=$fontId";
		$result = mysqli_query($dbc,$query);
		$resArr = mysqli_fetch_array($result);
		$font_name = $resArr['font_name'];
		$font_uri = $resArr['font_uri'];
		$query = "SELECT * FROM sb_styles_ext WHERE ext_pro_id=$extDspProf";
		$result = mysqli_query($dbc,$query);
		$resArr = mysqli_fetch_array($result);
		$mess0Col = $resArr['message_0_col'];
		$mess1Col = $resArr['message_1_col'];
		$mess0StCol = $resArr['message_0_s_col'];
		$mess1StCol = $resArr['message_1_s_col'];
		$mess0Font = $resArr['message_0_fon'];
		$mess1Font = $resArr['message_1_fon'];
			

		mysqli_close($dbc);
	}

