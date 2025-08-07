<?php
include("header.php");
include("sidebar.php");
?>
    
        <div id="content" class="float_r">
        	<h2>Forgot password?</h2>
            <h5><strong>Enter the Email address here</strong></h5>
            <div class="content_half float_l checkout">
               <form method="post" action="" name="frmforgotpassword" onsubmit="return validatepassword()">
				<p>Email ID
  				<input name="emailid" type="text" id="emailid"  style="width:300px;"  />
				  <br />
			  </p>
				<p> New Password:<label for="password"></label>
				  <input type="password" name="password" id="password" style="width:300px;"/>
			  </p>
				<p>Confirm Password
				  <input type="password" name="password2" id="password2" style="width:300px;"/>
				  <br />
				  <br />
                 
				  <input type="submit" name="btnlogin" id="btnlogin" value="Submit" />
			  </p> 
              </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="Back"><a href="login.php"><b>BACK</b></a></label><br />
              
            </div>
            
            <div class="content_half float_r checkout"></div>
            
            <div class="cleaner h50"></div>
</div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
  <?php
  include("footer.php");
  ?>
  <script type="application/javascript">
  function validatepassword()
  {
	 if(document.frmforgotpassword.emailid.value == "")
		{
			alert("Email ID should not be empty..");
			document.frmforgotpassword.emailid.focus();
			return false;
		}
		else if(document.frmforgotpassword.password.value == "")
		{
			alert("Enter password..");
			document.frmforgotpassword.password.focus();
			return false;
		}
		else if(document.frmforgotpassword.password2.value == "")
		{
			alert("Confirm your password..");
			document.frmforgotpassword.password2.focus();
			return false;
		}
		else
		{
			return true;
		}
  }
  </script>