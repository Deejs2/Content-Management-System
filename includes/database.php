<?php 
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "cms");
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(!$conn){
    echo "Error : ".mysqli_connect_error();
}
?>