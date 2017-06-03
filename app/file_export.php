<?php 
	
	/* kind of messy here, just relax */
	require_once("../config/app_config.php");
	
	$extension = "";
	$file_export = "";
	$file_name_generic = "";
	$file_export_json = "[";
	
	foreach ($_POST as $key => $value){
		if($key == "file_extensions_app_selector" && $value == "php") {
			$file_export = "<?php \n";
			$extension = $value;
		}
		if($key == "file_extensions_app_selector" && $value == "env"){
			$file_export = "";
			$extension = $value;
		} 
	}
	
	$files = 0;
	$file_name = EXPORT_DIR;
	$file_name_json = EXPORT_DIR;
	$file_rename = EXPORT_DIR;
	$file_name_generic = EXPORT_DIR;
	
	foreach ($_POST as $key => $value){
		
		/* file name comes as first input, no need to define */
		if($key != "file_extensions_app_selector"){
			if($files > 0){
				if($extension == "php"){
					$file_export .= "	define(\"".htmlspecialchars($key)."\", \"".htmlspecialchars($value)."\");"; 
				}else{
					$file_export .= "	".htmlspecialchars($key)."=".htmlspecialchars($value).""; 
				}
				$file_export .= "\n";
				
				/* JSON support file */
				$file_export_json .= '{"fieldName":"'.htmlspecialchars($key).'","validationValue":"'.htmlspecialchars($value).'"}';
				
			}else{
				
				/* Nome do Ficheiro, header apenas */ 
				$file_name .= htmlspecialchars($key).".txt";
				$file_name_generic .= htmlspecialchars($key);
				
				if($extension == "php"){
					$file_rename .= htmlspecialchars($key).".php";
				}else{
					$file_rename .= htmlspecialchars($key).".env";
				}
				$file_export .= "	/* File Name -> ".htmlspecialchars($key)." */ "; 
				$file_export .= "\n";
				
				$file_name_json .= htmlspecialchars($key).".json";
			}
			$files++;
		}
	}
	
	if($extension == "php"){
		$file_export .= "?>";
	}else{
		$file_export .= "";
	}
	
	/* JSON */
	$file_export_json .= "]";
	$file_export_json = str_replace("}{","},{",$file_export_json);
	
	
	/* I live my life dangerously, no warnings */	
	@unlink($file_name_generic.".php");
	@unlink($file_name_generic.".env");
	
	$myfilejson = fopen($file_name_json, "w") or die("Unable to open file!");
	fwrite($myfilejson, $file_export_json);
	fclose($myfilejson);
	
	/* Save file */
	$myfile = fopen($file_name, "w") or die("Unable to open file!");
	fwrite($myfile, $file_export);
	fclose($myfile);
	rename($file_name, $file_rename);
	
	/* remove special characters from file to show on screen */
	$file_export = htmlspecialchars($file_export);
	
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/app.js"></script>
		<title>File Export</title>
	</head>
	<body>
	<div class="container" style="margin-top:80px;">
		<div class="row">
				<form action="../index.html" method="GET">
					<?php 
						echo "File Generated, Please Check";
						echo "<pre>$file_export</pre>";
					?>
				<button id="get_back" type="submit" class="btn btn-default" >Back</button>
			</form>
		</div>
	</div>
	</body>
</html>