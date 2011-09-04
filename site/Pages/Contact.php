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
}
