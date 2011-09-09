<?php
/**
 * Session singleton wrapper, for easier use
 *
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Session {
	private static $instance;

	private $name;
	private $session;

	/**
	 * create a single instance.
	 *
	 * @access private
	 * @return void
	 */
	private function __construct() {
		$this->name = preg_replace('/^[A-Za-z0-9]/', '_', SITE.' '.VERSION.VER_EXT);

		session_start();

		if(isset($_SESSION[$this->name]))
			$this->session = unserialize(gzuncompress(base64_decode($_SESSION[$this->name])));
		else
			$this->session = array();
	}

	/**
	 * save the session data in the session itself.
	 *
	 * @access public
	 * @return void
	 */
	public function __destruct() {
		$_SESSION[$this->name] = base64_encode(gzcompress(serialize($this->session)));
	}

	/**
	 * disable clone fucntionality because this is a singleton.
	 *
	 * @access private
	 * @return void
	 */
	private function __clone() {}

	/**
	 * session single point of entry.
	 *
	 * @static
	 * @access public
	 * @return Session
	 */
	public static function sess() {
		if(empty(self::$instance))
			self::$instance = new Session();

		return self::$instance;
	}

	/**
	 * add stuff to the session.
	 *
	 * @param string $name
	 * @param mixed $value
	 * @access public
	 * @return void
	 */
	public function __set($name, $value) {
		$this->session[$name] = $value;
	}

	/**
	 * get stuff from the session.
	 *
	 * @param string $name
	 * @access public
	 * @return mixed
	 */
	public function __get($name) {
		return $this->session[$name];
	}

	/**
	 * check if the name isset?
	 *
	 * @param string $name
	 * @access public
	 * @return bool
	 */
	public function __isset($name) {
		return isset($this->session[$name]);
	}

	/**
	 * remove stuff from the session.
	 *
	 * @param string $name
	 * @access public
	 * @return void
	 */
	public function __unset($name) {
		unset($this->session[$name]);
	}
}
