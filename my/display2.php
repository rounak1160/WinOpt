

<?php
$item1=array();
$item2=array();

$count=0;
$file=fopen("OutputListingAll.txt","r");
$flag=0;
while(!feof($file))
{
	$no=0;
	$a= fgets($file);
	//echo " helo $a[0] ";
	$len=strlen($a);
	//	echo "strlen is $len <br>";
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
				
			#echo $piece[4];
			if($count < 8)
			{
			$item1[$count]=$piece[4];
		#	echo "   ";
			$item2[$count]=$piece[11];
		#	echo $piece[11];
			$count=$count+1;
			}
			else
			{
			$count=$count+1;
			}	
		}





	}

	//	}

}

fclose($file);

#print_r($item1);
#print_r($item2);




require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_line.php');


$graph = new Graph(300,250);
$graph->SetScale("textlin");
$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Filled Y-grid');
$graph->SetBox(false);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels(array('A','B','C','D','E','F','G','H'));
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($item1);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Line 1');

// Create the second line
#$p2 = new LinePlot($item2);
#$graph->Add($p2);
#$p2->SetColor("#B22222");
#$p2->SetLegend('Line 2');




$graph->legend->SetFrameWeight(1);

// Output line
#$graph->Stroke();
$fileName = "imagefile.png";
$graph->img->Stream($fileName);


?>
