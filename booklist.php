<?php
include("header.php");
include("sidebar.php");
include("databaseconnection.php");
?>
        <div id="content" class="float_r">
        	<h1> Books List</h1>
            <?php
			$i=0;
			$sql ="SELECT * FROM books where status='Active'";
			if(isset($_GET['catid']))
			{
			$sql = $sql . " AND cat_id='$_GET[catid]' ";
			}
			if(isset($_GET['subcat']))
			{
			$sql = $sql . " AND subcat_id='$_GET[subcat]' ";
			}
			if(isset($_GET['keyword']))
			{
			$sql = $sql . " AND book_name LIKE '%$_GET[keyword]%' ";				
			}
			if(isset($_GET['compid']))
			{
			$sql = $sql . " AND seller_id='$_GET[compid]' ";								
			}
			if(isset($_GET['book_author_id']))
			{
			$sql = $sql . " AND book_author_id='$_GET[book_author_id]' ";								
			}
			
			$qsql =mysqli_query($con,$sql);
			while($rsq = mysqli_fetch_array($qsql))
			{
                if($i=="2")
                {
					echo "<div class='product_box  no_margin_right'>";
					echo '<div class="cleaner"></div>';
					$i=0;
                }
				else
				{
					echo "<div class='product_box'>";
					echo '<div class="cleaner"></div>';					
				}
                ?>
            
            	<h3 style="height: 30px;" ><a href="productdetail.php?book_id=<?php echo $rsq['book_id']; ?>"><strong><?php echo ucfirst($rsq['book_name']); ?></strong></a></h3>
            	<a href="productdetail.php?book_id=<?php echo $rsq['book_id']; ?>"><img src="bookcoverimage/<?php 
				//check image
					echo $prodimage =  $rsq['images'];	
				?>" alt="<?php echo $rsq['book_name']; ?>"  width="100" height="150" /></a>
               
              <p class="product_price" style="color: red;">Rs. <?php echo $rsq['price']; ?></p>
                <?php
				 $checkcart="SELECT * FROM purchase WHERE book_id='$rsq[book_id]' AND cust_id='$_SESSION[loginid]' AND purchasestatus='Pending'";
				$rescart=mysqli_query($con,$checkcart);
			if(mysqli_num_rows($rescart) == 1)
			{
				?>
                <a href="viewcart.php" >Exist in Cart</a>
                <?php
			}
			else
			{
				if($rsq['stockstatus'] == "Out of Stock")
				{
					echo "<font color='red'><strong>Out of Stock</strong></font>";
				}
				else
				{
				?>
                <a href="viewcart.php?productid=<?php echo $rsq['book_id']; ?>&price=<?php echo $rsq['price']; ?>&qty=1&submit=Add+to+Cart" class="addtocart"></a>
                <?php
				}
			}
				?>
                <a href="productdetail.php?book_id=<?php echo $rsq['book_id']; ?>" class="detail"></a>
            </div>     
            <?php
			$i++;
			}
			?>  	
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
  <?php
  include("footer.php");
  ?>