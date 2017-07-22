<?
#https://github.com/J7mbo/twitter-api-php
require_once('TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "888708594635550721-iU9d9sJy7bY1s9IhAviyeeXxFAlK4Ia",
    'oauth_access_token_secret' => "2jxx9U5NbLqDDqxiDOUH4fiywmnz1tXey7zL9jYdZVsVQ",
    'consumer_key' => "8t5rHV5Js6SvEtcp0ViitjXcn",
    'consumer_secret' => "PgvMAbv915NbLpDA7SjxANnkjhB46AMM7JclTr145Nyp7zztvh"
);


$url = 'https://api.twitter.com/1.1/statuses/mentions_timeline.json';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$mentions = $twitter->buildOauth($url, $requestMethod)
    ->performRequest();

$mentionsObject = json_decode($mentions);

function findRemovedUsers($mentionsObject) {
    $filteredMentions = array_filter($mentionsObject, function($tweet) {
        return !!(strstr($tweet->text, "hello"));
        #return !!(strstr($tweet->text, "remove"));
    });
    return array_map(function($tweet) {
        return $tweet->user->screen_name;
    }, $filteredMentions) ;
}

$blacklist = findRemovedUsers($mentionsObject);


function filterMentionsByUser($user_blacklist, $mentionsObject) {
    $filteredMentions = [];
    foreach($mentionsObject as $tweet) {

        if (! in_array($tweet->user->screen_name, $user_blacklist) ) {
            $filteredMentions[] = $tweet;
        }
    };
    return $filteredMentions;
};


 $filteredMentions =  filterMentionsByUser($blacklist, $mentionsObject);



foreach($filteredMentions as $tweet) {
    print_r( $tweet->user->name);
    print_r(", ");
    print_r( $tweet->user->screen_name);
    print_r(", ");
    print_r( $tweet->text);
    print_r("\n");
}





?>
