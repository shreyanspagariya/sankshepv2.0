<?php

function get_recommendations($video_id, $con, $title, $tree, $tree_nodes, $parent)
{
	$out = [];
	$index = 0;

	$count = [];
	$video_count = 2103;

	$videos_to_recommend = [];
	$liked = 0;
	$disliked_video = 2;
	$disliked_topic = 1;

	$priority = [];

	for($i=0;$i<=10000;$i++)
	{
		$videos_to_recommend[$i] = 0;
	}

	for($i=0;$i<=$video_count;$i++)
	{
		$count[$i] = 0;
	}

	//Getting Current Node
	$node = "";
	for($i=sizeof($tree_nodes)-1;$i>=0;$i--)
	{
		if(strpos($title, $tree_nodes[$i]) !== false)
		{
			$node = $tree_nodes[$i];
			break;
		}
	}
	if($node == "")
	{
		$getposts = mysqli_query($con,"SELECT * FROM keywords WHERE video_id='$video_id' ORDER BY frequency DESC");
		while($row = mysqli_fetch_assoc($getposts))
		{
			if(strpos($title, $row["keyword"]) !== false)
			{
				$node = $row["keyword"];
				break;
			}
		}
	}

	if($node == "")
	{
		return($out);
	}

	//Getting videos for "liked" response
	for($i=0;$i<sizeof($tree[$node]);$i++)
	{
		$getposts = mysqli_query($con,"SELECT * FROM videos");
		while($row = mysqli_fetch_assoc($getposts))
		{
			if(strpos(strtolower($row["title"]), $tree[$node][$i]) !== false)
			{
				$videos_to_recommend[$liked] = $row["id"];
				$liked += 3;
			}
		}
	}

	//Getting videos for "disliked_video" response
	$getposts = mysqli_query($con,"SELECT * FROM videos");
	while($row = mysqli_fetch_assoc($getposts))
	{
		if(strpos(strtolower($row["title"]), $node) !== false)
		{
			$videos_to_recommend[$disliked_video] = $row["id"];
			$disliked_video += 3;
		}
	}

	//Getting videos for "disliked_topic" response
	for($i=0;$i<sizeof($tree[$parent[$node]]);$i++)
	{
		if($tree[$parent[$node]][$i] != $node)
		{
			$getposts = mysqli_query($con,"SELECT * FROM videos");
			while($row = mysqli_fetch_assoc($getposts))
			{
				if(strpos(strtolower($row["title"]), $tree[$parent[$node]][$i]) !== false)
				{
					$videos_to_recommend[$disliked_topic] = $row["id"];
					$disliked_topic += 3;
				}
			}
		}
	}

	for($i=0;$i<=10000;$i++)
	{
		if($videos_to_recommend[$i] > 0 && $count[$videos_to_recommend[$i]] == 0 && $videos_to_recommend[$i] != $video_id)
		{
			$count[$videos_to_recommend[$i]] = 1;
			$out[$index++] = $videos_to_recommend[$i];
		}
	}
	//Ontology Part Done


	for($i=0;$i<=$video_count;$i++)
	{
		$priority[$i] = 99999;
	}

	$getposts = mysqli_query($con,"SELECT * FROM mined_sequences WHERE count > 1");
	while($row = mysqli_fetch_assoc($getposts))
	{
		$sequence = $row["sequence"];
		$a = explode('-', $sequence);
		for($i=0;$i<sizeof($a);$i++)
		{
			if($a[$i] == $video_id)
			{
				for($j=$i+1;$j<sizeof($a); $j++)
				{
					$priority[$a[$j]] = min($priority[$a[$j]], $j-$i);
				}
			}
		}
	}

	for($i=0;$i<sizeof($out);$i++)
	{
		for($j=$i+1;$j<sizeof($out);$j++)
		{
			if($priority[$out[$i]] > $priority[$out[$j]])
			{
				$temp = $out[$i];
				$out[$i] = $out[$j];
				$out[$j] = $temp;
			}
		}
	}
	//Sequence Mining Part Done

	return($out);
}

?>