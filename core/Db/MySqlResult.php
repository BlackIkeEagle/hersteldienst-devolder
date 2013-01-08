<?php
/**
 * Db_MySqlResult.
 * mimic a mysqli/pdo - statement
 *
 * @uses Iterator
 * @uses Countable
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Db_MySqlResult implements Iterator,Countable {
	// {{{ mysql statement stuff
	const MYSQL_OBJECT=4;

	private $fetchType = MYSQL_ASSOC;
	private $result;
	// }}}

	// {{{ iterator stuff
	private $pos = 0; // needed for iterator stuff
	private $current; // some trick to make iterator work
	// }}}

	// {{{ CONSTRUCT / DESTRUCT
	/**
	 * construct.
	 * pass the result by reference
	 *
	 * @param resource $result
	 * @access public
	 * @return void
	 */
	public function __construct(&$result) {
		$this->result = $result;
		$this->rewind();
	}

	/**
	 * destruct.
	 * free the result if needed
	 *
	 * @access public
	 * @return void
	 */
	public function __destruct() {
		@mysql_free_result($this->result);
	}
	// }}}

	// {{{ setup return type
	/**
	 * setup what you will fetch.
	 *
	 * valid values :p
	 * - Db_MySqlResult::MYSQL_OBJECT -- defined above :p
	 * - MYSQL_ASSOC
	 * - MYSQL_BOTH
	 * - MYSQL_NUM
	 *
	 * @param const $type
	 * @access public
	 * @return bool
	 */
	public function setFetchType($type) {
		if(
			$type == self::MYSQL_OBJECT ||
			$type == MYSQL_ASSOC ||
			$type == MYSQL_BOTH ||
			$type == MYSQL_NUM
		) {
			$this->fetchType = $type;
			return true;
		}

		return false;
	}

	/**
	 * get what fetchtype is used.
	 *
	 * @access public
	 * @return const
	 */
	public function getFetchType() {
		return $this->fetchType;
	}
	// }}}

	// {{{ fetch stuff
	/**
	 * fetchRow.
	 * mimic the behaviour of mysql_fetch_*
	 * return current result and already load the next
	 *
	 * @access public
	 * @return mixed
	 */
	public function fetchRow() {
		$current = $this->current();
		$this->next();
		return $current;
	}

	/**
	 * fetch all the results in a array.
	 *
	 * @access public
	 * @return array
	 */
	public function fetchAll() {
		$out = array();
		foreach($this as $row) {
			array_push($out, $row);
		}
		return $out;
	}

	/**
	 * fetch the value lengths of the last row.
	 *
	 * @access public
	 * @return array
	 */
	public function fetchLengths() {
		return @mysql_fetch_lengths($this->result);
	}
	// }}}

	// {{{ count stuff
	/**
	 * get total number of rows.
	 *
	 * @access public
	 * @return int
	 */
	public function getNumRows() {
		return @mysql_num_rows($this->result);
	}

	/**
	 * get the number of columns.
	 *
	 * @access public
	 * @return int
	 */
	public function getNumCols() {
		return $this->getNumFields();
	}

	/**
	 * get the number of fields.
	 *
	 * @access public
	 * @return int
	 */
	public function getNumFields() {
		return @mysql_num_fields($this->result);
	}
	// }}}

	// {{{ implements Countable
	/**
	 * {@inheritdoc}
	 */
	public function count() {
		return $this->getNumRows();
	}
	// }}}

	// {{{ implements Iterator
	/**
	 * {@inheritdoc}
	 */
	public function current() {
		return $this->current;
	}

	/**
	 * {@inheritdoc}
	 */
	public function key() {
		return $this->pos;
	}

	/**
	 * {@inheritdoc}
	 */
	public function next() {
		if($this->fetchType == self::MYSQL_OBJECT)
			$this->current = @mysql_fetch_object($this->result);
		else
			$this->current = @mysql_fetch_array($this->result, $this->fetchType);
		$this->pos++;
	}

	/**
	 * {@inheritdoc}
	 */
	public function rewind() {
		@mysql_data_seek($this->result, 0);
		$this->pos = -1;
		$this->next();
	}

	/**
	 * {@inheritdoc}
	 */
	public function valid() {
		return !empty($this->current);
	}
	// }}}
}
