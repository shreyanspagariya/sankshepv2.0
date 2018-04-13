<?php include("../inc/connect.inc.php"); 

session_start();
$email = $_SESSION["email"];

$activity = $_POST["activity"];
$time = $_POST["time"];
$video_id = $_POST["video_id"];
$load_id = $_POST["load_id"];

mysqli_query($con, "INSERT INTO videos_watch_history (video_load_id, user_email ,video_id, activity_type, time_lapsed, activity_time, is_inserted_manually, is_random) VALUES ('$load_id', '$email', '$video_id', '$activity', '$time', '$datetime', '0', '0')");

$result = array('status' => 1,'msg'=>$activity);
echo json_encode($result);

?>