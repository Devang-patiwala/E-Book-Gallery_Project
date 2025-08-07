<?php
include("header.php");
include("admin_sidebar.php");
include("databaseconnection.php");
if(isset($_POST['submit']))
{
	$filename = rand() .  $_FILES['author_img']['name'];
	move_uploaded_file($_FILES['author_img']['tmp_name'],"authorimage/" . $filename);
	if(isset($_GET['editid']))
	{
		$sql = "UPDATE book_author SET author_name= '$_POST[author_name]',about_author= '$_POST[about_author]'";
		if($_FILES['author_img']['name'] != "")
		{
		$sql = $sql . ",author_img= '$filename'";
		}
		$sql = $sql . ",author_status= '$_POST[author_status]' WHERE book_author_id = $_GET[editid]";
		mysqli_query($con,$sql);
		echo "<script>alert('Author Record updated successfully..')</script>";
		echo "<script>window.location='viewauthor.php';</script>";
	}
	else
	{
		$query=mysqli_query($con,"insert into book_author(author_name,about_author,author_img,author_status)values('$_POST[author_name]','$_POST[about_author]','$filename','$_POST[author_status]')");
		echo "<script>alert('Author record inserted....')</script>";
		echo "<script>window.location='author.php';</script>";
	}
}
if(isset($_GET['editid']))
{
	$sql="select * from book_author where book_author_id='$_GET[editid]'";
	$qsql=mysqli_query($con,$sql);
	$res=mysqli_fetch_array($qsql);
}
?>
    
        <div id="content" class="float_r">
        	<h2> Add Author</h2>
       	  <div class="content_half float_l checkout">
			 <form method="post" enctype="multipart/form-data" action="" name="author" id="author" onsubmit="return validatecategory()">
			    <table width="531" height="181" border="1">
			      <tr>
			        <th width="170" scope="row">Author name</th>
			        <td width="305"><label for="author_name"></label>
		            <input type="text" name="author_name" id="author_name" value="<?php echo $res['author_name'];?>" /></td>
		          </tr>
			      <tr>
			        <th scope="row">About Author</th>
			        <td><textarea name="about_author" id="about_author" cols="45" rows="5"><?php echo $res['about_author'];?></textarea></td>
		          </tr>
			      <tr>
			        <th scope="row">About Image</th>
			        <td>
						<input type="file" name="author_img" id="author_img">
						<?php
						if(isset($_GET['editid']))
						{
							if($res['author_img'] == "")
							{
								$imgauthor = "images/default_image.jpg";
							}
							else if(file_exists("authorimage/" . $res['author_img']))
							{
								$imgauthor = "authorimage/" . $res['author_img'];
							}
							else
							{
								$imgauthor = "images/default_image.jpg";								
							}
						?>
						<img src="<?php echo $imgauthor; ?>" style="height: 150px; width: 155px;">
						<?php
						}
						?>
					</td>
		          </tr>
			      <tr>
			        <th scope="row">Author Status</th>
			        <td>
						<select name="author_status" id="author_status" >
							<option value="">Select Author Status</option>
							<?php
							$arr = array("Active","Inactive");
							foreach($arr as $val)
							{
								if($val == $res['author_status'])
								{
								echo "<option value='$val' selected >$val</option>";
								}
								else
								{
								echo "<option value='$val'>$val</option>";
								}
							}
							?>
						</select>
					</td>
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
	function  validatecategory()
	{
		if(document.author.author_name.value == "")
		{
			alert("Author name should not be empty..");
			document.author.author_name.focus();
			return false;
		}
		else if(document.author.author_status.value == "")
		{
			alert("Author Status should not be empty..");
			document.author.author_status.focus();
			return false;
		}
		else
		{
			return true;
		}
	}
  </script>