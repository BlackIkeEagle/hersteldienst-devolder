<?php
/**
 * Document_Xhtml.
 * Create and build your XhtmlDocument
 *
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Document_XHtml {
	/**
	 * document.
	 * the master himself
	 *
	 * @var DomDocument
	 * @access private
	 */
	private $document;
	/**
	 * head.
	 * the head, where we find title, scripts, styles, ...
	 *
	 * @var DomElement
	 * @access private
	 */
	private $head;
	/**
	 * body.
	 * the documents body, you know :p
	 *
	 * @var DomElement
	 * @access private
	 */
	private $body;

	/**
	 * title.
	 * the sites name, ...
	 *
	 * @var string
	 * @access private
	 */
	private $title;
	/**
	 * titleAppend.
	 * can be used for pagename or so
	 *
	 * @var string
	 * @access private
	 */
	private $titleAppend;
	/**
	 * favicon.
	 * if set thisone contains the path to the favicon
	 *
	 * @var string
	 * @access private
	 */
	private $favicon;
	/**
	 * keywords.
	 * the websites keywords
	 *
	 * @var mixed
	 * @access private
	 */
	private $keywords;

	/**
	 * init your xhtml document.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$doctype = DOMImplementation::createDocumentType('html',
			'-//W3C//DTD XHTML 1.0 Strict//EN',
			'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'
		);
		$this->document = DOMImplementation::createDocument(
			'http://www.w3.org/1999/xhtml',
			'html',
			$doctype
		);
		$this->head = $this->document->createElement('head');
		$this->body = $this->document->createElement('body');
		$this->setTitle(null);
		$this->setTitleAppend(null);
	}

	/**
	 * set the title of the document.
	 *
	 * @param string $title
	 * @access public
	 * @return void
	 */
	public function setTitle($title) {
		if(!empty($title))
			$this->title = $title;
		else
			$this->title = "HerecuraHtmlDocument";
	}

	/**
	 * get the title.
	 * as in sitename, application name, ...
	 *
	 * @access public
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * set title append.
	 * set an append string for the title as in pagename, ...
	 *
	 * @param string $titleAppend
	 * @access public
	 * @return void
	 */
	public function setTitleAppend($titleAppend) {
		if(!empty($titleAppend))
			$this->titleAppend = $titleAppend;
		else
			$this->titleAppend = null;
	}

	/**
	 * get the title append.
	 * as in pagename, application action, ...
	 *
	 * @access public
	 * @return string
	 */
	public function getTitleAppend() {
		return $this->titleAppend;
	}

	/**
	 * get full title.
	 * get a complete string with the title information
	 *
	 * @access public
	 * @return string
	 */
	public function getFullTitle() {
		if(!empty($this->title)) {
			$title = $this->title;
			if(!empty($this->titleAppend))
				$title .= " - ".$this->titleAppend;
			return $title;
		} else {
			return null;
		}
	}

	public function setFavicon($path) {
		if(!empty($path)) {
			$this->favicon = $path;
			return true;
		} else {
			return true;
		}
	}

	/**
	 * add css.
	 * add a style file to the document
	 *
	 * @param string $file
	 * @access public
	 * @return bool
	 */
	public function addCss($file) {
		if(!empty($file)) {
			$css = $this->document->createElement('link');
			$css->setAttribute('href', BASEPATH.'/'.$file);
			$css->setAttribute('rel', 'stylesheet');
			$css->setAttribute('type', 'text/css');
			$this->head->appendChild($css);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * add ie css.
	 * add a style file to the document
	 *
	 * @param string $file
	 * @param string $ieCondition
	 * @access public
	 * @return bool
	 */
	public function addIeCss($file, $ieCondition) {
		if(!empty($file) && !empty($ieCondition)) {
			$comment = $this->document->createComment(
				sprintf('[if %s]><link href="%s" rel="stylesheet" type="text/css" /><![endif]',
				$ieCondition,
				BASEPATH.'/'.$file)
			);
			$this->head->appendChild($comment);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * add script.
	 * add a javascript file for dynamic actions
	 *
	 * @param string $file
	 * @access public
	 * @return bool
	 */
	public function addScript($file) {
		if(!empty($file)) {
			$js = $this->document->createElement('script', ' ');
			$js->setAttribute('src', BASEPATH.'/'.$file);
			$js->setAttribute('type', 'text/javascript');
			$this->head->appendChild($js);
			return true;
		} else {
			return false;
		}
	}

	public function addKeywords($keywords) {
		if(!empty($this->keywords)) $this->keywords .= ', ';
		$this->keywords .= $keywords;
	}

	/**
	 * create a new element.
	 * a passthru function to DomDocument
	 *
	 * @param string $name
	 * @param string $value
	 * @access public
	 * @return void
	 */
	public function createElement($name, $value=null) {
		return $this->document->createElement($name, $value);
	}

	public function createTextNode($content = '') {
		return $this->document->createTextNode($content);
	}

	/**
	 * get a specific element ( mostly placeholders )
	 *
	 * @param mixed $id
	 * @access public
	 * @return DomElement
	 */
	function getElementById($id) {
		//$xpath = new DOMXPath($this->document);
		//return $xpath->query("//*[@id='$id']")->item(0);
		return $this->document->getElementById($id);
	}

	/**
	 * add content.
	 * add visible content
	 *
	 * @param DomElement $content
	 * @access public
	 * @return void
	 */
	public function addContent($content) {
		$this->body->appendChild($content);
	}

	/**
	 * return the document as string.
	 *
	 * @access public
	 * @return string
	 */
	public function __toString() {
		$this->document->formatOutput = true;
		$this->document->preserveWhitespace = false;
		$title = $this->document->createElement('title', $this->getFullTitle());
		$this->head->appendChild($title);
		if(!empty($this->favicon)) {
			$favicon = $this->document->createElement('link');
			$favicon->setAttribute('rel', 'shortcut icon');
			$favicon->setAttribute('href', $this->favicon);
			$this->head->appendChild($favicon);
			$favicon = $this->document->createElement('link');
			$favicon->setAttribute('rel', 'icon');
			$favicon->setAttribute('href', $this->favicon);
			$this->head->appendChild($favicon);
		}
		if(!empty($this->keywords)) {
			$keywords = $this->document->createElement('meta');
			$keywords->setAttribute('name', 'keywords');
			$keywords->setAttribute('content', $this->keywords);
			$this->head->appendChild($keywords);
		}
		$html =& $this->document->getElementsByTagName('html')->item(0);
		$html->appendChild($this->head);
		$html->appendChild($this->body);
		return $this->document->saveXML();
	}
}
