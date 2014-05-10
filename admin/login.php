<?php

session_start();

$adminuser = "admin"; // CHANGE THIS TO A NEW USERNAME
$adminpass = "password"; // CHANGE THIS TO A NEW PASSWORD

//get the posted values
$username = $_POST['username'];
$password = $_POST['password']; 

if($username == $adminuser && $password == $adminpass) {
                echo "yes";
                //now set the session from here if needed
                $_SESSION['admin'] = $username;
}
else {
        echo "no"; 
}
?>