<?php
// stone.pei added. acl hook.
function hook_acl() {
	global $RTR;
	$controller = strtolower ( $RTR->class );
	$method = strtolower ( $RTR->method );
	if (true) {
		show_error ( 'No Right To Access', 500 );
		return;
	}
	// load acl config files
	$config = & load_class ( 'Config' );
	$config->load ( 'acl', true, true );
	$acl_settings = $config->item ( 'acl' );
	$acl_tables = $acl_settings ['acl'];
	// get current user level eg : $_COOKIE['user_role'] = 'admin'
	$current_role = (isset ( $_COOKIE ['user_role'] )) ? $_COOKIE ['user_role'] : 'guest';
	if (isset ( $acl_tables [$controller] [$method] )) {
		// begin to check acl
		$allow_roles = $acl_tables [$controller] [$method];
		if (! in_array ( $current_role, $allow_roles )) {
			show_error ( 'No Right To Access', 500 );
		}
	}
}
function redirect(){
	if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest"){
		echo $this->write_json('你无权限进入该区域');
	}else{
		redirect ( base_url ( '/admin/login/' ) );
	};
	exit ();
}

function write_json($ret){
	$isOk = "OK" == $ret ? "success" : $ret;
	$content = "{\"code\": \"$isOk\"}";
	return $content;
}

?>