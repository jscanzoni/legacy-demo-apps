<?php
if(!file_exists("./data/data.json")){
  $reset = file_get_contents('./data/reset.json');
  $dataFile = fopen("./data/data.json", "w") or die("Unable to open file!");
  fwrite($dataFile, $reset);
  fclose($dataFile);
}
include "./includes/fields.php"; 
?>
<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= $appname ?></title>
  <meta name="description" content="A simple from <?= $copyright ?> that's never, ever going to be maintained. Need help? Email the IT department!">
  <meta name="author" content="Jason Scanzoni - Appian Solutions Consultant">

</head>

<body>