<?php include("../inc/connect.inc.php");

$name = $_POST["signup_name"];
$email = $_POST["signup_email"];
$password = $_POST["signup_pass"];
$roll = $_POST["signup_roll"];

$password = md5($password);

$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);

if($numResults == 1)
{
	echo "<br><br><br><center><h1>Already registered!</h1></center>";
}
else
{
	$query = "INSERT INTO users (email, password, name, roll_no) VALUES ('$email', '$password', '$name', '$roll')";
	mysqli_query($con, $query);

	session_start();
	$_SESSION["email"] = $email;
	
	header("Location: ../index.php");
}

?>
