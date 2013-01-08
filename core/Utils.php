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

	/**
	 * Validate an email address.
	 * Provide email address (raw input)
	 * Returns true if the email address has the email
	 * address format and the domain exists.
	 *
	 * http://www.linuxjournal.com/article/9585
	 *
	 * @param string $email
	 * @static
	 * @access public
	 * @return void
	 */
	public static function validEmailAddress($email) {
		$isValid = true;
		$atIndex = strrpos($email, "@");
		if (is_bool($atIndex) && !$atIndex) {
			$isValid = false;
		} else {
			$domain = substr($email, $atIndex+1);
			$local = substr($email, 0, $atIndex);
			$localLen = strlen($local);
			$domainLen = strlen($domain);
			if ($localLen < 1 || $localLen > 64) {
				// local part length exceeded
				$isValid = false;
			} elseif ($domainLen < 1 || $domainLen > 255) {
				// domain part length exceeded
				$isValid = false;
			} elseif ($local[0] == '.' || $local[$localLen-1] == '.') {
				// local part starts or ends with '.'
				$isValid = false;
			} elseif (preg_match('/\\.\\./', $local)) {
				// local part has two consecutive dots
				$isValid = false;
			} elseif (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
				// character not valid in domain part
				$isValid = false;
			} elseif (preg_match('/\\.\\./', $domain)) {
				// domain part has two consecutive dots
				$isValid = false;
			} elseif (
				!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
				str_replace("\\\\","",$local))
			) {
				// character not valid in local part unless
				// local part is quoted
				if (
					!preg_match('/^"(\\\\"|[^"])+"$/',
					str_replace("\\\\","",$local))
				) {
					$isValid = false;
				}
			}

			if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
				// domain not found in DNS
				$isValid = false;
			}
		}
		return $isValid;
	}
}
