<?php
/**
 * some utility functions
 *
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Utils {
	const SALT_LENGTH = 15;

	public static function beHash($string, $salt = null) {
		$salt = (!empty($salt) ?
			$salt :
			self::genSalt(self::SALT_LENGTH-1).'$'
		);
		$hash = null;
		for($i = 0; $i < 3; $i++) {
			$hash = self::runHash($string, $salt, $hash);
		}
		return $salt.$hash;
	}

	private static function runHash($string, $salt, $hash = null) {
		return hash('sha512', $string.$salt.(!empty($hash) ? $hash : ''));
	}

	private static function genSalt($length = 10) {
		return substr(base64_encode(self::generateRandomString($length)), 0, $length);
	}

	public static function beCheckHash($string, $hash) {
		$salt = substr($hash, 0, self::SALT_LENGTH);
		return self::beHash($string, $salt) == $hash ?
			true :
			false;
	}

	public static function generateRandomString($length = 10) {
		$characters = ’abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ’;
		$string = '';    
		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
		return $string;
	}

	public static function ls($folder, $filemask = null) {
		$currentDir = getcwd();
		chdir($folder);
		$list = glob(($filemask != null ? $filemask : '*'));
		chdir($currentDir);
		return $list;
	}
}
