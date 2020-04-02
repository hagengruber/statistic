<?php
	
	// Class statistic
	
	class statistic{
		
		// Geldbeträge in Form eines Arrays
		static $data;
		static $data_form;
		
		// Speichert die Geldbeträge in Form eines Arrays in die Variable statistic::$data
		public static function get_data() {
			
			// Geldbeträge in Variable lesen und als Array speichern
			$data = explode(';', file_get_contents('./data.dat'));
			
			// Letzter Index beinhaltet NULL -> löschen
			unset($data[count($data) - 1]);
			
			self::$data = $data;
			
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
				
				$data[$i] = 800 - ($data[$i] / 10);
				
				echo $width . ',' . $data[$i] . ' ';
			
				$width += 100;
			
			}
			
			self::$data_form = $data;
			
			// Graf wird beendet
			echo '" stroke-linecap="round" fill="none" stroke="silver" stroke-width="5">';

		}

		public static function put_gui_marking() {
			
			$data = self::$data;
			
			$width = 0;
			
			for($i = 0; $i != count($data); $i++) {
				
				$t = self::$data_form[$i] - 50;
				$t_w = $width - 40;
				
				if(isset($data[$i - 1])) {
					
					$dif = $data[$i] - $data[$i - 1];
					
				} else {
					
					$dif = 0;

				}
				
				if($dif > 0) {
					
					$dif = '+' . $dif . '€';
					
				} else {
					
					$dif = $dif . '€';
				
				}
				
				echo ' <div class="cap" style="top: ' . $t . '; left: ' . $t_w . ';" title="' . $dif . '"> ' . $data[$i] . '€ </div> ';
				
				$width += 100;
				
			}
			
		}
		
	}
	
?>