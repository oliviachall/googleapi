<link href="twitterstyle.css" rel="stylesheet">


<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="jquery.tweet-linkify.js"></script>


<script>
    function pageReady(){
        console.log("pageReady()");
        $('p.tweet').tweetLinkify();
        $('p.username').tweetLinkify();
    };
</script>

<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "506893987-HHPAOxgrVbXUISm2Qv9lDYhNiaVsgadNCxGtlcm8",
    'oauth_access_token_secret' => "npVVttaNxCRJ4RFjRMmhrzKnkXHJE0mn6OHn4FGAD0kcO",
    'consumer_key' => "zWLP8T8eQsiWFQlc6uoPvDs1c",
    'consumer_secret' => "9pjLDOYfEkNeuPowrzkGorRTa4cmtZEdbNb4HpwF0R2vyXxxuc"
);



/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
/**$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';**/

/** POST fields required by the URL above. See relevant docs as above **/
/**$postfields = array(
    'screen_name' => 'usernameToBlock', 
    'skip_status' => '1'
);**/

/** Perform a POST request and echo the response **/
/**$twitter = new TwitterAPIExchange($settings);
echo $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();**/

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/



$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23enoriver&count=20';


$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
/**echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();**/

$string = json_decode($twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest(),$assoc = TRUE);



foreach($string['statuses'] as $items)
    {
        $tweetText = $items['text'];
        $users = $items['user'];
        $tweetDate = $items['created_at'];
        
        
        
        echo "<img src ='" . $users['profile_image_url']. "' align='left'/>";
        
        echo "<p class='datetoshow'> " .$datetoshow = date("M d ", strtotime("$tweetDate")) . "<p/>";
        
        echo "<p class='username'> @" .$users['screen_name']. ":" . "<p/>";
        
        echo "<p class='tweet'>" .$tweetText . "<p/>";
        
        
        
        //echo "When: " . $items['created_at'] . " <br/>";
        echo "<hr/>";
        
    };

    
    
    echo '<script>pageReady();</script>';
    
    ?>
