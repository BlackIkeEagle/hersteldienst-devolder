<?php
class Pages_Digitaaltv extends APages {

	/**
	 * {@inheritdoc}
	 */
	public function init() {
		$this->data = new Data_Digitaaltv();
	}

	/**
	 * {@inheritdoc}
	 */
	public function index() {
		if($this->pageType == IPages::XHTML) {
			$this->document->setTitleAppend('digitaal tv');
			$this->document->addCss('public/css/digitaaltv.css');

			$content = $this->document->getElementById('content');

			$title = $this->document->createElement(
				'h1',
				'Digitaal Tv'
			);
			$content->appendChild($title);

			$text = $this->document->createElement(
				'p',
				'Genieten van uw televisie en film met nooit geziene beeld- en geluidskwaliteit.'
			);
			$content->appendChild($text);

			$head = $this->document->createElement(
				'h2',
				'Satelliet'
			);
			$content->appendChild($head);
			$text = $this->document->createElement(
				'p',
				'Dankzij deze rechtstreekse verbinding en de DVB-technologie (Digital Video Broadcasting) die wordt gebruikt, heeft digitale televisie via de satelliet dus via een superieure beeld- en geluidskwaliteit. Zeker in combinatie met een LCD- of Plasmascherm krijgt u een prachtig resultaat, maar ook met uw gewone televisie zult u versteld staan van het perfecte beeld.'
			);
			$content->appendChild($text);
			$suppliers = $this->document->createElement('div');
			$suppliers->setAttribute('class', 'suppliers');
			$this->suppliersList($suppliers, $this->data->getSuppliersSatellite());
			$content->appendChild($suppliers);

			$head = $this->document->createElement(
				'h2',
				'Kabel, Telefoon'
			);
			$content->appendChild($head);
			$text = $this->document->createElement(
				'p',
				'Via de vaste telefoonlijn of uw vaste kabel tv kijken in fantastische kwaliteit.'
			);
			$content->appendChild($text);
			$suppliers = $this->document->createElement('div');
			$suppliers->setAttribute('class', 'suppliers');
			$this->suppliersList($suppliers, $this->data->getSuppliersCable());
			$content->appendChild($suppliers);
		}
	}

	private function suppliersList(&$suppliersBox, $suppliersData) {
		foreach($suppliersData as $supplier) {
			$link = $this->document->createElement('a');
			$link->setAttribute('href', $supplier['url']);
			$link->setAttribute('rel', 'external');
			$link->setAttribute('target', '_blank'); // non valid but works very fine
			$link->setAttribute('title', $supplier['name']);
			$image = $this->document->createElement('img');
			$image->setAttribute('src', 'public/images/'.$supplier['logo']);
			$image->setAttribute('alt', $supplier['name']);
			$link->appendChild($image);
			$suppliersBox->appendChild($link);
		}
	}
}
