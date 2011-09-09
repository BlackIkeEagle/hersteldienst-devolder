<?php
/**
 * Pages_About.
 *
 * @uses Page_Abstract
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Pages_About extends APages{
	/**
	 * {@inheritdoc}
	 */
	public function index() {
		if($this->pageType == IPages::JSON) {
			$this->document->site = SITE;
			$this->document->version = VERSION;
			$this->document->version_ext = VER_EXT;
			$this->document->creator = CREATOR;
		} elseif($this->pageType == IPages::XHTML) {
			$this->document->setTitleAppend('About');
			$content = $this->document->getElementById('content');
			$appInfo = $this->document->createElement('table');
			$appInfo->setAttribute('class', 'about');

			$toolname = $this->document->createElement('tr');
			$toolname->appendChild($this->document->createElement('td', 'site:'));
			$toolname->appendChild($this->document->createElement('td', SITE));

			$version = $this->document->createElement('tr');
			$version->appendChild($this->document->createElement('td', 'version:'));
			$version->appendChild($this->document->createElement('td', VERSION.(VER_EXT !== '' ? ' ('.VER_EXT.')' : '')));

			$creator = $this->document->createElement('tr');
			$creator->appendChild($this->document->createElement('td', 'creator:'));
			$creator->appendChild($this->document->createElement('td', CREATOR));

			$appInfo->appendChild($toolname);
			$appInfo->appendChild($version);
			$appInfo->appendChild($creator);

			$content->appendChild($appInfo);
		}
	}
}
