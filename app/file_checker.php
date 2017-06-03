<?php 
	require_once("../config/app_config.php");
	$dir    = EXPORT_DIR;
	$files = scandir($dir);
	
	if (isset($_GET['file_name']) && $_GET['file_name'] != "") {
		$file_name_php = $_GET['file_name'].".php";
		$file_name_env = $_GET['file_name'].".env";
	}else{
		$file_name_php = "";
		$file_name_env = "";
	}
	
	if (in_array($file_name_php, $files)){
		echo '[{"status":"200","file_name":"'.$file_name_php.'"}]';
	}elseif(in_array($file_name_env, $files)){
		echo '[{"status":"200","file_name":"'.$file_name_env.'"}]';
	}else{	
		echo '[{"status":"404","file_name":""}]';
	}
?>