<?php
class Config {
	/**
	 * get the menu
	 *
	 * @static
	 * @access public
	 * @return array
	 */
	public static function getMenuItems() {
		return array(
			'Home' => 'home',
			'Hersteldienst' => 'hersteldienst',
			'Verkoop' => 'verkoop',
			'Digitaal Tv' => 'digitaaltv',
			'Contact' => 'contact',
			'Links' => 'links',
			//'About' => 'about'
		);
	}
}
