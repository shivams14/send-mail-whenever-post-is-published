<?php

$server = 'localhost';
$user = 'sweetsiteuser';
$pass = 'sweetsitedb';
$db = 'sweetsitedb';

$conn = mysqli_connect($server,$user,$pass,$db);

if (!$conn){
    //echo "not connected";
}
else{

    $email = $_POST['EMAIL'];
    
    $check_sql = "SELECT * FROM `newsletters` WHERE `email`='$email'";
    $check_query = mysqli_query($conn,$check_sql);
    
    $row = mysqli_num_rows($check_query);
    
    $data = mysqli_fetch_assoc($check_query);
    //echo $data['email'];
    if ($data['email']==$email){
        echo "matched";
    }
    else{
    
        $sql = "INSERT INTO `newsletters` (`email`) VALUES ('$email')";
        $query = mysqli_query($conn,$sql);
        
        if ($query){
            echo "submit";
        }
    }
}



//echo "submit";
//require_once('wp-load.php');

/*global $wpdb;

$email = $_POST['email'];
//$table_name = $wpdb->prefix.'newsletters';
$insert = $wpdb->insert( 'newsletters', array('email' => $_POST['email'],),array( '%s')
);

if ($insert){
    echo "submit";
}*/


?>
