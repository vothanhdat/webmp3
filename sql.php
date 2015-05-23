<?php
if(!isset($_SESSION))
	session_start();
header('Content-Type: application/json');

include 'sqlconfig.php';

$conn = mysqli_connect($sql_servername, $sql_username, $sql_password, $sql_dbname);
mysqli_set_charset($conn, "utf8");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




if(isset($_GET['filter'])){
	get_product_filter($conn);
}else if(isset($_GET['product'])){
	get_product($conn);
}else if(isset($_GET['manufacture'])){
	get_manufacter($conn);
}else if(isset($_GET['cagetory'])){
	get_catalog($conn);
}else if(isset($_GET['user'])){
	get_user($conn);
}

function get_catalog($conn)
{
    $sql = "SELECT * FROM catalog";
    $result = $conn->query($sql);

	$d = array();
	while ($row = $result->fetch_assoc()) {
		$d[] = $row;
	}
	$json = json_encode($d);
	echo $json;
}

function get_manufacter($conn)
{
    $sql = "SELECT * FROM manufacture";
    $result = $conn->query($sql);
	$d = array();
	while ($row = $result->fetch_assoc()) {
		$d[] = $row;
	}
	$json = json_encode($d);
	echo $json;
}

function get_product($conn)
{
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);

	$d = array();
	while ($row = $result->fetch_assoc()) {
		$d[] = $row;
	}
	$json = json_encode($d);
	echo $json;
}


function get_product_filter($conn)
{
    $sql="";
    if (isset($_GET['cagetory']))
        $sql = "SELECT * FROM product WHERE catalogID='" . $_GET['cagetory'] . "';";
    else  if (isset($_GET['manufacter']))
        $sql = "SELECT * FROM product WHERE manufactorID='" . $_GET['manufacter'] . "';";
	
	$result = $conn->query($sql);
	$d = array();
	while ($row = $result->fetch_assoc()) {
		$d[] = $row;
	}
	$json = json_encode($d);
	echo $json;
}

function get_html($conn,$id)
{
    $sql = "SELECT * FROM html WHERE id='$id'";
    $result = $conn->query($sql);
	$d = array();
	while ($row = $result->fetch_assoc()) {
		$d[] = $row;
	}
	$json = json_encode($d);
	echo $json;
}

function get_user_login($conn,$username,$pass)
{
    $sql = "SET @p0='$username'; SET @p1='$pass'; SELECT `login`(@p0, @p1) AS `login`;";
    $result = $conn->query($sql);
	$d = array();
	while ($row = $result->fetch_assoc()) {
		$d[] = $row;
	}
	$json = json_encode($d);
	echo $json;
}

function get_user($conn)
{
	if(isset($_SESSION['login'])){
		$user = $_SESSION['login'];
		$sql = "SELECT * FROM user WHERE username = '$user'";
		$result = $conn->query($sql);
		$d = array();
		while ($row = $result->fetch_assoc()) {
			$d[] = $row;
		}
		unset($d[0]["pass_md5"]);
		$json = json_encode($d);
		echo $json;
	}
}




