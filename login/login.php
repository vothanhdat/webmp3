
<?php
	session_start();
	include '../sqlconfig.php';

	$conn = mysqli_connect($sql_servername, $sql_username, $sql_password, $sql_dbname);
	mysqli_set_charset($conn, "utf8");


	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	if(isset($_GET['signup']))
		create_user($conn);
	else if(isset($_GET['user']) && isset($_GET['pass']))
		get_user_login($conn,$_GET['user'],$_GET['pass']);
	else if(isset($_GET['logout']))
		get_user_logout($conn);
	

	function get_user_login($conn,$username,$pass)
	{
		$sql = "SELECT `login`('$username', '$pass') AS `login`";
		$result = $conn->query($sql);
		switch($result->fetch_assoc()['login']){
			case '0':
				$sql = "SELECT * FROM user WHERE username = '$username'";

				$result = $conn->query($sql);
				$d = array();
				$d[]= "Done";
				while ($row = $result->fetch_assoc())
					$d[] = $row;
				unset($d[1]["pass_md5"]);
				
				$_SESSION['login'] = $username;
				
				switch($d[1]["per"]){
					case '0':
						$_SESSION['admin'] = "admin";
					break;
					case '1':
						$_SESSION['content'] = "content";
					break;
					case '2':
						$_SESSION['user'] = "user";
					break;
				}
				$json = json_encode($d);
				echo $json;
			break;
			case '1':
				$d = array();
				$d[]= "ipass";
				$json = json_encode($d);
				echo $json;
			break;
			case '2':
				$d = array();
				$d[]= "iuser";
				$json = json_encode($d);
				echo $json;
			break;	
		}
	}
	
	function get_user_logout($conn){
		unset($_SESSION['login']);
		unset($_SESSION['admin']);
		unset($_SESSION['content']);
		unset($_SESSION['user']);
		return "['asfasf':'sss']";
	}

	function create_user($conn){
		$d = array();


		if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['email']) && isset($_GET['sex']) && isset($_GET['addr'])){
			$username = $_GET['username'];
			$password = $_GET['password'];
			$email = $_GET['email'];
			$sex = $_GET['sex'];
			$addr = $_GET['addr'];
			$date = date('Y-m-d H:i:s');
			
			$sql = "INSERT INTO user (username, pass_md5, email, date, per, sex, addr) VALUES ('$username', '$password', '$email', '$date', '2', '$sex', '$addr');";

			if ( $conn->query($sql) === true) {
				$_SESSION['login'] = $username;
				$_SESSION['user'] = "user";
				$d[]= "DONE";
			}else{
				$d[]= "ERROR";
			}
		}else{
			$d[]= "ERROR";
		}
		$json = json_encode($d);
		echo $json;
	}
?>
