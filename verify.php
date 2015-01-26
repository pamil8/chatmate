<?php
	session_start();
	$username=$_REQUEST['username'];
	$password=$_REQUEST['pass'];
	$encrypted_password=md5($password);
	$con=mysql_connect("mysql.hostinger.in","u158767291_user","6IOyosV0Ku");
	if(mysql_errno()){
		echo "Failed to connect";
	}
	mysql_select_db("u158767291_chat");
	$flag=0;
	$result=mysql_query("SELECT * FROM users");
	while($row=mysql_fetch_array($result)){
		if($row['username']==$username && $row['password']==$encrypted_password){
			$flag=1;
			$_SESSION['name'] = stripslashes(htmlspecialchars($_POST['username']));
			header('Location: http://www.getgadget.co.in/chatmate/index.php');
		}
	}
	if($flag==0){
		echo "<h2>Wrong username and password</h2>";
		//sleep(10);
		header( 'Location: http://www.getgadget.co.in/chatmate/index.php' ) ;
		echo '<span class="error">Wrong username or password</span>';
	}
	mysql_close();
?>