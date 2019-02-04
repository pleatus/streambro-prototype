<?php
$credFile = fopen("cred.php","w");
$clientID = "clientid:" . "dg57ggohohzi2wonuxsqsx716p7er3";
//vars to store user supplied info to init steamBro application, stored to DB
$recEmail = "recoveryemail:" . "rayjaworski@gmail.com";
$appUser = "appuser:" . "chillbro";
$appPassword = "apppass:" . password_hash('password',PASSWORD_DEFAULT);
$userPin = "userpin:" . 1337;
//vars to store user supplied info to link with twitch and authorize app to act on behalf of account
$twitchUser = "username:" . "chillbrobagg1ns";
$channelID = "channelid:" . 140686783;
$oAuth = "uoauth:" . "16dhcr9kijibpa4v30y7c5ci1fdvga";
//array storing data to be written to file (for twitch access/auth)
$uData = [$twitchUser,$channelID,$oAuth];
//array storing data to be written to db
$uDataDb = [$recEmail,$appUser,$appPassword,$userPin];
$wData = implode(",\n", $uData);
//echo $wData;
fwrite($credFile,$wData);
fclose($credFile);
?>