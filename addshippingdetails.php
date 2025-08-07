<?php
if(!isset($_SESSION)){ session_start(); }
include("header.php");
ob_start();
include("admin_sidebar.php");
include("databaseconnection.php");
if(isset($_POST['submitaddress']))
{
	if(isset($_GET['editid']))
	{
		mysqli_query($con,"UPDATE address SET address= '$_POST[address]',state= '$_POST[state]',country= '$_POST[country]',pincode='$_POST[pincode]',contactno= '$_POST[contactno]' WHERE address_id = '$_GET[editid]'");
		echo "<script>alert('Record updated successfully..')</script>";
		echo "<script>window.location='viewshippingdetails.php';</script>";
	}
	else
	{
		$sql6="insert into address(custid,address,state,country,pincode,contactno)values('$_SESSION[cid]','$_POST[address]','$_POST[state]','$_POST[country]','$_POST[pincode]','$_POST[contactno]')";
		if(!mysqli_query($con,$sql6))
		{
			echo mysqli_error($con);
		}
		else
		{
			echo "<script>alert('Shipping Details added successfully..');</script>";
		}
		echo "<script>window.location = 'addshippingdetails.php';</script>";
	}
}
if(isset($_GET['editid']))
{
	$sql4="select * from address where address_id='$_GET[editid]'";
	$qsql4=mysqli_query($con,$sql4);
	$res4=mysqli_fetch_array($qsql4);
	$location_id = $res4['country'];
	$state_id = $res4['state'];
}
?>
    
        <div id="content" class="float_r">
        <form action="" method="post" name="frmregistration" onsubmit="return validatereg()">
        	<h2>Shipping Details</h2>
            <h5><strong>Enter the shipping address.</strong></h5>

          <table width="680px" border="1" cellpadding="5" cellspacing="0">
              <tr>
                <th align="left" bgcolor="#ddd" valign="top">Enter Shipping Address</th>
                <td align="left">&nbsp;
             
                  <h5><strong>Enter the shipping address.</strong></h5>
                  <p>Address :</p>
                  <p>
                    <textarea name="address" id="address" cols="45" rows="5"><?php echo $res4['address']; ?></textarea>
                    <br />
                  </p>
                  <p>
                    <?php
			  include("countrystatelist.php");
			  ?>
                    <br />
                    Pincode:<br />
                    <input name="pincode" type="text" id="pincode"style="width:300px;" value="<?php echo $res4['pincode']; ?>"  />
                    <br />
                    <br />
                    Contact Number :<br />
                    <input name="contactno" type="text" id="contactno"  style="width:300px;" value="<?php echo $res4['contactno']; ?>"  />
                    <br />
                    <br />
                    <input name="submitaddress" type="submit" id="submit" />
                  </p>
</td>
              </tr>
          </table>
          <p>&nbsp;</p>
        </form>
            </div>
            
       
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
          <?php
  include("footer.php");
  ?>
  
  <script type="application/javascript">
	function validatereg()
	{
		if(document.frmregistration.firstname.value == "")
		{
			alert("First Name should not be empty..");
			document.frmregistration.firstname.focus();
			return false;
		}
		else if(document.frmregistration.lastname.value == "")
		{
			alert("Last Name should not be empty..");
			document.frmregistration.lastname.focus();
			return false;
		}
		else if(document.frmregistration.date.value == "")
		{
			alert("Date should not be empty..");
			document.frmregistration.date.focus();
			return false;
		}
		else if(document.frmregistration.address.value == "")
		{
			alert("Address should not be empty..");
			document.frmregistration.address.focus();
			return false;
		}
		else if(document.frmregistration.contactno.value == "")
		{
			alert("Contact Number should not be empty..");
			document.frmregistration.contactno.focus();
			return false;
		}
		else if(document.frmregistration.country.value == "")
		{
			alert("Select country..");
			document.frmregistration.country.focus();
			return false;
		}
		else if(document.frmregistration.state.value == "")
		{
			alert("Select State..");
			document.frmregistration.state.focus();
			return false;
		}
		else if(document.frmregistration.email.value == "")
		{
			alert("Email ID should not be empty..");
			document.frmregistration.email.focus();
			return false;
		}
		else if(document.frmregistration.password.value == "")
		{
			alert("Enter password..");
			document.frmregistration.password.focus();
			return false;
		}
		else if(document.frmregistration.cpassword.value == "")
		{
			alert("Confirm your password..");
			document.frmregistration.cpassword.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
  </script>