<?php
include("header.php");
include("sidebar.php");
include("databaseconnection.php");
?>
        <div id="content" class="float_r">
        	<h1> books</h1>
            <?php
			$sql ="SELECT * FROM bookseller";
			$qsql =mysqli_query($con,$sql);
			while($rsq = mysqli_fetch_array($qsql))
			{
			?>  	
            <div class="product_box no_margin_right">
            	<h3>Mauris consectetur</h3>
            	<a href="productdetail.html"><img src="images/product/03.jpg" alt="Shoes 3" /></a>
                <p>Curabitur pellentesque ullamcorper massa ac ultricies. Maecenas porttitor erat quis leo pellentesque.</p>
              <p class="product_price">$ 60</p>
                <a href="shoppingcart.html" class="addtocart"></a>
                <a href="productdetail.html" class="detail"></a>
            </div>     
            <?php
			}
			?>
            <div class="cleaner"></div>
               	
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
  <?php
  include("footer.php");
  ?>