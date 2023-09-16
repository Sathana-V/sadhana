<?php
include "./db.php";
if (isset($_SERVER['HTTP_ORIGIN'])) {
	
	header('Access-Control-Allow-Origin:*');
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 1000');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
			
			header("Access-Control-Allow-Methods:*");
	}

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
			header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
	}
	exit(0);
}
$res = array();
$action='';

if (isset($_GET['action'])) {
	
	$action=$_GET['action'];
}


if ($action == 'publish') {
	$id=$_GET['id'];
	echo $id;
	$sql = "UPDATE circular_details SET state = 'Published',status='Despatched'  where id='".$id."'";
	$result = $conn->query($sql);
	if ($result===true) {
		$res['error'] = false;
		$res['message'] = "Successfully".$sql;
	} else {
		$res['error'] = true;
		$res['message'] = 'not updated'.$sql;
	}
	

}
if ($action == 'delete') {
	$id=$_GET['id'];
	echo $id;
	$sql = "UPDATE circular_details SET status='Deleted'  where id='".$id."'";
	$result = $conn->query($sql);
	if ($result===true) {
		$res['error'] = false;
		$res['message'] = "Successfully".$sql;
	} else {
		$res['error'] = true;
		$res['message'] = 'not updated'.$sql;
	}
	

}

if ($action == 'addcircular') {
	
	
	
	date_default_timezone_set("Asia/Kolkata");
	$time = date("Y-m-d-h-i-sa");
	$timestamp = date('Y-m-d H:i:s');
	$circular_subject = $_POST['circular_subject'];
	$circular_description = $_POST['circular_description'];
    $circular_type=$_POST['circular_type'];
	$date = date('Y-m-d', strtotime($_POST['date']));
	$state = $_POST['state'];
	$status=$_POST['status'];
	if($_POST['status']=='new')
	{
		$status ='Created';
	}
	$attachment='';
	$category=$_POST['category'];
		$upload_location = "uploads/";
	$department_id = $_POST['department_id'];
	$designation_id = $_POST['designation_id'];

	$files_arr = array();
	
	if (isset($_FILES['files']['name'])) {

		// Count total files
		$fileName = array();
		$countfiles = count($_FILES['files']['name']);

		// Upload directory
		$upload_location = "uploads/";
    
		// Loop all files
		for ($index = 0; $index <= $countfiles; $index++) {
			$i = 0;
			if (isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != '') {
				// File name
				$filename = $_FILES['files']['name'][$index];
                 
				// Get extension
				$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

				// Valid extensions
				$valid_ext = array("png", "jpeg", "jpg", "pdf", "txt", "doc", "docx");

				// Check extension
				if (in_array($ext, $valid_ext)) {

					// File path
					$pattern = '/Attachment_[0-9]{4}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}[a|p]m_/i';
                    $filename= preg_replace($pattern, '', $filename);
					$newfilename ="Attachment_".$time . "_" . $filename;
					$path = $upload_location . $newfilename;
					array_push($fileName, $newfilename);
					// Upload file
					if (move_uploaded_file($_FILES['files']['tmp_name'][$index], $path)) {
						$files_arr[] = $newfilename;
						$res['error'] = false;
						$res['message'] = "User Added Successfully" . $countfiles . $_FILES['files']['tmp_name'][$index] . "   --" . $path;
					} else {
						$res['error'] = true;
						$res['message'] = 'not added' . $_FILES['files']['tmp_name'][$index] . "   --" . $path;
					}
				}
			}
			$i++;
		}
		$attachment = serialize($fileName);
	}
	$msg='';
	if(isset($_POST['id']))
	{
		$id=$_POST['id'];
		
		$msg='';
		
		if (isset($_POST['oldfiles'])) {

			// Count total files
			$oldarr=$_POST['oldfiles'];
			$length=sizeof($oldarr);
			$location = "uploads/";
			$msg='yes'.$length;
			for($i=0;$i<$length;$i++)
			{
				
				
				$imgloc=$location.$oldarr[$i];
				//$imgloc=$oldarr[$i];
				$msg=$msg.$imgloc;
				if (unlink($imgloc)) {
					$msg.='The file ' . $imgloc . ' was deleted successfully!';
				} else {
					$msg.='There was a error deleting the file ' . $imgloc;
				}
			}
		}
		else{
			$msg='not set';
		}
	
		$sql="UPDATE `circular_details` SET `date`='".$date."',`circular_subject`='".$circular_subject."',`circular_description`='".$circular_description."',`attachment`='".$attachment."',`department_id`='".$department_id."',`designation_id`='".$designation_id."',`category`='".$category."',`status`='".$status."',`state`='".$state."',`timestamp`='".$timestamp."',`circular_type`='".$circular_type."' where id='".$id."'";

	}
	else{
		$sql = "INSERT INTO `circular_details`( `date`, `circular_subject`, `circular_description`, `attachment`, `department_id`, `designation_id`,`category`, `status`, `state`, `timestamp`,`circular_type`) VALUES ('$date','$circular_subject','$circular_description','$attachment','$department_id','$designation_id','$category','$status','$state','$timestamp','$circular_type')";

	}
	
	$result = $conn->query($sql);
	
	if ($result===true) {
		$res['error'] = false;
		$res['message'] = "User Added Successfully".$msg;
	} else {
		$res['error'] = true;
		$res['message'] = 'not added'.$sql;
	}
}

if($action=='getcirculars'){
	$sql="SELECT circular_details.*,designation_details.designation_name,teaching_staff,department_details.department_name FROM `circular_details` left JOIN department_details on department_details.id=circular_details.department_id left JOIN designation_details on designation_details.id=circular_details.designation_id where circular_details.status!='Deleted' ORDER BY `circular_details`.`id` DESC";
	$result=$conn->query($sql);
	$num=mysqli_num_rows($result);
	$userData=array();
	if($num >0){
		while($row=$result->fetch_assoc()){
			$row['date2']=date('Y-m-d', strtotime($row['date']));
			$row['date']=date('d/m/Y', strtotime($row['date']));
			if($row['designation_id']==-1)
			{
				$row['designation_name']='All';
			}
			if($row['department_id']==-1)
			{
				$row['department_name']='All';
			}
			$row['attached_images'] = unserialize($row['attachment']);
			array_push($userData,$row);

		}
		
        $res['user_Data']=$userData;
		$res['error']=false;
		$res['message']="data Successfully";

	}else{
		$res['error']=true;
        $res['message']="No Data Found!";
	}
	
}


if($action=='getdepartment')
{
	$sql="SELECT id,department_name,teaching_staff FROM department_details";
	$result=$conn->query($sql);
	$num=mysqli_num_rows($result);
	$userData=array();
	if($num >0){
		while($row=$result->fetch_assoc()){
			array_push($userData,$row);
		}
		
        $res['Depart_Data']=$userData;

	}else{
		$res['error']=true;
        $res['message']="No Data Found!";
	}
	$sql2="SELECT id,designation_name FROM designation_details";
	$result=$conn->query($sql2);
	$num=mysqli_num_rows($result);
	$DesigData=array();
	if($num >0){
		while($row=$result->fetch_assoc()){
			array_push($DesigData,$row);
		}
		$res['error']=false;
		$res['message']="depart susc";
        $res['Desig_Data']=$DesigData;

	}else{
		$res['error']=true;
        $res['message']="No Data Found!";
	}
}

$conn -> close();
header("Content-type: application/json");
echo json_encode($res);
die();
 ?>