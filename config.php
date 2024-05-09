<?php
$arrGroup = [
    1=>"PZ-21",
    2=>"PZ-22",
    3=>"PZ-23"
];
$arrGender = [
    1=>"M",
    2=>"F",
    3=>"Other"
];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection error: " .$conn->connect_error);
}
//echo "Succes connection";
?>