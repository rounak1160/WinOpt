<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
extract($_GET);

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta name="Kshitij" content="Online Windows Optimization Tool" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="images/style.css" type="text/css" />
	<title>Windows Optimization Tool</title>
	<style type="text/css">
		table{
			font-size:12px;
		}

	
	</style>
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

	<link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font" />


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


	<div id="page" align="center">
		<div id="header">
			<div id="companyname" align="left">Window Selection Tool </div>
			<div align="right" class="links_menu" id="menu"><!--<a href="index.html">Home</a> |--> <a href="main.php">Tool</a> <!--| <a href="glossary.html">Glossary</a> | <a href="docs.html">Documentation</a> -->| <a href="contact.html">Contact Us</a> </div>
		</div>
		<br />
		<div id="content">
			<div id="leftpanel">
<!-- blue chng kiya to grey--><p><a class="btn grey" href="main.php"><i></i><span><i></i><span></span>Calculate your savings</span></a></p>

<!-- yaha comment kiya -->		<!--		<div class="table_top">
					<div align="center"><span class="title_panel">News</span> </div>
				</div>
                                <div class="table_content">
					<div class="table_text">
						<span class="news_date">December, 2012</span> <br />
						<span class="news_text">The Cool Roof Calculator is being upgraded to EnergyPlus 7.1.</span><br />
					</div>
					<div class="table_text">
						<span class="news_date">April, 2012</span> <br />
						<span class="news_text">The Cool Roof Calculator is being upgraded to EnergyPlus 7.0.</span><br />
					</div>
                                        <div class="table_text">
                                                <span class="news_date">December 20, 2010</span> <br />
                                                <span class="news_text">The Cool Roof Calculator has been updated.</span><br />

                                        </div>
                                </div>  -->

	<!--			<div class="table_bottom">
					<img src="images/table_bottom.jpg" width="204" height="23" border="0" alt="" />
				</div>
				<br />
				<div class="table_top">
					<span class="title_panel">External Links</span>
				</div>
                                <div class="table_content">
                                        <div class="table_text" >
                                        <br />
                                                <span class="news_more"><a  target="_BLANK" href="http://www.ornl.gov/sci/roofs+walls/facts/CoolCalcEnergy.htm">DOE Cool Roof Calculator</a></span><br />
                                                <span class="news_more"><a  target="_BLANK" href="http://www.roofcalc.com/">Roof Savings Calculator </a></span><br />
                                                <span class="news_more"><a  target="_BLANK" href="http://heatisland.lbl.gov/">Heat Island Group</a></span><br />
                                                <span class="news_more"><a  target="_BLANK" href="http://coolcolors.lbl.gov/">Cool Colours Project</a></span><br />
<span class="news_more"><a  target="_BLANK" href="http://www.coolroofs.org/">Cool Roof Rating Council</a></span><br />
                                        </div>
                                </div>   -->

				<div class="table_bottom">
					<img src="images/table_bottom.jpg" width="204" height="23" border="0" alt="" />
				</div>
				<br />
			</div>
			<div id="contenttext">
				<br />
				<br />
				<br />
				<?php
				include('configdb.php'); 
				$userid = $_GET[userid];
	if($_GET[error] == "areaoutofrange")
	{
		echo "<span style='color:red; font-size: 12px; font-family: Verdana Sans-serif;'> The Roof Area "
			. "value you entered is out of range. We have assumed it to be 200 m<sup>2</sup> </span><br />";
	}
//	$userid="890162ab-9617-4dcf-8c62-354ebd677080";
	$updatequery = mysql_query("delete from queue where id = $userid");

	$baseidf="./working_directory/$userid/base/model.idf";
	$proposedidf="./working_directory/$userid/proposed/model.idf";
	$proposedidf1="./working_directory/$userid/proposed1/model.idf";
	$proposedidf2="./working_directory/$userid/proposed2/model.idf";
	

	$baseerrors="./working_directory/$userid/base/Output/model.err";
	$proposederrors="./working_directory/$userid/proposed/Output/model.err";
	$proposederrors1="./working_directory/$userid/proposed1/Output/model.err";
	$proposederrors2="./working_directory/$userid/proposed2/Output/model.err";

	$baseTable="./working_directory/$userid/base/Output/modelTable.html";
	$proposedTable="./working_directory/$userid/proposed/Output/modelTable.html";
	$proposedTable1="./working_directory/$userid/proposed1/Output/modelTable.html";
	$proposedTable2="./working_directory/$userid/proposed2/Output/modelTable.html";

	$BTable=fopen($baseTable,"r");
	if (!$BTable) 
	{

		 $to = "kshtjchndrsn@gmail.com";
		 $subject = "Error occured for base table: $userid";
		 $body = "";

		 $headers = "From: Window Optimization server <root@coolroof.cbs.iiit.ac.in>\r\n" .
		     "X-Mailer: php";
		 if (mail($to, $subject, $body, $headers)) {
		   echo("");
		  } else {
		   echo("");
		}

		die("There seems to be some unknown problem with the simulation. Please report this error.\nYou can contact the site admin at coolroof.cbs@gmail.com with the fllowing ID - \nSimulation ID: ".$userid);
	}

	$PTable=fopen($proposedTable,"r") or die("There seems to be some unknown problem with the simulation. Please report this error.");
	$PTable1=fopen($proposedTable1,"r") or die("There seems to be some unknown problem with the simulation1. Please report this error.");
	$PTable2=fopen($proposedTable2,"r") or die("There seems to be some unknown problem with the simulation2. Please report this error.");
//done
	$Bline=fgets($BTable);
	for($i=0;$i<150;$i++)
	$Bline=fgets($BTable);
	//echo "<br><br>".$Bline."<br><br>";
	list($BaseA,$BaseB,$BaseC) = split('[<>]', $Bline);

	$Pline=fgets($PTable);
	for($i=0;$i<150;$i++)
	$Pline=fgets($PTable);
	//echo "<br><br>".$Pline."<br><br>";

	list($PropA,$PropB,$PropC) = split('[<>]', $Pline);


	$Pline1=fgets($PTable1);
	for($i=0;$i<150;$i++)
	$Pline1=fgets($PTable1);
	//echo "<br><br>".$Pline."<br><br>";

	list($Prop1A,$Prop1B,$Prop1C) = split('[<>]', $Pline1);

	$Pline2=fgets($PTable2);
	for($i=0;$i<150;$i++)
	$Pline2=fgets($PTable2);
	//echo "<br><br>".$Pline."<br><br>";

	list($Prop2A,$Prop2B,$Prop2C) = split('[<>]', $Pline2);




	$BCooling = $BaseC*00.277777777777778;
	$PCooling = $PropC*00.277777777777778;
	$PCooling1 = $Prop1C*00.277777777777778;
	$PCooling2 = $Prop2C*00.277777777777778;
	//echo $res2;

	exec("egrep '<td align=\"right\">Heating</td>' $baseTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsBase);
	exec("egrep '<td align=\"right\">Cooling</td>' $baseTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsBase);
	exec("egrep '<td align=\"right\">Interior Lighting</td>' $baseTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsBase);
	exec("egrep '<td align=\"right\">Interior Equipment</td>' $baseTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsBase);
	exec("egrep '<td align=\"right\">Fans</td>' $baseTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsBase);
	exec("egrep '<td align=\"right\">Pumps</td>' $baseTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsBase);
	exec("egrep '<td align=\"right\">Heat Rejection</td>' $baseTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsBase);
	exec("grep 'Time Not Comfortable Based on Simple ASHRAE 55-2004' $baseTable -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsBase);
	exec("egrep '=OccupantComfortDataSummaryMonthly::ZN_1_FLR_1_SEC_5PEOPLE' $baseTable -A 141 | tail -129", $occupantComfortTableBase );

if($hvacsystem != "uc")
{
exec("grep 'Report:<b> EndUseEnergyConsumptionElectricityMonthly' -A 220 $baseTable | grep 'January' -A 194 | grep '[0-9]*\.[0-9]*' | grep -o '[0-9]*\.[0-9]*'", $dataForGraphBase);

for($vari=0;$vari<13;$vari++)
	for($monthi=0;$monthi<12;$monthi++)
		if( $buildingtype == "residentialonlynight" || $buildingtype == "residentialallday" )
			$varArrayBase[$vari][$monthi] = round( $dataForGraphBase[($monthi * 13 ) + $vari] * 200 / $roofarea, 2);
		else
			$varArrayBase[$vari][$monthi] = $dataForGraphBase[($monthi * 13 ) + $vari];
/*
	echo "<pre>";
	print_r($dataForGraphBase);
	echo "</pre>";*/
}

else
{

exec("grep 'PEOPLE AIR TEMPERATURES {FOR HOURS SHOWN}' -A 110 $baseTable | grep 'January' -A 100 | grep '\-\?[0-9]*\.[0-9]*' | grep -o '\-\?[0-9]*\.[0-9]*'", $dataForUnconditionedGraphBase);

//print_r($dataForUnconditionedGraphBase);

for($monthi=0;$monthi<12;$monthi++)
	$peopleAirTemperaturesBase[$monthi] = $dataForUnconditionedGraphBase[$monthi*5 + 1];


exec("grep 'FANGERPMV {FOR HOURS SHOWN}' -A 110 $baseTable | grep 'January' -A 100 | grep '\-\?[0-9]*\.[0-9]*' | grep -o '\-\?[0-9]*\.[0-9]*'", $fangerpmvDataForUnconditionedGraphBase);

for($monthi=0;$monthi<12;$monthi++)
	$fangerpmvBase[$monthi] = $fangerpmvDataForUnconditionedGraphBase[$monthi*5 + 3];

}

if ($buildingtype == "residentialonlynight" || $buildingtype == "residentialallday" )
{
	$heatingBase = round( ($valsBase[0] / 200)* $roofarea , 2);
	$coolingBase = round( ($valsBase[1] / 200)* $roofarea , 2);
	$interiorLightingBase = round( ($valsBase[2] / 200)* $roofarea, 2);
	$interiorEquipmentBase = round( ($valsBase[3] / 200)* $roofarea , 2);
	$fansBase = round( ($valsBase[4] / 200)* $roofarea , 2);
	$pumpsBase =round( ($valsBase[5] / 200)* $roofarea , 2);
	$heatRejectionBase = round( ($valsBase[6] / 200)* $roofarea , 2);
	$totalEnergyBase = round( ( ($valsBase[0] + $valsBase[1] + $valsBase[2] + $valsBase[3]+ $valsBase[4]+ $valsBase[5] + $valsBase[6])/200) * $roofarea , 2 );
}
else
{

	$heatingBase = $valsBase[0];
	$coolingBase = $valsBase[1];
	$interiorLightingBase = $valsBase[2];
	$interiorEquipmentBase = $valsBase[3];
	$fansBase = $valsBase[4];
	$pumpsBase = $valsBase[5];
	$heatRejectionBase = $valsBase[6];
	$totalEnergyBase = $valsBase[0] + $valsBase[1] + $valsBase[2] + $valsBase[3]+ $valsBase[4]+ $valsBase[5] + $valsBase[6];
}

$timeNotComfortableBase = $valsBase[7];

exec("egrep '<td align=\"right\">Heating</td>' $proposedTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed);
exec("egrep '<td align=\"right\">Cooling</td>' $proposedTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed);
exec("egrep '<td align=\"right\">Interior Lighting</td>' $proposedTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed);
exec("egrep '<td align=\"right\">Interior Equipment</td>' $proposedTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed);
exec("egrep '<td align=\"right\">Fans</td>' $proposedTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed);
exec("egrep '<td align=\"right\">Pumps</td>' $proposedTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed);
exec("egrep '<td align=\"right\">Heat Rejection</td>' $proposedTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed);
exec("grep 'Time Not Comfortable Based on Simple ASHRAE 55-2004' $proposedTable -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed);
exec("grep '=OccupantComfortDataSummaryMonthly::ZN_1_FLR_1_SEC_5' $proposedTable -A 141 | tail -129", $occupantComfortTableProposed );

if($hvacsystem != "uc")
{

exec("grep 'Report:<b> EndUseEnergyConsumptionElectricityMonthly' -A 220 $proposedTable | grep 'January' -A 194 | grep '[0-9]*\.[0-9]*' | grep -o '[0-9]*\.[0-9]*'", $dataForGraphProposed);

for($vari=0;$vari<13;$vari++)
	for($monthi=0;$monthi<12;$monthi++)
		
		if( $buildingtype == "residentialonlynight" || $buildingtype == "residentialallday" )
			$varArrayProposed[$vari][$monthi] = round( $dataForGraphProposed[($monthi * 13 ) + $vari] * 200 / $roofarea , 2);
		else
			$varArrayProposed[$vari][$monthi] = $dataForGraphProposed[($monthi * 13 ) + $vari] ;
			
}
else
{
exec("grep 'PEOPLE AIR TEMPERATURES {FOR HOURS SHOWN}' -A 110 $proposedTable | grep 'January' -A 100 | grep  '\-\?[0-9]*\.[0-9]*' | grep -o  '\-\?[0-9]*\.[0-9]*'", $dataForUnconditionedGraphProposed);

for($monthi=0;$monthi<12;$monthi++)
	$peopleAirTemperaturesProposed[$monthi] = $dataForUnconditionedGraphProposed[$monthi*5 + 1];


exec("grep 'FANGERPMV {FOR HOURS SHOWN}' -A 110 $proposedTable | grep 'January' -A 100 | grep '\-\?[0-9]*\.[0-9]*' | grep -o  '\-\?[0-9]*\.[0-9]*'", $fangerpmvDataForUnconditionedGraphProposed);

for($monthi=0;$monthi<12;$monthi++)
	$fangerpmvProposed[$monthi] = $fangerpmvDataForUnconditionedGraphProposed[$monthi*5 + 3];



}


print "<br /><br />";
//exit();



#echo "grep '=OccupantComfortDataSummaryMonthly::ZN_1_FLR_1_SEC_5' $proposedTable -A 141 | tail -137";
#exit;


if ($buildingtype == "residentialonlynight" || $buildingtype == "residentialallday"  )
{
	$heatingProposed = round( ($valsProposed[0] / 200) * $roofarea, 2) ;
	$coolingProposed = round( ($valsProposed[1] / 200) * $roofarea, 2);
	$interiorLightingProposed = round( ($valsProposed[2] / 200) * $roofarea, 2);
	$interiorEquipmentProposed = round( ($valsProposed[3] / 200) * $roofarea, 2) ;
	$fansProposed = round( ($valsProposed[4] / 200) * $roofarea, 2);
	$pumpsProposed = round( ($valsProposed[5] / 200) * $roofarea, 2);
	$heatRejectionProposed = round( ($valsProposed[6] / 200) * $roofarea, 2);
$totalEnergyProposed = round(( ($valsProposed[0] + $valsProposed[1] + $valsProposed[2] + $valsProposed[3]+ $valsProposed[4]+ $valsProposed[5] + $valsProposed[6])/200) * $roofarea , 2);

}
else
{

	$heatingProposed = $valsProposed[0];
	$coolingProposed = $valsProposed[1];
	$interiorLightingProposed = $valsProposed[2];
	$interiorEquipmentProposed = $valsProposed[3];
	$fansProposed = $valsProposed[4];
	$pumpsProposed = $valsProposed[5];
	$heatRejectionProposed = $valsProposed[6];
$totalEnergyProposed = $valsProposed[0] + $valsProposed[1] + $valsProposed[2] + $valsProposed[3]+ $valsProposed[4]+ $valsProposed[5] + $valsProposed[6];
}

$timeNotComfortableProposed = $valsProposed[7];













$coolingEnergySaving = number_format($coolingBase - $coolingProposed,2);
$heatingEnergySaving = number_format($heatingBase - $heatingProposed,2);
$hvacEnergySaving = number_format( $heatingBase + $coolingBase + $fansBase + $pumpsBase + $heatRejectionBase - $heatingProposed - $coolingProposed - $fansProposed - $pumpsProposed - $heatRejectionProposed,2) ;
$totalEnergySaving = number_format($totalEnergyBase - $totalEnergyProposed,2) ;
$totalEnergySaving2 = number_format($totalEnergyBase - $totalEnergyProposed,0) ;

$coolingEnergySavingpersqm = number_format(($coolingBase - $coolingProposed)/$roofarea,2);
$heatingEnergySavingpersqm = number_format(($heatingBase - $heatingProposed)/$roofarea,2);
$totalEnergySavingpersqm   = number_format(($totalEnergyBase - $totalEnergyProposed)/$roofarea,2) ;

$coolingEnergySavingINR = number_format(($coolingBase - $coolingProposed) * $electricityrate,2) ;
$heatingEnergySavingINR = number_format(($heatingBase - $heatingProposed) * $electricityrate,2) ;
$totalEnergySavingINR = number_format(($totalEnergyBase - $totalEnergyProposed) * $electricityrate,2)  ;
$totalEnergySavingINR2 = number_format(($totalEnergyBase - $totalEnergyProposed) * $electricityrate,0)  ;



if($heatingBase == 0)
	$heatingPSaving = 0;
else
	$heatingPSaving = number_format(( (($heatingBase - $heatingProposed)*100) /$heatingBase),2);

if($coolingBase == 0)
	$coolingPSaving = 0;
else
	$coolingPSaving = number_format(( (($coolingBase-$coolingProposed)*100) /$coolingBase),2) ;


if($interiorLightingBase == 0)
	$interiorLightingPSaving = 0;
else

	$interiorLightingPSaving = number_format(( (($interiorLightingBase-$interiorLightingProposed)*100) /$interiorLightingBase),2);

if($interiorEquipmentBase == 0)
	$interiorEquipmentPSaving = 0;
else
	$interiorEquipmentPSaving = number_format(( (($interiorEquipmentBase-$interiorEquipmentProposed)*100) /$interiorEquipmentBase),2);

if($fansBase == 0)
	$fansPSaving = 0;
else
	$fansPSaving = number_format(( (($fansBase-$fansProposed)*100) /$fansBase),2);

if($pumpsBase == 0)
	$pumpsPSaving = 0;
else
	$pumpsPSaving = number_format(( (($pumpsBase-$pumpsProposed)*100) /$pumpsBase),2);

if($heatRejectionBase == 0)
	$heatRejectionPSaving = 0;
else
	$heatRejectionPSaving = number_format(( (($heatRejectionBase-$heatRejectionProposed)*100) /$heatRejectionBase),2);

if($totalEnergyBase == 0)
	$totalEnergyPSaving = 0;
else
	$totalEnergyPSaving = number_format(( (($totalEnergyBase-$totalEnergyProposed)*100) /$totalEnergyBase),2) ;




























exec("egrep '<td align=\"right\">Heating</td>' $proposedTable1 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed1);
exec("egrep '<td align=\"right\">Cooling</td>' $proposedTable1 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed1);
exec("egrep '<td align=\"right\">Interior Lighting</td>' $proposedTable1 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed1);
exec("egrep '<td align=\"right\">Interior Equipment</td>' $proposedTable1 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed1);
exec("egrep '<td align=\"right\">Fans</td>' $proposedTable1 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed1);
exec("egrep '<td align=\"right\">Pumps</td>' $proposedTable1 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed1);
exec("egrep '<td align=\"right\">Heat Rejection</td>' $proposedTable1 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed1);
exec("grep 'Time Not Comfortable Based on Simple ASHRAE 55-2004' $proposedTable1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed1);
exec("grep '=OccupantComfortDataSummaryMonthly::ZN_1_FLR_1_SEC_5' $proposedTable1 -A 141 | tail -129", $occupantComfortTableProposed );

if($hvacsystem != "uc")
{

exec("grep 'Report:<b> EndUseEnergyConsumptionElectricityMonthly' -A 220 $proposedTable1 | grep 'January' -A 194 | grep '[0-9]*\.[0-9]*' | grep -o '[0-9]*\.[0-9]*'", $dataForGraphProposed1);

for($vari=0;$vari<13;$vari++)
        for($monthi=0;$monthi<12;$monthi++)

                if( $buildingtype == "residentialonlynight" || $buildingtype == "residentialallday" )
                        $varArrayProposed1[$vari][$monthi] = round( $dataForGraphProposed1[($monthi * 13 ) + $vari] * 200 / $roofarea , 2);
                else
                        $varArrayProposed1[$vari][$monthi] = $dataForGraphProposed1[($monthi * 13 ) + $vari] ;

}
else
{
exec("grep 'PEOPLE AIR TEMPERATURES {FOR HOURS SHOWN}' -A 110 $proposedTable1 | grep 'January' -A 100 | grep  '\-\?[0-9]*\.[0-9]*' | grep -o  '\-\?[0-9]*\.[0-9]*'", $dataForUnconditionedGraphProposed1);

for($monthi=0;$monthi<12;$monthi++)
        $peopleAirTemperaturesProposed1[$monthi] = $dataForUnconditionedGraphProposed1[$monthi*5 + 1];


exec("grep 'FANGERPMV {FOR HOURS SHOWN}' -A 110 $proposedTable1 | grep 'January' -A 100 | grep '\-\?[0-9]*\.[0-9]*' | grep -o  '\-\?[0-9]*\.[0-9]*'", $fangerpmvDataForUnconditionedGraphProposed1);

for($monthi=0;$monthi<12;$monthi++)
        $fangerpmvProposed1[$monthi] = $fangerpmvDataForUnconditionedGraphProposed1[$monthi*5 + 3];

}
if ($buildingtype == "residentialonlynight" || $buildingtype == "residentialallday"  )
{
        $heatingProposed1 = round( ($valsProposed1[0] / 200) * $roofarea, 2) ;
        $coolingProposed1 = round( ($valsProposed1[1] / 200) * $roofarea, 2);
        $interiorLightingProposed1 = round( ($valsProposed1[2] / 200) * $roofarea, 2);
        $interiorEquipmentProposed1 = round( ($valsProposed1[3] / 200) * $roofarea, 2) ;
        $fansProposed1 = round( ($valsProposed1[4] / 200) * $roofarea, 2);
        $pumpsProposed1 = round( ($valsProposed1[5] / 200) * $roofarea, 2);
        $heatRejectionProposed1 = round( ($valsProposed1[6] / 200) * $roofarea, 2);
$totalEnergyProposed1 = round(( ($valsProposed1[0] + $valsProposed1[1] + $valsProposed1[2] + $valsProposed1[3]+ $valsProposed1[4]+ $valsProposed1[5] + $valsProposed1[6])/200) * $roofarea , 2);

}
else
{

        $heatingProposed1 = $valsProposed1[0];
        $coolingProposed1 = $valsProposed1[1];
        $interiorLightingProposed1 = $valsProposed1[2];
        $interiorEquipmentProposed1 = $valsProposed1[3];
        $fansProposed1 = $valsProposed1[4];
        $pumpsProposed1 = $valsProposed1[5];
        $heatRejectionProposed1 = $valsProposed1[6];
$totalEnergyProposed1 = $valsProposed1[0] + $valsProposed1[1] + $valsProposed1[2] + $valsProposed1[3]+ $valsProposed1[4]+ $valsProposed1[5] + $valsProposed1[6];
}

$timeNotComfortableProposed1 = $valsProposed1[7];

$coolingEnergySaving1 = number_format($coolingBase - $coolingProposed1,2);
$heatingEnergySaving1 = number_format($heatingBase - $heatingProposed1,2);
$hvacEnergySaving1 = number_format( $heatingBase + $coolingBase + $fansBase + $pumpsBase + $heatRejectionBase - $heatingProposed1 - $coolingProposed1 - $fansProposed1 - $pumpsProposed1 - $heatRejectionProposed1,2) ;
$totalEnergySaving1 = number_format($totalEnergyBase - $totalEnergyProposed1,2) ;
$totalEnergySaving21 = number_format($totalEnergyBase - $totalEnergyProposed1,0) ;

$coolingEnergySavingpersqm1 = number_format(($coolingBase - $coolingProposed1)/$roofarea,2);
$heatingEnergySavingpersqm1 = number_format(($heatingBase - $heatingProposed1)/$roofarea,2);
$totalEnergySavingpersqm1   = number_format(($totalEnergyBase - $totalEnergyProposed1)/$roofarea,2) ;

$coolingEnergySavingINR1 = number_format(($coolingBase - $coolingProposed1) * $electricityrate,2) ;
$heatingEnergySavingINR1 = number_format(($heatingBase - $heatingProposed1) * $electricityrate,2) ;
$totalEnergySavingINR1 = number_format(($totalEnergyBase - $totalEnergyProposed1) * $electricityrate,2)  ;
$totalEnergySavingINR21 = number_format(($totalEnergyBase - $totalEnergyProposed1) * $electricityrate,0)  ;





if($heatingBase == 0)
        $heatingPSaving1 = 0;
else
        $heatingPSaving1 = number_format(( (($heatingBase - $heatingProposed1)*100) /$heatingBase),2);

if($coolingBase == 0)
        $coolingPSaving1 = 0;
else
        $coolingPSaving1 = number_format(( (($coolingBase-$coolingProposed1)*100) /$coolingBase),2) ;


if($interiorLightingBase == 0)
        $interiorLightingPSaving1 = 0;
else

        $interiorLightingPSaving1 = number_format(( (($interiorLightingBase-$interiorLightingProposed1)*100) /$interiorLightingBase),2);

if($interiorEquipmentBase == 0)
        $interiorEquipmentPSaving1 = 0;
else
        $interiorEquipmentPSaving1 = number_format(( (($interiorEquipmentBase-$interiorEquipmentProposed1)*100) /$interiorEquipmentBase),2);

if($fansBase == 0)
        $fansPSaving1 = 0;
else
        $fansPSaving1 = number_format(( (($fansBase-$fansProposed1)*100) /$fansBase),2);

if($pumpsBase == 0)
        $pumpsPSaving1 = 0;
else
        $pumpsPSaving1 = number_format(( (($pumpsBase-$pumpsProposed1)*100) /$pumpsBase),2);

if($heatRejectionBase == 0)
        $heatRejectionPSaving1 = 0;
else
        $heatRejectionPSaving1 = number_format(( (($heatRejectionBase-$heatRejectionProposed1)*100) /$heatRejectionBase),2);

if($totalEnergyBase == 0)
        $totalEnergyPSaving1 = 0;
else
        $totalEnergyPSaving1 = number_format(( (($totalEnergyBase-$totalEnergyProposed1)*100) /$totalEnergyBase),2) ;





















exec("egrep '<td align=\"right\">Heating</td>' $proposedTable2 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed2);
exec("egrep '<td align=\"right\">Cooling</td>' $proposedTable2 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed2);
exec("egrep '<td align=\"right\">Interior Lighting</td>' $proposedTable2 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed2);
exec("egrep '<td align=\"right\">Interior Equipment</td>' $proposedTable2 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed2);
exec("egrep '<td align=\"right\">Fans</td>' $proposedTable2 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed2);
exec("egrep '<td align=\"right\">Pumps</td>' $proposedTable2 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed2);
exec("egrep '<td align=\"right\">Heat Rejection</td>' $proposedTable2 -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed2);
exec("grep 'Time Not Comfortable Based on Simple ASHRAE 55-2004' $proposedTable2 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $valsProposed2);
exec("grep '=OccupantComfortDataSummaryMonthly::ZN_1_FLR_1_SEC_5' $proposedTable2 -A 141 | tail -129", $occupantComfortTableProposed );

if($hvacsystem != "uc")
{

exec("grep 'Report:<b> EndUseEnergyConsumptionElectricityMonthly' -A 220 $proposedTable2 | grep 'January' -A 194 | grep '[0-9]*\.[0-9]*' | grep -o '[0-9]*\.[0-9]*'", $dataForGraphProposed2);

for($vari=0;$vari<13;$vari++)
        for($monthi=0;$monthi<12;$monthi++)

                if( $buildingtype == "residentialonlynight" || $buildingtype == "residentialallday" )
                        $varArrayProposed2[$vari][$monthi] = round( $dataForGraphProposed2[($monthi * 13 ) + $vari] * 200 / $roofarea , 2);
                else
                        $varArrayProposed2[$vari][$monthi] = $dataForGraphProposed2[($monthi * 13 ) + $vari] ;

}
else
{
exec("grep 'PEOPLE AIR TEMPERATURES {FOR HOURS SHOWN}' -A 110 $proposedTable2 | grep 'January' -A 100 | grep  '\-\?[0-9]*\.[0-9]*' | grep -o  '\-\?[0-9]*\.[0-9]*'", $dataForUnconditionedGraphProposed2);

for($monthi=0;$monthi<12;$monthi++)
        $peopleAirTemperaturesProposed2[$monthi] = $dataForUnconditionedGraphProposed2[$monthi*5 + 1];


exec("grep 'FANGERPMV {FOR HOURS SHOWN}' -A 110 $proposedTable2 | grep 'January' -A 100 | grep '\-\?[0-9]*\.[0-9]*' | grep -o  '\-\?[0-9]*\.[0-9]*'", $fangerpmvDataForUnconditionedGraphProposed2);





for($monthi=0;$monthi<12;$monthi++)
        $fangerpmvProposed2[$monthi] = $fangerpmvDataForUnconditionedGraphProposed2[$monthi*5 + 3];

}
if ($buildingtype == "residentialonlynight" || $buildingtype == "residentialallday"  )
{
        $heatingProposed2 = round( ($valsProposed2[0] / 200) * $roofarea, 2) ;
        $coolingProposed2 = round( ($valsProposed2[1] / 200) * $roofarea, 2);
        $interiorLightingProposed2 = round( ($valsProposed2[2] / 200) * $roofarea, 2);
        $interiorEquipmentProposed2 = round( ($valsProposed2[3] / 200) * $roofarea, 2) ;
        $fansProposed2 = round( ($valsProposed2[4] / 200) * $roofarea, 2);
        $pumpsProposed2 = round( ($valsProposed2[5] / 200) * $roofarea, 2);
        $heatRejectionProposed2 = round( ($valsProposed2[6] / 200) * $roofarea, 2);
$totalEnergyProposed2 = round(( ($valsProposed2[0] + $valsProposed2[1] + $valsProposed2[2] + $valsProposed2[3]+ $valsProposed2[4]+ $valsProposed2[5] + $valsProposed2[6])/200) * $roofarea , 2);

}
else
{

        $heatingProposed2 = $valsProposed2[0];
        $coolingProposed2 = $valsProposed2[1];
        $interiorLightingProposed2 = $valsProposed2[2];
        $interiorEquipmentProposed2 = $valsProposed2[3];
        $fansProposed2 = $valsProposed2[4];
        $pumpsProposed2 = $valsProposed2[5];
        $heatRejectionProposed2 = $valsProposed2[6];
$totalEnergyProposed2 = $valsProposed2[0] + $valsProposed2[1] + $valsProposed2[2] + $valsProposed2[3]+ $valsProposed2[4]+ $valsProposed2[5] + $valsProposed2[6];
}

$timeNotComfortableProposed2 = $valsProposed2[7];

$coolingEnergySaving2 = number_format($coolingBase - $coolingProposed2,2);
$heatingEnergySaving2 = number_format($heatingBase - $heatingProposed2,2);
$hvacEnergySaving2 = number_format( $heatingBase + $coolingBase + $fansBase + $pumpsBase + $heatRejectionBase - $heatingProposed2 - $coolingProposed2 - $fansProposed2 - $pumpsProposed2 - $heatRejectionProposed2,2) ;
$totalEnergySaving2 = number_format($totalEnergyBase - $totalEnergyProposed2,2) ;
$totalEnergySaving22 = number_format($totalEnergyBase - $totalEnergyProposed2,0) ;

$coolingEnergySavingpersqm2 = number_format(($coolingBase - $coolingProposed2)/$roofarea,2);
$heatingEnergySavingpersqm2 = number_format(($heatingBase - $heatingProposed2)/$roofarea,2);
$totalEnergySavingpersqm2   = number_format(($totalEnergyBase - $totalEnergyProposed2)/$roofarea,2) ;


$coolingEnergySavingINR2 = number_format(($coolingBase - $coolingProposed2) * $electricityrate,2) ;
$heatingEnergySavingINR2 = number_format(($heatingBase - $heatingProposed2) * $electricityrate,2) ;
$totalEnergySavingINR23 = number_format(($totalEnergyBase - $totalEnergyProposed2) * $electricityrate,2)  ;
$totalEnergySavingINR22 = number_format(($totalEnergyBase - $totalEnergyProposed2) * $electricityrate,0)  ;





if($heatingBase == 0)
        $heatingPSaving2 = 0;
else
        $heatingPSaving2 = number_format(( (($heatingBase - $heatingProposed2)*100) /$heatingBase),2);

if($coolingBase == 0)
        $coolingPSaving2 = 0;
else
        $coolingPSaving2 = number_format(( (($coolingBase-$coolingProposed2)*100) /$coolingBase),2) ;


if($interiorLightingBase == 0)
        $interiorLightingPSaving2 = 0;
else

        $interiorLightingPSaving2 = number_format(( (($interiorLightingBase-$interiorLightingProposed2)*100) /$interiorLightingBase),2);

if($interiorEquipmentBase == 0)
        $interiorEquipmentPSaving2 = 0;
else
        $interiorEquipmentPSaving2 = number_format(( (($interiorEquipmentBase-$interiorEquipmentProposed2)*100) /$interiorEquipmentBase),2);

if($fansBase == 0)
        $fansPSaving2 = 0;
else
        $fansPSaving2 = number_format(( (($fansBase-$fansProposed2)*100) /$fansBase),2);

if($pumpsBase == 0)
        $pumpsPSaving2 = 0;
else
 $pumpsPSaving2 = number_format(( (($pumpsBase-$pumpsProposed2)*100) /$pumpsBase),2);

if($heatRejectionBase == 0)
        $heatRejectionPSaving2 = 0;
else
        $heatRejectionPSaving2 = number_format(( (($heatRejectionBase-$heatRejectionProposed2)*100) /$heatRejectionBase),2);

if($totalEnergyBase == 0)
        $totalEnergyPSaving2 = 0;
else
        $totalEnergyPSaving2 = number_format(( (($totalEnergyBase-$totalEnergyProposed2)*100) /$totalEnergyBase),2) ;








$payback1= number_format($totalEnergySavingINR2/$CPW1);
$payback2= number_format($totalEnergySavingINR21/$CPW2);
$payback3= number_format($totalEnergySavingINR22/$CPW3);



















if($hvacsystem == "uc")
{
/*	echo "

	<table border='1' cellspacing='0' cellpadding='4'>
	  <tbody>
	  <tr>
	    <td></td>
	    <td style='height: 50px;'>Normal roof</td>
	    <td style='height: 50px;'>Cool roof</td>


	  </tr> 
	  <tr>
	    <td align='right'>Time Not Comfortable Based on Simple ASHRAE 55-2004</td>
	    <td align='right'>$timeNotComfortableBase </td>
	    <td align='right'>$timeNotComfortableProposed </td>
	  </tr>

	</tbody></table>";
*/
	echo "<div style='text-align:left'>Normal roof:</div>";
	$occupantComfortTableBase = preg_replace("/([0-9]*)\.([0-9]{2})([0-9]*)/", "$1.$2", $occupantComfortTableBase);

	echo '<table border="1" cellpadding="4" cellspacing="0">
	  <tr><td></td>
	    <td align="right">Occupied hours [Hours]</td>
	    <td align="right">Air temperature for occupied hours [C]</td>
	    <td align="right">Relative Humidity for occupied hours [%]</td>
	    <td align="right">FangerPMV for occupied hours</td>
	    <td align="right">FangerPPD for occupied hours</td>
	  </tr>';

	for($i1=0;$i1<count($occupantComfortTableBase);$i1++)
		echo $occupantComfortTableBase[$i1];

	print "<br/> <br />";
	echo "<div style='text-align:left'>Cool roof:</div>";
	$occupantComfortTableProposed = preg_replace("/([0-9]*)\.([0-9]{2})([0-9]*)/", "$1.$2", $occupantComfortTableProposed);


	echo '<table border="1" cellpadding="4" cellspacing="0">
	  <tr><td></td>
	    <td align="right">Occupied hours [Hours]</td>
	    <td align="right">Air temperature for occupied hours [C]</td>
	    <td align="right">Relative Humidity for occupied hours [%]</td>
	    <td align="right">FangerPMV for occupied hours</td>
	    <td align="right">FangerPPD for occupied hours</td>
	  </tr>';



	for($i2=0;$i2<count($occupantComfortTableProposed);$i2++)
		echo $occupantComfortTableProposed[$i2];

	print "<br/> <br />";

}

else
{


/*echo "The annual savings achieved due to cool roof specified by you as compared to normal roof, specified by you is <b>" . $totalEnergySaving2 .
 	" kWh</b>, which results in an annual savings of <span class='WebRupee'>Rs.</span> <b> " . $totalEnergySavingINR2 .
	"</b> <br /> <br /> <br />";*/
/*echo "The annual savings achieved due to cool roof (Reflectivity $proposedcaser, Emmissivity $proposedcasee) as compared to normal roof (Reflectivity $basecaser, Emissivity $basecasee) specified by you is <b> $totalEnergySaving2 kWh </b>, which results in an annual savings of <b> Rs. $totalEnergySavingINR2</b> <br /> <br /> <br />";

	echo"
	<table border='1' cellspacing='0' cellpadding='4'>
	  <tbody>
	  <tr>
	    <td></td>
	    <td style='height:50px;'>Total savings<br /> (kWh/year)</td>
	    <td>Savings per unit area<br /> (kWh/m<sup>2</sup> per annum)</td>
	    <td>Saving in cost<br /> (INR/year)</td>

	  </tr> 
	  <tr>
	    <td align='right'>Savings in cooling</td>
	    <td align='right'>$coolingEnergySaving</td>
	    <td align='right'>$coolingEnergySavingpersqm</td>
	    <td align='right'> <span class='WebRupee'>Rs.</span> $coolingEnergySavingINR</td>
	  </tr>
	  <tr>
	    <td align='right'>Savings in heating</td>
	    <td align='right'>$heatingEnergySaving</td>
	    <td align='right'>$heatingEnergySavingpersqm</td>
	    <td align='right'><span class='WebRupee'>Rs.</span> $heatingEnergySavingINR</td>
	  </tr>
	  <tr>
	    <td align='right'>Overall savings</td>
	    <td align='right'>$totalEnergySaving</td>
	    <td align='right'>$totalEnergySavingpersqm</td>
	    <td align='right'><span class='WebRupee'>Rs.</span> $totalEnergySavingINR</td>
	  </tr>
	  <tr>
	    <td align='left' colspan='4'>Note: Negative value means loss</td>
	  </tr>
	</tbody></table>*/
	echo"
	<br/>

	<br />
	<table border='1' cellspacing='0' cellpadding='4'>
	  <tbody>
	    <tr>
		<td rowspan='2'>EndUseCategory</td>
		<td align='center' colspan='4'>Electricity [kWh]</td>
	    </tr>
	    <tr>
		<td align='center' width='70'>Base Window</td>
		<td align='right' width='70'>Window 1</td>
		<td align='right' width='70'>Window 2</td>
		<td align='right' width='70'>Window 3</td>

	    </tr>
	 
	  <tr>
	    <td align='right'>Heating</td>
	    <td align='right'>$heatingBase </td>
	    <td align='right'>$heatingProposed</td>
	    <td align='right'>$heatingProposed1</td>
	    <td align='right'>$heatingProposed2</td>
	  </tr>
	  <tr>
	    <td align='right'>Cooling</td>
	    <td align='right'>$coolingBase</td>
	    <td align='right'>$coolingProposed</td>
	    <td align='right'>$coolingProposed1</td>
	    <td align='right'>$coolingProposed2</td>
	  </tr>
	  <tr>
	    <td align='right'>Interior Lighting</td>
	    <td align='right'>$interiorLightingBase</td>
	    <td align='right'>$interiorLightingProposed</td>
	    <td align='right'>$interiorLightingProposed1</td>
	    <td align='right'>$interiorLightingProposed2</td>
	  </tr>
	  <tr>
	    <td align='right'>Interior Equipment</td>
	    <td align='right'>$interiorEquipmentBase</td>
	    <td align='right'>$interiorEquipmentProposed</td>
	    <td align='right'>$interiorEquipmentProposed1</td>
	    <td align='right'>$interiorEquipmentProposed2</td>
	  </tr>
	  <tr>
	    <td align='right'>Fans</td>
	    <td align='right'>$fansBase</td>
	    <td align='right'>$fansProposed</td>
	    <td align='right'>$fansProposed1</td>
	    <td align='right'>$fansProposed2</td>
	  </tr>
	  <tr>
	    <td align='right'>Pumps</td>
	    <td align='right'>$pumpsBase</td>
	    <td align='right'>$pumpsProposed</td>
	    <td align='right'>$pumpsProposed1</td>
	    <td align='right'>$pumpsProposed2</td>
	  </tr>
	  <tr>
	    <td align='right'>Heat Rejection</td>
	    <td align='right'>$heatRejectionBase</td>
	    <td align='right'>$heatRejectionProposed</td>
	    <td align='right'>$heatRejectionProposed1</td>
	    <td align='right'>$heatRejectionProposed2</td>
	  </tr>

	  <tr>
	    <td align='right'>Total</td>
	    <td align='right'>$totalEnergyBase    </td>
	    <td align='right'>$totalEnergyProposed    </td>
	    <td align='right'>$totalEnergyProposed1    </td>
	    <td align='right'>$totalEnergyProposed2    </td>
	  </tr>
	  <tr>
	    <td align='right'>Total Energy Saving</td>
	    <td align='right'>0    </td>
	    <td align='right'>$totalEnergySaving     </td>
	    <td align='right'>$totalEnergySaving1    </td>
	    <td align='right'>$totalEnergySaving2    </td>
	  </tr>
	  <tr>
	    <td align='right'>Total Saving in INR</td>
	    <td align='right'>0    </td>
	    <td align='right'>$totalEnergySavingINR2     </td>
	    <td align='right'>$totalEnergySavingINR21    </td>
	    <td align='right'>$totalEnergySavingINR22    </td>
	  </tr>
	  <tr>
	    <td align='right'>Total % Saving</td>
	    <td align='right'>0    </td>
	    <td align='right'>$totalEnergyPSaving     </td>
	    <td align='right'>$totalEnergyPSaving1    </td>
	    <td align='right'>$totalEnergyPSaving2    </td>
	  </tr>
	  <tr>
	    <td align='right'>Payback</td>
	    <td align='right'>0    </td>
	    <td align='right'>$payback1     </td>
	    <td align='right'>$payback2   </td>
	    <td align='right'>$payback3   </td>
	  </tr>
	</tbody></table>
	"; 
}


/******************************************Additional Checkpoints - KRONOS **************************************/
if($hvacsystem != "uc"){//EPI and Unmet Hours check only for conditioned buildings.
	exec("egrep 'Time Setpoint Not Met During Occupied Heating' $baseTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $checkPointsTable);
        exec("egrep 'Time Setpoint Not Met During Occupied Cooling' $baseTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $checkPointsTable);

        exec("egrep 'Time Setpoint Not Met During Occupied Heating' $proposedTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $checkPointsTable);
        exec("egrep 'Time Setpoint Not Met During Occupied Cooling' $proposedTable -m 1 -A 1 | tail -1| egrep -o [0-9]+.[0-9]+", $checkPointsTable);

        exec("egrep 'Utility Use Per Total Floor Area' $baseTable -m 1 -A 39 | tail -1| egrep -o [0-9]+.[0-9]+", $checkPointsTable);
        exec("egrep 'Utility Use Per Total Floor Area' $proposedTable -m 1 -A 39 | tail -1| egrep -o [0-9]+.[0-9]+", $checkPointsTable);

        $diff_heating = abs($checkPointsTable[0] - $checkPointsTable[2]);
        $diff_cooling = abs($checkPointsTable[1] - $checkPointsTable[3]);

        echo "<br />";

        $flag_wrong = 0;
#	print_r($checkPointsTable);
        if($checkPointsTable[0] > 300){
                echo "Time Setpoint Not Met During Occupied Heating for the base model is greater than 300 hours.";
        echo "<br />";
                $flag_wrong = 1;
        }
        if($checkPointsTable[1] > 300){
                echo "Time Setpoint Not Met During Occupied Cooling for the base model is greater than 300 hours.";
        echo "<br />";
                $flag_wrong = 1;
        }
        if($checkPointsTable[2] > 300){
                echo "Time Setpoint Not Met During Occupied Heating for the proposed model is greater than 300 hours.";
        echo "<br />";
                $flag_wrong = 1;
        }
        if($checkPointsTable[3] > 300){
                echo "Time Setpoint Not Met During Occupied Cooling for the proposed model is greater than 300 hours.";
        echo "<br />";
                $flag_wrong = 1;
        }
 
 
        if($checkPointsTable[4] < 80 || $checkPointsTable[4] > 300){
                echo "The energy performance index (EPI) for the base model does not lie between recommended values.";
        echo "<br />";
                $flag_wrong = 1;
        }
        if($checkPointsTable[5] < 80 || $checkPointsTable[5] > 300){
                echo "The energy performance index (EPI) for the proposed model does not lie between recommened values.";
        echo "<br />";
                $flag_wrong = 1;
        }
	
        if($diff_heating > 100){
                echo "The difference between the unmet heating hours of the base and proposed case is more than the advised values.";
                $flag_wrong = 1;
        echo "<br />";
        }

        if($diff_cooling > 100){
                echo "The difference between the unmet cooling hours of the base and proposed case is more than the advised values.";
                $flag_wrong = 1;
        echo "<br />";
        }
	if($flag_wrong == 1){
		echo("If you wish to know what went wrong, click <a href=\"error_followup.php?userid=$userid\" target=\"_blank\">here</a>");
	}
 }
 
/******************************************Additional Checkpoints End- KRONOS **************************************/

/****************************************** Graphs ***********************************/

if($hvacsystem != "uc")
{

// Graph for cooling
$coolingMax = max(max($varArrayBase[7]), max($varArrayProposed[7]),max($varArrayProposed1[7]),max($varArrayProposed2[7]));

if($coolingMax == 0 )
{
	$coolingMax = 1400;
}

echo '<br /> <br /> <img width="550px" src="http://chart.apis.google.com/chart?chxl=0:|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec&chxp=0,0,100,200,300,400,500,600,700,800,900,1000,1100&chxr=0,0,1100|1,0,';
echo $coolingMax;
echo '|2,0,';
echo $coolingMax;
echo '&chxs=0,555555,14,0,l,676767|1,676767,10.5,-0.5,l,676767&chxt=x,y,r&chs=660x210&cht=lc&chco=B3B3E5,2828D3,B328E3,FF0000&chds=0,';
echo $coolingMax;
echo ',0,';
echo $coolingMax;
echo '&chd=t:';

for($monthi=0;$monthi<11;$monthi++)
	print $varArrayBase[7][$monthi] . ",";

print $varArrayBase[7][11];


echo '|';

for($monthi=0;$monthi<11;$monthi++)
	print $varArrayProposed[7][$monthi] . ",";
print $varArrayProposed[7][11];

echo '|';

for($monthi=0;$monthi<11;$monthi++)
	print $varArrayProposed1[7][$monthi] . ",";
print $varArrayProposed1[7][11];
echo '|';

for($monthi=0;$monthi<11;$monthi++)
	print $varArrayProposed2[7][$monthi] . ",";
print $varArrayProposed2[7][11];

echo '&chdl=Base+Window|Window+1|Window+2|Window+3&chdlp=b&chls=3|3&chtt=Monthly+Cooling+Electricity+consumption+(kWh)" /> ';
//&chg=9.1,16.8

// Graph for heating
$heatingMax = max(max($varArrayBase[6]), max($varArrayProposed[6]),max($varArrayProposed1[6]),max($varArrayProposed2[6]));

if($heatingMax == 0 )
{
	$heatingMax = 1400;
}
/*
print "<br />Base:<br />";
for($monthi=0;$monthi<11;$monthi++)
	print $varArrayBase[7][$monthi] . ",";
print "<br />Proposed:<br />";
for($monthi=0;$monthi<11;$monthi++)
	print $varArrayProposed[7][$monthi] . ",";
*/
//echo "#####$heatingMax########";
echo '<br /> <br /> <br /> <img width="550px" src="http://chart.apis.google.com/chart?chxl=0:|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec&chxp=0,0,100,200,300,400,500,600,700,800,900,1000,1100&chxr=0,0,1100|1,0,'.$heatingMax.'|2,0,'.$heatingMax.'&chxs=0,555555,14,0,l,676767|1,676767,10.5,-0.5,l,676767&chxt=x,y,r&chs=660x210&cht=lc&chco=B3B3E5,2828D3,B328E3,FF0000&chds=0,'.$heatingMax.',0,'.$heatingMax.'&chd=t:';
//85A8ED,0000FF
for($monthi=0;$monthi<11;$monthi++)
	print $varArrayBase[6][$monthi] . ",";

print $varArrayBase[6][11];


echo '|';

for($monthi=0;$monthi<11;$monthi++)
	print $varArrayProposed[6][$monthi] . ",";

print $varArrayProposed[6][11];
echo '|';

for($monthi=0;$monthi<11;$monthi++)
	print $varArrayProposed1[6][$monthi] . ",";

print $varArrayProposed1[6][11];
echo '|';

for($monthi=0;$monthi<11;$monthi++)
	print $varArrayProposed2[6][$monthi] . ",";

print $varArrayProposed2[6][11];

echo '&chdl=Base+Window|Window+1| Window+2|Window+3&chdlp=b&chls=3|3&chtt=Monthly+Heating+Electricity+consumption+(kWh)" /> ';

/*
print "<br />Base:<br />";
for($monthi=0;$monthi<11;$monthi++)
	print $varArrayBase[6][$monthi] . ",";
print "<br />Proposed:<br />";
for($monthi=0;$monthi<11;$monthi++)
	print $varArrayProposed[6][$monthi] . ",";
*/

/*
// Graph for total energy consumption

for($vari=0;$vari<13;$vari++)
{
	$varArrayBaseSum[$vari] = 0;
	for($monthi=0;$monthi<12;$monthi++)
		$varArrayBaseSum[$vari] += $varArrayBase[$vari][$monthi] ;
}

for($vari=0;$vari<13;$vari++)
{
	$varArrayProposedSum[$vari] = 0;
	for($monthi=0;$monthi<12;$monthi++)
		$varArrayProposedSum[$vari] += $varArrayProposed[$vari][$monthi] ;
}

echo '<br /> <br /> <img width="550px" src="http://chart.apis.google.com/chart?chxl=0:|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec&chxp=0,0,100,200,300,400,500,600,700,800,900,1000,1100&chxr=0,0,1100|1,0,5972.131|2,0,5972.131&chxs=0,00AA00,14,0,l,676767|1,676767,10.5,-0.5,l,676767&chxt=x,y,r&chs=660x210&cht=lc&chco=85A8ED,0000FF&chds=0,5972.131,0,5972.131&chd=t:';

for($monthi=0;$monthi<11;$monthi++)
	print $varArrayBaseSum[$monthi] . ",";

print $varArrayBaseSum[11];


echo '|';

for($monthi=0;$monthi<11;$monthi++)
	print $varArrayProposedSum[$monthi] . ",";

print $varArrayProposedSum[11];

echo '&chdl=Base+case|Proposed+case&chdlp=b&chg=9.1,16.8&chls=2|1&chtt=Monthly+Energy+Consumption:" /> ';

//echo '<img src="http://chart.apis.google.com/chart?chxl=0:|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec&chxp=0,0,100,200,300,400,500,600,700,800,900,1000,1100&chxr=0,0,1100|1,0,2972.131|2,0,2972.131&chxs=0,00AA00,14,0,l,676767|1,676767,10.5,-0.5,l,676767&chxt=x,y,r&chs=660x210&cht=lc&chco=85A8ED,0000FF&chds=0,2972.131,0,1535.02&chd=t:392.94,490.26,881.38,1087.41,1535.02,1375.35,1077.31,1096.05,1068.1,1046.12,744.24,405.15|292.94,290.26,381.38,87.41,735.02,275.35,577.31,796.05,1068.1,246.12,444.24,205.15&chdl=Base+case|Proposed+case&chdlp=b&chg=9.1,25&chls=2|1" />';



for($monthi=0;$monthi<11;$monthi++)
	print $varArrayBaseSum[$monthi] . ",";

print $varArrayBaseSum[11];


echo '<br />';

for($monthi=0;$monthi<11;$monthi++)
	print $varArrayProposedSum[$monthi] . ",";

print $varArrayProposedSum[11];
*/
}

else
{

//print_r($peopleAirTemperaturesBase);

// People Air temperature
echo '<br /> <br /> <img width="550px" src="http://chart.apis.google.com/chart?chxl=0:|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec&chxp=0,0,100,200,300,400,500,600,700,800,900,1000,1100&chxr=0,0,1100|1,0,50|2,0,50&chxs=0,555555,14,0,l,676767|1,676767,10.5,-0.5,l,676767&chxt=x,y,r&chs=660x210&cht=lc&chco=5BD45B,055B05,FF0000,00FFFF&chds=0,50,0,50&chd=t:';

for($monthi=0;$monthi<11;$monthi++)
	echo $peopleAirTemperaturesBase[$monthi] . ",";

print $peopleAirTemperaturesBase[11];


echo '|';

for($monthi=0;$monthi<11;$monthi++)
	echo $peopleAirTemperaturesProposed[$monthi] . ",";

echo $peopleAirTemperaturesProposed[11];
echo '|';

for($monthi=0;$monthi<11;$monthi++)
	echo $peopleAirTemperaturesProposed1[$monthi] . ",";

echo $peopleAirTemperaturesProposed1[11];
echo '|';

for($monthi=0;$monthi<11;$monthi++)
	echo $peopleAirTemperaturesProposed2[$monthi] . ",";

echo $peopleAirTemperaturesProposed2[11];

echo '&chdl=Base+Window|Window+1|Window+2|Window+3&chdlp=b&chls=3|3&chtt=Monthly+Indoor+Air+Temperatures+(deg. C)" /> ';
//&chg=9.1,20
//print "People Air Temperatures:<br />";
/*
print "Base:";
for($monthi=0;$monthi<11;$monthi++)
	echo $peopleAirTemperaturesBase[$monthi] . "&#09;";

print "<br />Proposed:";
for($monthi=0;$monthi<11;$monthi++)
	echo $peopleAirTemperaturesProposed[$monthi] . "&#09;";
*/


// Fanger PMV
$fangerpmvMax =max(max($fangerpmvBase), max($fangerpmvProposed),max($fangerpmvProposed1),max($fangerproposed2));
$fangerpmvMin =min(min($fangerpmvBase), min($fangerpmvProposed),min($fangerpmvProposed1),min($fangerpmvProposed2));

if( $fangerpmvMin > 0 )
	$fangerpmvMin = 0;


echo '<br /><br /> <br /> <img width="550px" src="http://chart.apis.google.com/chart?chxl=0:|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec&chxp=0,0,100,200,300,400,500,600,700,800,900,1000,1100&chxr=0,0,1100|1,'.$fangerpmvMin.','.$fangerpmvMax.'|2,'.$fangerpmvMin.','.$fangerpmvMax.'&chxs=0,555555,14,0,l,676767|1,676767,10.5,-0.5,l,676767&chxt=x,y,r&chs=660x210&cht=lc&chco=5BD45B,055B05,FF0000,00FFFF&chds='.$fangerpmvMin.','.$fangerpmvMax.','.$fangerpmvMin.','.$fangerpmvMax.'&chd=t:';

for($monthi=0;$monthi<11;$monthi++)
	echo $fangerpmvBase[$monthi] . ",";

print $fangerpmvBase[11];


echo '|';

for($monthi=0;$monthi<11;$monthi++)
	echo $fangerpmvProposed[$monthi] . ",";

echo $fangerpmvProposed[11];
echo '|';

for($monthi=0;$monthi<11;$monthi++)
	echo $fangerpmvProposed1[$monthi] . ",";

echo $fangerpmvProposed1[11];
echo '|';

for($monthi=0;$monthi<11;$monthi++)
	echo $fangerpmvProposed2[$monthi] . ",";

echo $fangerpmvProposed2[11];

echo '&chdl=Base+Window|Window+1|Window+2|Window+3&chdlp=b&chls=3|3&chtt=Monthly+Fanger+Predicted+Mean+Vote" /> ';
//&chg=9.1,20

//print "PMV:<br />";
/*
print "Base:";
for($monthi=0;$monthi<11;$monthi++)
	echo $fangerpmvBase[$monthi] . "&#09;";

print "<br />Proposed:";
for($monthi=0;$monthi<11;$monthi++)
	echo $fangerpmvProposed[$monthi] . "&#09;";
*/




}
/*************************************************************************************/

/******************************************** Payback calculation ***********************************************************/

function gcm($a, $b) 
{
	return ( $b == 0 ) ? ($a):( gcm($b, $a % $b) );
}

function lcm($a, $b) 
{
	return ( $a / gcm($a,$b) ) * $b;
}

#print "basecasel: ". $basecasel;
#print "basecasec: ". $basecasec;

#print "proposedcasel: ". $proposedcasel;
#print "proposedcasec: ". $proposedcasec;

#exit();
if($form == "detailed" && $hvacsystem != "uc")
{
#	echo "Payback: base case life: $basecasel, proposed case life: $proposedcasel, base case cost: $basecasec, proposed case cost: $proposedcasec<br>";
	$lcm = lcm($basecasel, $proposedcasel);
/*	$extraCostMaterial = (($lcm/$proposedcasel) * $proposedcasec) - (($lcm/$basecasel) * $basecasec); //extra cost for 10 yrs
	$engSavings =  $lcm * ($totalEnergyBase- $totalEnergyProposed)/$roofarea;  // energy savings for lcm years per square meter
	$costSaved = $engSavings * $electricityrate;				   // Cost saved during lcm years

	if( $costSaved >= $extraCostMaterial )
		$payback = ($lcm/$costSaved) * $extraCostMaterial;         //$extraCostMaterial/$costSaved;
	else 
		$payback = "No Payback";
*/
	$extraCostMaterial = $proposedcasec - ceil($proposedcasel/$basecasel)*$basecasec;
	$engSavings = number_format($totalEnergySavingpersqm*$electricityrate,2);
	$pb = number_format($extraCostMaterial/$engSavings,2);
	
	echo "<div style='font-size:12px'>";
	$costSaved = round($costSaved, 2);
	echo "<br />In $lcm years duration the extra cost of material for cool roof is <b>Rs. " . round($extraCostMaterial, 2) . " </b>per square meter and the electricity savings are " . round($totalEnergySavingpersqm,2) . " kWh/m<sup>2</sup>/Year (i.e. Rs. $engSavings)";

	if(is_numeric($pb)) 
		echo "<br /><br />Simple payback is: ". $pb." years."; 
	
	if( is_numeric($payback) && ($payback <= 0) )
		echo " (means immediate payback)";

	echo "</div>";

}

/****************************************************************************************************************************/



/*

			       echo "<table align=\"center\" style=\"border:1px; border-collapse:collapse;color:#330099;font:normal 12px verdana, arial, helvetica, sans-serif;\">";
				echo "<caption style=\"background:#9933FF;color:#FFFFFF; text-align:center; text-transform:uppercase;\">   RESULT</th>";
				echo "<tr style=\"border:6px; background:#D3E4E5;\"><td>Purchase Cooling for User specified value:</td><td><b>".number_format($PCooling,7)."  MWh</b></td></tr>";
				echo "<tr style=\"border:6px; background:#33FFFF;\"><td>Purchase Cooling for base value : </td><td><b>".number_format($BCooling,7)."  MWh</b></td></tr>";
				echo "<tr style=\"border:6px; background:#D3E4E5;\"><td>Percentage Change:</td><td><b>". abs(number_format(( (($BCooling-$PCooling)*100) /$BCooling),2)). "%</b></td></tr></table>";
				echo "<br><br> To Save the file, right click and choose 'save link as' option:"; 
				echo "<br><a href=$proposedidf class=\"acl\" target=_BLANK>View Cool Roof IDF</a>";

				echo "<br><a href=$proposederrors class=\"acl\" target=_BLANK>View Errors</a>";

				echo "<br><br><a href=$baseidf class=\"acl\" target=_BLANK>View Base IDF</a>";

				echo "<br><a href=$baseerrors class=\"acl\" target=_BLANK>View Base Errors</a>";
*/
				?>
				<br />
				<br />
				<br />
				<br />
				<br />
				<br />
				<div style="border: 1px dashed black;">
				Disclaimer<br>
				<ul>
				<li>Results are based upon information provided by user. The online energy analysis produces estimates and projections only. The actual results may vary from these estimates and projections. The main purpose of this calculator is to compare the performance of cool roof with grey roof, there are several assumptions have been made in simulation model which might not be accurately matching with the actual building with regards to occupancy, equipments, zoning , setpoint temperature etc. The actual results may vary from these estimates and projections.</li>
				<li>Analyses have been done on top one floor only.</li>
				</ul>
				</div>
				<br />
				<br />
				<!-- Start of StatCounter Code -->
				<script type="text/javascript">
				var sc_project=6026997; 
				var sc_invisible=1; 
				var sc_security="569cc18b"; 
				</script>

				<script type="text/javascript"
				src="http://www.statcounter.com/counter/counter.js"></script><noscript><div
				class="statcounter"><a title="counter for tumblr"
				href="http://www.statcounter.com/tumblr/"
				target="_blank"><img class="statcounter"
				src="http://c.statcounter.com/6026997/0/569cc18b/1/"
				alt="counter for tumblr" ></a></div></noscript>
				<!-- End of StatCounter Code -->
				</p>
			</div>
			<br />
			<br />
			<div class="footer">
				<br />
				<!--<a href="index.html">Home</a> |--> <a href="main.php">Tool</a> | <a href="contact.html">Contact Us</a> | CBS, IIIT-Hyderabad. 
			</div>
		</div>
	</div>
</body>
</html>
