<?php
session_start();
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'db' => 'allsaintschapelDB'

	),
	'remember' => array(
		'cookie_name' => 'chapelMembers',
		'cookie_expiry' => '604800'
	),
	'session' => array(
		'session_admin' => 'chaplainIncharge',
		'session_members' => 'chapelMembers',
		'token_name' => 'token'
	)
);

//APP ROOT
define('APPROOT', dirname(dirname(__FILE__)));

//URL ROOT

define('URLROOT', 'https://localhost/allsaintschapel/');

//SITE NAME
define('SITENAME', 'ALL SAINTS CHAPEL');
define('APPVERSION', '1.0.0');
define('ADMIN', 'CONTROL ROOM');
define('NAVNAME', 'ASC');
define('DASHBOARD', 'ACS Panel');


//Instantiation and passing `true` enables exceptions


spl_autoload_register(function ($class) {
	require_once(APPROOT . '/classes/' . $class . '.php');
});


require_once(APPROOT . '/helpers/session_helper.php');
require_once(APPROOT . '/helpers/session.php');
