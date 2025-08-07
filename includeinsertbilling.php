<?php
		$sql = "INSERT INTO billing(custid,address_id, purch_date, cardtype, cardno, cvvno, expirydate) VALUES ('$_SESSION[cid]','$_POST[address]','$dt','$_POST[cardtype4]','$_POST[cardnumber]','$_POST[cvvno]','$_POST[expmonth]/$_POST[expyear]')";	
		$q = mysqli_query($con,$sql);
		$lastinsid = mysqli_insert_id($con);	
		$cartselect="UPDATE purchase  SET purchasestatus='$paymenttype',bill_id='$lastinsid' where cust_id='$_SESSION[cid]' AND purchasestatus='Pending'";
		if(!mysqli_query($con,$cartselect))
		{
			echo mysqli_error($con);
		}
		
		session_start();
		$_SESSION['orderPlaced'] = 'success';
		echo "<script>alert('Order confirmed successfully....')</script>";
		echo"<script>window.location='orderbilling.php?billid=$lastinsid';</script>";
?>