<?php
error_reporting(0);
include("databaseconnection.php");
if(!isset($_SESSION)){ session_start(); }
if(isset($_GET['qty']))
{
	$cartselect="UPDATE purchase SET qty='$_GET[qty]' where purch_id='$_GET[purch_id]'";
	mysqli_query($con,$cartselect);
	echo mysqli_error($con);
}
	$grandtotalprice = $totprice = 0;
	$cartselect="SELECT * FROM purchase where cust_id='$_SESSION[cid]' AND purchasestatus='Pending'";
	$res=mysqli_query($con,$cartselect);
	echo mysqli_error($con);
	if(mysqli_num_rows($res)  >= 1)
	{
?>              <table  width="100%"  border="1" class="tftable">
<thead>
                   	  <tr bgcolor="#ddd">
                        	<th width="130" align="left">Image </th> 
                        	<th width="143" align="left">Book Name </th> 
                       	  	<th width="62" align="center">Quantity </th> 
                        	<th width="72" align="right">Price </th>
                        	<th width="59" align="right">Discount</th> 
                        	<th width="80" align="right">Total </th> 
                        	<th width="53"> </th>
                            
                      </tr>             
              </thead>
                <tbody>
                      <?php
					  while($result=mysqli_fetch_array($res))
					  {
						  $cartselect1="SELECT * FROM books	 where book_id='$result[book_id]'";
						  $res1=mysqli_query($con,$cartselect1);
						  echo mysqli_error($con);
						  $result1=mysqli_fetch_array($res1);
					  ?>
                    	<tr>
                        	<td>
<img src="bookcoverimage/<?php 
				//check image
				echo $prodimage =  $result1['images'];	
				?>" alt="" width="124" height="85" /></td> 
                        	<td><?php echo $result1['book_name']; ?><br>
							(<?php echo $result1['book_type']; ?>)
							</td> 
                            <td align="center">
<input name="availableqty" id="availableqty" type="number" value="<?php echo intval($result['qty']); ?>" style="width: 50px; text-align: left" onkeyup="calcval(<?php echo $result['purch_id']; ?>,this.value,<?php echo $result1['totqty']; ?>)" onchange="calcval(<?php echo $result['purch_id']; ?>,this.value,<?php echo $result1['totqty']; ?>)" /> </td>
                            <td align="right">Rs.<?php echo intval($result['price']); ?></td>
                            <td align="right">Rs.<?php echo $discount = intval(($result['qty']* $result['price'])*$result1['discount'])/100; ?></td> 
                            <td align="right">Rs.<?php  echo $totprice = ($result['qty']* $result['price']) - $discount; ?></td>
                            <td align="center"><a href="viewcart.php?delid=<?php echo $result['purch_id']; ?>"><img src="images/remove_x.gif" alt="remove" width="14" height="18" /><br />Remove</a> </td>
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
              </tbody>
					</table>
                    <?php
					if(isset($_SESSION['cid']))
					{
					?>
                    <p style="float:right; width: 215px; margin-top: 20px;"><a href="confirmorders.php" style="color: #ffffff;" class="button" ><strong>Proceed to checkout</strong></a></p>
                    <?php
					}
					else
					{
					?>
					<p style="float:right; width: 215px; margin-top: 20px;"><a href="login.php?cart=checkout"  style="color: #ffffff;"  class="button" ><strong>Proceed to checkout</strong></a></p>
                    <?php
					}
					?>
                    <p style="float:right; width: 215px; margin-top: 20px;"><a href="booklist.php" style="color: #ffffff;"  class="button" ><strong>Continue shopping</strong></a></p>
                      <?php
				}
				else
				{
				?>
                   <p><h2>No items found in the cart</h2></p>
                <?php
				}
				?>