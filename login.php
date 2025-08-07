<?php 
if(!isset($_SESSION)){ 
	session_start(); 
}

ob_start();
if(isset($_SESSION['cid'])){
	if(isset($_GET['cart'])){
		$cartselect="UPDATE purchase  SET cust_id='$_SESSION[cid]' where purchasestatus='Pending'";
		
		if(!mysqli_query($con,$cartselect)){
			echo mysqli_error($con);
		}
		
		echo"<script>window.location='confirmorders.php';</script>";
	}else{
		header("Location:customerpanel.php");
	}
}

include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");
if(isset($_POST['btnlogin'])){
	$sql ="SELECT * FROM customer WHERE email='$_POST[emailid]' AND c_password='$_POST[password]' AND status='Active'";
	$qcustlogin = mysqli_query($con,$sql);

	if(mysqli_num_rows($qcustlogin) == 1){
		$rslogin = mysqli_fetch_array($qcustlogin);
		
		// echo "<pre>";
		// print_r($rslogin['custid']);
		// exit;

		$_SESSION['cid'] = $rslogin['custid'];
		$_SESSION['loginid'] = $_POST['emailid'];
		$_SESSION['logintype'] = "Customer";	
					
			if(isset($_SESSION['loginid']))
			{
				if(isset($_GET['cart']))
				{
					$cartselect="UPDATE purchase  SET cust_id='$_SESSION[cid]' where purchasestatus='Pending'";
					if(!mysqli_query($con,$cartselect))
					{
						echo mysqli_error($con);
					}
					echo "<script>window.location='confirmorders.php';</script>";
				}
				else
				{
						header("Location:customerpanel.php");
				}
			}
	}
	else
	{
		echo "<script>alert('Invalid login Id and password entered..');</script>";
	}
}

?>
    
        <div id="content" class="float_r">
        	<h2>Welcome To Customer Login Page</h2>
            <h5><strong>Kindly enter login id and password</strong></h5>
            <div class="content_half float_l checkout ">
            <form method="post" action="" name="frmlogin" onsubmit=" return validatebooksellerloginpanel()">
				Email ID
                  <input name="emailid" type="text" id="emailid"  style="width:300px;"  />
                <br />
                <br />
              Password:
				<input name="password" type="password" id="password"  style="width:300px;"  />
                <br />
                <br />
                <input type="submit" name="btnlogin" id="btnlogin" value="Submit" />
              </form>
            </div>
            
            <div class="content_half float_r checkout"></div>
            
            <div class="cleaner h50"></div>
            <?php
			if(isset($_GET['cart']))
			{
	            echo "<h3><a href='registration.php?cart=checkout'>Create New account</a></h3>";
			}
			else
			{
	            echo "<h3><a href='registration.php'>Create New account</a></h3>";
			}			
			?>
            <h4><a href="forgotpassword.php">Forgot password            </a></h4>
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
  <?php
  include("footer.php");
  ?>
  <script type="application/javascript">
	function  validatebooksellerloginpanel()
	{
		if(document.frmlogin.emailid.value == "")
		{
			alert("Enter correct Email Id");
			document.frmlogin.emailid.focus();
			return false;
		}
		else if(document.frmlogin.password.value == "")
		{
			alert("Enter password..");
			document.frmlogin.password.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
</script>