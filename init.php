<?php
// {{{ SITE DEFINITION
define('SITE', 'Audio Video Ktv Hersteldienst Luc Devolder');
define('VERSION', '2.0');
define('VER_EXT', 'Alpha');
define('COPYRIGHT', '&copy; 2006 - '.date('Y').' '.SITE);

define('CREATOR', 'Ike Devolder <ike DOT devolder AT gmail DOT com>');
$contributors = array(
);
if(VER_EXT !== '') {
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
}
define('DEFAULTPAGE', 'home');
define('BASEPATH', str_replace("\\", "/", str_replace(realpath($_SERVER['DOCUMENT_ROOT']), '', realpath('./'))));
// }}}

// {{{ AUTOLOADER
function autoload($classname) {
	if(!class_exists($classname, false)) {
		$classPath = str_replace('_', '/', $classname).'.php';
		if(file_exists('site/'.$classPath))
			@include('site/'.$classPath);
		elseif(file_exists('core/'.$classPath))
			@include('core/'.$classPath);
	}
}
spl_autoload_register('autoload');
// }}}

// {{{ SESSION
Session::sess();
// }}}

// {{{ DETECT AJAX
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
) {
	define('AJAX', true);
} else {
	define('AJAX', false);
}
// }}}
