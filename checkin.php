<?php
$connection = mysqli_connect('localhost','root','root','event-checkin');
if (!$connection) {
	die('Could not connect to MySQL: ' . mysqli_error());
}

$id=$_REQUEST['id'];
$faculty = (isset($_REQUEST['faculty']))?'Faculty':'Student';
$sql = "UPDATE aisyc_delig SET status='checkedin',designation='".$faculty."'";
if(isset($_REQUEST['email']) && !empty($_REQUEST['email'])){
	$sql = $sql.",email='".$_REQUEST['email']."'";
}
if(isset($_REQUEST['contact']) && !empty($_REQUEST['contact'])){
	$sql = $sql.",contact='".$_REQUEST['contact']."'";
}
$sql = $sql." WHERE slno=".$id;
$sql_result = mysqli_query($connection,$sql) or die ('request "Could not execute SQL query" '.$sql);
header('Location: search.php');
?>
