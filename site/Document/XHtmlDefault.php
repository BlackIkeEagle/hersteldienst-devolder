<?php
class Document_XHtmlDefault{
	public static function xhtml(&$document) {
		$document->setTitle(SITE);
		$keywords = 'audio, radio, cd, dvd, video, tv, tft, plasma, satelliet, satellite, '.
			'audio oostkamp, video oostkamp, tv oostkamp, satelliet oostkamp, blu ray oostkamp, '.
			'bluray oostkamp, luc devolder, devolder luc, luc, devolder, elektro oostkamp, '.
			'herstellingen, repairs, philips, panasonic, sony, technics, nokia, tv-vlaanderen, '.
			'tvvlaanderen, tv vlaanderen, oostkamp, brugge, waardamme, ruddervoorde, hertsberge, '.
			'vlaanderen, west vlaanderen, west-vlaanderen, oost vlaanderen, oost-vlaanderen';
		$document->addKeywords($keywords);

		$document->setFavicon('public/images/icons/favicon.ico');

		$document->addCss('public/css/base.css');
		$document->addIeCss('public/css/ie-lte6-base.css', 'lte IE 6');

		// {{{ HEADER
		$header = $document->createElement('div');
		$header->setAttribute('id', 'header');
		$header->setIdAttribute ('id', true);
		$smallhead = $document->createElement('div', 'Audio Video Ktv Hersteldienst');
		$smallhead->setAttribute('id', 'smallhead');
		$header->appendChild($smallhead);
		$bighead = $document->createElement('div', 'Luc Devolder');
		$bighead->setAttribute('id', 'bighead');
		$header->appendChild($bighead);
		$menu = $document->createElement('div');
		$menu->setAttribute('id', 'menu');
		$menu->setIdAttribute ('id', true);
		$menu->setAttribute('style', 'display: none');
		$header->appendChild($menu);
		// }}}
		// {{{ CONTENT
		$content = $document->createElement('div');
		$content->setAttribute('id', 'content');
		$content->setIdAttribute('id', true);
		// }}}
		// {{{ FOOTER
		$footer = $document->createElement('div', COPYRIGHT);
		$footer->setAttribute('id', 'footer');
		$footer->setIdAttribute ('id', true);
		// }}}

		$document->addContent($header);
		$document->addContent($content);
		$document->addContent($footer);
	}
}
