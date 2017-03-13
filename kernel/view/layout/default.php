<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo CSS . "themes.php"; ?>">
		<meta charset="utf-8">
		
		<script src="<?php echo JS . 'functions.js'; ?>"></script>
		<script src='https://code.jquery.com/jquery-1.12.4.js'></script>
		<script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>
		
		<title> <?php echo APPNAME; ?> </title>
		
	</head>
	
	<body>
		<?php
			// echo "<div class='debug'>" . "<table>" . "<tr>";
			// if(isset($_POST)){		echo "<td>" . "\$_POST :" .			"<pre>";	print_r($_POST);	echo "</pre>" . "</td>"; }
			// if(isset($_SESSION)){	echo "<td>" . "<br/>\$_SESSION :" . "<pre>";	print_r($_SESSION);	echo "</pre>" . "</td>"; }
			// echo "</tr>" . "</table>" . "</div>";
		?>
		<div id='header'>
			<?php require_once(VIEW."layout/header.php"); ?>
		</div>
		
		<div id='content'>
			<?php echo $content; ?>
		</div>

		<div id="footer">
			<?php require_once(VIEW."layout/footer.php"); ?>
		</div>
	</body>
</html>