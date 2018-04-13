<?php include("../inc/connect.inc.php");

$email = $_POST["login_email"];
$password = $_POST["login_pass"];

$password = md5($password);

$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($con, $query);

$get = mysqli_fetch_assoc($result);
$numResults = mysqli_num_rows($result);

if($numResults == 1)
{
	session_start();
	$_SESSION["email"] = $email;

	$query = "INSERT INTO login_details (email, login_time) VALUES ('$email','$datetime')";
	mysqli_query($con, $query);
	header("Location: ../index.php");
}
else
{
	echo "<br><br><br><center><h2>Invalid credentials! Please go back and re-enter your Email and Password.</h2></center>";
}

?>
