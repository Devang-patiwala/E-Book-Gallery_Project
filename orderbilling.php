<?php
if(!isset($_SESSION)){ session_start(); }
include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");
$dt= date("Y-m-d");

?>
        <div id="content" class="float_r">
<?php
	$ccustomer="SELECT * FROM customer WHERE custid='$_SESSION[cid]'";
	 $qcustomer=mysqli_query($con,$ccustomer);
	 $rscustomer = mysqli_fetch_array($qcustomer);
	 
	 $sbilling="SELECT * FROM billing WHERE bill_id='$_GET[billid]'";
	 $qsbilling=mysqli_query($con,$sbilling);
	 $rsbilling = mysqli_fetch_array($qsbilling);
	 
	 $sbillingaddress="SELECT * FROM address WHERE address_id='$rsbilling[address_id]'";
	 $qsbillingaddress=mysqli_query($con,$sbillingaddress);
	 $rsbillingaddress= mysqli_fetch_array($qsbillingaddress);

	$statDetail = "SELECT * FROM location WHERE location_id=".$rsbillingaddress['state'];
	$countryDetail = "SELECT * FROM location WHERE location_id=".$rsbillingaddress['country'];
	
	$result1 = mysqli_query($con,$statDetail);
	$stateName = mysqli_fetch_array($result1);
	
	$result2 = mysqli_query($con,$countryDetail);
	$countryName = mysqli_fetch_array($result2);
?>
       	<h1>Shipping details</h1>
<div id="txtcart">
<div id="billingreport">
<form method="post" action="">
   	<table width="680px" cellspacing="0" cellpadding="5" border="1">
                   	  <tr>
                        	<th width="157" align="left" bgcolor="#ddd">Customer Name </th> 
                        	<td width="497" align="left"><?php echo $rscustomer['custfname'] . " ". $rscustomer['custlname'];?></td>
                            <th width="157" align="left" bgcolor="#ddd">Bill No. </th> 
                        	<td width="497" align="left"><?php echo $rsbilling['bill_id'] ;?></td>                             
                      </tr>
                        <tr>
                        	<th width="157" align="left" bgcolor="#ddd">Address </th> 
                        	<td width="497" align="left"><?php echo $rsbillingaddress['address'];?></td> 
							<th width="157" align="left" bgcolor="#ddd">Purchase date</th> 
                        	<td width="497" align="left"><?php echo date("d-m-Y",strtotime($rsbilling['purch_date'])) ;?></td>     
                        </tr>
                        <tr>
                        	<th width="157" align="left" bgcolor="#ddd">State </th> 
                        	<td width="497" align="left"><?php echo $stateName['name']; ?></td> 
							<th width="157" align="left" bgcolor="#ddd">Delivery date </th> 
                        	<td width="497" align="left"><?php
							if($rsbilling['deliv_date'] == "0000-00-00")
							{
							echo "Pending Delivery";
							}
							else
							{
							echo date("d-m-Y",strtotime($rsbilling['deliv_date']));
							}
							?></td>     
                        </tr>
                        <tr>
                        	<th width="157" align="left" bgcolor="#ddd">Country </th> 
                        	<td width="497" align="left"><?php echo $countryName['name'];?> </td> 
							<th width="157" align="left" bgcolor="#ddd">Payment type </th> 
                        	<td width="497" align="left"><?php 
							if($rsbilling['cardtype'] == "")
							{
								echo "Cash on Delivery";
							}
							else
							{
								echo $rsbilling['cardtype'];
							}
							?></td> 
                        </tr>                        
                        <tr>
                        	<th width="157" align="left" bgcolor="#ddd">Contact No. </th> 
                        	<td width="497" align="left"><?php echo $rsbillingaddress['contactno']; ?></td> 
							<th width="157" align="left" bgcolor="#ddd">Any Note </th> 
                        	<td width="497" align="left"></td> 
                        </tr>
                        <tr>
                        	<th width="157" align="left" bgcolor="#ddd">Email ID </th> 
                        	<td width="497" align="left"><?php echo $rscustomer['email']; ?></td> 
                        	<td width="497" align="left"></td> 
                        	<td width="497" align="left"></td> 
                        </tr>         
	</table>
        
        <hr />
        	<h1>Ordered books</h1>

<?php
	$grandtotalprice = $totprice = 0;
	$cartselect="SELECT * FROM purchase where cust_id='$_SESSION[cid]' AND bill_id='$_GET[billid]'";
	$res=mysqli_query($con,$cartselect);
	if(mysqli_num_rows($res)  >= 1)
	{
?>
<table width="685" cellspacing="0" cellpadding="5" border="1">
                   	  <tr bgcolor="#ddd">
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
                        	<td><?php echo $result1['book_name'] ?></td> 
                            <td align="center"><?php echo intval($result['qty']); ?></td>
                            <td align="right">Rs. <?php echo intval($result['price']); ?></td>
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
                            <td colspan="3" align="right" style="background:#ddd; font-weight:bold">Rs. <?php echo $grandtotalprice; ?>  </td>
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
   </div>     	
            <div id="txtcart">
 <centeR><h1><button onclick="javascript:printDiv('billingreport')" >Print billing report</button></center>
<script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
           var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
          
        }
    </script>
</h1>
</form>                    
            </div>            
                    <div style="float:right; width: 215px; margin-top: 20px;"></div>
</div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
<?php
  include("footer.php");
?>