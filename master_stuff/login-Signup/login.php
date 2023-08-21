<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Login Form Using HTML And CSS Only</title>
</head>
<body>
	<div class="container" id="container">
		<div class="form-container log-in-container">
           
        <form name="f1" action = "loginprocess.php" onsubmit = "return validation()" method = "POST">
                <img src="../login-Signup/images/leave.png.png"  class="custom-gif">
				<h1>Login</h1>

				
				<input type="username" class="inputbar" id ="user" name  = "u_name" placeholder="username" /> 
				<input type="password" class="inputbar" id ="pass" name  = "u_password" placeholder="password" />
                
                    
                    <select  name="title"  class="inputbar" id="type">
                        
                    <option value="" selected disabled>Admin</option>
          <option value="director">Director</option>
          <option value="principal">Principal</option>
          <option value="asstt_director">Asstt. Director</option>
          <option value="dean">Dean</option>

    </select>
                
                
				<button type = "submit" id = "btn"  name="sub" >Log In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-right">
                    <img src="../login-Signup/images/cartoon.jpg" class="w3-round-small" alt="Norway" style="width:100%">
				</div>
			</div>
		</div>
	</div>

        <!-- code for the php  -->
        <?php 
if(isset($_REQUEST["err"]))
	// $msg="Invalid username or Password";
?>
<p style="color:red;">
<?php if(isset($msg))
{
	
echo $msg;
}
?>

      
    <script>  
            function validation()  
            {  
                var id=document.f1.user.value;  
                var ps=document.f1.pass.value;  
                if(id.length=="" && ps.length=="") {  
                    alert("User Name and Password fields are empty");  
                    return false;  
                }  
                else  
                {  
                    if(id.length=="") {  
                        alert("User Name is empty");  
                        return false;  
                    }   
                    if (ps.length=="") {  
                    alert("Password field is empty");  
                    return false;  
                    }  
                }                             
            }  
        </script> 
</body>
</html>