<?php include("inc/header.inc.php"); ?>
<?php
$query = strtolower($_GET["query"]);
mysqli_query($con, "INSERT INTO search_history (user_email, search_query, search_time) VALUES ('$email', '$query', '$datetime')");
?>
<div class="container">
	Showing results for <b>'<?php echo ucwords($query);?>'</b>.<br><br>
	<?php
		$getposts = mysqli_query($con,"SELECT * FROM videos ORDER BY view_count DESC");
		while($row = mysqli_fetch_assoc($getposts))
		{
			$id = $row["id"];
			$title = $row["title"];
			$view_count = $row["view_count"];
			$url = substr($row["url"], 1);
			$img_url = substr($row["img_url"], 1);
			$lower_title = strtolower($title);
			$is_clip = $row["is_clip"];
			if(strpos($lower_title, $query) !== false && $is_clip == 0)
			{
				?>
				<div class="row">
					<div class="col-md-3">
						<a href="video.php?v=<?php echo $id?>&search=<?php echo $query;?>"><img src="<?php echo $img_url?>" width="100%"></a><br><br>
					</div>
					<div class="col-md-7">
						<h5><a href="video.php?v=<?php echo $id?>&search=<?php echo $query;?>"><font color='black'><?php echo $title?></font></a></h5>
						<?php echo $view_count?> views
					</div>
				</div>
				<?php
			}
			else if(strpos($lower_title, $query) !== false && $is_clip == 1)
			{
				$parent_id = $row["parent_id"];
				$sql_query = "SELECT * FROM videos WHERE id='$parent_id'";
				$result = mysqli_query($con, $sql_query);
				$get = mysqli_fetch_assoc($result);
				$parent_title = $get["title"];
				?>
				<div class="row">
					<div class="col-md-3">
						<a href="video.php?v=<?php echo $id?>&search=<?php echo $query;?>"><img src="<?php echo $img_url?>" width="100%"></a><br><br>
					</div>
					<div class="col-md-7">
						<h5><a href="video.php?v=<?php echo $id;?>&search=<?php echo $query;?>"><font color='black'><?php echo $title?></font></a></h5>
						<?php echo $view_count?> views<br><br><font color='#848484' size='3'>A short clip on <b>'<?php echo ucwords($query);?>'</b> picked up from the lecture <b><u><a href="video.php?v=<?php echo $parent_id;?>&search=<?php echo $query;?>"><font color='#848484'><?php echo $parent_title ?></font></a></u></b></font>
					</div>
				</div>
				<?php
			}
		}
	?>
</div>
</body>
</html>