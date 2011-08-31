<?php
class Pages_Verkoop extends APages{

	/**
	 * {@inheritdoc}
	 */
	public function init() {
		$this->data = new Data_Verkoop();
	}

	/**
	 * {@inheritdoc}
	 */
	public function index() {
		if($this->pageType == IPages::XHTML) {
			$this->document->setTitleAppend('verkoop');
			$this->document->addCss('public/css/verkoop.css');
			$content = $this->document->getElementById('content');

			$titleSales = $this->document->createElement(
				'h1',
				'Verkoop'
			);
			$content->appendChild($titleSales);
			$sales = $this->document->createElement(
				'p',
				'Wenst u nieuw materiaal aan te kopen, ook dan kan u beroep doen op onze ervaring en service.'
			);
			$content->appendChild($sales);

			$titleHifi = $this->document->createElement(
				'h2',
				'Hifi &amp; Professionele audio'
			);
			$content->appendChild($titleHifi);
			$imgHifi = $this->document->createElement('img');
			$imgHifi->setAttribute('src', 'public/images/audio.png');
			$imgHifi->setAttribute('alt', 'hifi en professionele audio');
			$content->appendChild($imgHifi);
			$suppliers = $this->document->createElement('div');
			$suppliers->setAttribute('class', 'suppliers');
			$this->suppliersList($suppliers, $this->data->getSuppliersAudio());
			$content->appendChild($suppliers);

			$titleTelevision = $this->document->createElement(
				'h2',
				'Lcd tv &amp; Home cinema'
			);
			$content->appendChild($titleTelevision);
			$imgTelevision = $this->document->createElement('img');
			$imgTelevision->setAttribute('src', 'public/images/television.png');
			$imgTelevision->setAttribute('alt', 'lcd tv en home cinema');
			$content->appendChild($imgTelevision);
			$suppliers = $this->document->createElement('div');
			$suppliers->setAttribute('class', 'suppliers');
			$this->suppliersList($suppliers, $this->data->getSuppliersTelevision());
			$content->appendChild($suppliers);

			$titleSatellite = $this->document->createElement(
				'h2',
				'Satelliet'
			);
			$content->appendChild($titleSatellite);
			$imgSatellite= $this->document->createElement('img');
			$imgSatellite->setAttribute('src', 'public/images/satellite.png');
			$imgSatellite->setAttribute('alt', 'satelliet');
			$content->appendChild($imgSatellite);
			$suppliers = $this->document->createElement('div');
			$suppliers->setAttribute('class', 'suppliers');
			$this->suppliersList($suppliers, $this->data->getSuppliersSatellite());
			$content->appendChild($suppliers);
		}
	}

	private function suppliersList(&$suppliersBox, $suppliersData) {
		foreach($suppliersData as $supplier) {
			$link = $this->document->createElement('a');
			$link->setAttribute('href', $supplier['url']);
			$link->setAttribute('target', '_blank');
			$link->setAttribute('title', $supplier['name']);
			$image = $this->document->createElement('img');
			$image->setAttribute('src', 'public/images/'.$supplier['logo']);
			$image->setAttribute('alt', $supplier['name']);
			$link->appendChild($image);
			$suppliersBox->appendChild($link);
		}
	}
}
