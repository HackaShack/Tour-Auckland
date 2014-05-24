<?php
require_once 'meekrodb.2.2.class.php';

$results = DB::query("SELECT * FROM images");
$c = 0;
$arraysize = sizeof($results);

//print '{"markers":[{"latitude":-36.785054,"longitude":174.753281,"title":"Photo","content":"Uploaded by "}]}';
//exit;

print '{"markers":[';

foreach ($results as $row) {   
  $c++;  
  if ($arraysize == $c){
  	$term = '';
  } else {
  	$term = ',';  
  }
   
  print '{"latitude":' . $row['latitude']  . ',"longitude":' . $row['longitude'] .  ',"icon":"uploads/32x32_' . $row['imagename'] . '","title":"' . "Photo"  . '","content":"' . "<img src='uploads/100x100_" .  $row['imagename'] ."'><br>Uploaded by ".  $row['device_id'] . '"' . '}' . $term;
}	
	
#print json_encode ($results);
print ']}';
	
?>