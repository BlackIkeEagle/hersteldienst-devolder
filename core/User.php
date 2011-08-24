<?php
/**
 * basic user information
 *
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class User {
	private $username;
	//private $password; // this is not good !!!
	private $email;

	private $surName;
	private $givenName;
	private $displayName;

	public function __construct($userData) {
		if(isset($userData['username']) &&
			//isset($userData['password']) &&
			isset($userData['email'])
		) {
			foreach($userData as $name => $value) {
				$this->__set($name, $value);
			}
		} else {
			throw new Exception('userData does\'nt contain enough data');
		}
	}

	public function __set($name, $value) {
		if(in_array($name, array_keys(get_object_vars($this))))
			$this->{$name} = $value;
	}

	public function __get($name) {
		if(in_array($name, array_keys(get_object_vars($this))))
			return $this->{$name};
		else
			return null;
	}
}
