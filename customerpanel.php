<?php
if(!isset($_SESSION)){ session_start(); }
include("header.php");
include("admin_sidebar.php");
if(isset($_SESSION['cid']))
{
$sqlcustomer ="SELECT * FROM customer WHERE custid='$_SESSION[cid]'";
$qcustcustomer = mysqli_query($con,$sqlcustomer);
$rscustomer = mysqli_fetch_array($qcustcustomer);
}
$sqlbilling ="SELECT * FROM billing WHERE custid='$_SESSION[cid]'";
$qcustbilling = mysqli_query($con,$sqlbilling);
$rsbilling = mysqli_fetch_array($qcustbilling);

$sqlbillingpurchase ="SELECT * FROM purchase WHERE cust_id='$_SESSION[cid]'";
$qcustbillingpurchase = mysqli_query($con,$sqlbillingpurchase);
$rspurchase = mysqli_fetch_array($qcustbillingpurchase);
?>
        <div id="content" class="float_r">
        	<h1>Customer Panel</h1>
        <div class="cleaner"></div>
        <blockquote><strong>Welcome,</strong> <?php echo $rscustomer['custfname'] . " " . $rscustomer['custlname']; ?></blockquote>
        <div class="cleaner"></div>
        <blockquote><strong>Number of billing records :</strong> <?php echo mysqli_num_rows($qcustbilling); ?></blockquote>
                <div class="cleaner"></div>
        <blockquote> <strong>Number of purchase records:</strong> <?php echo mysqli_num_rows($qcustbillingpurchase); ?></blockquote>
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
<?php
include("footer.php");
?>