<?php session_start();
include_once('config.php');

if(!isset($_SESSION['email']) && !isset($_SESSION['subemail']) && !isset($_SESSION['user_dir'])     ){
	header('location:index.php');
	}
	
	
$tbl="";
$tr="";
$tr2="";
$name="";
$table="";
$count="";
$fid=$_GET['fid'];
$form_name=$_GET['fomr'];

//header("Content-Type:application/json");
//error_reporting(0);

    $user=$_SESSION['email'];
    $uemail=$_SESSION['subemail'];
    //getting names of subaccounts
    $query_names = mysqli_query($dbc,"SELECT  * FROM sub_account_tbl WHERE admin_email='$user' AND email='$uemail' LIMIT 1") or die(mysqli_error($dbc));
	$row_names = mysqli_fetch_array($query_names); 
	$uuu = $row_names['email'];
	

	//get count
	$query_count = mysqli_query($dbc,"SELECT * FROM sub_account_tbl WHERE admin_email='$user' AND email='$uemail' LIMIT 1") or die(mysqli_error($dbc));
	$row_count = mysqli_num_rows($query_count); 
	
	//check
	$query_ck = mysqli_query($dbc,"SELECT * FROM formresponse WHERE fid = '19d609519b2e5afb3808321168f3566458030bac'") or die(mysqli_error($dbc));
	$row_ck = mysqli_fetch_array($query_ck); 
	//echo "<pre>";
	//var_dump($row_ck);
	//echo "</pre>";

function GetAsiriabo(){
        $ch=curl_init();
        $day=sha1(date("jY-m-d"));
        //
        //echo $melo;
        $url="https://locationforms.net/api/get_daily_token.php?code=".$day."";
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_URL,$url);
        $result=curl_exec($ch);
        curl_close($ch);
        $jsondecode=json_decode($result,true);
        $data=$jsondecode['details'];
        
        return $data;	
	}
	
$asiri=Getasiriabo();
//echo $asiri;

function GetMelo($fid,$asiri){
//print_r( $data);
//echo $data;
$ch2=curl_init();
$owner=$_SESSION['email'];
$marge=$owner.$fid.$asiri;

$asiriabo=$asiri;
$merge=$asiriabo.$owner.$fid;
$para="?form_owner=".$owner."&form_id=".$fid."";
$hash=hash('sha512',$merge);
//echo $hash;

  

$url2="https://locationforms.net/api/get_form_response.php".$para;
curl_setopt($ch2,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch2,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch2,CURLOPT_URL,$url2);
curl_setopt($ch2,CURLOPT_POSTFIELDS,true);
curl_setopt($ch2, CURLOPT_POSTFIELDS, "asiriabo=$hash");
curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
$result2=curl_exec($ch2);
curl_close($ch2);
$jsondecode2=json_decode($result2,true);

// var_dump($jsondecode2);




$melo="";
if($jsondecode2['status']==1){
$melo=$jsondecode2['melo'];
}
echo "Total number of responses: $melo";
return $melo;
	}
	
	
function GetMelo_v2($fid,$asiri){
            //print_r( $data);
            //echo $data;
            $ch2=curl_init();
            $owner=$_SESSION['email'];
            $marge=$owner.$fid.$asiri;
            
            $asiriabo=$asiri;
            $merge=$asiriabo.$owner.$fid;
            $para="?form_owner=".$owner."&form_id=".$fid."";
            $hash=hash('sha512',$merge);
            //echo $hash;
            
            $url2="https://locationforms.net/api/get_form_response.php".$para;
            curl_setopt($ch2,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($ch2,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch2,CURLOPT_URL,$url2);
            curl_setopt($ch2,CURLOPT_POSTFIELDS,true);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, "asiriabo=$hash");
            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
            $result2=curl_exec($ch2);
            curl_close($ch2);
            $jsondecode2=json_decode($result2,true);
            
            // var_dump($jsondecode2);
            
            $melo="";
            if($jsondecode2['status']==1){
            $melo=$jsondecode2['melo'];
            }
            
            return $melo;
	}	

	

	
	
	
	
	 $melo= GetMelo($fid,$asiri);
	 $page=ceil($melo/20);
/*	function Validate_Resoponse_Data($melo,$fid,$i,$asiri,$page){
		
		$ch2=curl_init();
$owner=$_SESSION['email'];
$marge=$owner.$fid.$asiri;
$asiriabo=$asiri;
		
	
		
		if ($page==0){
	
	$merge=$asiriabo.$owner.$fid;
	$para="?form_owner=".$owner."&form_id=".$fid."";
	}
	else{
$merge=$asiriabo.$owner.$fid.$i;

$para="?form_owner=".$owner."&form_id=".$fid."&page=".$i."";
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
return json_decode($result2,true);
		
		}*/
		
		//print_r(Validate_Resoponse_Data($melo,$fid,$i,$asiri,$page));
	
	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//END OF FUNCTIONS
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*$val=array();
$pgn=$_GET['pno'];	
	$val[]=Validate_Resoponse_Data($melo,$fid,$pgn,$asiri,$page);

	$arr_tot= count($val);
	$jsondecode=$val;
	//echo count($jsondecode['data']);


/* original $qry="select * from formresponse where fid='$fid' order by dat desc";*/
/*$qry="select * from formresponse where fid='$fid'  order by dat desc";
	$res=mysqli_query($dbc,$qry);
	$da=mysqli_fetch_assoc($res);


$date=$da['dat'];


//echo $date;
	
for ($i=0;$i<$arr_tot;$i++){
	//echo $i;
	
	$val_per_arr=$jsondecode[$i]['data'];
	
	$arr_count= count( $val_per_arr);
	//echo $arr_count;
//echo count($val_per_arr);


	for($j=0;$j<$arr_count;$j++){
		
		$qry1="select * from formresponse where fid='$fid' and status=0";
	$res1=mysqli_query($dbc,$qry1);
	if(mysqli_num_rows($res1)>0){
		$count=mysqli_num_rows($res1);
		}
		
		
			$jsonr=mysqli_real_escape_string($dbc,json_encode($jsondecode[$i]['data'][$j]['json_response'],true));
$rowner=mysqli_real_escape_string($dbc,$jsondecode[$i]['data'][$j]['response_owner']);
$dat=mysqli_real_escape_string($dbc,$jsondecode[$i]['data'][$j]['date_received']);
$latlon=mysqli_real_escape_string($dbc,$jsondecode[$i]['data'][$j]['latlong']);
//print_r($jsonr);
//print_r($dat);
//print_r($rowner);

	
	
	
	//$response=implode("",$jsondecode['data'][$i]);
	include_once('config.php');
	$qry2="insert into formresponse
	set fid='$fid',
	response='$jsonr',
	owner='$rowner',
	latlong='$latlon',
	dat='$dat',
	status=0
	";
	//var_dump($qry2);
	$res2=mysqli_query($dbc,$qry2) or die ("Could Not Insert").mysqli_error();
	if ($res2){
	//echo "Saved"; 
		}
	
	}	
}*/





	//fetcing data from database 
	$pno="5";
	$perpage=20;
	$a=ceil($count/$perpage);
	if (isset($_GET['pno'])){
		
		if($_GET['pno']==1){
			
			$pno=0;
		}
			else{
				$pno=($_GET['pno']* $perpage)-$perpage;
				}
			}
			
	//echo $pno;
	if($melo>0){
	$qry4="select distinct response  from formresponse where status=0 and fid='$fid' limit $pno, $perpage ";
	$res4=mysqli_query($dbc,$qry4) or die('Could Not select1').mysqli_error();
	$count=mysqli_num_rows($res4);
	$row4=mysqli_fetch_assoc($res4);
			$removeslash=stripslashes($row4['response']);
					$decode=json_decode(trim($removeslash,'"'),true);
				$totkeys= count($decode['fields']);
			$k;	//echo $totkeys;
	for($k=0;$k<$totkeys;$k++){
	
	 $tr.="<th>".$decode['fields'][$k]['key']." </th>";
	}
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

 
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manage Response</title>
<link rel="stylesheet" href="../lightbox2-master/dist/css/lightbox.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.jgrowl.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>

<link rel="stylesheet" type="text/css" href="css/font-awesome-4.5.0/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/datatable.fixedcolumns.min.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.datatables.css"/>
<link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css"/>


<script type="text/javascript" src="js/jquery-2.2.3.js"></script>
 <script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/jquery.datatables.js"></script>
<script type="text/javascript" src="js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="js/dataTables.buttons.min.js"></script>




<script>

$(document).ready(function(){
	var table = $('#example').DataTable( {
  sScrollX: "100%",
 
  bScrollCollapse: true        
});
new $.fn.dataTable.FixedColumns(table);
	
	
});

</script>
</head>

<body>
<?php

if(isset($_POST['rebuild']) && isset($_POST['form_id']) && isset($_POST['melo']) && isset($_POST['user'])){
    $form_id111 = $_POST['form_id'];
    $melo111 = $_POST['melo'];
    $user11 = $_POST['user'];
    $number_pages = ceil($melo111/20);
    $number_pages = $number_pages +1;
    $i = 600;
    $asiri=Getasiriabo();
	echo "Paddy Miiii::";
	$melo = GetMelo_v2($form_id111,$asiri);
	$diff = $melo - $melo111;
    echo $melo.' -'.$asiri.'-- '.$melo111.' '.$diff;
    
    
}


if(isset($_POST['rebuilddd']) && isset($_POST['ddform_id']) && isset($_POST['ddmelo']) && isset($_POST['dduser'])){
        $form_id111 = $_POST['form_id'];
        $melo111 = $_POST['melo'];
        $user11 = $_POST['user'];
        $number_pages = ceil($melo111/20);
        $number_pages = $number_pages +1;
        $i = 600;
        $asiri=Getasiriabo();
		$melo= GetMelo($form_id111,$asiri);
		$flag_cleance = 0;
		
		//do house keeping first
		echo '<br/>First we do little House keeping.....<br/>';
			$qry1="select `frid` from formresponse where fid='$form_id111' ORDER BY latlong";
	$res1=mysqli_query($dbc,$qry1);
	if(mysqli_num_rows($res1)>0){
		$query_del = "DELETE FROM `formresponse` WHERE `fid`='$form_id111' and `status`=0";
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
$owner=$_SESSION['email'];
$asiriabo=$asiri;
		
	
		
		if ($page==0){
	
	$merge=$asiriabo.$owner.$fid;
	$para="?form_owner=".$owner."&form_id=".$fid."";
	}
	else{
$merge=$asiriabo.$owner.$fid.$i;

$para="?form_owner=".$owner."&form_id=".$fid."&page=".$i."";
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
	
	if($fid=='26bf5209c42bf55f3e07a50574a50769e54c294d'){
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
	SELECT `frid` FROM `formresponse` WHERE 
	
	fid='$fid',
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
		$qry2="insert into formresponse
	set fid='$fid',
	response='$jsonr',
	owner='$rowner',
	phone_number='$the_phone_number',
	latlong='$latlon',
	dat='$dat',
	status=0
	";
	$res2=mysqli_query($dbc,$qry2) or die ("Could Not Insert").mysqli_error();
	if ($res2){
	//echo "Saved";
echo '<li>
		Data saved to database  
		</li>';
		//var_dump($file_build);
	
		}else{
		echo '<<li>Data Not saved</li>';
		}
		
	
				
	}
		
	}
	echo '<br/>
		Page '.$i.' data built successfully
		<br/>';
	
	
		
					
	
	
	
	//delete the existing data
	
	
	//insert existing data
		
		$i++;
		set_time_limit(0);
}

//////////image list removed for cron job
	//build image list
	if(isset($_GET['fomr']) && isset($_GET['fid'])){
	    $formid = $_GET['fid'];
	}else{
	    $_GET['fomr'] = '';
	    $_GET['fid'] = '';
	    $formid = $_GET['fid'];
	}
	$form_name1  = $_GET['fomr'];
	$form_name1  =	str_replace(" ","_",strtolower($form_name1));
	$user_dir = $_SESSION['user_dir'];
						
						$file_dir = "../forms/".strtolower($user_dir)."/".$form_name1."/data";
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
$put_there = "../files_list/".$formid.'.txt';
file_put_contents($put_there,$the_data);
					echo '<br/>
		Images List rebuilt successifully
		
		<br/>';
	//	var_dump($put_there,$file_dir);	
	//echo '</div>';





	echo '

	<form action="" method="post">
    <input type="submit" name="rebuild" id="rebuild" value="Close Rebuild Report and view all responses" class="btn btn-danger">
    </form>
	';
}
?>
    <br/>
<form action="" method="post">
<input type="text" name="melo"  value="<?php echo $melo;?>" />
    <input type="text"  name="form_id"  value="<?php echo $fid;?>" />
    <input type="text" name="user"  value="<?php echo $user;?>" />
    <input type="submit"  name="rebuild" id="rebuild" value="Rebuild V2" class="btn btn-success">
    </form>

    <?php include('nav.php'); ?>

<div class="container">
<div class="row">
     <p align="center"><a href='formlist.php'>Back to Formlist</a></p>
<div class="res" align="center"><small style="font-size: 25px;">Responses from the Form:<br> <strong><?php echo $form_name; ?></strong></small>  </div><hr>
<div class="col-md-12">
<?php  if($melo>0) {?>
<div class="table table-responsive">

<table class="dataTable table table-responsive" id="example" style="width:100%;">

<thead><tr><?php  echo $tr; 

if ($count>0){
	echo '<th> Owner</th><th> LatLong </th><th>Date</th><th>Action</th>
</tr></thead>';
}
 ?>

<?php
	//Table Body
	var_dump($pno,$perpage);
	$qry5="select  * from formresponse where fid='$fid' and status=0 order by `frid` desc limit $pno,$perpage";
	$res5=mysqli_query($dbc,$qry5);
	//var_dump($qry5);
	//$count=mysqli_num_rows($res1);
		
			
			print_r( $decode['fields'][0]['key']);
			echo "<tbody>";
			while ($row5=mysqli_fetch_assoc($res5)){
			//	var_dump($row5);
		echo "<tr>		
		
		";
				for($l=0;$l<$totkeys;$l++){
			$removeslash2=stripslashes($row5['response']);
		//	echo $removeslash2;
					$decode2=json_decode(trim($removeslash2,'"'),true);
$fid2=$row5['fid'];
//echo $fid2;
	$formid = $fid2;


	if(!isset($decode2['fields'][$l]['value'])){
$thevalue = '';
}else{
$thevalue =str_replace("_","",$decode2['fields'][$l]['value']);
}
$is_there = strpos($thevalue,'.');


if($is_there===false){
echo "<td>".$thevalue."</td>";
}else{
	//check if the file exists and link the file
	$dir_list = "../files_list/".$formid.".txt";
	
	if(is_file($dir_list)){
	$the_file_list =	file_get_contents($dir_list);
	$the_decoded = json_decode($the_file_list,true);
	$file_dir_actual = stripslashes($the_decoded['path']);
	//echo $file_dir_actual.'<br/>';
	$file_list_actual = $the_decoded['files'];
	
	
	
	if(isset($the_decoded['file_names'])){
	$file_name_actual = $the_decoded['file_names'];
	
	//print_r($file_name_actual);
	}else{
		$file_name_actual = array();
	}
	$is_email = filter_var($thevalue, FILTER_VALIDATE_EMAIL);
	$is_url = filter_var($thevalue, FILTER_VALIDATE_URL);
$thevalue1 = strtolower($thevalue);

//print_r($thevalue1);
//print('<br/>');
	$is_file_now_there = in_array($thevalue1,$file_name_actual);
	//var_dump($is_file_now_there);
	if($is_url !==false){
		echo "<td>".$thevalue."</td>";
	}else{
	if($is_email!==false){
		echo "<td>".$thevalue."</td>";
	}else{
		//var_dump($file_list_actual);
		
		if($is_file_now_there){

			$array_key = array_search($thevalue1,$file_name_actual);
			$the_filo = $file_list_actual[$array_key];
			$file_path = "../".$file_dir_actual."/".$the_filo;
			
			$file_path1 = $file_dir_actual."/".$the_filo;
			//var_dump($finfo);
		//	if (file_exists($file_path1)) {
   // echo "The file $file_path1 exists <br/>";
//} else {
  //  echo "The file $file_path1 does not exist<br/><br/>";
//}
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
		//	var_dump($finfo);
$mime_type = strtolower(finfo_file($finfo, "$file_path"));
//var_dump($mime_type);
$mime = explode("/",$mime_type);
$mime_group = $mime[0];
$site_root = "https://locationforms.com/";
finfo_close($finfo);
$the_filesize = filesize($file_path);
$the_filesize = number_format($the_filesize/(1024*1024),2);
switch($mime_type){
	case 'image/jpeg':
echo "<td><a class='example-image-link' href='".$file_path."' data-lightbox='example-1' data-title='".$thevalue."' title='".$the_filesize." MB '>".$thevalue."</a></td>";
break;
	case 'image/png':
echo "<td><a class='example-image-link' href='".$file_path."' data-lightbox='example-1' data-title='".$thevalue."' title='".$the_filesize." MB '>".$thevalue."</a></td>";
break;
case 'image/tiff':
echo "<td><a class='example-image-link' href='".$file_path."' data-lightbox='example-1' data-title='".$thevalue."' title='".$the_filesize." MB '>".$thevalue."</a></td>";
break;
case 'image/jp2':
echo "<td><a class='example-image-link' href='".$file_path."' data-lightbox='example-1' data-title='".$thevalue."' title='".$the_filesize." MB '>".$thevalue."</a></td>";
break;
case 'text/plain':
echo "<td><a target='_blank' href='https://docs.google.com/viewerng/viewer?url=".$site_root.$file_path."' title='".$the_filesize." MB '>".$thevalue."</a></td>";
break;

case 'application/pdf':
echo "<td><a target='_blank' href='https://docs.google.com/viewerng/viewer?url=".$site_root.$file_path."' title='".$the_filesize." MB '>".$thevalue."</a></td>";
break;
case 'application/vnd.ms-powerpoint':
echo "<td><a target='_blank' href='https://docs.google.com/viewerng/viewer?url=".$site_root.$file_path."' title='".$the_filesize." MB '>".$thevalue."</a></td>";
break;

case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
echo "<td><a target='_blank' href='https://docs.google.com/viewerng/viewer?url=".$site_root.$file_path."' title='".$the_filesize." MB '>".$thevalue."</a></td>";
break;

default:

	//echo "<td><a href='".$file_path."' title='".$the_filesize." MB '>".$thevalue."</a></td>";
	
	
	echo "<td><a class='example-image-link' href='".$file_path."' data-lightbox='example-1' data-title='".$thevalue."' title='".$the_filesize." MB '>".$thevalue."</a></td>";
	
	break;

			
			
}
		}else{
			echo "<td>".$thevalue."</td>";
		}
	}
	}
	}else{
echo "<td>".$thevalue."</td>";
	}
	}


	
	
	
	//echo  "<td>".$decode2['fields'][$l]['value']."</td>";
	} echo "<td>".$row5['owner']."</td> <td><a href='https://www.google.com.ng/maps/place/".$row5['latlong']."' target='_blank'>".$row5['latlong']."</a></td><td>".$row5['dat']."</td><td><span ><a class='btn btn-success' href='message.php?status_fid=".$row5['frid']."&form_name=".$form_name."'>mark as done</span></td>";
	echo "

	
	</tr>";		
	}
	
  ?>


</tbody></table></div>






</div><!--row-->
<div class="row">
<?php
for($m=1;$m<=$page;$m++){
	
	echo '<ul class="pagination"> <li><a href="manage.php?pno='.$m.'&fid='.$fid.'">'.$m.'</a></li></ul>';
	}}
	else{
		echo '<div class="alert-danger" align="center" >No Response Yet</div>';
		
		}
?>



</div>
</div><!--container-->
</div>
<script src="../lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
<script>
    lightbox.option({
      'resizeDuration': 200,
      'fitImagesInViewport': true
    })
</script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
</body>
</html>