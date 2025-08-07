<p>Country :
                <label for="country"></label>
                <select name="country" id="country">
                   <option value="">Select</option>
               <?php
		            $sqlcountry="select * from countries";
					$querycountry=mysqli_query($con,$sqlcountry);
					while($rescountry=mysqli_fetch_array($querycountry))
					{
						if($rescountry['country_code']==$res['country_code'])
						{
							echo " <option value='$rescountry[country_code]' selected>$rescountry[country_name]</option>";
							
							}
							else
							{
								echo " <option value='$rescountry[country_code]'>$rescountry[country_name]</option>";
							
								}
						
						}
		
				?>
                  
                </select>
                <br />
                <br />
                
                  <p>State :
                 <label for="state"></label>
                <select name="state" id="state">
                   <option value="">Select</option>
                <?php
		            $sqlstate="select * from state";
					$querystate=mysqli_query($con,$sqlstate);
					while($resstate=mysqli_fetch_array($querystate))
					{
						if($resstate['state_id']==$res['state_id'])
						{
							echo " <option value='$resstate[state_id]' selected> $resstate[state]</option>";
							
							}
							else
							{
								echo " <option value='$resstate[state_id]' selected>$resstate[state]</option>";
							
								}
						
						}
		
				?>
             </select>