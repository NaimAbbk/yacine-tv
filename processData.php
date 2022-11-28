<?php 
	require("includes/connection.php");
	require("includes/lb_helper.php");
	require("language/language.php");
	
	$response=array();
	
	$_SESSION['class'] = "success";

	switch ($_POST['action']) {

		case 'toggle_status':{
				$id = $_POST['id'];
				$for_action = $_POST['for_action'];
				$column = $_POST['column'];
				$tbl_id = $_POST['tbl_id'];
				$table_nm = $_POST['table'];

				if ($for_action == 'active') {
					$data = array($column  =>  '1');
					$edit_status = Update($table_nm, $data, "WHERE $tbl_id = '$id'");
					$_SESSION['msg'] = "13";
				} else {
					$data = array($column  =>  '0');
					$edit_status = Update($table_nm, $data, "WHERE $tbl_id = '$id'");
					$_SESSION['msg'] = "14";
				}

				$response['status'] = 1;
				$response['action'] = $for_action;
				echo json_encode($response);
			}
			break;

		case 'multi_action': {
				$action = $_POST['for_action'];
				$ids = implode(",", $_POST['id']);
				$tbl_nm = $_POST['table'];

				if ($ids == '') {
					$ids = $_POST['id'];
				}

				if ($action == 'enable') {
					$sql = "UPDATE $tbl_nm SET `status`='1' WHERE `id` IN ($ids)";
					mysqli_query($mysqli, $sql);
					$_SESSION['msg'] = "13";
				} 
				else if ($action == 'disable') {
					$sql = "UPDATE $tbl_nm SET `status`='0' WHERE `id` IN ($ids)";
					if (mysqli_query($mysqli, $sql)) {
						$_SESSION['msg'] = "14";
					}
				}
				
				else if ($action == 'delete'){
				    
				    if($tbl_nm=='tbl_users'){
						
						$sql="SELECT * FROM tbl_users WHERE `id` IN ($ids)";
        				$res=mysqli_query($mysqli, $sql);
        				while ($row=mysqli_fetch_assoc($res)){
        					if($row['profile_img']!=""){
        						unlink('images/'.$row['profile_img']);
        					}
        				}
        				
						$deleteSql = "DELETE FROM tbl_active_log WHERE `user_id` IN ($ids)";
						mysqli_query($mysqli, $deleteSql);
						
						$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
						mysqli_query($mysqli, $deleteSql);
					}
					
					else if($tbl_nm=='tbl_reports'){
						$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
						mysqli_query($mysqli, $deleteSql);
					}
					
					else if($tbl_nm=='tbl_subscription'){
						$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
						mysqli_query($mysqli, $deleteSql);
					}
					
					else if($tbl_nm=='tbl_category'){
					    
					    $sql="SELECT * FROM tbl_category WHERE `cid` IN ($ids)";
        				$res=mysqli_query($mysqli, $sql);
        				while ($row=mysqli_fetch_assoc($res)){
        					if($row['category_image']!=""){
        						unlink('images/'.$row['category_image']);
        					}
        				}
						$deleteSql = "DELETE FROM $tbl_nm WHERE `cid` IN ($ids)";
						mysqli_query($mysqli, $deleteSql);
					}
					
					else if($tbl_nm=='tbl_banner'){
					    
					    $sql="SELECT * FROM tbl_banner WHERE `bid` IN ($ids)";
        				$res=mysqli_query($mysqli, $sql);
        				while ($row=mysqli_fetch_assoc($res)){
        					if($row['banner_image']!=""){
        						unlink('images/'.$row['banner_image']);
        					}
        				}
						$deleteSql = "DELETE FROM $tbl_nm WHERE `bid` IN ($ids)";
						mysqli_query($mysqli, $deleteSql);
					}
					
					else if($tbl_nm=='tbl_suggest'){
					    
					    $sql="SELECT * FROM tbl_suggest WHERE `id` IN ($ids)";
        				$res=mysqli_query($mysqli, $sql);
        				while ($row=mysqli_fetch_assoc($res)){
        					if($row['suggest_image']!=""){
        						unlink('images/'.$row['suggest_image']);
        					}
        				}
						$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
						mysqli_query($mysqli, $deleteSql);
					}
					
					else if($tbl_nm=='tbl_live'){
					    
					    $sql="SELECT * FROM tbl_live WHERE `id` IN ($ids)";
        				$res=mysqli_query($mysqli, $sql);
        				while ($row=mysqli_fetch_assoc($res)){
        					if($row['live_image']!=""){
        						unlink('images/'.$row['live_image']);
        					}
        				}
						$deleteSql = "DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
						mysqli_query($mysqli, $deleteSql);
					}
					$_SESSION['msg'] = "12";
				}
				
				$response['status'] = 1;
				echo json_encode($response);
			}
			break;
		
		default:
			# code...
			break;
	}
?>