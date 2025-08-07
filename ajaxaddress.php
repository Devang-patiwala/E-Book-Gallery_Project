<?php
error_reporting(E_ALL & ~E_NOTICE);
if(!isset($_SESSION)){ session_start(); }
include("databaseconnection.php");
	$ccaddress="SELECT * FROM address WHERE address_id='$_GET[addressid]'";
	$qaddress=mysqli_query($con,$ccaddress);
	$rsaddress = mysqli_fetch_array($qaddress);
	
	$sqlcustomer="SELECT * FROM customer WHERE custid='$_SESSION[cid]'";
	$qcustomer=mysqli_query($con,$sqlcustomer);
	$rscustomer = mysqli_fetch_array($qcustomer);
	
	$shipsqlstate = "SELECT name FROM  location where location_id='$rsaddress[state]' ";
	$shippingstate = mysqli_query($con,$shipsqlstate);
	$shipstate = mysqli_fetch_array($shippingstate);
	
	$shipsqlcountry = "SELECT name FROM  location where location_id='$rsaddress[country]' ";
	$shippingcountry = mysqli_query($con,$shipsqlcountry);
	$shipcountry = mysqli_fetch_array($shippingcountry);
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