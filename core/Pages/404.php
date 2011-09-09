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
			$err = $this->document->createElement('p', 'We are very sorry but the page you have requested can not be found.');
			$err->setAttribute('class', 'center message error');
			$content->appendChild($err);
			$link = $this->document->createElement('a', 'click here to start again');
			$link->setAttribute('href', $this->basepath);
			$link->setAttribute('class', 'center');
			$content->appendChild($link);
		}
	}
}
