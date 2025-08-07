<?php 
if(!isset($_SESSION)){ session_start(); }
ob_start();
include("databaseconnection.php");
if(!isset($_SESSION['loginid']))
{
	if($_SESSION['logintype'] != "Administrator")
	{
	header("Location: adminlogin.php");
	}
}
include("header.php");
include("admin_sidebar.php");
?>
        <div id="content" class="float_r">
        	<h1>Admin Dashboard</h1>
        
        <div class="cleaner"></div>
        <blockquote>
        Number of Administrator  : 
        <?php
		$sql= "SELECT * FROM administrator";
		$qadmin = mysqli_query($con,$sql);
		echo mysqli_num_rows($qadmin);
		?>
        </blockquote>
        <blockquote>
        Number of Customer  : 
        <?php
		$sql= "SELECT * FROM customer";
		$qcustomer = mysqli_query($con,$sql);
		echo mysqli_num_rows($qcustomer);
		?></blockquote>
        <blockquote>
        Number of books  :
        <?php
		$sql= "SELECT * FROM books";
		$qbooks = mysqli_query($con,$sql);
		echo mysqli_error($con);
		echo mysqli_num_rows($qbooks);
		?>
        </blockquote>
        <blockquote>
        Number of Purchase  : 
        <?php
		$sql= "SELECT * FROM purchase";
		$qpurchase = mysqli_query($con,$sql);
		echo mysqli_num_rows($qpurchase);
		?>
        </blockquote>
         <blockquote>
        Number of bookseller  :
        <?php
		$sql= "SELECT * FROM bookseller";
		$qbookseller = mysqli_query($con,$sql);
		echo mysqli_num_rows($qbookseller);
		?>
        </blockquote>
         <blockquote>
        Number of Category  :
        <?php
		$sql= "SELECT * FROM category";
		$qCategory = mysqli_query($con,$sql);
		echo mysqli_num_rows($qCategory);
		?>
        </blockquote>
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
<?php

include("footer.php");
?>