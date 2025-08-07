<?php
if(!isset($_SESSION)){ session_start(); }
ob_start();
include("header.php");
if($_SESSION['logintype'] == "Administrator")
{
	header("Location: dashboard.php");
}
include("admin_sidebar.php");
include("databaseconnection.php");
if(isset($_POST['btnlogin']))
{
	$sql ="SELECT * FROM administrator WHERE login_id='$_POST[adminloginid]' AND a_password='$_POST[adminpassword]' ";
	$rsadminlogin = mysqli_query($con,$sql);
	if(mysqli_num_rows($rsadminlogin) == 1)
	{
		$_SESSION['loginid'] = $_POST['adminloginid'];
		$_SESSION['logintype'] = "Administrator";		
		header("Location: dashboard.php");
	}
	else
	{
		echo "<script>alert('Invalid login Id and password entered..');</script>";
	}
}

?>
    
        <div id="content" class="float_r">
        	<h2>Administrator Login Panel</h2>
            <h5><strong>Kindly enter login id and password</strong></h5>
            <div class="content_half float_l checkout">
            <form method="post" action="" name="adminlogin"  onsubmit="return validateadministratorloginpanel()">
            				Login  ID
                              <input type="text"  style="width:300px;" name="adminloginid"  />
                <br />
                <br />
              Password:
				<input type="password"  style="width:300px;" name="adminpassword"  />
                <br />
                <br />
                <input type="submit" name="btnlogin" id="btnlogin" value="Submit" />
            </form>
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
	function  validateadministratorloginpanel()
	{
		if(document.adminlogin.adminloginid.value == "")
		{
			alert("Enter correct Login Id");
			document.adminlogin.adminloginid.focus();
			return false;
		}
		else if(document.adminlogin.adminpassword.value == "")
		{
			alert("Enter password..");
			document.adminlogin.adminpassword.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
  </script>