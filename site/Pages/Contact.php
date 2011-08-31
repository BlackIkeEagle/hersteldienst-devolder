<?php
class Pages_Contact extends APages {

	/**
	 * {@inheritdoc}
	 */
	public function index() {
		if($this->pageType == IPages::XHTML) {
			$this->document->setTitleAppend('contact');
			$this->document->addCss('public/css/contact.css');

			$content = $this->document->getElementById('content');

			$title = $this->document->createElement(
				'h1',
				'Contact'
			);
			$content->appendChild($title);
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

			$content->appendChild($table);

			$titleHours = $this->document->createElement(
				'h2',
				'Openingsuren'
			);
			$content->appendChild($titleHours);
			$hours = $this->document->createElement(
				'p',
				'Ma - Vr: 8.00u tot 20.00u'
			);
			$content->appendChild($hours);
			$hours = $this->document->createElement(
				'p',
				'Za : 8.00u tot 17.30u'
			);
			$content->appendChild($hours);
			$hours = $this->document->createElement(
				'p',
				'Zondag gesloten'
			);
			$content->appendChild($hours);
		}
	}
}
