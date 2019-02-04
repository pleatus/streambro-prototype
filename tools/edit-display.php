<h4 id="edToolLab">Edit <?php if(!empty($tool)){echo $tool;} ?> Style</h4>
<div id="editTool">
	<form method="POST" name="editStyle" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<label for="fontName">Font:
	<select name="fontName" id="fontName">
		<?php
			require_once('connectvars.php');
			$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			$query = "SELECT font_id,font_name FROM sb_fonts";
			$result = mysqli_query($dbc,$query);
			while($row = mysqli_fetch_assoc($result)){
				echo '<option value="' . $row['font_id'] . '"';
				if ($row['font_id'] == $fontId) {
					echo ' selected';
				}
				echo '>' . $row['font_name'] . '</option>';
			}
		?>
	</select></label>
	<label for="fontSize">Size:
	<input type="num" name="fontSize" id="fontSize" value="<?php if(!empty($font_size)){echo $font_size;}?>"></label>
	<label for="fontColor">Color:
	<input type="color" name="fontColor" id="fontColor" value="<?php if(!empty($font_color)){echo $font_color;}?>"></label>
	<label for="fontStroke">Stroke:
	<input type="color" name="fontStroke" id="fontStroke" value="<?php if(!empty($stroke_color)){echo $stroke_color;}else{echo '';}?>"></label>
	<label for="noStroke" class="inl-inp"><input type="checkbox" name="noStroke" id="noStroke" value="nostroke" <?php if($stroke_color == NULL){ echo 'checked';} else{ echo '';}?>>No Stroke</label>
	<label for="bgColor">Background Color:
	<input type="color" name="bgColor" id="bgColor" value="<?php if(!empty($bg_color)){echo $bg_color;}else{echo '';}?>"></label>
	<label for="noBgColor" class="inl-inp"><input type="checkbox" name="noBgColor" id="noBgColor" value="nobg" <?php if($bg_color == NULL){ echo 'checked';} else{ echo '';}?>>No Color</label>
	<h5>Border Radius</h5>
	<label for="brtl">Top Left:
	<input type="num" name="brtl" id="brtl" value="<?php if(!empty($bRadTl)){echo $bRadTl;}else{echo 0;}?>"></label>
	<label for="brtr">Top Right:
	<input type="num" name="brtr" id="brtr" value="<?php if(!empty($bRadTr)){echo $bRadTr;}else{echo 0;}?>"></label>
	<label for="brbl">Bottom Left:
	<input type="num" name="brbl" id="brbl" value="<?php if(!empty($bRadBl)){echo $bRadBl;}else{echo 0;}?>"></label>
	<label for="brbr">Bottom Right:
	<input type="num" name="brbr" id="brbr" value="<?php if(!empty($bRadBr)){echo $bRadBr;}else{echo 0;}?>"></label>
	<label for="setBrDefault" class="inl-inp"><input type="checkbox" name="setBrDefault" id="setBrDefault" value="">Set Radius Defaults</label>
	<input type="hidden" value="<?php echo $curDspProf; ?>" name="curDspProf" id="curDspProf">
	<input type="submit" name="update_style" value="Update Style">
	</form>
</div>
<script>
//script to hide and display the edit panel, edited out for panel development ease
	/*$('#editTool').hide();
	$('#edToolLab').click(function(){
		$('#editTool').slideToggle('fast');
	});*/
	$('#bgColor').click(function() {
		if ($('#noBgColor').prop('checked')) {
			$('#noBgColor').removeAttr('checked');
		}
	});
	$('#fontStroke').click(function() {
		if ($('#noStroke').prop('checked')) {
			$('#noStroke').removeAttr('checked');
		}
	});
	$('#setBrDefault').click(function() {
		if($(this).prop('checked')) {
			$('#brtl').val(0);
			$('#brtr').val(0);
			$('#brbl').val(0);
			$('#brbr').val(0);
		}
	});
</script>

<?php
			/*require_once('connectvars.php');
			$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			//$query = "SELECT dsp_profile FROM sb_countor WHERE inst=1";
			$query = "SELECT * FROM sb_tool_styles INNER JOIN sb_countor ON sb_countor.dsp_profile = sb_tool_styles.style_id WHERE sb_countor.inst=1";
			$result = mysqli_query($dbc,$query);
			//echo '<option>' . $result . '</option>';
			$resArr = mysqli_fetch_array($result);
			$fontId = $resArr['font_id'];
			$font_size = $resArr['font_size'];
			$font_color = $resArr['font_color'];
			$bg_color = $resArr['bg_color'];
			echo $result;*/
			
		?>