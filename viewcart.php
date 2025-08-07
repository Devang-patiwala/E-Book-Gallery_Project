<?php
include("header.php");
include("sidebar.php");
if(isset($_SESSION['cid']))
{
	$cartselect="UPDATE purchase  SET cust_id='$_SESSION[cid]' where purchasestatus='Pending'";
	if(!mysqli_query($con,$cartselect))
	{
		echo mysqli_error($con);
	}
}
if(isset($_GET['delid']))
{
	$cartdel="DELETE FROM purchase where purch_id='$_GET[delid]'";
	mysqli_query($con,$cartdel);
	echo"<script>alert('Record deleted from cart..')</script>";
}
if(isset($_GET['productid']))
{	
	 $checkcart="SELECT * FROM purchase WHERE book_id='$_GET[productid]' AND cust_id='$_SESSION[cid]' AND purchasestatus='Pending'";
	 $rescart=mysqli_query($con,$checkcart);
	 if(mysqli_num_rows($rescart) == 0)
	 {
	 		$cartquery=mysqli_query($con,"insert into purchase(book_id,cust_id,bill_id,qty,price,comments,purchasestatus) VALUES('$_GET[productid]','$_SESSION[cid]','0','$_GET[qty]','$_GET[price]','','Pending')");
			if(!$cartquery)
			{
			 	echo "<script>alert('Error')</script>".mysqli_errno($cquery);
			}
			else
			{
				echo"<script>alert('Record inserted to cart..')</script>";
			}
	 }
}
?>
        <div id="content" class="float_r">
        	<h1>Shopping Cart</h1>
            <div id="txtcart">
            <?php
			include("viewshoppingcart.php");
			?>
            </div>
                    <div style="float:right; width: 215px; margin-top: 20px;"></div>
			</div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
<?php
  include("footer.php");
?>
<script type="application/javascript">
function calcval(purch_id,qty,totqty)
{	
    if (purch_id == "")
	{
        document.getElementById("txtcart").innerHTML = "";
        return;
    } 
	else if(qty>totqty)
	{
		alert("Entered quantitiy is larger than available quantity..");
		document.getElementById("availableqty").value = totqty;
		return false;
	}
	else
	{ 
        if (window.XMLHttpRequest)
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
		else
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function()
		{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
                document.getElementById("txtcart").innerHTML = xmlhttp.responseText;
            }
        }
		var weblink= "viewshoppingcart.php?purch_id="+purch_id+"&qty="+qty;
        xmlhttp.open("GET",weblink,true);
        xmlhttp.send();
    }
}
</script>