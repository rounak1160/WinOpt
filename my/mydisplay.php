<?php
session_start();
$var_quantities=$_SESSION['var_quantities'];
?>




<html>
<head>

<title>Window OptimiZation Tool</title>
    <link type="text/css" rel="stylesheet" href="./ex.css">
    <script type="text/javascript" src="./protovis.js"></script><style type="text/css"></style>
    <script type="text/javascript" src="./results250.js"></script>
    <style type="text/css">

#fig {
  width: 880px;
  height: 560px;
}

#title {
  position: absolute;
  top: 70px;
  left: 200px;
  padding: 10px;
  background: white;
}

large {
  font-size: medium;
}

    </style>
  <link rel="stylesheet" type="text/css" href="data:text/css,"></head>
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
<?php
if ($var_quantities[0]=="1"){
	echo "<th>";
	echo "Azimuth Angle";
	echo "</th>";
}
?>


<?php
if ($var_quantities[1]==1){
echo "<th>";
echo" WWR Height ";
echo "</th>";
}
?>


<?php
if ($var_quantities[2]==1){
echo "<th>";
echo" Depth";
echo "</th>";
}
?>


<?php
if ($var_quantities[3]==1){
echo "<th>";
echo" SHGC ";
echo "</th>";
}
?>

</tr>


<?php
$x1=0;
while ($x1 < $count) 
{
	echo "<tr>";

	echo "<td>";
	echo $item1[$x1];
	echo "</td>";


	if($var_quantities[0]=="1")
	{
		echo "<td>";
		echo $item2[$x1] ;
		echo "</td>";
	}


	if($var_quantities[1]=="1")
	{
	echo "<td>";
	 echo $item3[$x1];
	echo "</td>";
	}

	if($var_quantities[2]=="1")
	{
		echo "<td>" ;
		echo $item4[$x1] ;
		echo "</td>";
	}

	if($var_quantities[3]=="1")
	{	
		echo "<td>";	
		echo $item5[$x1] ;
		echo "</td>";

	}
	echo "</tr>";
	 $x1++;
}

$fp1=fopen("./results250.js","w");
if(!$fp1){
	echo "unable to open file";
}

$str="var cars = [
";
//echo "var quantities is ".$var_quantities."<br>";
for($i=0;$i<$count;$i++){
	$model=$i+1;
	$str=$str."{model:$model";
	if($var_quantities[0]=='1'){
		$str=$str.",azimuth:$item2[$i]";
	}
	if($var_quantities[1]=='1'){
		$str=$str.",height:$item3[$i]";
	}
	if($var_quantities[2]=='1'){
		$str=$str.",depth:$item4[$i]";
	}
	if($var_quantities[3]=='1'){
		$str=$str.",shgc:$item5[$i]";
	}
	$str=$str.",energy:$item1[$i]";
	if($i==$count-1){
	$str=$str."}
";
	}
	else{
	$str=$str."},
";
	}
}
$str=$str."];";
fwrite($fp1,$str);
fclose($fp1);
 ?>


</table>
<!-- 
displaying the graph from here.... -->
  <div id="center"><div id="fig">
 <h2>Let's see it graphically :)</h2>
<!-- <small>Filter &amp; explore results by selecting a region and moving the sliders.</small><br><br>
 -->
<span style="display: inline-block;">
</span>

<script type="text/javascript+protovis">

// The units and dimensions to visualize, in order.
<?php
  echo 'var units = {
';

echo 'model: {name: "model", unit: ""},
';

  if($var_quantities[0]=='1'){
  	  echo 'azimuth: {name: "Azimuth", unit: " deg"},
';
  }
  if($var_quantities[1]=='1'){
  	 echo 'height: {name: "height", unit: " m"},
';
  }
  if($var_quantities[2]=='1'){
  	  echo 'depth: {name: "Overhang depth", unit: " m"},
';
  }
  if($var_quantities[3]=='1'){
  	  echo 'shgc: {name: "shgc", unit: ""},
';
  }

echo 'energy: {name: "Energy", unit: ""},
';
echo '}
';
?>


var dims = pv.keys(units);

/* Sizing and scales. */
var w = 1200,
    h = 500,
    fudge = 0.1,
    x = pv.Scale.ordinal(dims).splitFlush(0, w),
    y = pv.dict(dims, function(t) pv.Scale.linear(
        cars.filter(function(d) !isNaN(d[t])),
        function(d) Math.floor(d[t])-fudge,
        function(d) Math.ceil(d[t]) +fudge
        ).range(0, h)),
    c = pv.dict(dims, function(t) pv.Scale.linear(
        cars.filter(function(d) !isNaN(d[t])),
        function(d) Math.floor(d[t])-fudge,
        function(d) Math.ceil(d[t]) +fudge
        ).range("#00FF00", "red"));

/* Interaction state. */
var filter = pv.dict(dims, function(t) {
    return {min: y[t].domain()[0], max: y[t].domain()[1]};
  }), active = "model";

/* The root panel. */
var vis = new pv.Panel()
    .width(w)
    .height(h)
    .left(30)
    .right(30)
    .top(30)
    .bottom(20);

// The parallel coordinates display.
vis.add(pv.Panel)
    .data(cars)
    .visible(function(d) dims.every(function(t)
        (d[t] >= filter[t].min) && (d[t] <= filter[t].max)))
  .add(pv.Line)
    .data(dims)
    .left(function(t, d) x(t))
    .bottom(function(t, d) y[t](d[t]))
    .strokeStyle("#ddd")
    .lineWidth(1)
    .antialias(false);

// Rule per dimension.
rule = vis.add(pv.Rule)
    .data(dims)
    .left(x);

// Dimension label
rule.anchor("top").add(pv.Label)
    .top(-12)
    .font("bold 10px sans-serif")
    .text(function(d) units[d].name);

// The parallel coordinates display.
var change = vis.add(pv.Panel);

var line = change.add(pv.Panel)
    .data(cars)
    .visible(function(d) dims.every(function(t)
        (d[t] >= filter[t].min) && (d[t] <= filter[t].max)))
  .add(pv.Line)
    .data(dims)
    .left(function(t, d) x(t))
    .bottom(function(t, d) y[t](d[t]))
    .strokeStyle(function(t, d) c[active](d[active]))
    .lineWidth(1);

// Updater for slider and resizer.
function update(d) {
  var t = d.dim;
  filter[t].min = Math.max(y[t].domain()[0], y[t].invert(h - d.y - d.dy));
  filter[t].max = Math.min(y[t].domain()[1], y[t].invert(h - d.y));
  active = t;
  change.render();
  return false;
}

// Updater for slider and resizer.
function selectAll(d) {
  if (d.dy < 3) {
    var t = d.dim;
    filter[t].min = Math.max(y[t].domain()[0], y[t].invert(0));
    filter[t].max = Math.min(y[t].domain()[1], y[t].invert(h));
    d.y = 0; d.dy = h;
    active = t;
    change.render();
  }
  return false;
}

/* Handle select and drag */
var handle = change.add(pv.Panel)
    .data(dims.map(function(dim) { return {y:0, dy:h, dim:dim}; }))
    .left(function(t) x(t.dim) - 30)
    .width(60)
    .fillStyle("rgba(0,0,0,.001)")
    .cursor("crosshair")
    .event("mousedown", pv.Behavior.select())
    .event("select", update)
    .event("selectend", selectAll)
  .add(pv.Bar)
    .left(25)
    .top(function(d) d.y)
    .width(10)
    .height(function(d) d.dy)
    .fillStyle(function(t) t.dim == active
        ? c[t.dim]((filter[t.dim].max + filter[t.dim].min) / 2)
        : "hsla(0,0,50%,.5)")
    .strokeStyle("white")
    .cursor("move")
    .event("mousedown", pv.Behavior.drag())
    .event("dragstart", update)
    .event("drag", update);

handle.anchor("bottom").add(pv.Label)
    .textBaseline("top")
    .text(function(d) filter[d.dim].min.toFixed(0) + units[d.dim].unit);

handle.anchor("top").add(pv.Label)
    .textBaseline("bottom")
    .text(function(d) filter[d.dim].max.toFixed(0) + units[d.dim].unit);

vis.render();

 </script>
  </div></div>

</body>
</html>
