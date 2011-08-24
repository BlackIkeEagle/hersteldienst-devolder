<?php
/**
 * multi level menu module.
 *
 * @uses AModules
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Modules_MultiMenu extends AModules {
	protected $document;
	protected $basepath;

	protected $pageTypes = array(
		IPages::XHTML
	);

	protected $id = 'menu';
	protected $menuItems = array();

	/**
	 * create module and pass all the needed paramters to it
	 *
	 * @param mixed $document
	 * @param string $basepath
	 * @param array $menuItems
	 * @access public
	 * @return void
	 */
	public function __construct(&$document, $basepath, $menuItems) {
		$this->document = $document;
		$this->basepath = $basepath;
		$this->menuItems = $menuItems;
	}

	/**
	 * menu will be built before the content is generated.
	 *
	 * @access public
	 * @return void
	 */
	public function beforeContent() {
		$menu = $this->document->getElementById($this->id);
		if($menu) {
			$this->document->addCss('public/css/multimenu.css');
			$menu->removeAttribute('style');

			$menuList = $this->document->createElement('ul');

			foreach($this->menuItems as $lbl => $page) {
				if(is_array($page) && isset($page['default']))
					$checkPage = $page['default'];
				else
					$checkPage = $page;

				if(Acl::acl()->isAllowed($checkPage))
					$menuList->appendChild($this->fillMenu($lbl, $page));
			}

			$menu->appendChild($menuList);
		}
	}

	/**
	 * recursive fill the menu.
	 *
	 * @param string $lbl
	 * @param array $page
	 * @param string $class
	 * @access private
	 * @return	DomElement 
	 */
	private function fillMenu($lbl, $page, $class=null) {
		if($class === null)
			$rq = new RequestHandler(DEFAULTPAGE, $this->basepath);
		if(is_array($page)) {
			if(isset($page['default'])) {
				$li = $this->document->createElement('li');
				$a = $this->document->createElement('a', $lbl);
				$a->setAttribute('href', $this->basepath.'/'.$page['default']);
				if($class === null && $rq->getPage() == $page['default'])
					$li->setAttribute('class', 'selected');
				$li->appendChild($a);
				unset($page['default']);
			} else {
				$li = $this->document->createElement('li', $lbl);
			}
			if(count($page) > 0) {
				$subList = $this->document->createElement('ul');

				if(!empty($class))
					$subList->setAttribute('class', 'sub');
				else
					$subList->setAttribute('class', 'sub first');

				foreach($page as $slbl => $spage) {
					$subList->appendChild($this->fillMenu($slbl, $spage, 'sub'));
				}

				$li->appendChild($subList);
			}
			return $li;
		} else {
			$li = $this->document->createElement('li');
			$a = $this->document->createElement('a', $lbl);
			$a->setAttribute('href', $this->basepath.'/'.$page);
			if($class === null && $rq->getPage() == $page)
				$li->setAttribute('class', 'selected');
			$li->appendChild($a);
			return $li;
		}
	}

	private function example() {
		return array(
			'label1' => 'page1',
			'label2' => array(
				'default' => 'page2', // add link to toplevel
				'sublabel1' => 'page2/sublevel1',
				'sublabel2' => 'page2/sublevel2',
				'sublabel3' => array(
					'subsublabel1' => 'page2/sublevel3/subsublevel1'
				)
			),
			'label3' => array(
				'sublabel1' => 'page3/sublevel1'
			)
		);
	}
}
