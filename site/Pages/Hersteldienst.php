<?php
class Pages_Hersteldienst extends APages{
	/**
	 * {@inheritdoc}
	 */
	public function index() {
		if($this->pageType == IPages::XHTML) {
			$this->document->setTitleAppend('hersteldienst');
			$content = $this->document->getElementById('content');

			$titleRepair = $this->document->createElement(
				'h1',
				'Herstellingen van alle merken'
			);
			$content->appendChild($titleRepair);

			$repair = $this->document->createElement(
				'p',
				'De herstellingen worden in onze eigen werkplaats uitgevoerd. Dankzij een jarenlange ervaring worden deze op een snelle en nauwkeurige manier afgehandeld.'
			);
			$content->appendChild($repair);
			$repair = $this->document->createElement(
				'p',
				'U kunt dan ook bij ons terecht met toestellen van alle merken.'
			);
			$content->appendChild($repair);

			$repairImg = $this->document->createElement('img');
			$repairImg->setAttribute('src', 'public/images/lcd_4.jpg');
			$repairImg->setAttribute('alt', 'lcd open for repair');
			$content->appendChild($repairImg);
		}
	}
}
