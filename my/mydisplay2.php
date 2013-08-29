<?php
session_start();
$var_quantities=$_SESSION['var_quantities'];
?>




<html>
<head>

<title>JSChart</title>

<script type="text/javascript" src="jscharts.js"></script>

</head>
<body>

<?php
$item1=array();
$item2=array();
$item3=array();
$item4=array();
$item5=array();
$count=0;
$file=fopen("OutputListingAll.txt","r");
$flag=0;
while(!feof($file))
{
        $no=0;
        $a= fgets($file);
        //echo " helo $a[0] ";
        $len=strlen($a);
        //      echo "strlen is $len <br>";
        if($len==0 or $len==1)
        {
                continue;
        }
        else
        {
                if($len > 4 and $a[0]=='S' and $a[1]=='i' and $a[2]=='m' and $a[3]=='u' and $a[4]=='l' and $a[5]=='a')
                {
                        $flag=1;
                        continue;
                }
                if($flag==1)
                {
                        $piece = preg_split('/[\s]+/', $a);
                        $item1[$count]=$piece[4];
			$take=11;
			if($var_quantities[0]=="1")
			{
				$item2[$count]=$piece[$take];
				$take=$take+1;
			}
			else
			{
				$item2[$count]=1;
			}

			if($var_quantities[1]=="1")
			{
				$item3[$count]=$piece[$take];
				$take=$take+1;
			}
			else
			{
				$item3[$count]=1;
			}
			if($var_quantities[2]=="1")
			{
				$item4[$count]=$piece[$take];
				$take=$take+1;
			}
			else
			{
				$item4[$count]=1;
			}
			if($var_quantities[3]=="1")
			{
				$item5[$count]=$piece[$take];
				$take=$take+1;
			}
			else
			{
				$item5[$count]=1;
			}
                        $count=$count+1;
              }          
                


        }
}
fclose($file);

$x1=0;
$y1=0;
$temp1;
$temp2;
$temp3;
$temp4;
$temp5;
while($x1 < $count)
{
	$y1=0;
	while($y1 < $x1)
	{
		if($item1[$x1] < $item1[$y1])
		{
			$temp1=$item1[$x1];
			$item1[$x1]=$item1[$y1];
			$item1[$y1]=$temp1;
			

			$temp2=$item2[$x1];
			$item2[$x1]=$item2[$y1];
			$item2[$y1]=$temp2;
			

			$temp3=$item3[$x1];
			$item3[$x1]=$item3[$y1];
			$item3[$y1]=$temp3;
			
			$temp4=$item4[$x1];
			$item4[$x1]=$item4[$y1];
			$item4[$y1]=$temp4;
			
			$temp5=$item5[$x1];
			$item5[$x1]=$item5[$y1];
			$item5[$y1]=$temp5;
			
		}
		$y1=$y1+1;
	}
$x1=$x1+1;

}





?>





<table border="5" style="text-align:center;">
<tr>
<th>
Total Energy </th>
<th >
<?php
if ($var_quantities[0]==1)
echo" Azimuth Angle "
?>
</ th>


<th >
<?php
if ($var_quantities[1]==1)
echo" WWR Height "
?>
</ th>


<th >
<?php
if ($var_quantities[2]==1)
echo" Depth"
?>
</ th>


<th >
<?php
if ($var_quantities[3]==1)
echo" SHGC "
?>
</ th>




<?php
$x1=0;
while ($x1 <= $count) 
{
?>
<tr>
<td> <?php echo $item1[$x1] ?></td>

<td> <?php 

if($var_quantities[0]=="1")
	echo $item2[$x1] ?>
</td>
<td> 
<?php

if($var_quantities[1]=="1")
	 echo $item3[$x1] ?>
</td>
<td> 
<?php

if($var_quantities[2]=="1")
	 echo $item4[$x1] ?>
</td>
<td> 
<?php 

if($var_quantities[3]=="1")
	echo $item5[$x1] ?>
</td>
</tr>
<?php	
   $x1++;
}
?>



</table>




<div id="graph"></div>

<script type="text/javascript">

	var Array1= <?php echo json_encode($item1);?>;
	var Array2= <?php echo json_encode($item2);?>;
	var count= <?php echo json_encode($count);?>;
	
	var myData = new Array();
	for (var i = 0; i < count; i++) {
		  var a = parseFloat(Array1[i]);
		  var b = parseFloat(Array2[i]);
		
  		  myData.push(Array(b,a));
	};
		
//        var myData = new Array(parseFloat([Array1[0]);,parseFloat(Array2[0]]);, parseFloat([Array1[1]);, parseFloat(Array2[1]]);, [1998, 37], [1999, 45], [2000, 50], [2001, 55], [2002, 61], [2003, 61], [2004, 62], [2005, 66], [2006, 73]);

//	alert(myData);
        var myChart = new JSChart('graph', 'line');
        myChart.setDataArray(myData);
        myChart.setTitle('Total Energy');
        myChart.setTitleColor('#8E8E8E');
        myChart.setTitleFontSize(11);
        myChart.setAxisNameX('');
        myChart.setAxisNameY('');
        myChart.setAxisColor('#C4C4C4');
        myChart.setAxisValuesColor('#343434');
        myChart.setAxisPaddingLeft(100);
        myChart.setAxisPaddingRight(120);
        myChart.setAxisPaddingTop(50);
        myChart.setAxisPaddingBottom(40);
        myChart.setAxisValuesNumberX(6);
        myChart.setGraphExtend(true);
        myChart.setGridColor('#c2c2c2');
        myChart.setLineWidth(6);
        myChart.setLineColor('#9F0505');
        myChart.setSize(700, 700);
        myChart.setBackgroundImage('chart_bg.jpg');
//        myChart.draw();
</script>

</body>
</html>
~                                                                                                                                     
~                            
