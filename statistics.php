<head>
	
	<style>
		
		.cap {
			
			position: absolute;
			padding: 30px;
			opacity: 0.3;
			transition: 0.3s;
			margin-top: 30px;
			font-family: Arial;
			
		}
		
		.cap:hover {
			
			opacity: 1;
			cursor: pointer;
			margin-top: 0;
			padding-bottom: 60px;
			
		}
		
	</style>
	
</head>

<?php
	
	// Geldbeträge in Variable lesen und als Array speichern
	$data = explode(';', file_get_contents('./data.dat'));
	
	// Letzter Index beinhaltet NULL -> löschen
	unset($data[count($data) - 1]);
	
	echo '<svg style="height: 100%; width: ' . count($data) * 100 . 'px;">';
	
	echo '<polyline points="';
	
	$width = 0;

	$data_des = $data;
	
	for($i = 0; $i != count($data); $i++) {
		
		$data[$i] = 800 - ($data[$i] / 10);
		
		echo $width . ',' . $data[$i] . ' ';
	
		$width += 100;
	
	}
	
	echo '" stroke-linecap="round" fill="none" stroke="silver" stroke-width="5">';
	
	echo '</svg>';
	
	$width = 0;
	
	for($i = 0; $i != count($data_des); $i++) {
		
		$t = $data[$i] - 50;
		$t_w = $width - 40;
		
		if(isset($data_des[$i - 1])) {
			
			
			$dif = $data_des[$i] - $data_des[$i - 1];
			
		} else {
			
			$dif = 0;

		}
		
		if($dif > 0) {
			
			$dif = '+' . $dif . '€';
			
		} else {
			
			$dif = $dif . '€';
		
		}
		
		echo ' <div class="cap" style="top: ' . $t . '; left: ' . $t_w . ';" title="' . $dif . '"> ' . $data_des[$i] . '€ </div> ';
		
		$width += 100;
		
	}
	
?>
<div style="position: absolute;" id="scroll"> </div>

<script>
	
	document.getElementById('scroll').style.left = document.querySelector('svg').clientWidth;
	document.getElementById('scroll').scrollIntoView({ behavior: 'smooth' });
	
</script>