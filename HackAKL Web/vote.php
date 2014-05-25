<?php
require_once 'meekrodb.2.2.class.php';

$imagename = $_GET['imagename'];

$results = DB::query("SELECT * FROM voted WHERE imagename=%s AND device_id  = %s",$imagename,$_SERVER["REMOTE_ADDR"]);
//$results = DB::query("SELECT * FROM voted where imagename = " . $imagename . " and device_id = '" .  $_SERVER["REMOTE_ADDR"] . "'");

$c = 0;
$arraysize = sizeof($results);

if ($arraysize > 0){
	// Ignore vote
	//print "Already voted";
} else {
	if (empty($imagename)){
		//Ignore invalid vote
		//print "Invalid vote";
	} else {		
		// Insert vote
		//print "Voted!";
		DB::insert( 'voted', array('device_id'=> $_SERVER["REMOTE_ADDR"],'imagename' => $imagename));	
	}
}

//foreach ($results as $row) {   
//  $c++;  
	//print $c . "." . $row['imagename'] . "<br>";
//}	
	
?>