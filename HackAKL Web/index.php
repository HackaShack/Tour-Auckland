<?php

require_once 'meekrodb.2.2.class.php';
include( 'function.php');
// settings
$max_file_size = (1024*200)*100; // 20MB
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
// thumbnail sizes
$sizes = array(32 => 32, 100 => 100, 150 => 150, 250 => 250);

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'])) {
	 	
  if( $_FILES['image']['size'] < $max_file_size ){
    // get file extension
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, $valid_exts)) {
      /* resize image */
      foreach ($sizes as $w => $h) {
        $files[] = resize($w, $h);
      }
	
    } else {
      $msg = 'Unsupported file';
    }
  } else{
    $msg = 'Please upload image smaller than 200KB';
  }
  
  if (isset($_POST["longitude"]) AND isset($_POST["latitude"]) AND  $_FILES['image']['size'] < $max_file_size AND trim($_FILES['image']['name']) !=''){
  	DB::insert( 'images', array('device_id'=> $_SERVER["REMOTE_ADDR"],'imagename' => $_FILES['image']['name'],'longitude' => $_POST["longitude"],'latitude' => $_POST["latitude"]));
  }
  header('Location: http://tourauckland.webappcreator.net/');  
}

?>
<!doctype html>
<html lang="en">
   <head>
		<title>Tour Auckland - HackAKL</title>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta http-equiv="content-language" content="en" />
		<meta name="viewport" content="width=device-width,initial-scale=1" />
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
		<meta name="DC.title" content="Example with Google maps, jQuery and JSON - Google maps jQuery plugin" />
		<meta name="DC.subject" content="Google maps;jQuery;plugin;JSON" />
		<meta name="DC.description" content="An example how to load markers with JSON using jQuery and Google maps v3" />
		<meta name="DC.creator" content="Johan Säll Larsson" />
		<meta name="DC.language" content="en" />


<script type="text/javascript">
var popbackground="white" //specify backcolor or background image for pop window
var windowtitle="Image Window"  //pop window title

function detectexist(obj){
return (typeof obj !="undefined")
}

function jkpopimage(imgpath, popwidth, popheight, textdescription){
	popwidth = 325;
	popheight = 445;
	textdescription = 'Photo';

function getpos(){
leftpos=(detectexist(window.screenLeft))? screenLeft+document.body.clientWidth/2-popwidth/2 : detectexist(window.screenX)? screenX+innerWidth/2-popwidth/2 : 0;
toppos=(detectexist(window.screenTop))? screenTop+document.body.clientHeight/2-popheight/2 : detectexist(window.screenY)? screenY+innerHeight/2-popheight/2 : 0;

if (window.opera){
leftpos-=screenLeft;
toppos-=screenTop;
} 

	
}


getpos();
var winattributes='width='+popwidth+',height='+popheight+',resizable=yes,left='+leftpos+',top='+toppos;
var bodyattribute=(popbackground.indexOf(".")!=-1)? 'background="'+popbackground+'"' : 'bgcolor="'+popbackground+'"';
if (typeof jkpopwin=="undefined" || jkpopwin.closed){
jkpopwin=window.open("","",winattributes)
}else{
//getpos() //uncomment these 2 lines if you wish subsequent popups to be centered too
//jkpopwin.moveTo(leftpos, toppos)
jkpopwin.resizeTo(popwidth, popheight+30)
}

jkpopwin.document.open();
jkpopwin.document.write('<html><title>'+windowtitle+'</title><body '+bodyattribute+'><img src="uploads/250x250_'+imgpath+'" style="margin-bottom: 0.5em;text-align: center"><br />'+textdescription+'<input type="button" value="Vote" onclick="alert(1)"></body></html>');
jkpopwin.document.close();
jkpopwin.focus();
	return false;
}

</script>
	<style>	
		html{height: 100% }
		body{height: 100%; margin:0;padding:0 }
				
		#map_canvas{
			width: 100%;
			height: 100%;
		}
		
		#wrapper {position: relative;height:100%;width: 100%;}
		#over_map {position: absolute; top: 10px; left: 10px;z-index:99;}
		
		div.upload {
    width: 157px;
    height: 57px;
    background: url(images/upload.png);
    overflow: hidden;
}

div.upload input {
    display: block !important;
    width: 157px !important;
    height: 57px !important;
    opacity: 0 !important;
    overflow: hidden !important;
}
		
	</style>
    
	
	</head>
    <body>
	<script>
	  $("#map_canvas").height($(window).height());
	</script>
	<div id="wrapper">
		<div id="map_canvas"></div>	
		<div id="over_map">
		
			<form  action="index.php" method="post" enctype="multipart/form-data">
    <label>    
	<div class="upload">	
      <input type="file" onchange="this.form.submit();" name="image" accept="image/*" />
      
	 </div>
    </label>
    
    <input type="hidden" id="longitude" name="longitude" value="">
    <input type="hidden" id="latitude" name="latitude" value="">
  </form>

		</div>
	</div>

<script>
  if (navigator.geolocation){
    navigator.geolocation.getCurrentPosition(showPosition);
  }
  
function showPosition(position)
  {
  //x.innerHTML="Latitude: " + position.coords.latitude + 
  //"<br>Longitude: " + position.coords.longitude;	
  document.getElementById("longitude").value = position.coords.longitude;
  document.getElementById("latitude").value = position.coords.latitude;  
  }
    
</script>

		
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
		<script type="text/javascript" src="js/jquery-1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/underscore-1.2.2/underscore.min.js"></script>
		<script type="text/javascript" src="js/backbone-0.5.3/backbone.min.js"></script>
		<script type="text/javascript" src="js/prettify/prettify.min.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="../ui/jquery.ui.map.js"></script>
		<script type="text/javascript">
            $(function() { 
				demo.add(function() {				
					$('#map_canvas').gmap({'disableDefaultUI':true, 'callback': function() {
						var self = this;
						$.getJSON( 'http://tourauckland.webappcreator.net/imagesJSON.php', function(data) { 
							
							$.each( data.markers, function(i, marker) {
														
								self.addMarker({'icon': marker.icon, 'position': new google.maps.LatLng(marker.latitude, marker.longitude), 'bounds':true } ).click(function() {
									self.openInfoWindow({ 'content': marker.content }, this);
								});
								
								
								
							});
							
						});
					}}); 
				}).load();
			});
        </script>
    
  
<?php
	//print $longitude;

	?>
        
	</body>
</html>
