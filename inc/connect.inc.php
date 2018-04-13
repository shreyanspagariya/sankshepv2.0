<?php

$local_user = "root";
$local_pass = "12345678";
$local_db = "sankshep";

$server_user = "shreyans";
$server_pass = "user2018";
$server_db = "shreyans";

$con = mysqli_connect("localhost",$local_user,$local_pass,$local_db);
//$con = mysqli_connect("localhost",$server_user,$server_pass,$server_db);

$g_url = "http://localhost/sankshepv2.0/";
//$g_url = "http://10.4.14.50/shreyans/sankshepv2.0/";

date_default_timezone_set("Asia/Kolkata");
$datetime = date("Y-m-d H:i:s");
?>