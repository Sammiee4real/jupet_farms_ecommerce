<?php

		
		$number_pages = ceil($getmelo/20);
		$number_pages = $number_pages +1;
		$i = $last_page_number;
		
		// $melo= GetMelo($formid,$asiri,$formuser);
		$flag_cleance = 0;
		
		echo "<h4>Rebuild for. ".$formname."</h4><br>";

		//do house keeping first
		echo '<br/>First we do little House keeping.....<br/>';
				$qry1="select `frid` from formresponse_staging where fid='$formid' ORDER BY latlong";
		$res1=mysqli_query($dbc,$qry1);
		if(mysqli_num_rows($res1)>0){
				$query_del = "DELETE FROM `formresponse_staging` WHERE `fid`='$formid' and `status`=0";
				$res_del=mysqli_query($dbc,$query_del);
				//	$res_del  = false; //debug
				if($res_del){
				echo '<span style="color:green;">Done!</span><br/>';
				}else{
				echo '<br/><span style="color:red;">FAILED! dont worry, effect is that you can have duplicate data in the view, you may try again</span><br/>';
				}
			}
		
		//echo '<div style="max-height:25%; overflow:auto;">';
	while($number_pages>$i){
		$page = $i;
		//get from API and insert into db
		unset($val);
	 	$ch2=curl_init();
		// $owner=$formuser;
		// $asiriabo=$asiri;
		
		if ($page==0){
			$merge=$asiri.$formuser.$formid;
			$para="?form_owner=".$formuser."&form_id=".$formid."";
			}
		else{
			$merge=$asiri.$formuser.$formid.$i;
			$para="?form_owner=".$formuser."&form_id=".$formid."&page=".$i."";
		}
		
		$hash=hash('sha512',$merge);

		$url2="https://locationforms.net/api/get_form_response.php".$para;
		curl_setopt($ch2,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch2,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch2,CURLOPT_URL,$url2);
		curl_setopt($ch2,CURLOPT_POSTFIELDS,true);
		curl_setopt($ch2, CURLOPT_POSTFIELDS, "asiriabo=$hash");
		curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
		$result2=curl_exec($ch2);
		curl_close($ch2);
		//var_dump($result2);
		$val = json_decode($result2,true);
			$jsondecode=$val;
			$val_per_arr=$jsondecode['data'];
			$arr_count= count( $val_per_arr);
			
		//	echo "<pre>";
		//	print_r($jsondecode);
	
		if($formid=='26bf5209c42bf55f3e07a50574a50769e54c294d'){
		$phone_number_id = 2;
		}else{
		$phone_number_id = 36;	
		}



	for($j=0;$j<$arr_count;$j++){
	    //get phone number 
	    $get_phone = json_decode($jsondecode['data'][$j]['json_response'],true);		
		if(isset($get_phone["fields"][$phone_number_id]["value"])){
	    $the_phone_number = $get_phone["fields"][$phone_number_id]["value"];
		}else{
		    $the_phone_number = '';		    
		}
		
		//var_dump($the_phone_number);
		//$jsonr=mysqli_real_escape_string($dbc,$jsondecode['data'][$j]['json_response'],true);
		$jsonr=mysqli_real_escape_string($dbc,json_encode($jsondecode['data'][$j]['json_response'],true));
		$rowner=mysqli_real_escape_string($dbc,$jsondecode['data'][$j]['response_owner']);
		$dat=mysqli_real_escape_string($dbc,$jsondecode['data'][$j]['date_received']);
		$latlon=mysqli_real_escape_string($dbc,$jsondecode['data'][$j]['latlong']);

		//print_r($jsonr);
		//print_r($dat);
		//print_r($rowner);

		//$response=implode("",$jsondecode['data'][$i]);
		include_once('config.php');
		
		$query_checkfirst = "
		SELECT `frid` FROM `formresponse_staging` WHERE 
		
		fid='$formid',
		response='$jsonr',
		owner='$rowner',
		phone_number='$the_phone_number',
		latlong='$latlon',
		dat='$dat',
		status=1
		
		";
		$quer_res = mysqli_query($dbc,$query_checkfirst);
		
		$num = mysqli_num_rows($quer_res);
	
		if($num==0){
			$qry2="insert into formresponse_staging
		set fid='$formid',
		response='$jsonr',
		owner='$rowner',
		phone_number='$the_phone_number',
		latlong='$latlon',
		dat='$dat',
		status=0
		";
		$res2=mysqli_query($dbc,$qry2) or die (mysqli_error($dbc));
		if ($res2){
			//echo "Saved";
			echo '<li>Data saved to database</li>';
			//var_dump($file_build);
			}else{
			echo '<<li>Data Not saved</li>';
			}
			
		
					
		}
			
		}

		echo '<br/>Page '.$i.' data built successfully<br/>';
	
		//delete the existing data	
		//insert existing data
		
		$i++;
		set_time_limit(0);
}

	//////////image list removed for cron job
	//build image list
	// if(isset($_GET['fomr']) && isset($_GET['fid'])){
	//     $formid = $_GET['fid'];
	// }else{
	//     $_GET['fomr'] = '';
	//     $_GET['fid'] = '';
	//     $formid = $_GET['fid'];
	// }
	// $form_name1  = $_GET['fomr'];
	
	$form_name1  =	str_replace(" ","_",strtolower($formname));
	// $user_dir = $_SESSION['user_dir'];
						
	$file_dir = "../forms/".strtolower($formuser)."/".$form_name1."/data";
	$d=scandir($file_dir);
	//save the file_list in file

	$the_data = $d;
	$file_nom = array();
	foreach ($d as $file_name){
		$file_n = strripos($file_name,"_");
		$actual_fn = substr($file_name,$file_n+1);
		array_push($file_nom,$actual_fn);
	}

	$data = array('path'=>$file_dir,'files'=>$d,'file_names'=>$file_nom);
	$the_data = json_encode($data);
	$put_there = "../files_list2/".$formid.'.txt';
	file_put_contents($put_there,$the_data);
						echo '<br/>
			Images List rebuilt successifully
			
			<br/>';
		//	var_dump($put_there,$file_dir);	
		//echo '</div>';
