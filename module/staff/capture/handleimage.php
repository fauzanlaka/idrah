<?php
session_start();
//$_SESSION['id']="1";
//$id=$_SESSION['id'];
$t_id = $_GET['t_id'];

include '../../../connect/connect.php';
$name = date('YmdHis');
$photo = $name."+".$t_id.".jpg";
$newname = "../photo/".$photo."";
$file = file_put_contents( $newname, file_get_contents('php://input') );
if (!$file) {
	print "Error occured here";
	exit();
}
else
{
    $sql = mysqli_query($con, "UPDATE teachers SET t_photo='$photo' WHERE t_id='$t_id'");
    //$result=mysqli_query($con,$sql);
    //$value=mysqli_insert_id($con);
    //$_SESSION["myvalue"]=$value;
	
}

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $newname;
print "$url\n";

?>
