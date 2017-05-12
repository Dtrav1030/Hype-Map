<?php
    include ("inc/cityWeather.php");
    require('inc/access.php');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, minimal-ui">
    <!-- for ios 7 style, multi-resolution icon of 152x152 --> <meta name="apple-mobile-web-app-capable" content="yes">        <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent"> <link rel="apple-touch-icon" href="icon152.png"> <!-- for Chrome on Android, multi-resolution icon of 196x196 --> <meta name="mobile-web-app-capable" content="yes"> <link rel="shortcut icon" sizes="192x192" href="icon192.png"> 
    <title>Assignment 3 Mashup - HypeMap</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="css/jquery.bxslider.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/site.css">
</head>

<body onload="load()">
    <div class="pure-g">
          <div class="pure-u-1 logo">
              <img src="images/logo.svg" alt="Hype Map Logo" id="logo">
          </div>
          <div class="seldrop">
            <form method="post" name="form">
              <select onchange="load()" id="select" class="dropdown">
                <option value="selectregion">Select A City</option>
                <option value="orlando">Orlando, FL</option>
                <option value="denver">Denver, CO</option>
                <option value="houston">Houston, TX</option>
                <option value="la">Los Angeles, CA</option>
                <option value="newyork">New York, NY</option>
              </select>
            </form>
            <a href="#" id="citySubmit" class="pure-button pure-button-primary appButton">Submit</a>
            <div id="footer">
                <p>This is an educational assignment prepared for the UCF SVAD course DIG4503: Rapid App with Dan Novatnak, Spring 2016. Not a commercial product.</p>
            </div>
        </div>
        <div id="mapContainer" style="width: 100%; height: 100%;" class="absolute">
        	<div id="map"></div>
            <div id="mapButtons">
                <a href="#" id="refreshMap">Refresh Map</a>
                <a href="#" id="mapFeedLink">Go to Feed</a>
            </div>
        </div>
        <div id="twitterfeed" class="pure-u-1 twit absolute">
            <div id="recent_tweets"></div>
        </div>
     </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1SzAvq-XSb0iiI93Q_9BQS3VhzcxOC10"
                type="text/javascript"></script>
     <script src="js/google.js" type="text/javascript"></script>
     <script type="text/javascript" src="js/hashtag.js"></script>
     <script src="js/jquery.bxslider.min.js"></script>
     <script src="js/weather.js"></script>
</body>
</html>
<?php $mysqli->close(); ?>