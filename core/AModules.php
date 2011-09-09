<?php
/**
 * basic stuff for the modules.
 *
 * @abstract
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
abstract class AModules {
	protected $pageTypes;

	/**
	 * check if the module is available for the pagetype requested.
	 *
	 * @param string $pageType
	 * @access public
	 * @return bool
	 */
	public function isAvailableForPageType($pageType) {
		if(is_array($this->pageTypes)) {
			return in_array($pageType, $this->pageTypes);
		} elseif($this->pageTypes == 'all') {
			return true;
		} else {
			return false;
		}
	}
}
