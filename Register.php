<?php
include'config.php';

error_reporting(0);
if(isset($_POST['submit'])){
	$Fname = $_POST['Fname'];
	$Lname = $_POST['Lname'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
	
	$check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'"));
	
	if($password !== $cpassword){
	echo "<script>alert('password not matched!')</script>";
	}
	elseif($check_email >0){
			echo "<script>alert('Email is already exsisting in the database!')</script>";
	}else{
		
		$sql = "INSERT INTO user(Fname,Lname,email,password)
		VALUES('$Fname','$Lname','$email','$password')";
		$result = mysqli_query($conn,$sql);
		
		
		if($result){
			$_POST["Fname"]="";
			$_POST["Lname"]="";
			$_POST["email"]="";
			$_POST["password"]="";
			$_POST["cpassword"]="";
			
				echo "<script>alert('User registration successfully.')</script>";
		}else{
			echo "<script>alert('User registration Failed.')</script>";
		}
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
	<link rel="stylesheet"  type="text/css" href="registercss.css">
</head>
<style>
body{
	margin:0;
	padding: 0;
	background:url("images/74198.jpg");
	background-size: cover;
	background-position: center;
	height: 100vh;
	font-family: sans-serif;
	
}
</style>
<body>
	<div class="Registerbox">
		<img src="images/avatar.png" class="avatar">
		<h1>Register Here</h1>
		<form action="Register.php" method="POST">
		<p>First name</p>
			<input type="text" name="Fname" placeholder="Enter First name" value ="<?php echo $_POST["Fname"]?>" required>
			<p>last name</p>
			<input type="text" name="Lname" placeholder="Enter Last name" value ="<?php echo $_POST["Lname"]?>" required>
			<p>Email</p>
			<input type="email" name="email" placeholder="Enter Email" value ="<?php echo $_POST["email"]?>" required>
			
			<p>Password</p>
			<input type="Password" name="password" placeholder="Enter Password" value ="<?php echo $_POST["password"]?>" required>
			<p> Confirm Password</p>
			<input type="Password" name="cpassword" placeholder="Enter Password again" value ="<?php echo $_POST["cpassword"]?>" required>
			<input type="submit" name="submit" value="Register">
		</form>
	
	
	</div>
</body>
	

</html>
