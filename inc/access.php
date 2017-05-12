<?php
error_reporting(0);
ini_set("display_errors", 0);
require("db_connect.php");
include "twitteroauth.php";

$consumer_key = "1OmX1yUHpuf2rB3PLrR3Mr0cE";
$consumer_secret = "dxGvjKDwF8HWdFKA9RamEIa0oNKzErx73omaBQkE24KUtGbqxB";
$access_token = "70696689-dJRE00bNKBXSCoiRGB0KWxHwtpiqgDmJ012aMO04m";
$access_token_secret = "XbXLBojCjTjSJ6au2Rk4eqQM25gaXWvZXOnNeP934CRZ2";

$twitter = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);

if (isset ($_POST["q"])){
  $q=$_POST["q"];
}else{
  $q = "selectregion";
}



if($q=="orlando"){
  $trending=("https://api.twitter.com/1.1/trends/place.json?id=2466256");
  $geocode=("https://api.twitter.com/1.1/search/tweets.json?geocode=28.4813989,-81.5088368,50mi&result_type=mixed&count=100");
}elseif($q=="denver"){
  $trending=("https://api.twitter.com/1.1/trends/place.json?id=2391279");
  $geocode=("https://api.twitter.com/1.1/search/tweets.json?geocode=39.7645187,-104.995197,50mi&result_type=mixed&count=100");
}elseif($q=="houston"){
  $trending=("https://api.twitter.com/1.1/trends/place.json?id=12590119");
  $geocode=("https://api.twitter.com/1.1/search/tweets.json?geocode=29.8174782,-95.6814869,50mi&result_type=mixed&count=100");
}elseif($q=="la"){
  $trending=("https://api.twitter.com/1.1/trends/place.json?id=2487956");
  $geocode=("https://api.twitter.com/1.1/search/tweets.json?geocode=34.0565955,-118.253157,4mi&result_type=mixed&count=100");
}elseif($q=="newyork"){
  $trending=("https://api.twitter.com/1.1/trends/place.json?id=2459115");
  $geocode=("https://api.twitter.com/1.1/search/tweets.json?geocode=40.7058316,-74.2581936,50mi&result_type=mixed&count=100");
}else {
  $trending=("https://api.twitter.com/1.1/trends/place.json?id=2459115"); 
}

$trend = $twitter->get($trending);

$trends = json_decode(json_encode($trend));

$tweet = new stdClass();
$tweet = $twitter->get($geocode);
$response = new stdClass();
$tweets = json_decode(json_encode($tweet));
$tweets = $tweet->statuses;

$response->tweets = [];


if($q=="orlando"){
  $result = $mysqli->query("SELECT * FROM markers_orlando");
  $row_cnt = $result->num_rows;
  $delete_geo_query = "DELETE FROM markers_orlando ORDER BY id ASC LIMIT 100";
}elseif($q=="denver"){
    $result = $mysqli->query("SELECT * FROM markers_orlando");
    $row_cnt = $result->num_rows;
    $delete_geo_query = "DELETE FROM markers_denver ORDER BY id ASC LIMIT 100";
}elseif($q=="houston"){
    $result = $mysqli->query("SELECT * FROM markers_orlando");
    $row_cnt = $result->num_rows;
    $delete_geo_query = "DELETE FROM markers_houston ORDER BY id ASC LIMIT 100";
}elseif($q=="la"){
    $result = $mysqli->query("SELECT * FROM markers_la");
    $row_cnt = $result->num_rows;
    $delete_geo_query = "DELETE FROM markers_la ORDER BY id ASC LIMIT 100";
}elseif($q=="newyork"){
    $result = $mysqli->query("SELECT * FROM markers_orlando");
    $row_cnt = $result->num_rows;
    $delete_geo_query = "DELETE FROM markers_new_york ORDER BY id ASC LIMIT 100";
}
else return false;

if($row_cnt > 150){
    $mysqli->query($delete_geo_query);
}

$trend = $twitter->get($trending);
$trends = json_decode(json_encode($trend));

foreach($tweets as $tweet) {
	$info = new stdClass();
	
	//setting the objects from the json that we want to display with the ajax call
	$info->hashtags = $tweet->entities->hashtags;
     $tweet_content= $tweet->text;
    $formatted_text = preg_replace('/(\b(www\.|https\:\/\/)\S+\b)/', "<a target='_blank' href='$1'>$1</a>", $tweet_content);
    $formatted_text = preg_replace('/\#(\w+)/', "<a target='_blank' href='https://twitter.com/search?f=tweets&vertical=default&q=$1'>#$1</a>", $formatted_text);
    $formatted_text = preg_replace('/\@(\w+)/', "<a target='_blank' href='http://twitter.com/$1'>@$1</a>", $formatted_text);
	$info->tweet    = $formatted_text;
	$info->profile_image = $tweet->user->profile_image_url;
    $username= $tweet->user->screen_name;
    $formatted_user = preg_replace('/(\b(www\.|https\:\/\/)\S+\b)/', "<a class='formatted_user' target='_blank' href='$1'>$1</a>", $username);
    $formatted_user = preg_replace('/\#(\w+)/', "<a class='formatted_user' target='_blank' href='https://twitter.com/search?f=tweets&vertical=default&q=$1'>#$1</a>", $formatted_user);
    $formatted_user = preg_replace('/(\w+)/', "<a class='formatted_user' target='_blank' href='http://twitter.com/$1'>$1</a>", $formatted_user);
	$info->username = $formatted_user;
    $info->coordinates = $tweet->geo->coordinates;
    $info->city = $tweet->place->full_name;
    $user_picture = $tweet->user->profile_image_url;
	$geo=$tweet->geo->coordinates;
    
    
    
	  if($q=="orlando"){
  $insert_coordinates = "INSERT INTO markers_orlando (user_picture, name, tweet, lat, lng, type)
                         VALUES ('$user_picture','".mysqli_real_escape_string($mysqli,$formatted_user)."','".mysqli_real_escape_string($mysqli,$formatted_text)."','$geo[2]', '$geo[3]', 'orlando')";
    }
    elseif($q=="denver"){
  $insert_coordinates = "INSERT INTO markers_denver (user_picture, name, tweet, lat, lng, type)
                         VALUES ('$user_picture','".mysqli_real_escape_string($mysqli,$formatted_user)."','".mysqli_real_escape_string($mysqli,$formatted_text)."','$geo[0]', '$geo[1]', 'denver')";
    }
    elseif($q=="houston"){
  $insert_coordinates = "INSERT INTO markers_houston (user_picture, name, tweet, lat, lng, type)
                         VALUES ('$user_picture','".mysqli_real_escape_string($mysqli,$formatted_user)."','".mysqli_real_escape_string($mysqli,$formatted_text)."','$geo[0]', '$geo[1]', 'houston')";
    }
    elseif($q=="la"){
  $insert_coordinates = "INSERT INTO markers_la (user_picture, name, tweet, lat, lng, type)
                         VALUES ('$user_picture','".mysqli_real_escape_string($mysqli,$formatted_user)."','".mysqli_real_escape_string($mysqli,$formatted_text)."','$geo[0]', '$geo[1]', 'la')";
    }
    elseif($q=="newyork"){
  $insert_coordinates = "INSERT INTO markers_new_york (user_picture, name, tweet, lat, lng, type)
                         VALUES ('$user_picture','".mysqli_real_escape_string($mysqli,$formatted_user)."','".mysqli_real_escape_string($mysqli,$formatted_text)."','$geo[0]', '$geo[1]', 'new_york')";
    }   
    else return false;
    
    $mysqli->query($insert_coordinates);
    
    array_push($response->tweets,$info);
}
echo json_encode($response);