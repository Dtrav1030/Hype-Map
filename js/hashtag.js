$("#select").change(ajax);

function ajax(e){
	var valueSelected = e.target.value;

	$.ajax({
		type : "POST",
		url : "inc/access.php",
		data : "q="+valueSelected,
		success : function(geocode){
			console.log(geocode);
			geocode = JSON.parse(geocode);		
			$("#twitterfeed").html("<h1>Recent Area Tweets</h1>");
			//create refresh button before feed
			$('<div id="feed_buttons"><a href="#" id="refreshFeed">Refresh Feed</a><a href="#" id="feedMapLink">Go to Map</a></div>').appendTo('#twitterfeed');
			//create map button before feed.
			
			//run ajax function when refresh button is clicked
			$('#refreshFeed').click(function() {
				ajax(e);
			});
			$('#feedMapLink').click(function() {
				$('.container').fadeOut("slow", function() {
					$('#weatherMainContainer').addClass("absolute");
					$('#twitterfeed').addClass("absolute");
					$('#mapButtons').removeClass("absolute");
					$('#mapContainer').removeClass("absolute");
				});
				$('.container').fadeIn("slow", function() {
					load();
				});		
			});
			var tweets = geocode.tweets;
			for (key in tweets) {
				var username  = tweets[key].username
				var tweet = tweets[key].tweet;
				var image = tweets[key].profile_image;			
				var hashtags = tweets[key].hashtags;
				var hashtag = [];
				for (key in hashtags) {
					hashtag.push(hashtags[key].text);
				}
				$("#twitterfeed").append($("<img src='" + image + "'/><b>" + username + "</b><p>" + tweet + "</p>"));
				$("#twitterfeed").append($("<hr>"));
				}	
            
		},
		error: function() {
         $('#twitterfeed').text('An error occurred');
      }
	});
}