<?php
function sessionStarter($conn){
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        $query = "SELECT * FROM websiteUsers WHERE user_name = '$username'";
        $result = $conn -> query($query);
        if($result -> num_rows > 0){
           $user_data = $result -> fetch_assoc();
           return $user_data;
        }
    }
    else{
        header("location:login.php");
    }
}


function logOut(){
    session_destroy();
    header("location:login.php");
}
?>
