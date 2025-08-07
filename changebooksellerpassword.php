<?php
if(!isset($_SESSION)){ session_start(); }
include("header.php");
include("databaseconnection.php");
include("admin_sidebar.php");
if(isset($_POST['submit']))
{
	$ssql="UPDATE bookseller SET s_password='$_POST[password]' where login_id='$_POST[emailid]' AND s_password='$_POST[oldpassword]'";
	$qpasssql1=mysqli_query($con,$ssql);
	if(mysqli_affected_rows($con) == 1)
	{
	echo "<script>alert('Your password changed successfully....')</script>";
	}
	else
	{
	echo "<script>alert('You have entered Invalid old password and Email ID..')</script>";		
	}
}
?>
    
        <div id="content" class="float_r">
        	<h2>Change Password</h2>
            <h5><strong>You can change your password here</strong></h5>
            <div class="content_half float_l checkout">
<form method="post" action="" onsubmit="return validateforgotpassword()" name="frmchangepassword">
<table width="531" height="176" border="1">
 				<tr>
                  <td>Email ID  :</td>     
                  <td><input name="emailid" type="email" id="emailid"  style="width:300px;" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" /></td></tr>
			  
  
              <tr><td> Old Password :</td>
				  <td><input type="password" name="oldpassword" id="oldpassword" style="width:300px;"/></td></tr>
			  
			<tr><td> New Password :</td>
				  <td><input type="password" name="password" id="password" style="width:300px;"/></td></tr>
			  <tr>
              <td>Confirm Password :</td>
				  <td><input type="password" name="password2" id="password2" style="width:300px;"/></td></tr>
	
                 
				  <th colspan="2" scope="row"><input type="submit" name="submit" id="submit" value="Submit" /></th>
             
			    
              </table></form>    
            </div>
            
            <div class="content_half float_r checkout"></div>
            
            <div class="cleaner h50"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
  <?php
  include("footer.php");
  ?>
  <script>
 function  validateforgotpassword()
	{
		if(document.frmchangepassword.emailid.value == "")
		{
			alert("Emailid should not be blank..");
			document.frmchangepassword.emailid.focus();
			return false;
		}
		else if(document.frmchangepassword.oldpassword.value == "")
		{
			alert(" Enter a old Password..");
			document.frmchangepassword.oldpassword.focus();
			return false;
		}
		else if(document.frmchangepassword.password.value == "")
		{
			alert(" Enter a New Password..");
			document.frmchangepassword.password.focus();
			return false;
		}
		
		else if(document.frmchangepassword.password.value.length < 8)
		{
			alert("Password length must be more than 8 characters..");
			document.frmchangepassword.password.focus();
			return false;
		}
		else if(document.frmchangepassword.password2.value == "")
		{
			alert(" Confirm you are password..");
			document.frmchangepassword.password2.focus();
			return false;
		}
		else if(document.frmchangepassword.password2.value!=document.frmchangepassword.password.value)
		{
			alert("Password not matching..");
			document.frmchangepassword.password2.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
  </script> 