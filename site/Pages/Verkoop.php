<?php
class Pages_Verkoop extends APages{
	/**
	 * {@inheritdoc}
	 */
	public function index() {
		if($this->pageType == IPages::XHTML) {
			$this->document->setTitleAppend('verkoop');
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

			$titleTelevision = $this->document->createElement(
				'h2',
				'Lcd tv &amp; Home cinema'
			);
			$content->appendChild($titleTelevision);
			$imgTelevision = $this->document->createElement('img');
			$imgTelevision->setAttribute('src', 'public/images/television.png');
			$imgTelevision->setAttribute('alt', 'lcd tv en home cinema');
			$content->appendChild($imgTelevision);

			$titleSatellite = $this->document->createElement(
				'h2',
				'Satelliet'
			);
			$content->appendChild($titleSatellite);
			$imgSatellite= $this->document->createElement('img');
			$imgSatellite->setAttribute('src', 'public/images/satellite.png');
			$imgSatellite->setAttribute('alt', 'satelliet');
			$content->appendChild($imgSatellite);
		}
	}
}
