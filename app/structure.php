<?php

/*
 * Implement any type of control access or various structures
 * regarding multiple files formats
 */
 
 /* menu structure for your files */
$structure_main = '[
                        {"fileName":"File_1"}
                    ]';

/* file mandatory fields */
$structure_1 = '[{
                        "fieldName": "Field_1",
                        "validationType": "text"
                    }, {
                        "fieldName": "Field_2",
                        "validationType": "text"
                }]';

	if (isset($_GET['struct_name']) && $_GET['struct_name'] != "") {
		$struct_name = $_GET['struct_name'];
	}else{
		$struct_name = "";
	}
	
	if (isset($_GET['file_name']) && $_GET['file_name'] != "") {
		$file_name = $_GET['file_name'];
	}else{
		$file_name = "";
	}
	
	switch ($struct_name) {
		case '':
			$struct_format = $structure_main;
			break;
		case 'json_file_read_app':
			require_once("../config/app_config.php");
			$dir = EXPORT_DIR."".$file_name.".json";
			$struct_format = file_get_contents($dir);
			break;
		case 'File_1':
			$struct_format = $structure_1;
			break;
		default:
			$struct_format = "";
	}

	echo $struct_format;
?>