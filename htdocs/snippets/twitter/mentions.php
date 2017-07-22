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

print_r( $mentionsObject[0]->user->name);
print_r("\n");
print_r( $mentionsObject[0]->text);

?>
