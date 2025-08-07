<?php
if(!isset($_SESSION)){ session_start(); }
include("databaseconnection.php");
?>
<div class="container">
            <!--  Lets display all countries in an drop down list           -->
            Country:<br />
            <select name="country" id="country" onchange="ajax_call(this.value)">
                <option value="">Select Country</option>
                <?php
				// Lets select all countries from our table...
				$sqlAllCountries = "SELECT * FROM location WHERE location_type =0";
				$sqlAllCountriesResult = mysqli_query($con,$sqlAllCountries);
                while ($row =  mysqli_fetch_array($sqlAllCountriesResult))
				{
					if($row['location_id'] == $location_id)
					{
                    	echo "<option value='$row[location_id]' selected>$row[name]</option>";
					}
					else
					{
						echo "<option value='$row[location_id]'>$row[name]</option>";
					}
                }
                ?>
            </select>
            <br/><br/>
            State <br>
    <div id='loadajaxstate'>
    <select name="state" id="state" >
    <?php
    $sqlAllCountries = "SELECT * FROM location ";
				$sqlAllCountriesResult = mysqli_query($con,$sqlAllCountries);
                while ($row =  mysqli_fetch_array($sqlAllCountriesResult))
				{
					if($row['location_id'] == $state_id)
					{
                    	echo "<option value='$row[location_id]' selected>$row[name]</option>";
					}
					else
					{
						echo "<option value='$row[location_id]'>$row[name]</option>";
					}

				}
	?>
	</select>
    </div>
</div>
<div id="loading"></div>
<script type="application/javascript">
function ajax_call(country) {
    if (country == "") {
        document.getElementById("loadajaxstate").innerHTML = "<select name='state' id='state'></select>";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("loadajaxstate").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","ajaxstate.php?country="+country,true);
        xmlhttp.send();
    }
}
</script>