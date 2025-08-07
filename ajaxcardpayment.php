<?php
error_reporting(E_ALL & ~E_NOTICE);
if(!isset($_SESSION)){ session_start(); }
include("databaseconnection.php");
if($_GET['paymenttype'] == "CardPayment")
{
?>
<table width='685' cellspacing='0' cellpadding='5' border='1'>
<tr><th width='139' align='left' bgcolor='#ddd'>Card type </th>
<th width='520' align='left'><select name='cardtype4' id='cardtype4'><option>Select</option><option value='VISA'>VISA</option><option value='Master card'>Master card</option><option value='Maestro'>Maestro</option><option value='American express'>American express</option></select></th></tr>
<tr><th width='139' align='left' bgcolor='#ddd'>Card Number </th><th width='520' align='left'><input type='text' name='cardnumber' id='cardnumber' width='260' onkeydown='return isNumeric(event.keyCode);'/></th></tr>
<tr><th width='139' align='left' bgcolor='#ddd'>CVV Number </th><th width='520' align='left'><input type='text' name='cvvno' id='cvvno' width='60'  onkeydown='return isNumeric(event.keyCode);'/></th></tr><tr><th width='139' align='left' bgcolor='#ddd'>Expriy date </th><th width='520' align='left'><select name='expmonth'><?php $arr = array('Select Month','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');							foreach($arr as $val){ echo "<option value='$val'>$val</option>"; } ?></select><select name='expyear'><option value=''>Select Year</option><?php for($yr=2015; $yr<=2025; $yr++){ echo "<option value='$yr'>$yr</option>"; } ?></select></th></tr><tr><th colspan='2' align='center' bgcolor='#ddd'>&nbsp;
<input name='btncardpayment' type='submit' value='Click here to Make payment' /></th></tr></table>
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
	$msgbody = "Hello $rs[customercustfname] $rscustomer[custlname], You COD confirmation code is $codcode. Thank you.";
	sendmsg($mobno,$msgbody);
	sendmail($rscustomer['email'],"COD Confirmation code",$msgbody);
?>
<table width='685' cellspacing='0' cellpadding='5' border='1'>
  <tr>
    <th colspan="2" align='left' bgcolor='#ddd'><font color="#FF0000">COD confirmation code sent to following registered Email ID and Mobile Number. 
    Kindly enter confirmation code</font></th>
  </tr>
  <tr>
    <th width='182' align='left' bgcolor='#ddd'>Email ID</th><th width='477' align='left'><label for='cardtype'>
      <input name='emailid' type='text' id='emailid' onkeydown='return isNumeric(event.keyCode);' readonly width='260' value="<?php echo $rscustomer['email']; ?>" />
    </label></th></tr><tr>
      <th width='182' align='left' bgcolor='#ddd'>Mobile No</th><th width='477' align='left'><input name='mobileno' type='text' id='mobileno' onkeydown='return isNumeric(event.keyCode);' readonly width='260' value="<?php echo $rscustomeraddress['contactno']; ?>"  /></th></tr><tr>
  <th width='182' align='left' bgcolor='#ddd'>COD confirmation code</th>
  <th width='477' align='left' >
  <input type='hidden' name='smshiddenconfirmationcode' id='smshiddenconfirmationcode' value="<?php echo $codcode; ?>"/>
  <input type='text' name='smsconfirmationcode' id='smsconfirmationcode' width='60' onkeydown='return isNumeric(event.keyCode);'/>
  </th></tr><tr><th colspan='2' align='center' bgcolor='#ddd'>&nbsp;<input name='btnsmsconfirm' type='submit' value='Click here to confirm' /></th></tr></table>
<?php
}
	function sendmsg($mobno,$msg)
	{
		/*
		$ch = curl_init();
		$user="kotianmadhushri75@gmail.com:q1w2e3r4/";
		$receipientno=$mobno; 
		$senderID="TEST SMS"; 
		$msgtxt=$msg;
		curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
		$buffer = curl_exec($ch);
		if(empty ($buffer))
		{ echo " buffer is empty "; }
		else
		{ 
		//echo $buffer; 
		} 
		curl_close($ch);
		*/
	}
	
	function sendmail($toemail,$msgtitle,$msgbody)
	{
		require 'PHPMailer-master/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'mail.dentaldiary.in';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'sendmail@dentaldiary.in';                 // SMTP username
		$mail->Password = 'q1w2e3r4/';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		
		$mail->From = 'sendmail@dentaldiary.in';
		$mail->FromName = 'WebMall';
		$mail->addAddress($toemail, 'Webmall');     // Add a recipient
		$mail->addAddress($toemail);               // Name is optional
		$mail->addReplyTo('aravinda@technopulse.in', 'Information');
		$mail->addCC('cc@example.com');
		$mail->addBCC('bcc@example.com');
		
		$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = $msgtitle;
		$mail->Body    = $msgbody;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			//echo 'Message has been sent';
		}
	}
?>