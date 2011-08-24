<?php
/**
 * simple flat menu
 *
 * @uses AModules
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Modules_SimpleMenu extends AModules {
	protected $document;
	protected $basepath;

	protected $pageTypes = array(
		IPages::XHTML
	);

	protected $id = 'menu';
	protected $menuItems = array();

	/**
	 * create module and pass al the needed parameters to it
	 *
	 * @param mixed $document
	 * @param mixed $basepath
	 * @param mixed $menuItems
	 * @access public
	 * @return void
	 */
	public function __construct(&$document, $basepath, $menuItems) {
		$this->document = $document;
		$this->basepath = $basepath;
		$this->menuItems = $menuItems;
	}

	/**
	 * build menu before content
	 *
	 * @access public
	 * @return void
	 */
	public function beforeContent() {
		$menu = $this->document->getElementById($this->id);
		if($menu) {
			$this->document->addCss('public/css/simplemenu.css');
			$menu->removeAttribute('style');

			$menuList = $this->document->createElement('ul');

			$rq = new RequestHandler(DEFAULTPAGE, $this->basepath);

			foreach($this->menuItems as $lbl => $page) {
				$li = $this->document->createElement('li');
				$a = $this->document->createElement('a', $lbl);
				$a->setAttribute('href', $this->basepath.'/'.$page);
				if($rq->getPage() == $page)
					$li->setAttribute('class', 'selected');
				$li->appendChild($a);
				$menuList->appendChild($li);
			}
			$menu->appendChild($menuList);
		}
	}
}
