<?php include("inc/header.inc.php");
include("ontology.php"); 
include("recommendations.php");
?>
<?php
$video_id = (int)$_GET["v"];

$query = "SELECT * FROM videos WHERE id='$video_id'";
$result = mysqli_query($con, $query);
$get = mysqli_fetch_assoc($result);
$title = $get["title"];
$video_url = substr($get["url"], 1);
$is_clip = $get["is_clip"];
$view_count = $get["view_count"];

mysqli_query($con, "UPDATE videos SET view_count = view_count+1 WHERE id='$video_id'");

if(isset($_GET["recommended_from"]))
{
	$recommended_from = $_GET["recommended_from"];
}
else
{
	$recommended_from = 0;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$load_id = generateRandomString();

$search_query = "";
if(isset($_GET["search"]))
{
	$search_query = $_GET["search"];
}

mysqli_query($con, "INSERT INTO video_loads (unique_id, video_id, user_email, view_duration, view_time, recommended_from, search_query) VALUES ('$load_id', '$video_id', '$email', '0', '$datetime', '$recommended_from', '$search_query')");

?>
<div style = "padding-left:10px;">
<div class="row">
<div class = "col-md-8">
	<video controls autoplay width='100%' id="video-clip"> <source src="<?php echo $video_url;?>" type='video/mp4'> </video><br><br>
	<h5><?php echo $title;?></h5>
	<div align="right" style="margin-top:-30px;">
		<h5><?php echo $view_count;?> views</h5>
	</div>
</div>
<div class = "col-md-4">
	<div style="overflow:auto; height: 100%;">
	<?php
	if($is_clip == 1)
	{
		$tag = $_GET["search"];

		$parent_id = $get["parent_id"];
		$sql_query = "SELECT * FROM videos WHERE id='$parent_id'";
		$parent_result = mysqli_query($con, $sql_query);
		$parent_get = mysqli_fetch_assoc($parent_result);
		$parent_title = $parent_get["title"];

		$parent_url = substr($parent_get["url"], 1);
		?>
		<div class="row">
			<div class="col-md-3">
				<a href="video.php?v=<?php echo $parent_id?>&search=<?php echo $tag;?>"><img src="<?php echo $parent_url.'.jpg'?>" width="100%"></a><br><br>
			</div>
			<div class="col-md-7">
				<a href="video.php?v=<?php echo $parent_id?>&search=<?php echo $tag;?>"><font color='black'><?php echo $parent_title?></font></a><br>
				<font size='2'>Full Lecture</font><br><br>
			</div>
		</div>
		<hr>
		<?php
	}
	$recommendations = get_recommendations($video_id, $con, strtolower($title), $tree, $tree_nodes, $parent);
	for($i=0;$i<sizeof($recommendations);$i++)
	{
		$id = $recommendations[$i];
		$sql_query = "SELECT * FROM videos WHERE id='$id'";
		$result = mysqli_query($con, $sql_query);
		$get = mysqli_fetch_assoc($result);
		$title = $get["title"];
		$view_count = $get["view_count"];
		$url = substr($get["url"], 1);
		$img_url = substr($get["img_url"], 1);
		$is_clip = $get["is_clip"];
		?>
		<div class="row">
			<div class="col-md-4">
				<a href="video.php?v=<?php echo $id?>&recommended_from=<?php echo $video_id?>"><img src="<?php echo $img_url?>" width="100%"></a><br><br>
			</div>
			<div class="col-md-7">
				<a href="video.php?v=<?php echo $id?>&recommended_from=<?php echo $video_id?>"><font color='black'><?php echo $title?></font></a><br>
				<font size='2'>Recommended for You Next</font><br><br>
			</div>
		</div>
		<?php
	}
	?>
	</div>
</div>
</div>
</div>
<script>
var videocontainer = '#video-clip';
var vid = document.getElementById("video-clip");
 
$(videocontainer).on('play', function() {
  console.log("play");
  console.log(vid.currentTime);

	$.ajax(
	{
		url: "backend/video-activity.php",
		dataType: "json",
		type:"POST",
		data:
		{
			activity: 'play',
			video_id: "<?php echo $video_id;?>", 
			time: vid.currentTime,
			load_id: "<?php echo $load_id;?>", 
		},
		success: function(json)
		{
			if(json.status==1)
			{

			}
			else
			{

			}
		},
		error : function()
		{
			console.log("something went wrong");
		}
	});
});

$(videocontainer).on('pause', function() {

  console.log("pause");
  console.log(vid.currentTime);

  $.ajax(
	{
		url: "backend/video-activity.php",
		dataType: "json",
		type:"POST",
		data:
		{
			activity: 'pause',
			video_id: "<?php echo $video_id;?>", 
			time: vid.currentTime,
			load_id: "<?php echo $load_id;?>", 
		},
		success: function(json)
		{
			if(json.status==1)
			{

			}
			else
			{

			}
		},
		error : function()
		{
			console.log("something went wrong");
		}
	});
});

function add_duration()
{
	$.ajax(
	{
		url: "backend/add_duration.php",
		dataType: "json",
		type:"POST",
		data:
		{
			load_id: "<?php echo $load_id;?>", 
		},
		success: function(json)
		{
			if(json.status==1)
			{

			}
			else
			{

			}
		},
		error : function()
		{
			console.log("something went wrong");
		}
	});

	setTimeout(function(){
  
    add_duration();

  }, 10000)
}
window.onload=add_duration();
</script>