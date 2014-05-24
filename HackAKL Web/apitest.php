<html>

<head>
	
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	
</head>

<body>
	
	<script>
	
	function func_callbk(){
    	console.log(arguments);
    	//document.write(arguments[0].text);
	}

	//var scriptTag = document.createElement('script');
	//scriptTag.type = 'text/javascript';
	//scriptTag.src = 'http://api.at.govt.nz/v1/gtfs/routes?api_key=3a2de33d-8388-4e97-9382-555c6a6e2e43&callback=func_callbk';
	//s.src = 'http://api.at.govt.nz/v1/gtfs/routes/stopid/7022?api_key=3a2de33d-8388-4e97-9382-555c6a6e2e43&callback=func_callbk';
	//var h = document.getElementsByTagName('script')[0];
	//h.parentNode.insertBefore(s, h);
	//document.getElementsByTagName('HEAD')[0].appendChild(scriptTag);
//var url = 'http://api.at.govt.nz/v1/gtfs/routes?api_key=3a2de33d-8388-4e97-9382-555c6a6e2e43callback=?';
	var url = 'http://api.at.govt.nz/v1/gtfs/routes/geosearch?api_key=fdd37e17-f166-4920-bacd-69667282d353&lat=-36.613918&lng=174.784251&distance=1000&callback=?';
  	$.getJSON(url, function(jsonp){
	    $("#jsonp-response").html(JSON.stringify(jsonp, null, 2));
  	});

</script>
	
<span id="jsonp-response"></span>
</body>			
</html>