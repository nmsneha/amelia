<?php
function create_cookie_with_samesite($name, $value, array $options) {
	$header = 'Set-Cookie:';
	$header .= rawurlencode($name) . '=' . rawurlencode($value) . ';';

	if (!empty($options['expires']) && $options['expires'] > 0) {
		$header .= 'expires=' . \gmdate('D, d-M-Y H:i:s T', (int) $options['expires']) . ';';
		$header .= 'Max-Age=' . max(0, (int) ($options['expires'] - time())) . ';';
	}

	//$header .= 'path="/"';
	$header .= 'path=' . rawurlencode($options['path']). ';';
	$header .= 'domain=wordpress-195737-2866416.cloudwaysapps.com;';

	if (!empty($options['secure'])) {
		$header .= 'secure;';
	}
	$header .= 'httponly;';
	$header .= 'SameSite=' . rawurlencode($options['samesite']);

	header($header, false);
	$_COOKIE[$name] = $value;
}


$external_token='';
if (isset($_POST['external_token'])) {
	$external_token = $_POST['external_token'];
}

$bridge_token = base64_encode( get_option( 'oliver_pos_subscription_email' ) . ':' . get_option( 'oliver_pos_subscription_token' ) );
if($bridge_token==$external_token){
	//'expires' => time() + 24 * 60 * 60,
	$cst_base_options = [
			'expires' => time() + 120,
			'domain' => 'wordpress-195737-2866416.cloudwaysapps.com',
			'httponly' => true,
			'samesite' => 'None',
		];
	create_cookie_with_samesite( 'show_amelia_only', $external_token, $cst_base_options + ['secure' => true, 'path' => '/']);

	$username = "testuser";
	$user = get_user_by('login',$username);
	$user_id = $user->ID;
	$user_login = $user->login;
	wp_set_current_user( $user_id, $user_login );
	wp_set_auth_cookie( $user_id );
	$redirect_to_url = home_url().'/wp-admin/admin.php?page=wpamelia-dashboard#/dashboard/';
	header("Location: $redirect_to_url"); 
}
else{
	
	$redirect_to_url = home_url().'/wp-admin';	
	header("Location: $redirect_to_url"); 
}
?>