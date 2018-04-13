<?php

include("../../inc/connect.inc.php");

$getposts = mysqli_query($con,"SELECT * FROM videos");
while($row = mysqli_fetch_assoc($getposts))
{
	$id = $row["id"];
	$is_clip = $row["is_clip"];
	$parent_id = $row["parent_id"];

	if($is_clip == 1)
	{
		$parent_id = $row["parent_id"];
		$sql_query = "SELECT * FROM videos WHERE id='$parent_id'";
		$result = mysqli_query($con, $sql_query);
		$get = mysqli_fetch_assoc($result);
		$url = $get["url"].".jpg";
	}
	else
	{
		$url = $row["url"].".jpg";
	}
	mysqli_query($con, "UPDATE videos SET img_url='$url' WHERE id='$id'");
}

?>