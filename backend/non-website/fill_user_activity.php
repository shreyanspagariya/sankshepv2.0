<?php 

include("../../inc/connect.inc.php");

$user_patterns = array(
					array(18,34,10,32), 
					array(47,4,37,1), 
					array(31,6,9,42), 
					array(19,7,23,14), 
					array(44,8,25,13,36,30,35), 
					array(33,5,38,11,27), 
					array(40,16,15,24,3), 
					array(28,2,21,41)
				);

$video_count = 2103;
$num_users = 20;

for($j=1;$j<=$num_users;$j++)
{
	$user_email = "bot-".(string)($j)."@gmail.com";

	for($i=0;$i<sizeof($user_patterns);$i++)
	{
		$random_activity_count = rand(1,10);

		for($k=0;$k<$random_activity_count;$k++)
		{
			$random_video_watched = rand(1,$video_count);

			mysqli_query($con,"INSERT INTO videos_watch_history (user_email, video_id, activity_type, time_lapsed, activity_time, is_inserted_manually, is_random) VALUES ('$user_email', '$random_video_watched', 'play', '0', '$datetime', '1', '1')");
		}

		for($k=0;$k<sizeof($user_patterns[$i]);$k++)
		{
			$video_watched = $user_patterns[$i][$k];
			
			mysqli_query($con,"INSERT INTO videos_watch_history (user_email, video_id, activity_type, time_lapsed, activity_time, is_inserted_manually, is_random) VALUES ('$user_email', '$video_watched', 'play', '0', '$datetime', '1', '0')");
		}
	}
}



?>