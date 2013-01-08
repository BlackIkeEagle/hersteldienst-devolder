<?php
/**
 * auth module.
 *
 * @uses AModules
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Modules_Auth extends AModules {
	protected $pageTypes = 'all';

	public function onEntry() {
		global $cookie_found;
		if(isset($_POST['logTheUserOut'])) {
			unset(Session::sess()->user);
			header('Location: '.BASEPATH.'/'.DEFAULTPAGE);
			exit;
		} elseif(isset($_POST['logTheUserIn']) &&
			!empty($_POST['userName']) &&
			!empty($_POST['userPass']) &&
			!isset(Session::sess()->user)
		) {
			$userData = new Data_User(Data_User::LDAP, $_POST['userName'], $_POST['userPass']);
			Session::sess()->user = $userData->getUser();
		}

		if(isset(Session::sess()->user)) {
			Acl::acl()->setRole(Session::sess()->user->role);
		} else {
			Acl::acl()->setRole();
		}
	}
}
