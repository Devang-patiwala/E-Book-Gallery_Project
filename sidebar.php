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
<div class="sidebar_box"><span class="bottom"></span>
            	<h3>AUTHORS</h3>   
                <div class="content"> 
                <?php
                    $sql = "SELECT * FROM book_author order by rand() limit 5";
                    $rsquerycomp = mysqli_query($con,$sql);
                    while($rscomp = mysqli_fetch_array($rsquerycomp))
                    {
                        if($rscomp['author_img'] == "")
                        {
                            $imgauthor = "images/default_image.jpg";
                        }
                        else if(file_exists("authorimage/" . $rscomp['author_img']))
                        {
                            $imgauthor = "authorimage/" . $rscomp['author_img'];
                        }
                        else
                        {
                            $imgauthor = "images/default_image.jpg";								
                        }
					?>
                       <div class="bs_box">
                       <a href="booklist.php?book_author_id=<?php echo $rscomp['book_author_id'] ; ?>"><img src="<?php echo $imgauthor; ?>" width="58" height="58"  /></a>
                       <h4><a href="booklist.php?book_author_id=<?php echo $rscomp['book_author_id'] ; ?>"><?php echo $rscomp['author_name']; ?></a></h4>
                       <button type="button" class="button" style="padding: 4px;margin: 2px;" onclick="showauthorinfo('<?php echo $rscomp['about_author']; ?>')">About Author</button>
                       <button type="button" class="button"  onclick="window.location='booklist.php?book_author_id=<?php echo $rscomp['book_author_id'] ; ?>'" style="padding: 4px;margin: 2px;">View Books</button>
                            <div class="cleaner"></div>
                        </div>
					<?php
					}
					?>                                        
              </div>
            </div>
        </div>
<script>
function showauthorinfo(about_author)
{
    alert(about_author);
}
</script>