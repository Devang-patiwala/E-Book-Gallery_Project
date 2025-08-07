<?php
if(!isset($_SESSION)){ session_start(); }
if(!isset($_SESSION['loginid']))
{
	header("Location: adminlogin.php");
}
include("header.php");
include("sidebar.php");
include("databaseconnection.php");
if(isset($_POST['submit']))
{
	
	if(isset($_GET['editid']))
	{
	mysqli_query($con,"UPDATE administrator SET name='$_POST[adminname]',login_id='$_POST[loginid]',a_password='$_POST[password]',email_id='$_POST[emailid]',contactno='$_POST[contactno]' WHERE admin_id='$_GET[editid]'");
	echo "<script>alert('Record updated successfully...')</script>";
	echo "<script>window.location='viewadministrator.php';</script>";
	}
	else
	{
$query=mysqli_query($con,"insert into administrator(name,login_id,a_password,email_id,contactno)VALUES('$_POST[adminname]','$_POST[loginid]','$_POST[password]','$_POST[emailid]','$_POST[contactno]')");
	
	if(!$query)
		{
		echo mysqli_error($con);
		}
		else
		{
			echo "<script>alert('Admin record inserted')</script>";
		}
	}
}
if(isset($_GET['editid']))
{
	$sql="select *from administrator where admin_id='$_GET[editid]'";
	$rsql=mysqli_query($con,$sql);
	$res=mysqli_fetch_array($rsql);
}
?>

    
        <div id="content" class="float_r">
        	<h2>Administrator </h2>
            <h5><strong></strong></h5>
            <div class="content_half float_l checkout">
            <form action="" method="post" name="frmadmin" onsubmit="return validateadmin()" >
            
              <p>Admin Name :
                <input name="adminname" type="text" id="adminname"  style="width:300px;"value="<?php echo $res['name'];?>"onkeydown='return isAlpha(event.keyCode);'  />
                <br />
                <br />
                Login Id:
                 <input name="loginid" type="text" id="loginid"  style="width:300px;" value="<?php echo $res['login_id'];?>" />
              </p>
              <p>Password :
                <label for="password"></label>
                <input type="password" name="password" id="password"style="width:300px;" value="<?php echo $res['a_password'];?>" >
              </p>
              <p>Confirm Password :
                <label for="cpassword"></label>
            <input type="password" name="cpassword" id="cpassword"style="width:300px;" value="<?php echo $res['a_password'];?>"/>
              </p>
              <p>Email Id :
                <label for="emailid"></label>
                <input type="text" name="emailid" id="emailid"style="width:300px;"  required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"value="<?php echo $res['email_id'];?>"/>
              </p>
              <p>Contact No :
                <label for="contactno"></label>
                <input type="text" name="contactno" id="contactno"style="width:300px;" value="<?php echo $res['contactno'];?>" onkeydown='return isNumeric(event.keyCode);'/>
              </p>
              <p>
                <input type="submit" name="submit" id="submit" value="Submit">
              </p>
              <p>&nbsp;</p>
              </form>
            </div>
            
            
          <div class="content_half float_r checkout"><br />
                <br />
          </div>
           
            
          <div class="cleaner h50"></div>
            <h3>&nbsp;</h3>
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
  <?php
  include("footer.php");
  ?>
  <script type="application/javascript">
	function validateadmin()
	{
		if(document.frmadmin.adminname.value == "")
		{
			alert("Admin name should not be empty..");
			document.frmadmin.adminname.focus();
			return false;
		}
		else if(document.frmadmin.loginid.value == "")
		{
			alert("Login ID  should not be empty..");
			document.frmadmin.loginid.focus();
			return false;
		}
		else if(document.frmadmin.loginid.value.length < 6)
		{
			alert("Login ID must more than 6 character..");
			document.frmadmin.loginid.focus();
			return false;
		}	
		else if(document.frmadmin.password.value == "")
		{
			alert("Password should not be empty..");
			document.frmadmin.password.focus();
			return false;
		}	
		else if(document.frmadmin.password.value.length < 8)
		{
			alert("Password length should be more than 8 characters.");
			document.frmadmin.password.focus();
			return false;
		}
		else if(document.frmadmin.password.value != document.frmadmin.cpassword.value)
		{
			alert("Password not matching..");
			document.frmadmin.password.focus();
			return false;
		}	
		else if(document.frmadmin.emailid.value == "")
		{
			alert("Kindly enter valid email ID.");
			document.frmadmin.password.focus();
			return false;
		}
		else if(document.frmadmin.contactno.value == "")
		{
			alert("Contact number should not be empty..");
			document.frmadmin.contactno.focus();
			return false;
		}
		else if(document.frmadmin.contactno.value.length < 10)
		{
			alert("Enter 10 digit contact number..");
			document.frmadmin.contactno.focus();
			return false;
		}											
		else
		{
			return true;
		}
	}
  </script>
   <script type = "text/javascript">
    function isNumeric(keyCode)
    {
        return ((keyCode >= 48 && keyCode <= 57) || keyCode == 8 || keyCode == 9 || keyCode == 46 || keyCode == 37 || keyCode == 39 ||
                (keyCode >= 96 && keyCode <= 105))
    }
	
    function isAlpha(keyCode)
    {
        return ((keyCode >= 65 && keyCode <= 90) || keyCode == 8 || keyCode == 9 || keyCode == 46 || keyCode == 37 || keyCode == 39 )
    }
	</script>