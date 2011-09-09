<?php
class Pages_404 extends APages{
	/**
	 * {@inheritdoc}
	 */
	public function index() {
		if($this->pageType == IPages::XHTML) {
			header("HTTP/1.0 404 Not Found");
			$this->document->setTitleAppend('OePS');
			$content = $this->document->getElementById('content');
			$img = $this->document->createElement('img');
			$img->setAttribute('src', 'public/images/404.png');
			$img->setAttribute('alt', '404');
			$img->setAttribute('class', 'center');
			$content->appendChild($img);

			$err = $this->document->createElement('p', 'Oeps, de pagina die u wenst te bezoeken werd niet gevonden');
			$err->setAttribute('class', 'center hersteldienstfail');
			$content->appendChild($err);

			$link = $this->document->createElement('a', 'terug naar home');
			$link->setAttribute('href', $this->basepath);
			$link->setAttribute('class', 'center');
			$content->appendChild($link);
		}
	}
}
