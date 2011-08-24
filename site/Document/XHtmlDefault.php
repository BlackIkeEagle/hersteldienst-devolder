<?php
class Document_XHtmlDefault{
	public static function xhtml(&$document) {
		$document->setTitle(SITE.' '.VERSION.(VER_EXT !== '' ? ' ('.VER_EXT.')' : ''));

		$document->addCss('public/css/base.css');

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
