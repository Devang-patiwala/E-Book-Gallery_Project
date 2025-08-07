<?php
error_reporting(E_ALL & ~E_NOTICE);
include("databaseconnection.php");
?>
Sub Category :<br />
                <select name="subcat" id="subcat" style="width:300px;height:30px;">>
                <option value="">Select</option>
                <?php
				$sql2="SELECT * FROM  `subcategory` WHERE cat_id='$_GET[categoryid]' ";
				$res2 = mysqli_query($con,$sql2);
				while($rs2 = mysqli_fetch_array($res2))
				{
					if($rs2['subcat_id']==$resview['subcat_id'])
					{
					echo "<option value='$rs2[subcat_id]' selected>$rs2[subcategory]</value>";
					}
					else
					{
						echo "<option value='$rs2[subcat_id]' >$rs2[subcategory]</value>";
						}
				}
				?>
                </select>