<?php
/**
 * simple loginbox :: username, password
 *
 * @uses AModules
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Modules_LoginBox extends AModules {
	protected $document;

	protected $pageTypes = array(
		IPages::XHTML
	);

	protected $id = 'login';

	/**
	 * create module and pass the needed paramters to it
	 *
	 * @param mixed $document
	 * @access public
	 * @return void
	 */
	public function __construct(&$document) {
		$this->document = $document;
	}

	/**
	 * create the loginbox before the content is generated
	 *
	 * @access public
	 * @return void
	 */
	public function beforeContent() {
		$loginbox = $this->document->getElementById($this->id);
		if($loginbox) {
			$this->document->addCss('public/css/login.css');
			$loginbox->removeAttribute('style');
			if(isset(Session::sess()->user)) {
				$logoutForm = $this->document->createElement('form');
				$logoutForm->setAttribute('method', 'post');

				$logoutSubmit = $this->document->createElement('input');
				$logoutSubmit->setAttribute('type', 'submit');
				$logoutSubmit->setAttribute('name', 'logTheUserOut');
				$logoutSubmit->setAttribute('value', 'logout');
				$logoutForm->appendChild($logoutSubmit);

				$logoutName = $this->document->createElement('input');
				$logoutName->setAttribute('type', 'text');
				$logoutName->setAttribute('value', 'Welcome: '.Session::sess()->user->displayName);
				$logoutName->setAttribute('disabled', 'disabled');
				$logoutName->setAttribute('class', 'loggedInMessage');
				$logoutForm->appendChild($logoutName);

				$loginbox->appendChild($logoutForm);
			} else {
				$loginForm = $this->document->createElement('form');
				$loginForm->setAttribute('method', 'post');

				$loginName = $this->document->createElement('input');
				$loginName->setAttribute('type', 'text');
				$loginName->setAttribute('name', 'userName');
				$loginForm->appendChild($loginName);

				$loginPass = $this->document->createElement('input');
				$loginPass->setAttribute('type', 'password');
				$loginPass->setAttribute('name', 'userPass');
				$loginForm->appendChild($loginPass);

				$loginSubmit = $this->document->createElement('input');
				$loginSubmit->setAttribute('type', 'submit');
				$loginSubmit->setAttribute('name', 'logTheUserIn');
				$loginSubmit->setAttribute('value', 'login');
				$loginForm->appendChild($loginSubmit);

				$loginbox->appendChild($loginForm);
			}
		}
	}
}
