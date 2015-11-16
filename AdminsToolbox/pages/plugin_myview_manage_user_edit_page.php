<?php

function print_user_get_assigned_open_bugs( $p_user_id ) {
	$t_bug_table = db_get_table( 'mantis_bug_table' );
	$t_category_table = db_get_table( 'mantis_category_table' );
	$t_project_table = db_get_table( 'mantis_project_table' );

	$t_resolved = config_get( 'bug_resolved_status_threshold' );

	$p_output = '<tr><td class="form-title" colspan="3">'.plugin_lang_get( 'assigned_issues' ).'</td>';
	$p_output .= '<td style="text-align:right"><a href="view_all_set.php?type=1&temporary=y&handler_id='.$p_user_id.'&hide_status='.$t_resolved.'">'.plugin_lang_get( 'view_issues_filter' ).'</a></td></tr>';
	$p_output .= '<tr class="row-category"><td>ID</td><td>'.lang_get( 'project_name' ).'</td><td>'.lang_get( 'category' ).'</td><td>'.lang_get( 'summary' ).'</td></tr>';
	
	$query = "SELECT b.id, b.project_id, p.name as project, b.status, b.summary, b.category_id, c.name as category 
			FROM $t_bug_table AS b 
				JOIN $t_project_table AS p ON (p.id=b.project_id) 
				JOIN $t_category_table AS c ON (c.id=b.category_id)
			WHERE 
   				b.status<'$t_resolved'
   				AND b.handler_id=" . db_param()."
			ORDER BY b.id ASC";

	$result = db_query_bound( $query, Array( $p_user_id ) );
	$count = db_num_rows( $result );
	for( $i = 0;$i < $count;$i++ ) {
		$row = db_fetch_array( $result );
		//$p_output .= '<tr '.helper_alternate_class( ).'>';		
		$p_output .= '<tr style="background-color:'.get_status_color( $row['status'] ).';">';		
		$p_output .= '<td>'.string_get_bug_view_link( $row['id'] ).'</td>';
		$p_output .= '<td>'.$row['project'].'</td>';
		$p_output .= '<td>'.$row['category'].'</td>';
		$p_output .= '<td>'.$row['summary'].'</td>';
		$p_output .= '</tr>';		
	}
	return $p_output;
}

$myView = "<script>
$(document).ready(function() {
	//allow admin to set password directly
	//include input for new password
	var frm = $('form[action=\"manage_user_reset.php\"]');
	$('<input type=\"password\" id=\"new_passw\" /><input type=\"submit\" value=\"".plugin_lang_get('change_password')."\" class=\"button\" id=\"submit_newpassw\" />').prependTo(frm);
	
	frm.children('#submit_newpassw').on('click', function(){
		if($('#new_passw').val().length > 5){
		$.post(
			\"plugins/AdminsToolbox/pages/ajax.php\", 
			{user_id: $('input[name=\"user_id\"]').val(),
			 new_passw:$('#new_passw').val(),
			 manage_user_reset_token:$('input[name=\"manage_user_reset_token\"]').val()
			}
		).done(function(data) {
			$('#new_passw').val('');
			alert('".plugin_lang_get('password_success')."');
			console.log(\"Data Loaded: \" + data);
		});
		} else {
			alert('".plugin_lang_get('password_length')."');		
		}		

		return false;
	});

	$('form[action=\"manage_user_delete.php\"]').parent().next()
		.after('<div align=\"center\"><table class=\"width75\"><tbody>".print_user_get_assigned_open_bugs(gpc_get_int('user_id', ''))."</tbody></table></div><br />');
	
});
</script>";
?>
