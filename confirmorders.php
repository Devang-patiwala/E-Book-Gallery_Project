<?php
if(!isset($_SESSION)){ session_start(); }
include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");
$dt= date("Y-m-d");
$invalidotp = 0;
if(isset($_GET['cancelorder']))
{
	$sql = "DELETE FROM purchase WHERE  purchasestatus='Pending'";
	$qsql = mysqli_query($con,$sql);
	echo "<script>alert('Order cancelled successfully..');</script>";
	echo "<script>window.location.assign('index.php')</script>";
}
if(isset($_POST['submitaddress']))
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
}
if(isset($_POST['btnsmsconfirm'])) 
{  
	if($_POST['smshiddenconfirmationcode'] != $_POST['smsconfirmationcode'])
	{
		$invalidotp = 0;
		echo "<script>alert('You have entered invalid COD confirmation code.. Please try again..')</script>";		
	}
	else
	{
		$invalidotp = 1;
		$paymenttype= "Cash On Delivery";
		include("includeinsertbilling.php");
	}
}
if(isset($_POST['btncardpayment'])) 
{ 
		$paymenttype= "Paid";
		include("includeinsertbilling.php");	
}
if(isset($_GET['delid']))
{
	$cartdel="DELETE FROM purchase where purch_id='$_GET[delid]'";
	mysqli_query($con,$cartdel);
	echo"<script>alert('Record deleted from cart..')</script>";
}
?>
        <div id="content" class="float_r">
<?php
	$ccustomer="SELECT * FROM customer WHERE custid='$_SESSION[cid]'";
	 $qcustomer=mysqli_query($con,$ccustomer);
	 $rscustomer = mysqli_fetch_array($qcustomer);
	 
	 $ccaddress="SELECT * FROM address WHERE custid='$_SESSION[cid]'";
	 $qaddress=mysqli_query($con,$ccaddress);
	 $rsaddress = mysqli_fetch_array($qaddress);
?>
       	<h1>Shipping details</h1>

<form method="post" action="" name="formorders" onsubmit="return validateorders()">
<div id="txtcart">
   	<table width="680px" cellspacing="0" cellpadding="5" border="1">
                   	  <tr>
                        	<th width="157" align="left" bgcolor="#ddd">Customer Name </th> 
                        	<td width="497" align="left"><?php echo $rscustomer['custfname'] . " ". $rscustomer['custlname'];?></td>                             
                      </tr>
                        <tr>
                          <th align="left" bgcolor="#ddd">Select Address</th>
                          <td align="left">&nbsp;
<?php
$ccaddress="SELECT * FROM address WHERE custid='$_SESSION[cid]'";
$qaddress=mysqli_query($con,$ccaddress);
if(mysqli_num_rows($qaddress) == 0)
{
?>             
            <h5><strong>Enter the shipping address.</strong></h5>
      
              <p>Address :</p>
              	<p><textarea name="address" id="address" cols="45" rows="5"><?php echo $res4['address']; ?></textarea> 
                	<br />
          		</p>
              <p>
              <?php
			  include("countrystatelist.php");
			  ?>
              <br />
                Pincode:<br />
                <input name="pincode" type="text" id="pincode"style="width:300px;" value="<?php echo $res4['pincode']; ?>" onkeydown='return isNumeric(event.keyCode);' /><br />
                <br />
                
                Contact Number :<br />
                <input name="contactno" type="text" id="contactno"  style="width:300px;" value="<?php echo $res4['contactno']; ?>"  onkeydown='return isNumeric(event.keyCode);'/><br />

                <input name="submitaddress" type="submit" id="submit" />
              </p>
<?php
}
else
{
?>
    <select name="address" id="address" onchange="loadaddress(this.value)">
    <option value="">Select</option>
    <?php
    while($rsaddress = mysqli_fetch_array($qaddress))
    {
        if($_GET['addressid'] ==$rsaddress['address_id'])
        {
        echo "<option value='$rsaddress[address_id]' selected>$rsaddress[address]</option>";
        }
        else
        {
        echo "<option value='$rsaddress[address_id]'>$rsaddress[address]</option>";
        }
    }
    ?>
    </select>
<?php
}
?>

                          </td>
                        </tr>         
	</table>
          </div>
<div id="ajaxloadaddress">
<?php
if(isset($_GET['addressid']))
{
	$ccaddress="SELECT * FROM address WHERE address_id='$_GET[addressid]'";
	$qaddress=mysqli_query($con,$ccaddress);
	$rsaddress = mysqli_fetch_array($qaddress);
		
	$shipsqlstate = "SELECT name FROM  location where location_id='$rsaddress[state]' ";
	$shippingstate = mysqli_query($con,$shipsqlstate);
	$shipstate = mysqli_fetch_array($shippingstate);
	
	$shipsqlcountry = "SELECT name FROM  location where location_id='$rsaddress[country]' ";
	$shippingcountry = mysqli_query($con,$shipsqlcountry);
	$shipcountry = mysqli_fetch_array($shippingcountry);
	
	$sqlcustomer="SELECT * FROM customer WHERE custid='$_SESSION[cid]'";
	$qcustomer=mysqli_query($con,$sqlcustomer);
	$rscustomer = mysqli_fetch_array($qcustomer);
?>	 
<table width="680px" border="1" cellpadding="5" cellspacing="0">
<tr>
<th width="157" align="left" bgcolor="#ddd">Address </th>
<td width="497" align="left"><?php echo $rsaddress['address'];?></td>
</tr>
<tr>
<th width="157" align="left" bgcolor="#ddd">State </th>
<td width="497" align="left"><?php echo $shipstate[0];?></td>
</tr>
<tr>
<th width="157" align="left" bgcolor="#ddd">Country </th>
<td width="497" align="left"><?php echo $shipcountry[0];?></td>
</tr>
<tr>
<th width="157" align="left" bgcolor="#ddd">Contact No. </th>
<td width="497" align="left"><?php echo $rsaddress['contactno']; ?></td>
</tr>
<tr>
<th width="157" align="left" bgcolor="#ddd">Email ID </th>
<td width="497" align="left"><?php echo $rscustomer['email']; ?></td>
</tr>
</table>
<?php
}
?>
</div>
        <p>&nbsp;</p>
        <hr />
        	<h1>Ordered books</h1>
            <div id="txtcart">
<?php
	$grandtotalprice = $totprice = 0;
	$cartselect="SELECT * FROM purchase where cust_id='$_SESSION[cid]' AND purchasestatus='Pending'";
	$res=mysqli_query($con,$cartselect);
	if(mysqli_num_rows($res)  >= 1)
	{
?>
<table width="685" cellspacing="0" cellpadding="5" border="1">
                   	  <tr bgcolor="#ddd">
                        	<th width="130" align="left">Image </th> 
                        	<th width="143" align="left">Book Name </th> 
                       	  	<th width="62" align="center">Quantity </th> 
                        	<th width="72" align="right">Price </th>
                        	<th width="59" align="right">Discount</th> 
                        	<th width="80" align="right">Total </th> 
                            
      </tr>
                      <?php
					  while($result=mysqli_fetch_array($res))
					  {
						  $cartselect1="SELECT * FROM books	 where book_id='$result[book_id]'";
						  $res1=mysqli_query($con,$cartselect1);
						  $result1=mysqli_fetch_array($res1);
					  ?>
                    	<tr>
                        	<td>
<img src="bookcoverimage/<?php 
				//check image
				echo $prodimage =  $result1['images'];	
				?>" alt="" width="124" height="85" /></td> 
                        	<td><?php echo $result1['book_name']; ?></td> 
                            <td align="center"><?php echo $result['qty']; ?></td>
                            <td align="right">Rs.<?php echo $result['price']; ?></td>
                            <td align="right">Rs.<?php echo $discount = (($result['qty']* $result['price'])*$result1['discount'])/100; ?></td> 
                            <td align="right">Rs.<?php  echo $totprice = ($result['qty']* $result['price']) - $discount; ?></td>
						</tr>
                       <?php
                       $grandtotalprice = $grandtotalprice + $totprice;
					   }
					   
					   ?>
                        <tr>
                        	<td colspan="3" align="right"  height="30px"></td>
                            <td align="right" style="background:#ddd; font-weight:bold"> Total </td>
                            <td colspan="3" align="center" style="background:#ddd; font-weight:bold">Rs. <?php echo $grandtotalprice; ?>  </td>
                        </tr>
					</table>                   
              <?php
				}
				else
				{
				?>
                   <p><h2>No items found in the cart</h2></p>
                <?php
				}
				?>
            </div>
        <hr />
        	<h1>Payment details</h1>

<table width="685" cellspacing="0" cellpadding="5" border="1">
     <tr bgcolor="#ddd">
    <th scope="row">&nbsp;Payment type: </th>
    <td>&nbsp;
    <select name="paymenttype" onchange="showpaymenttype(this.value,address.value)">
    <option value="">Select</option>
    <option value="CardPayment" <?php 
	if($_GET['paymenttype'] == "CardPayment")
	{
		echo "selected";
	}
?>
	>Card Payment</option>
    <option value="CashonDelivery" <?php 
	if($_GET['paymenttype'] == "CashonDelivery")
	{
		echo "selected";
	}
?>>Cash on Delivery</option>    
    </select></td>
  </tr>
</table>
<input type="hidden" name="paymenttype" id="paymenttype" value="CardPayment" >
<?php
if($_GET['paymenttype'] == "CardPayment")
{
?>
<table width='685' cellspacing='0' cellpadding='5' border='1'>
<tr><th width='139' align='left' bgcolor='#ddd'>Card type </th>
<th width='520' align='left'><select name='cardtype4' id='cardtype4' width='260'><option value="">Select</option><option value='VISA'>VISA</option><option value='Master card'>Master card</option><option value='Maestro'>Maestro</option><option value='American express'>American express</option></select></th></tr>
<tr><th width='139' align='left' bgcolor='#ddd'>Card Number </th><th width='520' align='left'><input type='text' name='cardnumber' id='cardnumber' width='260' onkeydown='return isNumeric(event.keyCode);'/></th></tr>
<tr><th width='139' align='left' bgcolor='#ddd'>CVV Number </th><th width='520' align='left'><input type='text' name='cvvno' id='cvvno' width='260'  onkeydown='return isNumeric(event.keyCode);'/></th></tr><tr><th width='139' align='left' bgcolor='#ddd'>Expriy date </th><th width='520' align='left'><select name='expmonth'><option=""></option><?php $arr = array('Select Month','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');							foreach($arr as $val){ echo "<option value='$val'>$val</option>"; } ?></select><select name='expyear'><option value=''>Select Year</option><?php for($yr=date("Y"); $yr<=2030; $yr++){ echo "<option value='$yr'>$yr</option>"; } ?></select></th></tr><tr><th colspan='2' align='center' bgcolor='#ddd'>&nbsp;
<input name='btncardpayment' type='submit' value='Click here to Make payment' /> | <input name='btncancel' type='button' value='Cancel Order'  onclick="cancelorder()" /></th></tr></table>
<?php
}
else if($_GET['paymenttype'] == "CashonDelivery")
{
	$sqlcustomer = "SELECT * FROM customer where custid='$_SESSION[cid]'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	$rscustomer = mysqli_fetch_array($qsqlcustomer);
	
	$sqlcustomeraddress = "SELECT * FROM address where custid='$_SESSION[cid]' ORDER BY custid ASC LIMIT 0 , 1";
	$qsqlcustomeraddress = mysqli_query($con,$sqlcustomeraddress);
	$rscustomeraddress = mysqli_fetch_array($qsqlcustomeraddress);
	
	$codcode = rand();
	$mobno = $rscustomeraddress['contactno'];
    $msgtitle = "OTP for Book Shop COD confirmation";
	$msgbody = "Hello $rs[customercustfname] $rscustomer[custlname], You COD confirmation code is $codcode. Thank you.";
	//sendmsg($mobno,$msgbody);
	//sendmail($rscustomer['email'],"COD Confirmation code",$msgbody);
?>
<table width='685' cellspacing='0' cellpadding='5' border='1'>
  <tr>
    <th colspan="2" align='left' bgcolor='#ddd'><font color="#FF0000">COD confirmation code sent to following registered Email ID. 
    Kindly enter confirmation code which you received by Mail.</font></th>
  </tr>
  <tr>
    <th width='182' align='left' bgcolor='#ddd'>Email ID</th><th width='477' align='left'><label for='cardtype'>
      <input name='emailid' type='text' id='emailid' onkeydown='return isNumeric(event.keyCode);' readonly style="width: 70%;background-color: #f0f0f0;" value="<?php echo $rscustomer['email']; ?>" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"/>
    </label></th></tr><tr>
  <th width='182' align='left' bgcolor='#ddd'>COD confirmation code</th>
  <th width='477' align='left' >
  <input type='hidden' name='smshiddenconfirmationcode' id='smshiddenconfirmationcode' value="<?php echo $codcode; ?>"/>
  <input type='text' name='smsconfirmationcode' id='smsconfirmationcode' width='60' onkeydown='return isNumeric(event.keyCode);'/>
  </th></tr><tr><th colspan='2' align='center' bgcolor='#ddd'>
  &nbsp;<input name='btnsmsconfirm' type='submit' value='Click here to confirm' /> |  <input name='btncancel' type='button' value='Cancel Order' onclick="cancelorder()" />
   &nbsp; &nbsp; </th></tr></table>
<?php
	if($invalidotp == 0)
	{
		include("phpmailer.php");
		sendmail($rscustomer['email'], 'Gift Shop' , $msgtitle, $msgbody);
	}
}
?>

</form>                    
            </div>            
                    <div style="float:right; width: 215px; margin-top: 20px;"></div>

        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
<?php
  include("footer.php");
?>
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
	
	function showpaymenttype(paymenttype,addressid)
	{
	
		if (paymenttype == "") 
		{
			document.getElementById("ajaxpaymenttype").innerHTML = "";
			return;
		} 
		else
		{ 
			 window.location.assign("confirmorders.php?paymenttype="+paymenttype+"&addressid="+addressid)
    	}
	}
	
	function loadaddress(addressid)
	{
		if (addressid == "") {
			document.getElementById("ajaxloadaddress").innerHTML = "";
			return;
		} else { 
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("ajaxloadaddress").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","ajaxaddress.php?addressid="+addressid,true);
			xmlhttp.send();
		}
	}
	
	function cancelorder()
	{
		 window.location.assign("confirmorders.php?cancelorder=cancel");
	}
	
</script>
<script type="application/javascript">
	function validateorders()
	{
		if(document.formorders.cardtype4.value == "")
		{
			alert("Select Card Type..");
			document.formorders.cardtype4.focus();
			return false;
		}
		else if(document.formorders.cardnumber.value == "")
		{
			alert("Enter Card Number..");
			document.formorders.cardnumber.focus();
			return false;
		}
		else if(document.formorders.cardnumber.value.length<16)
		{
			alert("Enter correct 16 digit Card Number");
			document.formorders.cardnumber.focus();
			return false;
		}
		else if(document.formorders.cvvno.value == "")
		{
			alert("Enter CVV Number..");
			document.formorders.cvvno.focus();
			return false;
		}
		else if(document.formorders.cvvno.value.length<3)
		{
			alert("Enter correct 3 digit CVV Number");
			document.formorders.cvvno.focus();
			return false;
		}
		else if(document.formorders.expmonth.value == "")
		{
			alert("Enter Expiry month..");
			document.formorders.expmonth.focus();
			return false;
		}
		else if(document.formorders.expyear.value == "")
		{
			alert("Enter Expiry Year..");
			document.formorders.expyear.focus();
			return false;
		}
		else if(document.formorders.emailid.value == "")
		{
			alert("Enter valid Email ID..");
			document.formorders.emailid.focus();
			return false;
		}
		else if(document.formorders.mobileno.value == "")
		{
			alert("Mobile Numbers should not be blank..");
			document.formorders.mobileno.focus();
			return false;
		}
		else if(document.formorders.mobileno.value.length<10)
		{
			alert("Enter 10 digit phone number..");
			document.formorders.mobileno.focus();
			return false;
		}
		else if(document.formorders.address.value == "")
		{
			alert("Address should not be blank..");
			document.formorders.address.focus();
			return false;
		}
		else if(document.formorders.pincode.value == "")
		{
			alert("Pincode should not be blank..");
			document.formorders.pincode.focus();
			return false;
		}
		else if(document.formorders.pincode.value.length<6)
		{
			alert("Enter 6 digit pincode..");
			document.formorders.pincode.focus();
			return false;
		}
		else if(document.formorders.contctno.value == "")
		{
			alert("Contact Number should not be blank..");
			document.formorders.contctno.focus();
			return false;
		}
		else if(document.formorders.contctno.value.length<10)
		{
			alert("Enter 10 digit Contact Number ..");
			document.formorders.contctno.focus();
			return false;
		}
	   else
		{
			return true;
		}
	}
  </script>