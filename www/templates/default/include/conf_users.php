<?php 

include('configuration-menu.php');

echo '<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-10 col-xs-offset-2">';
echo '<div class="center"><h2>'._('Users configuration').'</h2></div>';
echo '
	 <div class="btn-group btn-group-greenleaf block-right">
		<button type="button" class="btn btn-greenleaf" onclick="PopupNewUser()"><span class="fa fa-user-plus" aria-hidden="true"></span> '._('New user').'</button>
	</div><br/><br/>';

echo '<table class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th class="center">'._('Lastname').'</th>
					<th class="center">'._('Firstname').'</th>
					<th class="center">'._('Username').'</th>
					<th class="center">'._('Activity').'</th>
				</tr>
			</thead>
			 <tbody>';
			foreach($listuser as $elem){
				echo '	<tr>
							<td>'.$elem->lastname.'</td>
							<td>'.$elem->firstname.'</td>
							<td>'.$elem->username.'</td>
							<td>';
								if ($elem->activity == 0){
									echo _('Never');
								}else{
									echo $request->date($elem->activity + $time, 3);
								}
							echo '</td><td class="center">
									<a href="/conf_users/'.$elem->mcuser_id.'" class="btn btn-primary" title="'._('Edit').'">
										<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									</a>';
								if ($currentuser != $elem->mcuser_id){
									if ($elem->mcuser_level == 1){
									echo '
										<a class="btn btn-warning" href="/conf_users/'.$elem->mcuser_id.'/'.$elem->mcuser_level.'" title="'._('Permissions').'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>';
									}
									else {
										echo '
										<a class="btn btn-invisible" href="/conf_users/'.$elem->mcuser_id.'/'.$elem->mcuser_level.'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>';
									}
									echo'
										<button type="button" title="'._('Delete').'" id="" class="btn btn-danger" onclick="PopupDeleteUser('.$elem->mcuser_id.')">
											<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
										</button>';
								}else {
									echo '
									<a class="btn btn-invisible" href="/conf_users/'.$elem->mcuser_id.'/'.$elem->mcuser_level.'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
									<button type="button" class="btn btn-invisible" onclick="">
										<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
									</button>';
								}
						echo '</td>
						</tr>';
			}
	echo	'</tbody>
		</table>';

echo '</div>
		
<script type="text/javascript">

$(document).ready(function(){
	activateMenuElem(\'users\');
});

function PopupNewUser(){
		
	$.ajax({
		type:"GET",
		url: "/templates/'.TEMPLATE.'/popup/popup_new_user.php",
		success: function(msg) {
			BootstrapDialog.show({
				title: "'._('New user').'",
				message: msg
			});
		}
	});
}

function PopupDeleteUser(iduser){
		
	$.ajax({
		type:"GET",
		url: "/templates/'.TEMPLATE.'/popup/popup_delete_user.php",
		data: "iduser="+iduser,
		success: function(msg) {
			BootstrapDialog.show({
				title: "'._('Delete user').'",
				message: msg
			});
		}
	});
}

function NewUser(){
	var username = $("#newusername").val();
	var password = $("#newpassword").val();
	var lastname = $("#newlastname").val();
	var firstname = $("#newfirstname").val();
	
	$.ajax({
		type:"GET",
		url: "/form/form_user_new.php",
		data: "username="+encodeURIComponent(username)+
		"&password="+encodeURIComponent(password)+"&lastname="+encodeURIComponent(lastname)+
		"&firstname="+encodeURIComponent(firstname),
		success : function(result) {
			if (result != "0"){
				location.href="/conf_users/"+result;
			}else{
				$("#signerr").show();
			}
		},
		error : function(result, status) {
			location.href=\'/conf_users\';
		}
	});		
}

function DeleteUser(iduser){
	
	$.ajax({
		type:"GET",
		url: "/form/form_remove_user.php",
		data: "iduser="+iduser,
		complete: function(result, status) {
			location.href=\'/conf_users\';
		}
	});				
}
</script>';

?>