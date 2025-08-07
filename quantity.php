<?php

include("header.php");
include("sidebar.php");
include("databaseconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		mysqli_query($con,"UPDATE subcategory SET subcategory='$_POST[catname]',description='$_POST[description]', cat_id='$_POST[maincat]' where subcat_id='$_GET[editid]'");
		echo "<script>alert('record updated successfully..');</script>";
		echo"<script>window.location='viewsubcategory.php';</script>";
	}
	else
	{
		mysqli_query($con,"INSERT INTO quantity(book_id,size_id, qty) VALUES('$_POST[bookname]','$_POST[size]','$_POST[quantity]')");
		echo "<script>alert('Quantity record inserted successfully..');</script>";
	}
}



	$sql1 = "SELECT * FROM quantity";
	$qsql1 = mysqli_query($con,$sql1);
	$rssql1 = mysqli_fetch_array($qsql1);

?>
    
        <div id="content" class="float_r">
        	<h2> Quantity          </h2>
       	  <div class="content_half float_l checkout">
			 <form method="post" action="" name="subcategory" onsubmit="return validatesubcategory()">
            
			    <table width="531" height="176" border="1">
			      <tr>
			        <th height="26" scope="row">Book Name</th>
			        <td><label for="bookname"></label>
			          <select name="bookname" id="bookname">
                      <option value="">Select</option>
                      <?php
					  $sqlpro = "SELECT * FROM books";
					  $resultpro = mysqli_query($con,$sqlpro);
					  while($rspro = mysqli_fetch_array($resultpro))
					  {
						  if($rspro['product_id']==$rssql1['product_id'])
						  {
						  echo "<option value='$rspro[product_id]' selected>$rspro[book_name]</option>";
						  }
						  else
						  {
							   echo "<option value='$rspro[product_id]'>$rspro[book_name]</option>";
						  }
					  
					  }
					  
					  ?>                      
	                </select></td>
		          </tr>
			      <tr>
			        <th width="170" height="26" scope="row">Size</th>
                    
			        <td width="305"><select name="size" id="size">
                      <option value="">Select</option>
                      <?php
					  $sqltype = "SELECT * FROM type";
					  $resulttype = mysqli_query($con,$sqltype);
					  while($rstype = mysqli_fetch_array($resulttype))
					  {
						  if($rstype['size_id']==$rssql1['size_id'])
						  {
						  echo "<option value='$rstype[size_id]' selected>$rstype[size]</option>";
						  }
						  else
						  {
							   echo "<option value='$rstype[size_id]'>$rstype[size]</option>";
						  }
					  
					  }
					  
					  ?>                      
	                </select></td>
		          </tr>
			      <tr>
			        <th scope="row">Color</th>
			        <td><select name="color" id="color">
                      <option value="">Select</option>
                      <?php
					  $sqltype1 = "SELECT * FROM type";
					  $resulttype1 = mysqli_query($con,$sqltype1);
					  while($rstype = mysqli_fetch_array($resulttype1))
					  {
						  if($rstype1['size_id']==$rssql1['size_id'])
						  {
						  echo "<option value='$rstype1[size_id]' selected>$rstype1[color]</option>";
						  }
						  else
						  {
							   echo "<option value='$rstype1[size_id]'>$rstype1[color]</option>";
						  }
					  
					  }
					  
					  ?>                        
	                </select>
		             </td>
		          </tr>
                   <tr>
			        <th height="26" scope="row">Quantity</th>
			        <td><label for="maincat"></label>
			         <input type="number" id="quantity" name="quantity" /></td>
		          </tr>
			      <tr>
			        <th colspan="2" scope="row"><input type="submit" name="submit" id="submit" value="Submit" /></th>
		          </tr>
	        </table>
            </form>
          </div>
            
          <div class="content_half float_r checkout"><br />
          </div>
            
          <div class="cleaner h50"></div>
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
  <?php
  include("footer.php");
  ?>
  <script type="application/javascript">
	function  validatesubcategory()
	{
		if(document.subcategory.maincat.value == "")
		{
			alert("Category name should not be empty..");
			document.subcategory.maincat.focus();
			return false;
		}
		else if(document.subcategory.catname.value == "")
		{
			alert("Subcategory name should not be empty..");
			document.subcategory.catname.focus();
			return false;
		}
		else if(document.subcategory.description.value == "")
		{
			alert("Description should not be empty..");
			document.subcategory.description.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
  </script>