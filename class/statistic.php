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
				fwrite($f, '0;');
				fclose($f);
				
			}
			
			// Geldbeträge in Variable lesen und als Array speichern
			$data = explode(';', file_get_contents('./data.dat'));
			
			// Letzter Index beinhaltet NULL -> löschen
			unset($data[count($data) - 1]);
			
			// $data speichern
			self::$data = $data;
			
			// Max. und min. Geldbetrag speichern
			self::$max = max($data) + 10;
			self::$min = min($data);
			
			// SVG-Container Höhe berechnen
			self::$svg_height = self::$max - self::$min;
			
		}
		
		// Erstellt den Grafen
		public static function put_gui_graph() {
			
			$data = self::$data;
			
			// In dem SVG-Container wird nun der Graf erstellt
			echo '<polyline points="';
			
			// Breite der einzelnen Punkte
			// Regelmäßiger Abstand von 100px
			$width = 0;

			// Punkte der Grafen werden festgelegt
			for($i = 0; $i != count($data); $i++) {
				
				// Geldbetrag wird vom Max. Geldbetrag subtrahieren
				// So wird der Graf richtig rum dargestellt
				$data[$i] = self::$max - $data[$i];
				
				echo $width . ',' . $data[$i] . ' ';
			
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
				$top = self::$data_form[$i] - 50;
				
				// Der Abstand zu left wird festgelegt
				$left = $width - 40;
				
				// Wenn vorherige Geldbeträge existieren, wird die differenz ermittelt
				if(isset($data[$i - 1])) {
					
					$dif = $data[$i] - $data[$i - 1];
					
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
				echo ' <div onclick="difference(' . $i . ')" class="cap" style="top: ' . $top . '; left: ' . $left . ';" title="' . $dif . '"><span id="' . $i . '"> ' . $data[$i] . '</span>€ </div> ';
				
				$width += 100;
				
			}
			
			// DIV-Container wird zum letzten Punkt für das Scrollen gesetzt
			echo ' <div class="cap" id="scroll" style="top: ' . $top . 'px; left: ' . $left . 'px;"> </div> ';
			
		}
		
	}
	
?>