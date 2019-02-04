<?php
	$tool = 'Counter';
	require_once('../tool-styles.php');	
?>

<html>
<head>
	<meta charset="utf-8">
    <meta name="author" content="Ray Jaworski">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>++ - The Countor</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<style>
		<?php if(!empty($font_uri)){echo "@import url('" . $font_uri . "');";} ?>
		div#counterCurrent{
			margin-top:100px;
			margin-left:100px;
			font-family:'<?php if($font_name != NULL){echo $font_name;} ?>';
			font-size:<?php if($font_size != NULL){echo $font_size;} ?>em;
			color:<?php if($font_color != NULL){echo $font_color;} ?>;
			<?php if($stroke_color != NULL){echo
			'text-shadow:-1px -1px 0 ' . $stroke_color .
			', 1px -1px 0 ' . $stroke_color .
			',-1px 1px 0 ' . $stroke_color .
			',1px 1px 0 ' . $stroke_color . ';';} ?>
		}
		div#counterCurrent span {
			padding: 18px 18px 18px 18px;
			<?php if($bg_color != NULL){echo 'background-color:' . $bg_color . ';';} ?>
			<?php if($bRadTl != NULL){echo 'border-top-left-radius:' . $bRadTl . ';';} ?>
			<?php if($bRadTr != NULL){echo 'border-top-right-radius:' . $bRadTr . ';';} ?>
			<?php if($bRadBl != NULL){echo 'border-bottom-left-radius:' . $bRadBl . ';';} ?>
			<?php if($bRadBr != NULL){echo 'border-bottom-right-radius:' . $bRadBr . ';';} ?>
		}
	</style>
</head>
<body data-title="plgndsp">
	<div id="counterCurrent" style="">loading</div>
	<script src="dspCountor.js"></script>
</body>
</html>

