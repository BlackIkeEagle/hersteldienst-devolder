<?php
class Pages_Links extends APages {
	private $data;

	/**
	 * {@inheritdoc}
	 */
	public function init() {
		$this->data = new Data_Links();
	}

	public function index() {
		if($this->pageType == IPages::XHTML) {
			$this->document->setTitleAppend('links');
			$this->document->addCss('public/css/verkoop.css');
			$content = $this->document->getElementById('content');

			$title = $this->document->createElement(
				'h1',
				'Links'
			);
			$content->appendChild($title);

			$title = $this->document->createElement(
				'h2',
				'Audio - Video - Ktv'
			);
			$content->appendChild($title);
			$suppliers = $this->document->createElement('div');
			$suppliers->setAttribute('class', 'suppliers');
			$this->suppliersList($suppliers, $this->data->getSuppliersAudioVideo());
			$content->appendChild($suppliers);

			$title = $this->document->createElement(
				'h2',
				'Satelliet'
			);
			$content->appendChild($title);
			$suppliers = $this->document->createElement('div');
			$suppliers->setAttribute('class', 'suppliers');
			$this->suppliersList($suppliers, $this->data->getSuppliersSatellite());
			$content->appendChild($suppliers);

			$title = $this->document->createElement(
				'h2',
				'Digitaal tv'
			);
			$content->appendChild($title);
			$suppliers = $this->document->createElement('div');
			$suppliers->setAttribute('class', 'suppliers');
			$this->suppliersList($suppliers, $this->data->getSuppliersCable());
			$content->appendChild($suppliers);

			$title = $this->document->createElement(
				'h2',
				'Andere'
			);
			$content->appendChild($title);
			$suppliers = $this->document->createElement('div');
			$suppliers->setAttribute('class', 'suppliers');
			$this->suppliersList($suppliers, $this->data->getSuppliersOther());
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
