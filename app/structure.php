<?php

/*
 * Implement any type of control access or various structures
 * regarding multiple files formats
 */
 
 /* menu structure for your files */
$structure_main = '[
                        {"fileName":"File_1"},
                        {"fileName":"File_2"},
                        {"fileName":"File_3"},
                        {"fileName":"File_4"}
                    ]';

/* file mandatory fields */
$structure_1 = '[{
                    "fieldName":"Field_1",
                    "validationType":"number"
                }]';


$structure_2 = '[{
                        "fieldName": "Field_1",
                        "validationType": "text"
                    }, {
                        "fieldName": "Field_2",
                        "validationType": "text"
                }]';

$structure_3 = '[{
                        "fieldName": "Field_1",
                        "validationType": "number"
                    }, {
                        "fieldName": "Field_2",
                        "validationType": "number"
                }, {
                        "fieldName": "Field_3",
                        "validationType": "text"
                }]';

$structure_4 = '[{
                        "fieldName": "Field_1",
                        "validationType": "number"
                    }, {
                        "fieldName": "Field_2",
                        "validationType": "number"
                }, {
                        "fieldName": "Field_3",
                        "validationType": "text"
                }, {
                        "fieldName": "Field_4",
                        "validationType": "text"
                }, {
                        "fieldName": "Field_5",
                        "validationType": "text"
                }, {
                        "fieldName": "Field_6",
                        "validationType": "text"
                }, {
                        "fieldName": "Field_7",
                        "validationType": "text"
                }, {
                        "fieldName": "Field_8",
                        "validationType": "text"
                }, {
                        "fieldName": "Field_9",
                        "validationType": "text"
                }, {
                        "fieldName": "Field_10",
                        "validationType": "number"
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
		case 'File_2':
			$struct_format = $structure_2;
			break;
		case 'File_3':
			$struct_format = $structure_3;
			break;
		case 'File_4':
			$struct_format = $structure_4;
			break;
		default:
			$struct_format = "";
	}

	echo $struct_format;
?>