<?php
if(!isset($_SESSION))
    session_start();
header('Content-Type: application/json');

include '../sqlconfig.php';

$conn = mysqli_connect($sql_servername, $sql_username, $sql_password, $sql_dbname);
mysqli_set_charset($conn, "utf8");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET["oder"]))
    on_oder($conn);
else if(isset($_GET["get_oder"]))
    get_oder($conn);






function on_oder($conn){
    if(isset($_SESSION["login"])){
        if(isset($_GET["proid"]) && isset($_GET["date"]) && isset($_GET["addr"]) && isset($_GET["quantity"])){
            $proid = $_GET["proid"];
            $date = $_GET["date"];
            $addr = $_GET["addr"];
            $quantity = $_GET["quantity"];
            $user = $_SESSION["login"];
            $sql = "INSERT INTO `ooder` (`product_id`, `user_id`, `quantity`, `date`, `addr`) VALUES ('$proid', '$user', '$quantity', '$date', '$addr')";
            if ( $conn->query($sql) === true) {
                $d[]= "DONE";
            }else{
                $d[]= "ERROR";
            }
            $json = json_encode($d);
            echo $json;
        }
    }
}


function get_oder($conn)
{
    $user = $_SESSION["login"];
    $sql = "SELECT * FROM ooder ".(isset($_SESSION["admin"])?"":("WHERE user_id='$user'"));
    $result = $conn->query($sql);

    $d = array();
    while ($row = $result->fetch_assoc()) {
        $d[] = $row;
    }
    $json = json_encode($d);
    echo $json;
}

?>