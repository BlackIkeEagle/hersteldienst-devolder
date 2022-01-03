<?php
class Pages_Home extends APages{
	/**
	 * {@inheritdoc}
	 */
	public function index() {
		if($this->pageType == IPages::XHTML) {
			$this->document->setTitleAppend('home');
			$content = $this->document->getElementById('content');

			$welcome = $this->document->createElement(
				'h1',
				'Welkom bij Audio Video Ktv Hersteldienst Luc Devolder'
			);
			$content->appendChild($welcome);

			$titleLocation = $this->document->createElement(
				'h2',
				'Ligging'
			);
			$content->appendChild($titleLocation);
			$location = $this->document->createElement(
				'p',
				'Audio Video Ktv Hersteldienst Luc Devolder is gelegen in de wijk Nieuwenhove te Oostkamp. Daar dit een zeer centrale locatie is in de gemeente Oostkamp kunnen wij ook een zeer snelle bediening garanderen naar de deelgemeenten Oostkamp, Waardamme, Hertsberge en Ruddervoorde.'
			);
			$content->appendChild($location);
			$location = $this->document->createElement(
				'p',
				'De service die geleverd wordt, is natuurlijk niet enkel beperkt tot de gemeente Oostkamp. Er wordt altijd gestreefd naar de meest kwalitatieve oplossing voor problemen in gans Vlaanderen, meer specifiek West-Vlaanderen en Oost-Vlaanderen.'
			);
			$content->appendChild($location);

			$titleWhat = $this->document->createElement(
				'h2',
				'Wat?'
			);
			$content->appendChild($titleWhat);
			$what = $this->document->createElement(
				'p',
				'U kan altijd bij ons terecht om uw kapot toestel te laten herstellen. Wij helpen wanneer u problemen hebt bij de installatie van uw toestellen. Wenst u nieuw materiaal aan te kopen, ook dan kan u beroep doen op onze ervaring en service. Kwaliteit wordt zeer hoog in het vaandel gedragen. Dit voor al uw toestellen: TV, Flatscreen, TFT, DVD, BluRay, Radio, Cd-speler, Versterker, Boxen, Satellietsysteem, Digitaal Tv.'
			);
			$content->appendChild($what);

			$titleHours = $this->document->createElement(
				'h2',
				'Openingsuren'
			);
			$content->appendChild($titleHours);

			$table = $this->document->createElement('table');

			$p = $this->document->createElement('p', 'De vermelde openingsuren zijn op afspraak, altijd best eerst telefoneren.');
			$content->appendChild($p);

			$row = $this->document->createElement('tr');
			$element = $this->document->createElement('td', 'Ma - Do:');
			$element->setAttribute('class', 'olbl');
			$row->appendChild($element);
			$element = $this->document->createElement('td', '8.00u tot 20.00u');
			$row->appendChild($element);
			$table->appendChild($row);

			$row = $this->document->createElement('tr');
			$element = $this->document->createElement('td', 'Vr:');
			$element->setAttribute('class', 'olbl');
			$row->appendChild($element);
			$element = $this->document->createElement('td', '8.00u tot 18.00u');
			$row->appendChild($element);
			$table->appendChild($row);

			$row = $this->document->createElement('tr');
			$element = $this->document->createElement('td', 'Za - Zo:');
			$element->setAttribute('class', 'olbl');
			$row->appendChild($element);
			$element = $this->document->createElement('td', 'gesloten');
			$row->appendChild($element);
			$table->appendChild($row);

			$content->appendChild($table);
		}
	}
}
