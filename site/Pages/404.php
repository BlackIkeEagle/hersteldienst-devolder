<?php
class Pages_404 extends APages{
	/**
	 * {@inheritdoc}
	 */
	public function index() {
		if($this->pageType == IPages::XHTML) {
			header("HTTP/1.0 404 Not Found");
			$this->document->setTitleAppend('OoOPS');
			$content = $this->document->getElementById('content');
			$err = $this->document->createElement('p', 'Oeps, de pagina die u wenst te bezoeken is niet gevonden');
			$err->setAttribute('class', 'center hersteldienstfail');
			$content->appendChild($err);
			$link = $this->document->createElement('a', 'terug naar home');
			$link->setAttribute('href', $this->basepath);
			$link->setAttribute('class', 'center');
			$content->appendChild($link);
		}
	}
}
