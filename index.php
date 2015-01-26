<?php
include 'head.html';
session_start();
date_default_timezone_set('Asia/Dili');
function loginForm(){
    echo'<script type="text/javascript">
    function valid(form){
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
    return true;
}
</script>
    <div id="loginform">
    <form name="form" action="verify.php" method="post" onSubmit="return valid(this)" >
        <p>Chatmate</p>
        <div class="form-group" id="demo2">
        <input type="text" class="form-control" name="username" id="name" placeholder="Enter username"/>
        </div>
        <div class="form-group" id="demo2">
        <input type="password" class="form-control" name="pass" id="name" placeholder="Enter password"/>
        </div>
        <input type="submit" name="enter" class="btn btn-success" id="enter" value="Enter" />
    </form><br/><br/>
    <form action="register.php">
        <div class="pa"><b>New to Chatmate register here</b></div>
        <input type="submit" id="register" class="btn btn-danger" value="Register"/>
    </form>
    </div>
    ';
}

 
if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
}
if(!isset($_SESSION['name']))
{
	loginForm();
}
else
{
?>
 <body><div align="center">
        <h2 class="text-primary">Chat Room</h2>
    </div>
<div class="row">
        <div class="col-md-12">
<div id="wrapper">
    <div id="menu">
        <p class="welcome" style="font-size:25px;color:#ffab00;">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
        <p class="logout"><button id="exit" class="btn btn-warning" href="#">Exit Chat</button></p>
        <div style="clear:both"></div>
    </div>    
    <div id="chatbox" class="form-group"><?php
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle,filesize("log.html"));
    fclose($handle);
    echo $contents;
}
?></div>
     
    <form name="message" action="">
        <div class="form-group" id="demo">
        <input type="text" class="form-control" id="usermsg">
        </div>
         <input name="submitmsg" class="btn btn-primary" type="submit"  id="submitmsg" value="Send" />
    </form> 
</div>
</div></div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
function loadLog(){     
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
    $.ajax({
        url: "log.html",
        cache: false,
        success: function(html){        
            $("#chatbox").html(html); //Insert chat log into the #chatbox div   
             
            //Auto-scroll           
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }               
        },
    });
}
$(document).ready(function(){
	setInterval (loadLog, 500);
	$('<audio id="chatAudio"><source src="notify.ogg" type="audio/ogg"><source src="notify.mp3" type="audio/mpeg"><source src="notify.wav" type="audio/wav"></audio>').appendTo('body');
	$("#submitmsg").click(function(){   
    var clientmsg = $("#usermsg").val();
    $.post("post.php", {text: clientmsg});
	$('#chatAudio')[0].play();                
    $("#usermsg").attr("value", "");
    return false;
});
    //If user wants to end session
    $("#exit").click(function(){
        var exit = confirm("Are you sure you want to end the session?");
        if(exit==true){
            window.location = 'index.php?logout=true';}      
    });
});
</script></body>
<?php
}
if(isset($_GET['logout'])){ 
     //$mark=0;
    //Simple exit message
    $fp = fopen("log.html", 'a');
	date_default_timezone_set('Asia/Colombo');
    fwrite($fp, date("g:i:s A")."<div class='msgln'><i> User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
    fclose($fp);
    session_destroy();
 header('Location:http://www.getgadget.co.in/chatmate/index.php'); //Redirect the user
}
?>