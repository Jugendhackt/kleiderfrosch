<?php 
	header ("Content-Type: text/plain; charset=utf-8");
	$prefix = $_GET['prefix'] ;
	$prefixlen = strlen ( $prefix ) ;
    $cities = file ("cities_DE.txt") ;
	
	if ($prefixlen >= 3) {
		
		foreach ($cities as $i => $city) {
		
		
			if ( substr_compare($city, $prefix, 0, $prefixlen, true) == 0 ) {
				echo $city ;
			
			}
			
		}
	
	}

?>
