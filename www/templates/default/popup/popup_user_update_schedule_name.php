<?php

include('header.php');

if (!empty($_GET['schedule_id'])) {
	echo
		'<div>'.
			'<div id="errorMsg"></div>'.
			'<div class ="center">'._('Please enter the new Schedule name :').'</div>'.
			'<div class="input-group margin-top">'.
				'<label class="input-group-addon left" for="scheduleName">'._('Name').'</label>'.
				'<input id="scheduleName" name="scheduleName" title="'._('schedule Name').'" '.
				'value="" placeholder="Schedule name" type="text" class="form-control">'.
			'</div>'.
		'</div>'.
		'<br/>'.
		'<div class="controls center">'.
			'<button onclick="updateScheduleName()" class="btn btn-success">'.
				''._('Save').''.
				'<span class="glyphicon glyphicon-ok"></span>'.
			'</button> '.
			'<button onclick="popup_close()" class="btn btn-danger">'.
				''._('Close').''.
				'<span class="glyphicon glyphicon-remove"></span>'.
			'</button>'.
		'</div>';
	
	echo
		'<script type="text/javascript">'.
		
			'$("#popupTitle").html("'._("New Schedule").'");'.
			
			'function updateScheduleName() {'.
				'var name = "";'.
				
				'name = $("#scheduleName").val();'.
				'name = name.trim();'.
				
				'$.ajax({'.
					'type: "GET",'.
					'url: "/templates/default/form/form_update_schedule_name.php",'.
					'data: "schedule_id="+'.$_GET['schedule_id'].'+"&schedule_name="+name,'.
					'success: function(result) {'.
						'if (result && result.split("-1")[1]) {'.
							'$("#errorMsg").html(result.split("-1")[1]);'.
						'}'.
						'else if (result) {'.
							'popup_close();'.
							'$("#navbarScheduleName").html(name);'.
						'}'.
					'}'.
				'});'.
			'}'.
			
		'</script>';
}
?>