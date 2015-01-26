<?php
include 'head.html';
?>
<script>
function validate(form){
	if(form.name.value.length==0){
		alert("Enter name");
		form.name.focus();
		return false;
	}
	if(form.age.value.length==0){
		alert("Enter age");
		form.age.focus();
		return false;
	}
	if(form.gender[0].checked == false && form.gender[1].checked == false){
		alert("Select gender");
		return false;
	}
	if(form.username.value.length==0){
		alert("Enter username");
		form.username.focus();
		return false;
	}
	if(form.pass.value.length==0){
		alert("Enter password");
		form.pass.focus();
		return false;
	}

}
</script>
<div id="registerform">
<div class="row">
	<div class="col-md-4"></div>
<div class="col-md-4 col-sm-12">
<form action="insert.php" method="post" onSubmit="return validate(this)" name="form">
        <p>Registration Form</p>
        <form action="insert.php" name="form" method="POST" onSubmit="return validate(this)">
	<div class="form-group">
		<input type="text"  class="form-control" name="name" placeholder="Enter name">
	</div>
	<div class="form-group">
		<input type="text" name="age"  class="form-control" placeholder="Enter age">
	</div>
	<div class="form-group">
	<div class="pam">Gender&nbsp&nbsp<input type="radio" name="gender" value="male">Male<input type="radio" name="gender" value="female">Female</pa>
	</div>
	<div class="form-group">
		<input type="text"  class="form-control" name="username" placeholder="Enter Username">
	</div>
	<div class="form-group">
		<input type="password"  class="form-control" name="pass" placeholder="Enter password">
	</div>
	<input type="submit" class="btn btn-danger">
    </form></div>
    <div class="col-md-4"></div>
</div>
</div>