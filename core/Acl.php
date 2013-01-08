<?php
/**
 * Simple Access Control List
 *
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Acl {
	private static $instance;

	private static $settings;

	private $role = null;

	/**
	 * create a single instance.
	 *
	 * @access private
	 * @return void
	 */
	private function __construct() {
		$this->setRole();
	}

	/**
	 * disable clone fucntionality because this is a singleton.
	 *
	 * @access private
	 * @return void
	 */
	private function __clone() {}
	
	public static function settings($settings) {
		if(is_array($settings) && empty(self::$settings))
			self::$settings = $settings;
	}

	/**
	 * acl single point of entry.
	 *
	 * @static
	 * @access public
	 * @return Acl
	 */
	public static function acl() {
		if(empty(self::$instance))
			self::$instance = new Acl();

		return self::$instance;
	}

	public function setRole($role = null) {
		if(!empty($role) && in_array($role, self::$settings->roles)) {
			$this->role = $role;
		} else {
			if(is_object(self::$settings)) {
				reset(self::$settings->roles);
				$this->role = self::$settings->default;
			} else {
				$this->role = null;
			}
		}
	}

	public function isAllowed($page = null) {
		if(is_object(self::$settings)) {
			if(isset(self::$settings->resources[$page])) {
				return in_array($this->role, self::$settings->resources[$page]['allow']);
			} else {
				return true;
			}
		} else {
			return true;
		}
	}
}
