<!DOCTYPE HTML>
<html>
	
	<head>
		
		<title> Finanzen </title>
		
	</head>
	
	<?php
		
		if(isset($_POST['money'])) {
			
			echo $_POST['date'];
			
			$file = file_get_contents('./data.dat');
			
			$f = fopen('./data.dat', "w");
			fwrite($f, $file . $_POST['money'] . ';');
			fclose($f);
			
		}
		
	?>
	
	<body>
		
		<iframe src="./statistics.php" style="height: 90vh; width: 100%; border: none;"> Ihr Browser unterstützt leider kein IFrame... :( </iframe>
		
		<form action="" method="POST">
			
			<input name="money"> <input type="date" name="date"> <input type="submit" value="Eintrag hinzufügen">
			
		</form>
		
	</body>
	
</html>