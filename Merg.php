<?php
    function cmp($a, $b)
{
    		$dateString = $a["created"];
$date = strtotime($dateString);
$c= date('yyyy-mm-dd H:i:s', strtotime($dateString));
$dateString = $b["created"];
$date = strtotime($dateString);
$d= date('yyyy-mm-dd H:i:s', strtotime($dateString));
    
    return strcmp($c, $d);
}

function getsorted($posts){
	usort($posts, "cmp");
	
	return $posts;
}
function reverse($posts){
	$sorted=getsorted($posts);
	$reverse=array_reverse($sorted, TRUE);
	return $reverse;
}
?>