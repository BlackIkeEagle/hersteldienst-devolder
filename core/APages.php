<?php
/**
 * APages
 *
 * @uses IPages
 * @abstract
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
abstract class APages implements IPages{
	protected $document;
	protected $pageType;
	protected $basepath;
	protected $parameters;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(&$document, $pageparams) {
		$this->setDocument($document);
		$this->setPageType($pageparams['pagetype']);
		$this->setBasePath($pageparams['basepath']);
		if(method_exists($this, 'init'))
			$this->init();
	}

	/**
	 * pass the existing document
	 *
	 * @param mixed $document
	 * @access private
	 * @return void
	 */
	private function setDocument(&$document) {
		$this->document = $document;
	}

	/**
	 * set the type of the page
	 *
	 * @param string $type :: from Page_Interface
	 * @access private
	 * @return void
	 */
	private function setPageType($type) {
		if(!empty($type))
			$this->pageType = $type;
		else
			throw new Exception('PageType cant be empty');
	}

	/**
	 * set the basepath.
	 *
	 * @param string $basepath
	 * @access private
	 * @return void
	 */
	private function setBasePath($basepath) {
		if(!empty($basepath))
			$this->basepath = $basepath;
		else
			$this->basepath = '/';
	}

	/**
	 * {@inheritdoc}
	 */
	public function setParameters($parameters) {
		if(!empty($parameters) && is_array($parameters))
			$this->parameters = $parameters;
	}
}
