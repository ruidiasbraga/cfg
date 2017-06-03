<?php 

		/* simple file reader, just print content */
		require_once("../config/app_config.php");
		$file_name = EXPORT_DIR;
	
		if (isset($_GET['file_name']) && $_GET['file_name'] != "") {
			$file_name .= $_GET['file_name'];
		}else{
			$file_name = "";
		}
		
		$file_read = file_get_contents($file_name);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/app.js"></script>
    <title>File Reader</title>
</head>
<body>
<div class="container" style="margin-top:80px;">
    <div class="row">
	        <form action="../index.html" method="GET">
				<?php 
					echo "Reading File $file_name, Please Check";
					echo "<pre>$file_read</pre>";
				?>
			<button id="get_back" type="submit" class="btn btn-default" >Back</button>
		</form>
    </div>
</div>
</body>
</html>