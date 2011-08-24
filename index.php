<?php
/**
 * single point of entry pls
 */
require_once('init.php');

$page = new Page(AJAX, DEFAULTPAGE, BASEPATH);

$page->addModule(new Modules_SimpleMenu($page->getDocument(), BASEPATH, Config::getMenuItems()));

echo $page;
