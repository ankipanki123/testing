<?php
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Client;

$client = new Client();
$url = 'http://unicorns.idioti.se';
if(isset($_GET['id']))
{
  $url.= "/".$_GET['id'];
}
$res = $client->request('GET', $url ,
[ 'headers'=>
  [  'Accept'=> 'application/json',]
]);
$data = json_decode($res->getBody());

$log = new Logger('Laboration 1');
$log->pushHandler(new StreamHandler('greetings.log', Logger::INFO));


if(isset($_GET['id']))
$log->info("reg info about: ".$data->name);
else
{
  $log->info("reg info about: All Unicorns");
}
?>
<!DOCTYPE html>
<html>
<head>

<title>Testing, testing</title>
<link rel="stylesheet" type="text/css" href="background.css">

</head>

<body>


<?php

  if(isset($_GET['id']))
  {
    echo "<h1> $data->name </h1>"  ;
    echo $data->description."<br>"."<br>";
    //echo $data->reportedBy."<br>";
    echo "<a href=\"index.php\">Tillbaka</a><br>";
    echo "<img src=$data->image>";

  }
  else
  {

    foreach ($data as $id => $unicorn)
    {
      echo "<a href=\"index.php?id=" .$unicorn->id . "\"> " . $unicorn->name . "</a><br>";

    }
  }
?>


</body>
</html>
