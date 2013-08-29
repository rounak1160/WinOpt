<?php
	session_start();
	$file="tutorial_template.idf";
	$file1 = fopen($file, "r") or die("can't open template file for reading");
	$theData = fread($file1, filesize($file));
	fclose($file1);

	$file="./tutorial_template2.idf";
	$file1 = fopen($file, "w") or die("can't open template for writing");
	fwrite($file1,$theData);
	fclose($file1);

	/* $filevars1 = fopen("./vars.txt","r") or die("can't open vars.txt for writing");

	$noofvars=fgets($filevars1);
	$fixazi=0;
	$fixwwr=0;
	$fixdepth=0;
	for($i=0;$i<$noofvars;$i++){
		$str=fgets($filevars1);
		$keywords = preg_split("/[\s;=]+/",$str);
		if($keywords[0]==="azimuth"){
			$fixazi=$keywords[1];
		}
		if($keywords[0]==="wwr"){
			$fixwwr=$keywords[1];
		}
		if($keywords[0]==="depth"){
			$fixdepth=$keywords[1];
		}		
	}
	echo $fixazi."<br>";
	echo $fixwwr."<br>";
	echo $fixdepth."<br>";	
	fclose($filevars1);
	 */
	 
	 $var_quantities='';
	extract($_POST);
	echo "azi is ";
	echo $azi_var_fix;
	echo "<br>";
	$variable_string='';


	/*------------azimuth angle calculations------------*/
	if($azi_var_fix==="variable"){
  		$variable_string="  Parameter{ // solar, visible, and thermal transmittance of shading device
  Name    = azimuth_angle;
  Min     = $azi_min_value;
  Ini     = $azi_ini_value;
  Max     = $azi_max_value;
  Step    = $azi_step_value;
  }
";
	$var_quantities=$var_quantities.'1';
	}
	elseif($azi_var_fix==="fixed") {
		$file="./tutorial_template2.idf";
		$file1 = fopen($file, "r") or die("can't open model template for reading");
		$theData = fread($file1, filesize($file));
		$replacedData = str_replace(array('%azimuth_angle%'),array($azi_value),$theData);
		fclose($file1);
		$file1 = fopen($file, "w") or die("can't open template for reading");
		fwrite($file1,$replacedData);
		fclose($file1);
		echo "azi is fixed";
		echo "<br>";
		$var_quantities=$var_quantities.'0';
	}

	/*--------wwr calculations------------*/	
	$height_of_window=3;//fixing the height of the window to 3; according the given model
	if($wwr_var_fix==="variable"){

		$height_of_window=3;//fixing the height of the window to 3; according the given model
		$ratio_min_value=$wwr_min_value/100*$height_of_window;
		$ratio_ini_value=$wwr_ini_value/100*$height_of_window;
		$ratio_max_value=$wwr_max_value/100*$height_of_window;
		$ratio_step_value=$wwr_step_value/100*$height_of_window;


		$variable_string=$variable_string."  Parameter{ // solar, visible, and thermal transmittance of shading device
  Name    = wwr_height;
  Min     = $ratio_min_value;
  Ini     = $ratio_ini_value;
  Max     = $ratio_max_value;
  Step    = $ratio_step_value;
  }
";
	$ratio_min_value2=$height_of_window/2-$ratio_max_value/2;
	$ratio_ini_value2=$height_of_window/2-$ratio_ini_value/2;
	$ratio_max_value2=$height_of_window/2-$ratio_min_value/2;
	$ratio_step_value2=$ratio_step_value/2;

	$half_window_height=$height_of_window/2;
	$variable_string=$variable_string."  Function{
  Name    = wwr_startz;
  Function=\"subtract($half_window_height,multiply(%wwr_height%,0.5))\";
  }
";
	$var_quantities=$var_quantities.'1';
	}
	elseif($wwr_var_fix==="fixed"){
		echo "wwr is fixed <br>";
		$file="./tutorial_template2.idf";
		$file1 = fopen($file, "r") or die("can't open model template for reading");
		$theData = fread($file1, filesize($file));
		
		$wwr_height=$wwr_value/100*$height_of_window;
		$wwr_startz=$height_of_window/2-$wwr_height/2;

		$replacedData = str_replace(array('%wwr_height%','%wwr_startz%'),array($wwr_height,$wwr_startz),$theData);
		fclose($file1);
		$file1 = fopen($file, "w") or die("can't open model template for reading");
		fwrite($file1,$replacedData);
		fclose($file1);
		$var_quantities=$var_quantities.'0';
	}



/*----------------overhang_depth_calculations-------------*/
	if($depth_var_fix==="variable"){
		$variable_string=$variable_string."  Parameter{ // solar, visible, and thermal transmittance of shading device
  Name    = depth;
  Min     = $depth_min_value;
  Ini     = $depth_ini_value;
  Max     = $depth_max_value;
  Step    = $depth_step_value;
  }
";
	$var_quantities=$var_quantities.'1';
	}
	elseif($depth_var_fix==="fixed"){
		$file="./tutorial_template2.idf";
		$file1 = fopen($file, "r") or die("can't open model template for reading");
		$theData = fread($file1, filesize($file));
		$replacedData = str_replace(array("%depth%"),array($depth_value),$theData);
		fclose($file1);
		$file1 = fopen($file, "w") or die("can't open model template for reading");
		fwrite($file1,$replacedData);
		fclose($file1);
		echo "wwr is fixed <br>";
		$var_quantities=$var_quantities.'0';
	}
	
/*-------------------window type calculations-----------------*/
	$var_quantities=$var_quantities.'1';//since window is always a varialble

	$flagshgc=0;
 	$shgcvalueset='"';
	if(isset($_POST['windowtype1'])){
		if($flagshgc==0){
			$shgcvalueset=$shgcvalueset."0.25";
			$flagshgc=1;
		}
		else if($flagshgc==1){
			$shgcvalueset=$shgcvalueset."0.25";
		}
		echo "window1 is set <br>";
	}
	if(isset($_POST['windowtype2'])){
		if($flagshgc==0){
			$shgcvalueset=$shgcvalueset."0.28";
			$flagshgc=1;
		}
		else if($flagshgc==1){
			$shgcvalueset=$shgcvalueset.",0.28";
		}
		echo "window2 is set <br>";
	}
	if(isset($_POST['windowtype3'])){
		if($flagshgc==0){
			$shgcvalueset=$shgcvalueset."0.2";
			$flagshgc=1;
		}
		else if($flagshgc==1){
			$shgcvalueset=$shgcvalueset.",0.2";
		}
		echo "window3 is set <br>";
	}
	if(isset($_POST['windowtype4'])){
		if($flagshgc==0){
			$shgcvalueset=$shgcvalueset."0.67";
			$flagshgc=1;
		}
		else if($flagshgc==1){
			$shgcvalueset=$shgcvalueset.",0.67";
		}
		echo "window4 is set <br>";
	}
	$shgcvalueset=$shgcvalueset.'"';	
	echo $shgcvalueset."<br>";


	$variable_string=$variable_string."  Parameter{ // solar, visible, and thermal transmittance of shading device
  Name    = shgc;
  Ini     = 1;
  Values = $shgcvalueset;
  }
  Function{
  Name = u_factor;
  Function = \"find_u_factor(%shgc%)\";
  }
  Function{
  Name = vlt;
  Function = \"find_vlt(%shgc%)\";
  }
";
	
/*----------------final printing------------------*/

	echo "variable string is <br>";
  	echo $variable_string;
  	echo "<br>";
  	
	$file1 = fopen("./command.txt","w") or die("can't open command.txt for writing");
	$variable_string="Vary{
".$variable_string."}"."
OptimizationSettings{
MaxIte = 2000;
MaxEqualResults = 100;
WriteStepNumber = false;
}

Algorithm{
  Main = GPSPSOCCHJ;
  NeighborhoodTopology = vonNeumann;
  NeighborhoodSize = 5;
  NumberOfParticle = 10;
  NumberOfGeneration = 10;
  Seed = 1;
  CognitiveAcceleration = 2.8;
  SocialAcceleration = 1.3;
  MaxVelocityGainContinuous = 0.5;
  MaxVelocityDiscrete = 4;
  ConstrictionGain = 0.5;
  MeshSizeDivider = 2;
  InitialMeshSizeExponent = 0;
  MeshSizeExponentIncrement = 1;
  NumberOfStepReduction = 4;
}
";
	fwrite($file1, $variable_string);
	fclose($file1);
	echo "variable string is ".$var_quantities."<br>";
	$_SESSION['var_quantities']=$var_quantities;
	echo("<meta http-equiv=\"refresh\" content=\"4;URL=./mycallserver.php\">");	

?>
