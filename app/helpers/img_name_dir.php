<?php 

	function img_name_dir($name_peace, $dir = false){
		if ($dir == false) {
			$name = strtolower($name_peace);
			$name_peaces = explode(' ', $name);
			if ($name_peaces) {
				$name_composse = implode('_', $name_peaces);
				$name_complete = $name_composse . '_' . time();
				return $name_complete;				
			} else {
				$name_complete = $name . '_' . time();
				return $name_comlete;	
			}
		} else {
			$dir_name = strtolower($name_peace);
			$name_peaces = explode(' ', $dir_name);
			if ($name_peaces) {
				$name_complete = implode('_', $name_peaces);
				return $name_complete;				
			} else {
				return $dir_name;
			}

		}
	}