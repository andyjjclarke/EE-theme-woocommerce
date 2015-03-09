<?php
date_default_timezone_set('Europe/London');

$options =  array(
    'screen_name' => $_GET['screen_name'], 
    'count' => 1, 
    'trim_user' => 'false', 
    'exclude_replies' => 'false', 
    'include_rts' => 'true'
    );

$consumer_key    = 'PgxxZQwAiHY0QfU5mvWGw';
$consumer_secret = 'mswF7mvIig9I5cJV5pZqypkCAhMyy1G7RZq5RTh7dN4';
$user_token      = '1509913562-6DCKKMTcyq2x3jjisjjnGtkEaRGg8CwqZebAMkL';
$user_secret     = 'XPeiVw8LutKbxE7yjMNNIFjurxV8wK99QhlHHFYIZQ';

$cacheFile = getcwd() .  '/cache.json';

$diff = filemtime($cacheFile) - strtotime('now');
if(date('H', $diff) > '1' || !filesize($cacheFile)){
    //get tweets from twitter only if cache file is empty or an hour has passed
    require 'tmhOAuth.php';
    require 'tmhUtilities.php';
     $tmhOAuth = new tmhOAuth(array(
      'consumer_key'    => $consumer_key,
      'consumer_secret' => $consumer_secret,
      'user_token'      => $user_token,
      'user_secret'     => $user_secret,
    ));

    $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), $options);
    file_put_contents($cacheFile, $tmhOAuth->response['response']);
}

echo file_get_contents($cacheFile);