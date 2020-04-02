<html>

	<head>
		
		<link rel="stylesheet" href="./style/statistic.css" type="text/css">
		
	</head>

	<body>

		<?php
			
			// Klasse für diese Datei
			include_once('./class/statistic.php');
			
			// In $data wird ein Array mit den Geldbeträgen gespeichert
			statistic::get_data();
			$data = statistic::$data;
			
			// Erstellt ein SVG Container
			// Die Breite wird an der Anzahl der Geldbeträge angepasst
			echo '<svg style="height: 100%; width: ' . count($data) * 100 . 'px;">';
			
			// Erstellt den Grafen
			statistic::put_gui_graph();
			
			$data_des = $data;
			
			// SVG-Container wird geschlossen
			echo '</svg>';
			
			statistic::put_gui_marking();
			
		?>
		
		<div style="position: absolute;" id="scroll"> </div>

		<script>
			
			document.getElementById('scroll').style.left = document.querySelector('svg').clientWidth;
			document.getElementById('scroll').scrollIntoView({ behavior: 'smooth' });
			
		</script>
	
	</body>
	
</html>