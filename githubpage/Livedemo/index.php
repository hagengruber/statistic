<html>

	<head>
		
		<link rel="stylesheet" href="./style/statistic.css" type="text/css">
		<script src="./js/scroll.js" defer=""> </script>
		<script src="./js/difference.js" defer=""> </script>
		
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
			echo '<svg style="height: ' . statistic::$svg_height . 'px; width: ' . count($data) * 100 . 'px; margin-left: 10px">';
			
			// Erstellt den Grafen
			statistic::put_gui_graph();
			
			$data_des = $data;
			
			// SVG-Container wird geschlossen
			echo '</svg>';
			
			echo '<input type="hidden" value="' . statistic::$max . '" id="max">';
			
			statistic::put_gui_marking();
			
		?>
		
	</body>
	
</html>