<?php 
	header ("Content-Type: text/plain; charset=utf-8");
	$prefix = $_GET['prefix'] ;
    $max    = $_GET['max'] ;
    $cities = file ("cities_DE.txt") ;
	$prefixlen = strlen ( $prefix ) ;
	
    // make a binary search through the list of cities
    // to find a starting point and then print the $max
    // following city names
    
    $lower = 0 ;
    $upper = count ($cities) ;

    while ($lower <= $upper) {
        $middle = floor ( ($lower + $upper) / 2 ) ;
        $cmp = substr_compare ($cities [$middle], $prefix, 0, $prefixlen, true) ;
        if ($cmp == 0) {
            // we're somewhere in the block of cities 
            // beginning with our prefix
            break ; 
        } else if ($cmp < 0) {
            $lower = $middle + 1 ;
        } else if ($cmp > 0) {
            $upper = $middle - 1 ;
        }
    }

    // if this is still True, we existed the while loop 
    // through break and found a city
    if ($lower <= $upper) {
        // as long as the previous city name also starts with our given
        // prefix, we go one step back in the array
        for (; substr ($cities [$middle - 1], 0, $prefixlen) == $prefix; $middle--) ;

        for ($i = $middle; $i < ($middle + $max) && 
             substr ($cities [$i], 0, $prefixlen) == $prefix; $i++) {
            echo $cities [$i] ;
        }
    }
?>
