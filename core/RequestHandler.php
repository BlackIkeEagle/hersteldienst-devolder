<?php
/**
 * RequestHandler.
 * parse the url path and give us page, action and paramters
 *
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class RequestHandler {
	private $path = null;
	private $page = null;
	private $action = null;
	private $parameters = null;

	/**
	 * create requesthandler.
	 * pass the basepath if you are not starting from $_SERVER['DOCUMENT_ROOT']
	 *
	 * @param string $default
	 * @param string $basepath
	 * @access public
	 * @return void
	 */
	public function __construct($default, $basepath = null) {
		$escapedBasepath = str_replace('/', '\/', $basepath);
		$this->path = trim(preg_replace('/^index\.php/', '', preg_replace('/^'.$escapedBasepath.'/', '', $_SERVER['REQUEST_URI'])), '/');

		if(!empty($this->path))
			$allParams = explode('/', $this->path);
		else
			$allParams = array();

		if(count($allParams) > 0) {
			$this->page = array_shift($allParams);
		} else {
			$this->page = $default;
		}

		if(count($allParams) > 0) {
			$this->action = array_shift($allParams);
		}

		$cntRest = count($allParams);
		if($cntRest > 0) {
			for($x = 0; $x < $cntRest; $x = $x+2) {
				if(!empty($allParams[$x]) && !empty($allParams[$x+1])) {
					$this->parameters[$allParams[$x]] = $allParams[$x+1];
				}
			}
		}

		unset($allParams); // i don't always trust garbage collection
	}

	/**
	 * get the used path.
	 *
	 * @access public
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * get what the requested page is.
	 *
	 * @access public
	 * @return string
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * get what the requested page action is.
	 *
	 * @access public
	 * @return string
	 */
	public function getAction() {
		return $this->action;
	}

	/**
	 * get the remaining parameters.
	 *
	 * @access public
	 * @return array
	 */
	public function getParameters(){
		return $this->parameters;
	}
}
