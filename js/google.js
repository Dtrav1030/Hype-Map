
    //<![CDATA[

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      }
    };

    function load() {
      var selectValue = $( "#select" ).val();
      if (selectValue == "orlando"){
        var map = new google.maps.Map(document.getElementById("map"), {             
            center: new google.maps.LatLng(28.4813989,-81.5088368),
            zoom: 11,
            mapTypeId: 'roadmap'
        });
      }
        
     else if (selectValue == "denver"){
        var map = new google.maps.Map(document.getElementById("map"), {             
        center: new google.maps.LatLng(39.7645187,-104.995197),
        zoom: 11,
        mapTypeId: 'roadmap'
      });
          }
     else if (selectValue == "houston"){
        var map = new google.maps.Map(document.getElementById("map"), {             
        center: new google.maps.LatLng(29.7459634,-95.3374731),
        zoom: 11,
        mapTypeId: 'roadmap'
      });
          }
    else if (selectValue == "la"){
        var map = new google.maps.Map(document.getElementById("map"), {             
        center: new google.maps.LatLng(34.0565955,-118.253157),
        zoom: 11,
        mapTypeId: 'roadmap'
      });
          }
    else if (selectValue == "newyork"){
        var map = new google.maps.Map(document.getElementById("map"), {             
        center: new google.maps.LatLng(40.7595604,-74.0385843),
        zoom: 11,
        mapTypeId: 'roadmap'
      });
          }
        
      else{
          var map = new google.maps.Map(document.getElementById("map"), {             
        center: new google.maps.LatLng(37.6989281,-97.484044),
        zoom: 4,
        mapTypeId: 'roadmap'
      });
          
      }
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      if (selectValue == "orlando"){
        downloadUrl("../assignment03/inc/google_orlando.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
              var user_picture = markers[i].getAttribute("user_picture");
              var name = markers[i].getAttribute("name");
              var tweet = markers[i].getAttribute("tweet");
              var type = markers[i].getAttribute("type");
              var point = new google.maps.LatLng(
                  parseFloat(markers[i].getAttribute("lat")),
                  parseFloat(markers[i].getAttribute("lng")));
              var html = "<img src='" + user_picture + "'><b>" + name + "</b> <br/>" + tweet;
              var icon = customIcons[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: icon.icon
              });
              bindInfoWindow(marker, map, infoWindow, html);
            }
        });
      }
        
     else if (selectValue == "denver"){
         downloadUrl("../assignment03/inc/google_denver.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
              var user_picture = markers[i].getAttribute("user_picture");
              var name = markers[i].getAttribute("name");
              var tweet = markers[i].getAttribute("tweet");
              var type = markers[i].getAttribute("type");
              var point = new google.maps.LatLng(
                  parseFloat(markers[i].getAttribute("lat")),
                  parseFloat(markers[i].getAttribute("lng")));
              var html = "<img src='" + user_picture + "'><b>" + name + "</b> <br/>" + tweet;
              var icon = customIcons[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: icon.icon
              });
              bindInfoWindow(marker, map, infoWindow, html);
            }
        });

          }
     else if (selectValue == "houston"){
         downloadUrl("../assignment03/inc/google_houston.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
              var user_picture = markers[i].getAttribute("user_picture");
              var name = markers[i].getAttribute("name");
              var tweet = markers[i].getAttribute("tweet");
              var type = markers[i].getAttribute("type");
              var point = new google.maps.LatLng(
                  parseFloat(markers[i].getAttribute("lat")),
                  parseFloat(markers[i].getAttribute("lng")));
              var html = "<img src='" + user_picture + "'><b>" + name + "</b> <br/>" + tweet;
              var icon = customIcons[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: icon.icon
              });
              bindInfoWindow(marker, map, infoWindow, html);
            }
        });
   
          }
    else if (selectValue == "la"){
        downloadUrl("../assignment03/inc/google_la.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
              var user_picture = markers[i].getAttribute("user_picture");
              var name = markers[i].getAttribute("name");
              var tweet = markers[i].getAttribute("tweet");
              var type = markers[i].getAttribute("type");
              var point = new google.maps.LatLng(
                  parseFloat(markers[i].getAttribute("lat")),
                  parseFloat(markers[i].getAttribute("lng")));
              var html = "<img src='" + user_picture + "'><b>" + name + "</b> <br/>" + tweet;
              var icon = customIcons[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: icon.icon
              });
              bindInfoWindow(marker, map, infoWindow, html);
            }
        });
        
          }
    else if (selectValue == "newyork"){
        downloadUrl("../assignment03/inc/google_new_york.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
            for (var i = 0; i < markers.length; i++) {
              var user_picture = markers[i].getAttribute("user_picture");
              var name = markers[i].getAttribute("name");
              var tweet = markers[i].getAttribute("tweet");
              var type = markers[i].getAttribute("type");
              var point = new google.maps.LatLng(
                  parseFloat(markers[i].getAttribute("lat")),
                  parseFloat(markers[i].getAttribute("lng")));
              var html = "<img src='" + user_picture + "'><b>" + name + "</b> <br/>" + tweet;
              var icon = customIcons[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: icon.icon
              });
              bindInfoWindow(marker, map, infoWindow, html);
            }
        });
       
          }
      
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>