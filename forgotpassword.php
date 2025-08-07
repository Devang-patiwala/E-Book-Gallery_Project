<?php
if(!isset($_SESSION)){ session_start(); }
include("header.php");
include("sidebar.php");
if(isset($_POST['btnlogin']))
{
	include("phpmailer.php");
	$hsqlcustomer="SELECT * from customer where email='$_POST[emailid]'";
	$hrescustomer=mysqli_query($con,$hsqlcustomer);
	$hres1customer=mysqli_fetch_array($hrescustomer);
	$message = "<strong>Dear $hres1customer[custfname] $hres1customer[custlname],</strong><br />
				<strong>Your Email ID is :</strong> $hres1customer[email]<br />
				<strong>Your Password is :</strong> $hres1customer[c_password]
				";
	if(mysqli_num_rows($hrescustomer) == 1)
	{
		$name = $hres1customer['custfname']  . " " . $hres1customer['custlname'];
		sendmail($hres1customer['email'],$name,"BookStore Login Credentials",$message);
		echo "<script>alert('Password sent by mail..');</script>";
		echo "<script>window.location='index.php';</script>";
	}
	else
	{
		echo "<script>alert('Account Not found..');</script>";
		echo "<script>window.location='index.php';</script>";
	}
}
?>
<div id="content" class="float_r">
	<h2>EMAIL</h2>
	  <h5><strong>Enter the Email address here</strong></h5>
		<div class="content_half float_l checkout">
		<form method="post" action="forgotpassword.php" name="forgotpassword" onsubmit="return validateadmin()">
			<p>Email ID
			<input name="emailid" type="text" id="email id"  style="width:300px;"required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"   />
			  <br />
		  </p>
		
			 
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
	function validateadmin()
	{
		if(document.forgotpassword.emailid.value == "")
		{
			alert("Email ID should not be empty..");
			document.forgotpassword.emailid.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
  </script>