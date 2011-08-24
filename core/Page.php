<?php
/**
 * basic definition of a page.
 *
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Page {
	private $document;

	private $pageType; // flag
	private $defaultPage;
	private $basepath;

	private $modules = array(
		'onEntry' => array(),
		'beforeContent' => array(),
		'afterContent' => array(),
		'onExit' => array()
	);

	/**
	 * construct the basic page stuff
	 *
	 * @param bool $ajax
	 * @param string $defaultPage
	 * @param string $basepath
	 * @access public
	 * @return void
	 */
	public function __construct($ajax, $defaultPage, $basepath = null) {
		$this->setPageType($ajax);
		$this->setDefaultPage($defaultPage);
		$this->setBasePath($basepath);
		if($this->pageType == IPages::JSON) {
			$this->document = new Document_Json();
		} else {
			$this->document = new Document_XHtml();
			Document_XHtmlDefault::xhtml($this->document);
		}
	}

	/**
	 * get the document.
	 *
	 * @access public
	 * @return Document_*
	 */
	public function &getDocument() {
		return $this->document;
	}

	/**
	 * add a module all, or output stuff
	 *
	 * @param AModule $module
	 * @access public
	 * @return void
	 */
	public function addModule($module) {
		if($module instanceof AModules) {
			foreach(array_keys($this->modules) as $function) {
				if(method_exists($module, $function))
					array_push($this->modules[$function], $module);
			}
		}
	}

	/**
	 * define the pagetype (xhtml, json, ...)
	 *
	 * @param bool $ajax
	 * @access private
	 * @return void
	 */
	private function setPageType($ajax) {
		$this->pageType = IPages::XHTML;
		if(!empty($ajax))
			$this->pageType = IPages::JSON;
	}

	/**
	 * define the fallback / default page.
	 *
	 * @param string $defaultPage
	 * @access private
	 * @return void
	 */
	private function setDefaultPage($defaultPage) {
		$this->defaultPage = $defaultPage;
	}

	/**
	 * set the basepath.
	 * this if the 'site' is not running from DOCUMENT_ROOT
	 * but from a subdirectory
	 *
	 * @param string $basepath
	 * @access private
	 * @return void
	 */
	private function setBasePath($basepath = null) {
		$this->basepath = $basepath;
	}

	/**
	 * run submodules.
	 * run the submodules who define the whatModules function
	 *
	 * @param mixed $whatModules
	 * @access private
	 * @return void
	 */
	private function runModules($whatModules) {
		foreach($this->modules[$whatModules] as $module) {
			if($module->isAvailableForPageType($this->pageType)) {
				$module->$whatModules();
			}
		}
	}

	/**
	 * default page run.
	 * all is controlled by thisone (well thisone is called from __toString)
	 *
	 * @access private
	 * @return void
	 */
	private function run() {
		/* onentry modules */
		$this->runModules('onEntry');

		$rq = new RequestHandler($this->defaultPage, $this->basepath);

		/* beforeContent modules */
		$this->runModules('beforeContent');

		$page = null;
		$classname = "Pages_".ucfirst($rq->getPage());
		if(class_exists($classname) && Acl::acl()->isAllowed($rq->getPage())) {
			$page = new $classname($this->document, $this->toArray());
			if(!($page instanceof IPages))
				throw new Exception('the page doesnt implement the page interface');

			if($rq->getParameters() != null)
				$page->setParameters($rq->getParameters());

			if($rq->getAction() != null && method_exists($page, $rq->getAction())) {
				$action = $rq->getAction();
				$page->$action();
			} else {
				$page->index();
			}
		} else {
			$page = new Pages_404($this->document, $this->toArray());
			$page->index();
		}

		/* afterContent modules */
		$this->runModules('afterContent');

		/* onExit modules */
		$this->runModules('onExit');
	}

	/**
	 * output the document.
	 *
	 * @access public
	 * @return void
	 */
	public function __toString() {
		$this->run();
		return $this->document->__toString();
	}

	/**
	 * output the parameters which define this page.
	 *
	 * @access public
	 * @return array
	 */
	public function toArray() {
		return array(
			'pagetype' => $this->pageType,
			'basepath' => $this->basepath
		);
	}
}
