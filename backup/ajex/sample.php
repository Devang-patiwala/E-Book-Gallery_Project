<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form>
<select name="sample" onchange="sample1(this.value)">
<option value="aaa">1</option>
<option value="bbb">2</option>
<option value="ccc">3</option>
</select>
</form>
<p id="name"></p>
</body>
</html>
<script type="application/javascript">
function sample1(example)
{
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
   xmlhttp.open("GET","getuser.php?q="+example,true);
  xmlhttp.send();
    xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("name").innerHTML=xmlhttp.responseText;
    }
  }
}
</script>