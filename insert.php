<?php
$name=$_REQUEST['name'];
$age=$_REQUEST['age'];
$gender=$_REQUEST['gender'];
$userName=$_REQUEST['username'];
$password=$_REQUEST['pass'];
$encrypted_password=md5($password);
$con=mysqli_connect("mysql.hostinger.in","u158767291_user","6IOyosV0Ku","u158767291_chat");
if(mysql_errno()){
	echo "Failed to connect to database";
}
$sql="INSERT INTO users(username,password,name,age,gender) VALUES('$userName','$encrypted_password','$name','$age','$gender')";
if(mysqli_query($con,$sql)){
	echo "Welcome ".$name." Here are your details<br> Name : ".$name."<br>Age : ".$age."<br>Gender : ".$gender."<br>Username :".$userName."<br>Password :".$password;
	//sleep(5);
	header("Location:http://www.getgadget.co.in/chatmate/index.php");
}
else{
	echo "Failed";
}
mysqli_close($con);
?>