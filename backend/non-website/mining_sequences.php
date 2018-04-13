<?php

include("../../inc/connect.inc.php");

$num_users = 20;

for($j=1;$j<=$num_users;$j++)
{
	$user_email = "bot-".(string)($j)."@gmail.com";

	$arr = [];

	$getposts = mysqli_query($con,"SELECT * FROM videos_watch_history WHERE user_email='$user_email' ORDER BY id ASC");
	while($row = mysqli_fetch_assoc($getposts))
	{
		$video_id = $row["video_id"];
		array_push($arr,$video_id);
	}
	for($l=2;$l<=10;$l++)
	{
		for($i=0;$i<=sizeof($arr)-$l;$i++)
		{
			$seq_str = "";
			for($k=$i;$k<$i+$l;$k++)
			{
				$seq_str .= (string)$arr[$k];
				if($k != $i+$l-1)
				{
					$seq_str .= "-";
				}
			}
			$query = "SELECT * FROM mined_sequences WHERE sequence='$seq_str'";
			$result = mysqli_query($con, $query);
			$numResults = mysqli_num_rows($result);
			if($numResults == 0)
			{
				mysqli_query($con,"INSERT INTO mined_sequences (sequence, count) VALUES ('$seq_str', '1')");
			}
			else
			{
				mysqli_query($con,"UPDATE mined_sequences SET count = count + 1 WHERE sequence='$seq_str'");
			}
		}
	}
}

?>