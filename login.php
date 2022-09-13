<?php
session_start();
include("connection.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM websiteUsers WHERE user_name ='$username'";

    $result = $conn -> query($query);

    if($result ->num_rows == 0){
        echo "<script>alert('Username does not exist. Try signin up')</script>";
    }
    else{
        $getPass = "SELECT password FROM websiteUsers WHERE user_name = '$username'";
        $thisPass = $conn -> query($getPass);
        if($result = $thisPass -> fetch_assoc()){//edit this one
			if($result["password"] == $password){
				$_SESSION['user'] = $username;
				header("location:index.php");
			}
			else{
				echo "<script>alert('wrong password')</script>";
			}
        }
    }



    echo '<script>console.log("$username")</script>';

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Log In</title>
	<link rel="stylesheet" href="login.css">
</head>
<body id="body">
	<div class="box-alert" id="alert">
		<div class = "alert">
			<p id = "paragraph">something is wrong</p>
			<button class="alert-button" id="alert-button">OK</button>
			
		</div>
		
	</div>
	<div class= "box-cover" id="cover">
		<form class ="loginForm" action="" method="POST" accept-charset="utf-8">
			<div>
				<p class = "login">log in</p>
				<input type="text" name="username" placeholder="username" class="field" id="username">
				<br>
				<input type="password" name="password" placeholder="password" class="passwordfield" id="password1">
				<span class="extend"><input type="button" name="button1" class="extend" id="button1" value="show"></span>
				<br>
				<input type="submit" name="submit" value="Log In" class="button" id="submit"> 
				<p>does not have an account?</p>
				<p>sign up <a href="signup.php" title="">here</a></p>
			</div>
		</form>
		
	</div>
	<script>
		const submit = document.getElementById("submit");
		const paragraph = document.getElementById("paragraph");
		const alertBox = document.getElementById("alert");
		const coverBox = document.getElementById("cover");
		const alertButton = document.getElementById("alert-button");
		const firstPassword = document.getElementById("password1")
		const firstButton = document.getElementById("button1");
		const username = document.getElementById("username");
		var timer = undefined;

		function showAlert(){
			alertBox.style.display = "";
			coverBox.style.display = "none";
		}

		function hideAlert(){
			alertBox.style.display = "none";
			coverBox.style.display = "";
		}

		function disable(){
			var disable = submit.disabled;
			if(!disable){
				submit.disabled = true;
			}
		}

		window.addEventListener("DOMContentLoaded", () =>{
			coverBox.style.display = "block";
			alertBox.style.display = "none";
		})
		alertButton.addEventListener("click", hideAlert);

		submit.addEventListener("mousemove", () =>{
			var disable = submit.disabled;
			if(firstPassword.value == "" | username.value == ""){
				if(!disable){
					submit.disabled = true;
					paragraph.innerHTML = "Missing User Name or Password";
					showAlert();
				}

			}
			else{
				if(disable){
					submit.disabled = false;
				}
			}
		})

		firstButton.addEventListener("click", ()=>{
				if(firstPassword.getAttribute("type") == "password"){
					firstPassword.setAttribute("type", "text");
					firstButton.setAttribute("value", "hide");
				}
				else{
					firstPassword.setAttribute("type", "password");
					firstButton.setAttribute("value", "show");
				}
			})
	</script>
</body>
</html>