<?php
/**
 * IPages
 * Pages have to implement this interface before being useable
 *
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
interface IPages{

	const XHTML = 'xhtml';
	const JSON = 'json';

	/**
	 * page have to be contstructed with type and content.
	 *
	 * @param array $pageparams
	 * @access public
	 * @return void
	 */
	public function __construct(&$document, $pageparams);

	/**
	 * add parameters to the page.
	 *
	 * @param array $parameters
	 * @access public
	 * @return void
	 */
	public function setParameters($parameters);

	/**
	 * this is the default output of the page
	 *
	 * @access public
	 * @return void
	 */
	public function index();
}
