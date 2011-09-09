<?php
/**
 * single point of entry pls
 */
require_once('init.php');

function moved_permanently($url) {
	header('HTTP/1.0 301 Moved Permanently');
	header('Location: '.BASEPATH.'/'.$url);
}

/** CATCH AND REDIRECT OLD LINKS */
if(!empty($_GET) && !empty($_GET['menu'])) {
	switch($_GET['menu']) {
	case 'home':
		moved_permanently('home');
		break;
	case 'hersteldienst':
		moved_permanently('hersteldienst');
		break;
	case 'verkoop':
		moved_permanently('verkoop');
		break;
	case 'digitaal_tv':
		moved_permanently('digitaaltv');
		break;
	case 'contact':
		moved_permanently('contact');
		break;
	case 'links':
		moved_permanently('links');
		break;
	default:
		moved_permanently(null);
		break;
	}
	exit;
} elseif(!empty($_GET) && !empty($_GET['contact'])) {
	switch($_GET['contact']) {
	case 'route':
		moved_permanently('contact/route');
		break;
	case 'mail':
		moved_permanently('contact/email');
		break;
	default:
		moved_permanently('contact');
		break;
	}
	exit;
}

$page = new Page(AJAX, DEFAULTPAGE, BASEPATH);

$page->addModule(new Modules_SimpleMenu($page->getDocument(), BASEPATH, Config::getMenuItems()));

echo $page;
