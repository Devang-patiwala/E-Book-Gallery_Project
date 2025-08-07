<?php
if(!isset($_SESSION)){ session_start(); }
include("databaseconnection.php");
?>
    <div id="templatemo_main">
    	<div id="sidebar" class="float_l">
<?php
if($_SESSION['logintype'] =="Administrator")
{
?>	
    	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Admin Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<li class="first"><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="viewcustomer.php">View Customer</a></li>
                        <li><a href="book.php">Add New Book</a></li>
                        <li><a href="viewbooks.php">View books</a></li>
                        <li><a href="bookseller.php">Add Book Seller</a></li>
                    	<li><a href="administrator.php">Add Administrator</a></li>                        
                        <li><a href="viewadministrator.php">View Administrator</a></li>
                        <li><a href="category.php">Add Category</a></li>
                        <li><a href="viewcategory.php">View category</a></li>
                        <li><a href="author.php">Add Author</a></li>
                        <li><a href="viewauthor.php">View Author</a></li>
                        <li><a href="viewbookseller.php">View Book Sellers</a></li>
                        <li><a href="purchasereport.php">View purchase report</a></li>
                        <li><a href="billingreport.php">View billing report</a></li>
                        <li class="last"><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>            
<?php
}
if($_SESSION['logintype'] =="Customer")
{
?>	
    	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Customer Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<li class="first"><a href="customerpanel.php">Home</a></li>   
                        <li><a href="changecustomerprofile.php">Customer Profile</a></li>
                        <li><a href="changepassword.php">Change Password</a></li>                     
                        <li><a href="customerbillingreport.php">Billing report</a></li>						
                    	<li><a href="customerpurchasereport.php">Digital Downloads</a></li>
                        <li><a href="addshippingdetails.php">Add Shipping Address</a></li>
                        <li><a href="viewshippingdetails.php">View Shipping Address</a></li>
                        <li class="last"><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>            
<?php
}
if($_SESSION['logintype'] =="bookseller")
{
?>	
    	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Book Seller Menu</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<li class="first"><a href="booksellerpanel.php">Home</a></li>
                        <li><a href="book.php">Add New Book</a></li>
                        <li><a href="viewbooks.php">View books</a></li>       
                        <li><a href="changebooksellerpassword.php">Change Password</a></li>
                        <li><a href="changebooksellerprofile.php">Book Seller Profile</a></li>                     
                    	<li><a href="purchasereport.php">Purchase report</a></li>                       
                        <li class="last"><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>            
<?php
}
?>            

        </div>
<script>
function showauthorinfo(about_author)
{
    alert(about_author);
}
</script>