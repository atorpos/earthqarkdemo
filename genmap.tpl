<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Last 24 hours Earth Quakes Map</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }
    </style>
</head>
<body>
<header>
    <div class="jumbotron">
        <div class="container">
            <h3>Earthqark in last 24 hours </h3>
        </div>
    </div>
</header>
<div id="map"></div>
<script>
    // Initialize and add the map
    var map;
    function initMap() {

        map = new google.maps.Map(
            document.getElementById('map'), {zoom: 2, center: new google.maps.LatLng(2.8,-187.3), mapTypeId: 'terrain'});
        {foreach $dataresult $key $value}
            var contentString{$key} = '<p><b>{$value["event_place"]}</b><br><b>Magnitude: {$value["magnitude"]} Depth: {$value["geo_attr"]["coordinates"][2]}</b><br><b> Event time: {$value["event_time"]}</p>';
            var infowindow{$key}= new google.maps.InfoWindow({content: contentString{$key}});
            var myLatlng{$key} = new google.maps.LatLng({$value["geo_attr"]["coordinates"][1]}, {$value["geo_attr"]["coordinates"][0]});
            var marker{$key} = new google.maps.Marker({position: myLatlng{$key});
            marker{$key}.addListener('click', function() {infowindow{$key}.open(map, marker{$key});});
        {/foreach}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcbHd5yheNtrV6W55ATWFVD1Dg7QdWvP8&callback=initMap" type="text/javascript"></script>
</body>
</html>