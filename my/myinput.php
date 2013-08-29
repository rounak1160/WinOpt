<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
$simple = false;
if ($_GET['simple'] == 'true') {
	$simple = true;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW, NOARCHIVE">
	<meta name="Kshitij" content="Online Cool Roof Calculator" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="images/style.css" type="text/css" />
	<script type="text/javascript" src="validator.js"></script>
	<title>Windows Optimisation Tool</title>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	    _gaq.push(['_setAccount', 'UA-17329527-1']);
	      _gaq.push(['_trackPageview']);

	        (function() {
		     var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		         ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			       })();

	</script>

</script>

<link href="css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
.form-horizontal .control-group {
  margin-bottom: 5px;
}​
</style>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20687132-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
	<div class="container">
		<div class="row">
		
			<div id="header">
				<div id="companyname" align="left">Windows Optimisation Tool</div>
<!--				<div align="right" class="links_menu" id="menu"><a href="index.html">Home</a> | <a href="calculator_detailed.php">Calculator</a> | <a href="glossary.html">Glossary</a> | <a href="vendors.php">Material Database</a>| <a href="docs.html">Documentation</a> | <a href="contact.html">Contact Us</a> </div>
		-->	</div>
			<br />
		</div>














		<script type="text/javascript" >
			function hide(n){
				if(n=='1'){
					var a=document.getElementById('azifixed');
					a.style.display="none";
					a=document.getElementById('azivariable');
					a.style.display="block";
				}
				else if(n=='2'){
					var a=document.getElementById('azivariable');
					a.style.display="none";
					a=document.getElementById("azifixed");
					a.style.display="block";
				}
				else if(n=='3'){
					var a=document.getElementById('wwrfixed');
					a.style.display="none";
					a=document.getElementById('wwrvariable');
					a.style.display="block";
				}
				else if(n=='4'){
					var a=document.getElementById('wwrvariable');
					a.style.display="none";
					a=document.getElementById("wwrfixed");
					a.style.display="block";
				}
				else if(n=='5'){
					var a=document.getElementById('depthfixed');
					a.style.display="none";
					a=document.getElementById('depthvariable');
					a.style.display="block";
				}
				else if(n=='6'){
					var a=document.getElementById('depthvariable');
					a.style.display="none";
					a=document.getElementById("depthfixed");
					a.style.display="block";
				}

			}
			
			//validation of the form for correct values is here
			function validateForm(){
				var flag=0;//makes sure that atleast one is a variable
				var radios = document.getElementsByTagName('input');
				var value;
				for (var i = 0; i < radios.length; i++) {
					if (radios[i].type === 'radio' && radios[i].checked) {
						// get value, set checked flag or do whatever you need to
						value = radios[i].value;
						//alert(radios[i].name+value);
						
						//azimuth limitations
						if(radios[i].name==="azi_var_fix" && value==="variable"){
							flag=1;
							var div = document.getElementById('azivariable').getElementsByTagName('input');
							var k;
							var ini=0;
							var max=0;
							var min=0;
							for (k=0;k<div.length;k++)
							{
								if(div[k].name==="azi_ini_value"){
									ini=div[k].value;
									ini=Number(ini);
								}
								if(div[k].name==="azi_min_value"){
									min=div[k].value;
									min=Number(min);
								}
								if(div[k].name==="azi_max_value"){
									max=div[k].value;
									max=Number(max);
								}
								if(div[k].value===''|| div[k].value===null){
									alert(div[k].name+" is left unfilled");
									return false;
								}
								else if(div[k].value<0){
									alert(div[k].name+" negative value not possible");
									return false;
								}
								else if(div[k].value>360){
									alert(div[k].name+" value greater than 360 not possible");
									return false;
								}
							}
							if(min<=ini && ini<=max);
							else{
								alert("initial value of azimuth should be between minimun and maximum");
								return false;
							}
							
						} 
						else if(radios[i].name==="azi_var_fix" && value==="fixed"){
							var div = document.getElementById('azifixed').getElementsByTagName('input');
							var k;
							for (k=0;k<div.length;k++)
							{
								if(div[k].value===''|| div[k].value===null){
									alert(div[k].name+" is left unfilled");
									return false;
								}
								else if(div[k].value<0){
									alert(div[k].name+" negative value not possible");
									return false;
								}
								else if(div[k].value>360){
									alert(div[k].name+" value greater than 360 not possible");
									return false;
								}								
							}
							
						}
						
						//wwr limitations
						if(radios[i].name==="wwr_var_fix" && value==="variable"){
							flag=1;
							var div = document.getElementById('wwrvariable').getElementsByTagName('input');
							var k;
							var ini=0;
							var max=0;
							var min=0;
							for (k=0;k<div.length;k++)
							{
								if(div[k].name==="wwr_ini_value"){
									ini=div[k].value;
									ini=Number(ini);
									
								}
								if(div[k].name==="wwr_min_value"){
									min=div[k].value;
									min=Number(min);
								}
								if(div[k].name==="wwr_max_value"){
									max=div[k].value;
									max=Number(max);
								}
								if(div[k].value===''|| div[k].value===null){
									alert(div[k].name+" is left unfilled");
									return false;
								}
								else if(div[k].value<0){
									alert(div[k].name+" negative value not possible");
									return false;
								}								
							}
							if(min<10 || min>90){
								alert("wwr min should be between 10 and 90");
								return false;
							}
							if(max<10 || max>90){
								alert("wwr max should be between 10 and 90");
								return false;
							}
							if(ini<10 || ini>90){
								alert("wwr ini should be between 10 and 90");
								return false;
							}
							if(min<=ini && ini<=max);
							else{
								alert("initial value of wwr should be between minimun and maximum");
								return false;
							}
							
						}
						else if(radios[i].name==="wwr_var_fix" && value==="fixed"){
							var div = document.getElementById('wwrfixed').getElementsByTagName('input');
							var k;
							for (k=0;k<div.length;k++)
							{
								if(div[k].value===''|| div[k].value===null){
									alert(div[k].name+" is left unfilled");
									return false;
								}
								else if(div[k].value<10){
									alert(div[k].name+" value cannot be less than 10");
									return false;
								}
								else if(div[k].value>90){
									alert(div[k].name+" value cannot be more than 90");
									return false;
								}								
							}
							
						}
						
						//overhang depth limitations	
						if(radios[i].name==="depth_var_fix" && value==="variable"){
							flag=1;
							var div = document.getElementById('depthvariable').getElementsByTagName('input');
							var k;
							var ini=0;
							var max=0;
							var min=0;
							for (k=0;k<div.length;k++)
							{
								if(div[k].name==="depth_ini_value"){
									ini=div[k].value;
									ini=Number(ini);
								}
								if(div[k].name==="depth_min_value"){
									min=div[k].value;
									min=Number(min);
								}
								if(div[k].name==="depth_max_value"){
									max=div[k].value;
									max=Number(max);
								}
								if(div[k].value===''|| div[k].value===null){
									alert(div[k].name+" is left unfilled");
									return false;
								}
								else if(div[k].value<0){
									alert(div[k].name+" negative value not possible");
									return false;
								}								
							}
							if(min<0.1 || min>3){
								alert("overhang depth min should be between 0.1 and 3");
								return false;
							}
							if(max<0.1 || max>3){
								alert("overhang max should be between 0.1 and 3");
								return false;
							}
							if(ini<0.1 || ini>3){
								alert("overhang ini should be between 0.1 and 3");
								return false;
							}
							if(min<=ini && ini<=max);
							else{
								alert("initial value of depth should be between minimun and maximum");
								return false;
							}
							
						}
						else if(radios[i].name==="depth_var_fix" && value==="fixed"){
							var div = document.getElementById('depthfixed').getElementsByTagName('input');
							var k;
							for (k=0;k<div.length;k++)
							{
								if(div[k].value===''|| div[k].value===null){
									alert(div[k].name+" is left unfilled");
									return false;
								}
								else if(div[k].value<0.1){
									alert(div[k].name+" negative value not possible");
									return false;
								}
								else if(div[k].value<0.1){
									alert(div[k].name+" value cannot be less than 0.1");
									return false;
								}
								else if(div[k].value>3){
									alert(div[k].name+" value cannot be more than 3");
									return false;
								}								
							}
							
						}
					}
				}
				
				if(flag===0){
					alert("atleast one has to be a variable");
					return false;
				}
				
				var checkboxes = document.getElementsByTagName('input');
				flag=0;
				for (var i = 0; i < checkboxes.length; i++) {
					if (checkboxes[i].type == 'checkbox' && checkboxes[i].checked) {
						// get value, set checked flag or do whatever you need to
						value = checkboxes[i].value;
						//alert(value);
						flag=1;
					}
				}
				if(flag===0){
					alert("aleast one window type has to be selected");
					return false;
				}
				return true;
			}
		</script>
		<div style="width:1000px; height:750px; background-color:#659EC7;" >
<h3 style="text-align:center;"> Inputs </h3>
			<form style="margin-left:50px" name="data" action="mycommand_file_generator.php" method="POST" onsubmit="return validateForm()">
				<h3><b> Azimuth value :- </b></h3>
				
				<input type="radio" name="azi_var_fix" value="variable" onClick="hide('1')" checked>azimuth is variable 
				&nbsp;	&nbsp;	&nbsp;	&nbsp;	
				<input type="radio" name="azi_var_fix" value="fixed" onClick="hide('2')">azimuth is fixed<br><br>
				<div id="azivariable">
				<table>
				<tr>
				<td>Initial Value:- </td><td>&nbsp;</td><td> <input type="text" name="azi_ini_value" value="90" style="width:200px"></td>
 
	
				<td style="padding-left:50px;"> Minimum Value:- </td><td>&nbsp;</td> <td><input type="text" name="azi_min_value" value="0" style="width:200px"></td>
				</tr>
				<tr>	
				<td>Maximum Value </td><td>:-</td> <td><input type="text" name="azi_max_value" value="360" style="width:200px"></td>
				
				<td style="padding-left:50px;">	Step Value:- </td><td>&nbsp;</td> <td><input type="text" name="azi_step_value" value="90" style="width:200px"></td>
				</tr>
				</table>
				</div>
				<div id="azifixed" style="display:none">
					Value :- <input type="text" name="azi_value" value="90"><br>
				</div>

				<h3> WWR value :- </h3>
				<input type="radio" name="wwr_var_fix" value="variable" onClick="hide('3')" checked>WWR is variable
				&nbsp;	&nbsp;	&nbsp;	&nbsp;	
				<input type="radio" name="wwr_var_fix" value="fixed" onClick="hide('4')">WWR is fixed<br><br>
				<div id="wwrvariable">
					<table>
					<tr>
					<td>Initial Value:- </td><td>&nbsp;</td> <td><input type="text" name="wwr_ini_value" value="40"></td>
					
					<td style="padding-left:50px;">Minimum Value:- </td><td>&nbsp;</td> <td><input type="text" name="wwr_min_value" value="20"></td>
					</tr>
					<tr>
					<td>Maximum Value:- </td><td>&nbsp;</td><td><input type="text" name="wwr_max_value" value="80"></td>
					
					<td style="padding-left:50px;">Step Value:- </td><td>&nbsp;</td><td> <input type="text" name="wwr_step_value" value="10"></td>
					</tr>
					</table>
				</div>
				<div id="wwrfixed" style="display:none">
					Value:- <input type="text" name="wwr_value" value="90"><br>
				</div>

				<h3> Overhang Depth :- </h3>
				<input type="radio" name="depth_var_fix" value="variable" onClick="hide('5')" checked>Overhang Depth is variable
				&nbsp;	&nbsp;	&nbsp;	&nbsp;	
				<input type="radio" name="depth_var_fix" value="fixed" onClick="hide('6')">Overhang Depth is fixed<br><br>
				<div id="depthvariable">
					<table>
					<tr>
					<td>Initial Value:- </td><td>&nbsp; </td><td><input type="text" name="depth_ini_value" value="0.5"></td>
					
					<td style="padding-left:50px;">Minimum Value:- </td><td>&nbsp; </td><td><input type="text" name="depth_min_value" value="0.2"></td>
					</tr>
					<tr>
					<td>Maximum Value:- </td><td>&nbsp;</td> <td><input type="text" name="depth_max_value" value="1"></td>
					<td style="padding-left:50px;">Step Value:- </td><td>&nbsp; </td><td><input type="text" name="depth_step_value" value="0.1"></td>
					</tr>
					</table>
				</div>
				<div id="depthfixed" style="display:none">
					Value :- <input type="text" name="depth_value" value="1"><br>
				</div>

				<h3> Window Type :- </h3>
				<input type="checkbox" name="windowtype1" value="window1" checked>U factor: 1.5; SHGC: 0.25; VLT: 0.50
					&nbsp; &nbsp; &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; &nbsp;
					 &nbsp;
				<input type="checkbox" name="windowtype2" value="window2" >U factor: 3.72; SHGC: 0.28; VLT: 0.27<br>
				<input type="checkbox" name="windowtype3" value="window3" >U factor: 1.5; SHGC: 0.20; VLT: 0.35
					&nbsp; &nbsp; &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; &nbsp;
					&nbsp;
				<input type="checkbox" name="windowtype4" value="window4" >U factor: 5.7; SHGC: 0.67; VLT: 0.67<br>
				<br />
				<input type="Submit" value="submit">
			</form>
		</div>
	</body>

</html>
