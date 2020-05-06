<?php
	
	// Class statistic
	
	class statistic{
		
		// Geldbeträge in Form eines Arrays
		static $data;
		static $data_form;
		static $max;
		static $min;
		static $svg_height;
		
		// Speichert die Geldbeträge in Form eines Arrays in die Variable statistic::$data
		public static function get_data() {
			
			// Wenn die Datei nicht existiert, erzeuge eine neue mit dem Wert 0
			if(!file_exists('./data.dat')) {
				
				$f = fopen('./data.dat', "w");
				fwrite($f, '0,' . date("t.m.y") . ';');
				fclose($f);
				
			}
			
			// Geldbeträge in Variable lesen und als Array speichern
			$data = explode(';', file_get_contents('./data.dat'));
			
			// Letzter Index beinhaltet NULL -> löschen
			unset($data[count($data) - 1]);
			
			$date_data = [];
			
			for($i = 0; $i != count($data); $i++) {
				
				$temp_data = explode(',', $data[$i]);
				
				$date_data[$i] = [ 'money' => $temp_data[0], 'date' => $temp_data[1] ];
				
			}
			
			// $data speichern
			self::$data = $date_data;
			
			
			// Max. und min. Geldbetrag speichern
			self::$max = self::max_min_betrag(true) + 100;
			self::$min = self::max_min_betrag(false);
			
			// SVG-Container Höhe berechnen
			self::$svg_height = self::$max - self::$min;
			
		}
		
		public static function max_min_betrag($fun) {
			
			$data = self::$data;
			$betrag = [];
			
			for($i = 0; $i != count($data); $i++) {
				
				$betrag[$i] = $data[$i]['money'];
				
			}
			
			return $fun ? max($betrag) : min($betrag); 
			
		}
		
		// Erstellt den Grafen
		public static function put_gui_graph() {
			
			$data = self::$data;
			
			// In dem SVG-Container wird nun der Graf erstellt
			echo '<polyline points="';
			
			// Breite der einzelnen Punkte
			// Regelmäßiger Abstand von 100px
			$width = 10;

			// Punkte der Grafen werden festgelegt
			for($i = 0; $i != count($data); $i++) {
				
				// Geldbetrag wird vom Max. Geldbetrag subtrahieren
				// So wird der Graf richtig rum dargestellt
				$data[$i]['money'] = self::$max - $data[$i]['money'];
				
				echo $width . ',' . $data[$i]['money'] . ' ';
			
				// Gleichbleibender Abstand zwischen Punkten
				$width += 100;
			
			}
			
			self::$data_form = $data;
			
			// Graf wird beendet
			echo '" stroke-linecap="round" fill="none" stroke="silver" stroke-width="5"> </polyline>';
			
			echo '<a id="pol" href="#"> </polyline> </a>';

		}

		// Gibt Beschriftung der einzelnen Punkte aus
		public static function put_gui_marking() {
			
			$data = self::$data;
			
			// Breite beginnt ab 10px
			$width = 10;
			
			// Jeder Punkt wird beschriftet
			for($i = 0; $i != count($data); $i++) {
				
				// Der Abstand zu top wird festgelegt
				$top = self::$data_form[$i]['money'] - 70;
				
				// Der Abstand zu left wird festgelegt
				// Je größer die Zahl, desto kleiner wird links
				$left = $width - 49;
				
				// Wenn vorherige Geldbeträge existieren, wird die differenz ermittelt
				if(isset($data[$i - 1])) {
					
					$dif = $data[$i]['money'] - $data[$i - 1]['money'];
					
				} else {
					
					// Wenn nicht, wird die differenz auf 0 gesetzt
					$dif = 0;

				}
				
				// Wenn die differenz im positiven Bereich liegt, wird ein "+" angefügt
				if($dif > 0) {
					
					$dif = '+' . $dif . '€';
					
				} else {
					
					$dif = $dif . '€';
				
				}
				
				// Gib Beschriftung aus
				echo ' <div onclick="difference(' . $i . ')" class="cap" style="top: ' . $top . '; left: ' . $left . ';" title="' . $dif . '" id="div' . $i . '"> <div class="show"> <span id="' . $i . '"> ' . $data[$i]['money'] . ' </span>€ </div> </div> ';
				echo ' <div style="color: #AFAEAE; position: absolute; top: ' . ($top-20) . '; left: ' . ($left+49) . ';" > ' . $data[$i]['date'] . ' </div> ';
				echo ' <div class="border" style="top: ' . ($top-5) . '; left: ' . ($left+65) . ';" > </div> ';
				
				$width += 100;
				
			}
			
			// DIV-Container wird zum letzten Punkt für das Scrollen gesetzt
			echo ' <div id="scroll" style="position: absolute; top: ' . $top . 'px; left: ' . ($left+200) . 'px;"> </div> ';
			
			echo '<div id="difference" class="cap_n"> <div class="show_n" id="difference_inner"> Test </div> </div>';
			
		}
	
	}
	
?>