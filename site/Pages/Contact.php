<?php
class Pages_Contact extends APages {
	private $content;

	public function init() {
		if($this->pageType == IPages::XHTML) {
			$this->document->setTitleAppend('contact');
			$this->document->addCss('public/css/contact.css');
			$this->content = $this->document->getElementById('content');
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function index() {
		if($this->pageType == IPages::XHTML) {
			$title = $this->document->createElement(
				'h1',
				'Contact'
			);
			$this->content->appendChild($title);
			$table = $this->document->createElement('table');

			$row = $this->document->createElement('tr');
			$element = $this->document->createElement('td', 'Audio Video Ktv Hersteldienst Luc Devolder');
			$element->setAttribute('colspan', 2);
			$row->appendChild($element);
			$table->appendChild($row);

			$row = $this->document->createElement('tr');
			$element = $this->document->createElement('td', 'Pieter Paul Rubensstraat 11');
			$element->setAttribute('colspan', 2);
			$row->appendChild($element);
			$table->appendChild($row);

			$row = $this->document->createElement('tr');
			$element = $this->document->createElement('td', '8020 Oostkamp');
			$element->setAttribute('colspan', 2);
			$row->appendChild($element);
			$table->appendChild($row);

			$row = $this->document->createElement('tr');
			$element = $this->document->createElement('td', 'Ondernemingsnummer :');
			$element->setAttribute('class', 'lbl');
			$row->appendChild($element);
			$element = $this->document->createElement('td', '0673 150 504');
			$row->appendChild($element);
			$table->appendChild($row);

			$row = $this->document->createElement('tr');
			$element = $this->document->createElement('td', 'Btw-nummer :');
			$element->setAttribute('class', 'lbl');
			$row->appendChild($element);
			$element = $this->document->createElement('td', 'BE 0673 150 504');
			$row->appendChild($element);
			$table->appendChild($row);

			$row = $this->document->createElement('tr');
			$element = $this->document->createElement('td', 'telefoon :');
			$element->setAttribute('class', 'lbl');
			$row->appendChild($element);
			$element = $this->document->createElement('td', '+32 (0)50 82 49 19');
			$row->appendChild($element);
			$table->appendChild($row);

			$this->content->appendChild($table);

			$links = $this->document->createElement('p');
			$routeLink = $this->document->createElement('a', 'route');
			$routeLink->setAttribute('href', $this->basepath.'/contact/route');
			$routeLink->setAttribute('title', 'route');
			$links->appendChild($routeLink);
			$mailLink = $this->document->createElement('a', 'email');
			$mailLink->setAttribute('href', $this->basepath.'/contact/email');
			$mailLink->setAttribute('title', 'email');
			$mailLink->setAttribute('style', 'margin-left: 10px');
			$links->appendChild($mailLink);
			$this->content->appendChild($links);

			$titleHours = $this->document->createElement(
				'h2',
				'Openingsuren'
			);
			$this->content->appendChild($titleHours);
			$hours = $this->document->createElement(
				'p',
				'Ma - Vr: 8.00u tot 20.00u'
			);
			$this->content->appendChild($hours);
			$hours = $this->document->createElement(
				'p',
				'Za : 8.00u tot 17.30u'
			);
			$this->content->appendChild($hours);
			$hours = $this->document->createElement(
				'p',
				'Zondag gesloten'
			);
			$this->content->appendChild($hours);
		}
	}

	public function route() {
		if($this->pageType == IPages::XHTML) {
			$this->document->setTitleAppend($this->document->getTitleAppend().' - route');
			$title = $this->document->createElement(
				'h1',
				'Route'
			);
			$this->content->appendChild($title);

			$googleContent = $this->document->createElement('iframe');
			$googleContent->setAttribute('width', 780);
			$googleContent->setAttribute('height', 600);
			$googleContent->setAttribute('frameborder', 0);
			$googleContent->setAttribute('scrolling', 'no');
			$googleContent->setAttribute('marginheight', 0);
			$googleContent->setAttribute('marginwidth', 0);
			$googleContent->setAttribute('src', 'http://maps.google.be/maps?f=q&source=s_q&hl=nl&geocode=&q=11+Pieter+Paul+Rubensstraat,+Oostkamp,+Vlaams+Gewest&aq=t&sll=51.137552,3.228425&sspn=0.011646,0.03298&vpsrc=0&ie=UTF8&hq=&hnear=Pieter+Paul+Rubensstraat+11,+8020+Oostkamp,+West-Vlaanderen,+Vlaams+Gewest&ll=51.137571,3.228436&spn=0.026927,0.066948&z=14&iwloc=A&output=embed');
			$this->content->appendChild($googleContent);
			//$googleContent = $this->document->createElement('small');
			//$googleLink = $this->document->createElement('a', 'Grotere kaart weergeven');
			//$googleLink->setAttribute('href', 'http://maps.google.be/maps?f=q&source=embed&hl=nl&geocode=&q=11+Pieter+Paul+Rubensstraat,+Oostkamp,+Vlaams+Gewest&aq=1&sll=50.805935,4.432983&sspn=6.006454,16.885986&vpsrc=0&ie=UTF8&hq=&hnear=Pieter+Paul+Rubensstraat+11,+8020+Oostkamp,+West-Vlaanderen,+Vlaams+Gewest&z=14&ll=51.137552,3.228425');
			//$googleLink->setAttribute('style', 'color:#0000FF;text-align:left');
			//$googleContent->appendChild($googleLink);
			//$this->content->appendChild($googleContent);
		}
	}

	public function email() {
		if($this->pageType == IPages::XHTML) {
			$this->document->setTitleAppend($this->document->getTitleAppend().' - email');
			$title = $this->document->createElement(
				'h1',
				'Email'
			);
			$this->content->appendChild($title);

			$mailForm = $this->document->createElement('form');
			$mailForm->setAttribute('method', 'post');
			$mailForm->setAttribute('action', $this->basepath.'/contact/sendmail');

			$mailTable = $this->document->createElement('table');

			$mailRow = $this->document->createElement('tr');
			$mailElement = $this->document->createElement('td', 'naam:');
			if(isset(Session::sess()->mailSend) && !isset(Session::sess()->mailSend->name))
				$mailElement->setAttribute('class', 'wrong');
			$mailRow->appendChild($mailElement);
			$mailElement = $this->document->createElement('td');
			$mailInput = $this->document->createElement('input');
			$mailInput->setAttribute('type', 'text');
			$mailInput->setAttribute('name', 'naam');
			if(isset(Session::sess()->mailSend) && isset(Session::sess()->mailSend->name))
				$mailInput->setAttribute('value', Session::sess()->mailSend->name);
			$mailElement->appendChild($mailInput);
			$mailRow->appendChild($mailElement);

			$mailTable->appendChild($mailRow);

			$mailRow = $this->document->createElement('tr');
			$mailElement = $this->document->createElement('td', 'telefoon:');
			if(isset(Session::sess()->mailSend) && !isset(Session::sess()->mailSend->tel))
				$mailElement->setAttribute('class', 'wrong');
			$mailRow->appendChild($mailElement);
			$mailElement = $this->document->createElement('td');
			$mailInput = $this->document->createElement('input');
			$mailInput->setAttribute('type', 'text');
			$mailInput->setAttribute('name', 'tel');
			if(isset(Session::sess()->mailSend) && isset(Session::sess()->mailSend->tel))
				$mailInput->setAttribute('value', Session::sess()->mailSend->tel);
			$mailElement->appendChild($mailInput);
			$mailRow->appendChild($mailElement);

			$mailTable->appendChild($mailRow);

			$mailRow = $this->document->createElement('tr');
			$mailElement = $this->document->createElement('td', 'email:');
			if(isset(Session::sess()->mailSend) && !isset(Session::sess()->mailSend->email))
				$mailElement->setAttribute('class', 'wrong');
			$mailRow->appendChild($mailElement);
			$mailElement = $this->document->createElement('td');
			$mailInput = $this->document->createElement('input');
			$mailInput->setAttribute('type', 'text');
			$mailInput->setAttribute('name', 'email');
			if(isset(Session::sess()->mailSend) && isset(Session::sess()->mailSend->email))
				$mailInput->setAttribute('value', Session::sess()->mailSend->email);
			$mailElement->appendChild($mailInput);
			$mailRow->appendChild($mailElement);

			$mailTable->appendChild($mailRow);

			$mailRow = $this->document->createElement('tr');
			$mailElement = $this->document->createElement('td', 'bericht:');
			if(isset(Session::sess()->mailSend) && !isset(Session::sess()->mailSend->message))
				$mailElement->setAttribute('class', 'wrong');
			$mailRow->appendChild($mailElement);
			$mailElement = $this->document->createElement('td');
			if(isset(Session::sess()->mailSend) && isset(Session::sess()->mailSend->message))
				$mailInput = $this->document->createElement('textarea', Session::sess()->mailSend->message);
			else
				$mailInput = $this->document->createElement('textarea');
			$mailInput->setAttribute('name', 'bericht');
			$mailInput->setAttribute('cols', 90);
			$mailInput->setAttribute('rows', 15);
			$mailElement->appendChild($mailInput);
			$mailRow->appendChild($mailElement);

			$mailTable->appendChild($mailRow);

			$mailRow = $this->document->createElement('tr');
			$mailElement = $this->document->createElement('td');
			$mailInput = $this->document->createElement('input');
			$mailInput->setAttribute('type', 'submit');
			$mailInput->setAttribute('name', 'sendMail');
			$mailInput->setAttribute('value', 'verzend');
			$mailElement->appendChild($mailInput);
			$mailRow->appendChild($mailElement);
			$mailElement = $this->document->createElement('td');
			$mailInput = $this->document->createElement('input');
			$mailInput->setAttribute('type', 'reset');
			$mailInput->setAttribute('value', 'leegmaken');
			$mailElement->appendChild($mailInput);
			$mailRow->appendChild($mailElement);

			$mailTable->appendChild($mailRow);

			$mailForm->appendChild($mailTable);

			$this->content->appendChild($mailForm);
			Session::sess()->canSendMail = 'yes';
		}
	}

	public function sendmail() {
		if(isset(Session::sess()->canSendMail) && Session::sess()->canSendMail == 'yes') {
			unset(Session::sess()->canSendMail);
			if(isset(Session::sess()->mailSend))
				unset(Session::sess()->mailSend);

			Session::sess()->mailSend = new stdClass();

			if(isset($_POST['sendMail']) && $_POST['sendMail'] == 'verzend') {
				if(!empty($_POST['naam']))
					Session::sess()->mailSend->name = $_POST['naam'];

				if(!empty($_POST['tel']) && is_numeric($_POST['tel']))
					Session::sess()->mailSend->tel = $_POST['tel'];

				if(!empty($_POST['email']) && Utils::validEmailAddress($_POST['email']))
					Session::sess()->mailSend->email = $_POST['email'];

				if(!empty($_POST['bericht']))
					Session::sess()->mailSend->message = $_POST['bericht'];

				if(isset(Session::sess()->mailSend->name) &&
					isset(Session::sess()->mailSend->tel) &&
					isset(Session::sess()->mailSend->email) &&
					isset(Session::sess()->mailSend->message)
				) {
					$mailHersteldienst = 'info@hersteldienst-devolder.be';
					//send the mail
					$toHerst = array();
					$toClient = array();

					$toHerst['to'] = $mailHersteldienst;
					$toHerst['from'] = Session::sess()->mailSend->email;
					$toHerst['subject'] = 'info hersteldienst Devolder';
					$toHerst['message'] = 'info aanvraag hersteldienst devolder'."\n".
						'-------------------------------------------------------------------------------'."\n\n".
						'van   : '.Session::sess()->mailSend->name."\n".
						'email : '.Session::sess()->mailSend->email."\n".
						'tel   : '.Session::sess()->mailSend->tel."\n".
						"\n\n".
						wordwrap(Session::sess()->mailSend->message, 79).
						"\n\n".
						'-------------------------------------------------------------------------------'."\n".
						'Audio Video Ktv Hersteldienst Luc Devolder'."\n".
						'Pieter Paul Rubensstraat 11'."\n".
						'8020 Oostkamp'."\n".
						'tel : +32 (0)50 82 49 19'."\n".
						'btw : BE 0673 150 504'."\n".
						'www.hersteldienst-devolder.be';
					$toHerst['header'] = 'FROM: '.Session::sess()->mailSend->email."\r\n".
						'Reply-To: '.Session::sess()->mailSend->email."\r\n".
						'X-Mailer: HersteldienstDevolder';

					$toClient['to'] = $toHerst['from'];
					$toClient['from'] = $toHerst['to'];
					$toClient['subject'] = $toHerst['subject'];
					$toClient['message'] = $toHerst['message'];
					$toClient['header'] = 'FROM: '.$mailHersteldienst."\r\n".
						'Reply-To: '.$mailHersteldienst."\r\n".
						'X-Mailer: HersteldienstDevolder';

					if(mail($toHerst['to'], $toHerst['subject'], $toHerst['message'], $toHerst['header']) &&
						mail($toClient['to'], $toClient['subject'], $toClient['message'], $toClient['header'])) {
							unset(Session::sess()->mailSend);
							header('Location: '.$this->basepath.'/contact');
						} else {
							if($this->pageType == IPages::XHTML) {
								$this->document->setTitleAppend($this->document->getTitleAppend().' - email');
								$title = $this->document->createElement(
									'h1',
									'Email'
								);
								$this->content->appendChild($title);

								$sorry = $this->document->createElement('p', 'Het verzenden van de mail is mislukt, probeer nog eens opnieuw');
								$sorry->setAttribute('class', 'error message');

								$this->content->appendChild($sorry);
							}
						}
				} else {
					header('Location: '.$this->basepath.'/contact/email');
				}
			}
		} else {
			if($this->pageType == IPages::XHTML) {
				$this->document->setTitleAppend($this->document->getTitleAppend().' - email');
				$title = $this->document->createElement(
					'h1',
					'Email'
				);
				$this->content->appendChild($title);

				$sorry = $this->document->createElement('p', 'Sorry maar u kan geen mail verzenden, controlleer of u alle correcte stappen hebt doorlopen om een mail te versturen naar Hersteldienst Devolder');
				$sorry->setAttribute('class', 'error message');

				$this->content->appendChild($sorry);
			}
		}
	}
}
