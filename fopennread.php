<?php
$credFile = fopen("cred.php","r");
//$twitchUser = "username:" . "chillbrobagg1ns";
//$userPin = "userpin:" . 1337;
//$oAuth = "uoauth:" . "16dhcr9kijibpa4v30y7c5ci1fdvga";
//$uData = [$twitchUser,$userPin,$oAuth];
//$wData = implode("\n", $uData);
$fData = fread($credFile,filesize("cred.php"));
echo $fData;
fclose($credFile);
?>