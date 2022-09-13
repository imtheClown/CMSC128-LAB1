<?php
session_start();
include("connection.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password1'];

	$userNameCheck = "SELECT user_name FROM websiteusers WHERE user_name = '$username';";
	$sameUser = $conn -> query($userNameCheck);
	if($sameUser -> num_rows > 0){
		echo "<script>alert('USERNAME IS NOT AVAILABLE')</script>";
	}
	else{
		$query = "INSERT INTO websiteUsers(user_name, password) VALUES('$username', '$password')";
		if($conn -> query($query)){
			header("location:login.php");
		}
		else{
			echo "<script>alert('Failed to sign up')</script>";
		}
	}

}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>index</title>
	<link rel="stylesheet" href="login.css">
</head>
<body>
	<div class="box-alert" id="alert">
		<div class = "alert">
			<p id="paragraph">something is wrong</p>
			<button class="alert-button" id="alert-button">OK</button>
		</div>
		
	</div>
	<div class= "box-cover" id = "cover">
		<form class ="loginForm2" action="" method="POST" accept-charset="utf-8">
			<div>
				<p class = "login">sign up</p>
				<input type="text" name="username" placeholder="username" class="field" id="username">
				<br>
				<input type="password" name="password1" placeholder="password" class="passwordfield" id="priPassword">
				<span><input type="button" name="" class="extend" id="button1" value = "show"></span>
				<br>
				<input type="password" name="password2" placeholder="re-type password" class="passwordfield" id="secoPassword">
				<span class="extend"><input type="button" name="" class="extend" id="button2" value="show"></span>
				<br>
				<input type="submit" name="submit" value="sign up" class="button" id="submit"> 
				<br>
				<p><a href="login.php" title="">return to log in</a></p>
			</div>
		</form>
		
	</div>
		<script>
			const submit = document.getElementById("submit");
			const alertButton = document.getElementById("alert-button");
			const paragraph = document.getElementById("paragraph");
			const alert = document.getElementById("alert");
            const cover =document.getElementById("cover");
            const username = document.getElementById("username");
			const primaryPassword = document.getElementById("priPassword");
			const secondaryPassword = document.getElementById("secoPassword");
			const button1 = document.getElementById("button1");
			const button2 = document.getElementById("button2");
			var passwordStatement = "";
			var finished = false;
			var timer = undefined;

			function disable(){
				var disabler = submit.disabled;
				if(!disabler){
					submit.disabled = true;
				}
			}

			function hideAlert(){
				alert.style.display = "none";
				cover.style.display = "";
			}

			function showAlert(){
				alert.style.display = "";
				cover.style.display = "none";
			}

			function passWordChecker(){
				var passwordValue = primaryPassword.value
				if(passwordValue.search(/[A-Z]/) == -1| passwordValue.search(/[0-9]/) == -1|passwordValue.search(/[-_]/)== -1){
					if(passwordValue.length != 0){
						passwordStatement = "Password Must Contain At Least One Capital Letter, A Number and - Or _";
					}
				}
				if(passwordValue.length < 8 && passwordValue.length != 0){
					passwordStatement = "Password Must Be At Least 8 Characters Long";
				}
				if(passwordStatement != ""){
					secondaryPassword.disabled = true;
					paragraph.innerHTML = passwordStatement;
					disable();
					showAlert();
				}
			}

			window.addEventListener("DOMContentLoaded", hideAlert());

			alertButton.addEventListener("click", hideAlert);

			primaryPassword.addEventListener("keydown", ()=>{
				clearTimeout(timer);
				passwordStatement = "";
				secondaryPassword.disabled = false;
			})

			secondaryPassword.addEventListener("keydown", () =>{
				if(secondaryPassword.value == ""){
					passWordChecker();
					secondaryPassword.value ="";
				}
			})

			submit.addEventListener("mousemove", ()=>{
				var sentence ="";
				if((primaryPassword.value != secondaryPassword.value) && secondaryPassword.value.length != 0){
					sentence = "Passwords Does Not Match";
				}
				if(username.value == "" | primaryPassword.value == "" | secondaryPassword.value == ""){
					sentence = "Please Fill Up All the Fields";
				}

				if(sentence != ""){
					disable()
					paragraph.innerHTML = sentence;
					showAlert();
				}
				else{
					submit.disabled = false;
				}
		
			})



			button1.addEventListener("click", ()=>{
				if(primaryPassword.getAttribute("type") == "password"){
					primaryPassword.setAttribute("type", "text");
					button1.setAttribute("value", "hide");
				}
				else{
					primaryPassword.setAttribute("type", "password");
					button1.setAttribute("value", "show");
				}
			})

			button2.addEventListener("click", ()=>{
				if(secondaryPassword.getAttribute("type") == "password"){
					secondaryPassword.setAttribute("type", "text");
					button2.setAttribute("value", "hide");
				}
				else{
					secondaryPassword.setAttribute("type", "password");
					button2.setAttribute("value", "show");
				}
			})


	</script>
	
</body>
</html>