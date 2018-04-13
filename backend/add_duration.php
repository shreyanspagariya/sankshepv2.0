<?php include("../inc/connect.inc.php"); 

$load_id = $_POST["load_id"];

mysqli_query($con, "UPDATE video_loads SET view_duration = view_duration + 10 WHERE unique_id='$load_id'");

$result = array('status' => 1,'msg'=>'success');
echo json_encode($result);

?>