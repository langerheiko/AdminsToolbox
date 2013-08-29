<?php

require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ). DIRECTORY_SEPARATOR . 'core.php';
form_security_validate( 'manage_proj_user_remove' );

$f_user_id		= gpc_get_int( 'user_id' );
$f_project_id		= gpc_get_int( 'project_id' );
$f_access_level		= gpc_get_int( 'access_level' );

# We should check both since we are in the project section and an
#  admin might raise the first threshold and not realize they need
#  to raise the second
access_ensure_project_level( config_get( 'manage_project_threshold' ), $f_project_id );
access_ensure_project_level( config_get( 'project_user_threshold' ), $f_project_id );

project_remove_user( $f_project_id, $f_user_id );
project_add_user( $f_project_id, $f_user_id, $f_access_level );
	
echo "done";
/*
if($f_user_passw) {
	user_set_password($f_user_id, $f_user_passw);
	echo "New password set for user_id ".$f_user_id;
} else {
	echo "Cannot set no password!";
}
*/
