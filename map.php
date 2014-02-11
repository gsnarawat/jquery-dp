<DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&amp;callback=initGoogleMaps"></script> 
</script>



</head>

<body>
<?php $lat = 28.6100;
 $long = 77.2300; ?>
<script type="text/javascript">

function initGoogleMaps() {
	/* Google Maps Init */
	var myLatlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>);
	var myOptions = {
		zoom: 15	,
		center: myLatlng,
		popup: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(document.getElementById("googlemap"), myOptions, marker);
	
	var marker = new google.maps.Marker({
		position: myLatlng, 
		map: map,
		title: "Our Location",
                icon: "http://www.iconsdb.com/icons/preview/caribbean-blue/circle-xl.png"
	});
	google.maps.event.addListener(marker, 'click', function() {

		map.setZoom(5);
	});
}

</script> 
<div id="googlemap" style="width:800px;height:400px;"></div>

</body>
</html> 
