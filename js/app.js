
/* where magic happens */

$(document).ready(function () {
    var functionClick = "";

    $.ajax({
        url: "app/structure.php",
        type: "get",
        success: function (result) {
            var obj = jQuery.parseJSON(result);
            $.each(obj, function () {

                functionClick = "getStructure('" + this.fileName + "');";
                $("#contentNav").append('<li><a class="nav-link" href="#" onclick=' + functionClick + '>' + this.fileName + '</a></li>');
            });
        },
        error: function (xhr) {
            $("#contentNav").html('Error');
        }
    });
});

function getStructure(fileName) {
	
	$('#mainContainer').hide();

    $("#contentStructure").html('');
    $("#contentStructure").append('<div class="col-md-12"style="margin-bottom:10px"><h4><small>You selected: </small>' + fileName + '</h4></div>');
    $("#contentStructure").append('<div class="col-md-12"><input type="hidden" id="'+fileName+'"  name="'+fileName+'" /></div>');

    $.ajax({
        url: "app/structure.php",
        type: "get",
        data: {
            struct_name: fileName
        },
        success: function (result) {
            var obj = jQuery.parseJSON(result);
            $.each(obj, function () {
                validation = "'" + this.validationType + "'";
                $("#contentStructure").append('<div class="col-md-12"><div class="form-group"><label for="'+this.fieldName+'">' + this.fieldName + '</label><input id="'+this.fieldName+'"  name="'+this.fieldName+'" class="form-control" placeholder="'+this.fieldName+'" type=' + validation + ' /></div></div>');
            });

			$("#contentSupport").html('');
			$('#contentSupport').append('<div class="row">');
			$("#contentSupport").append('<div class="col-md-6"><button id="submit_file_variables" type="submit" class="btn btn-primary">Submit</button></div>');
			$('#contentSupport').append('<div class="col-md-6"><div class="btn-group pull-right" data-toggle="buttons"><label class="btn btn-default active"><input type="radio" name="file_extensions_app_selector" id="file_extensions_app_selector1" value="php" autocomplete="off" checked> .php </label><label class="btn btn-default"><input type="radio" name="file_extensions_app_selector" id="file_extensions_app_selector2" value="env" autocomplete="off"> .env </label></div>');
			$('#contentSupport').append('</div></div>');
        },
		complete: function (result){
			getFileExists(fileName);
			$("#mainContainer").css("background-color", "");
			$('#mainContainer').fadeIn(300);
		},
        error: function (xhr) {
            $("#contentStructure").html('Error');
        }
    });
}

function getFileExists(fileName) {
	
	$("#contentFileExists").html('');

    $.ajax({
        url: "app/file_checker.php",
        type: "get",
        data: {
            file_name: fileName
        },
        success: function (result) {
			var obj = jQuery.parseJSON(result);
			if(obj[0].status == 200){
					functionClick = "getFileJson('" + fileName + "');";
				$('#contentFileExists').append('<div class="col-md-12"><form action="./app/file_reader.php" method="GET"><input type="hidden" id="file_name" name="file_name" value="'+obj[0].file_name+'" /><button type="submit" class="btn btn-default">Show File</button><button type="button" class="btn btn-info" style="margin-left:5px;" onclick="'+functionClick+'">Get Data</button></form></div>');

			}else{
				$('#contentFileExists').append('<div class="col-md-12"><form><button type="submit" class="btn btn-default" disabled="disable">Show File</button><button type="button" class="btn btn-info" style="margin-left:5px;" disabled="disable">Get Data</button></form></div>');
			}
        },
        error: function (xhr) {
            $("#contentFileExists").html('No File Found - Error');
        }
    });
}


function getFileJson(fileName) {
	
	var id = "";
	var value = "";

    $.ajax({
        url: "app/structure.php",
        type: "get",
        data: {
            struct_name: 'json_file_read_app',
			file_name: fileName
        },
        success: function (result) {
			var obj = jQuery.parseJSON(result);
			$.each(obj, function () {
				
				id = "#"+this.fieldName+"";
				value = ""+this.validationValue+"";
				
				$(id).val(value);
			});
        },
        error: function (xhr) {
			/* Do nothing, user don't needs to have anxiety crysis */
        }
    });
}