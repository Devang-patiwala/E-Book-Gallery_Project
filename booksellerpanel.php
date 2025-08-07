<?php 
if(!isset($_SESSION)){ session_start(); }
ob_start();
if(!isset($_SESSION['loginid']))
{
	header("Location: booksellerlogin.php");
}
include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");
?>
        <div id="content" class="float_r">
        	<h1>Book Seller  PANEL</h1>
        
        <div class="cleaner"></div>
        <blockquote> Number of books uploaded : 
                <?php
		$sql= "SELECT * FROM books where seller_id='$_SESSION[seller_id]'";
		$qbooks = mysqli_query($con,$sql);
		echo mysqli_num_rows($qbooks);
		?>
        </blockquote>
                <div class="cleaner"></div>
        <blockquote> books purchased : 
                <?php
		$sql= "SELECT     ifnull(COUNT(purchase.qty),0) AS Expr1 FROM         books INNER JOIN purchase ON books.book_id = purchase.book_id GROUP BY books.seller_id HAVING      (books.seller_id = '$_SESSION[seller_id]')";
		$qpurchase = mysqli_query($con,$sql);
		$rsprocount = mysqli_fetch_array($qpurchase);
        if(mysqli_num_rows($qpurchase) == 0)
        {
            echo 0;
        }
        else
        {
		echo $rsprocount['Expr1'];
        }
		?>
        </blockquote><br />

 <h2>Recent orders:</h2>
           <div style='overflow:auto; width:675px;height:370px;'>
<table width="958" border="1">
  <tr>
    <th width="138" scope="col">Bill ID</th>
    <th width="138" scope="col">Purchase date</th>
    <th width="173" scope="col">Book Name</th>
    
    <th width="177" scope="col">Customer Name</th>
    <th width="177" scope="col">Quantity</th>
     <th width="177" scope="col">Price</th>
      <th width="177" scope="col">Purchase Status</th>
    </tr>
<?php
$pursql="SELECT  books.*, purchase.*, billing.* FROM billing INNER JOIN purchase ON billing.bill_id = purchase.bill_id LEFT OUTER JOIN books ON purchase.book_id = books.book_id WHERE (books.seller_id = '$_SESSION[seller_id]') AND purchase.purchasestatus='PAID'";
$pursql= $pursql . "  ORDER BY purchase.purch_id";
	$purres=mysqli_query($con,$pursql);
	while($prs=mysqli_fetch_array($purres))
	{		
		
		
		$rss3="select * from `customer` where custid='$prs[cust_id]'";
		$resrs3=mysqli_query($con,$rss3);
		$rs3=mysqli_fetch_array($resrs3);
		
  echo"<tr>
    <td>$prs[bill_id]</td>
	<td>$prs[purch_date]</td>
    <td>$prs[book_name]</td>
    
    <td>$rs3[custfname]</td>
	<td>$prs[qty]</td>
	<td>$prs[price]</td>
	<td>$prs[purchasestatus]";
	echo "</td></tr>";
	}
	?>
</table>
    </div>
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
<?php
include("footer.php");
?>