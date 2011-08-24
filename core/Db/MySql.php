<?php
/**
 * Db_MySql.
 * this mysql class is a full wrapper around the old mysql functions
 *
 * @author Ike Devolder <ike DOT devolder AT gmail DOT com>
 */
class Db_MySql {
	/* connection settings */
	private $dbHost;
	private $dbUser;
	private $dbPass;
	private $dbPort;
	private $dbSock;

	/* database charset */
	private $dbCharSet;

	/* database selector */
	private $dbDatabase;

	/* query settings */
	private $dbQueryBuffered = true;

	/* saved connection */
	private $_connection;

	// {{{ CONSTRUCT / DESTRUCT
	/**
	 * constructor.
	 * pass the settings pls
	 * possible settings:
	 * - host
	 * - user
	 * - pass
	 * - port
	 * - sock
	 *
	 * @param array $dbSettings
	 * @access public
	 * @return void
	 */
	public function __construct($dbSettings = array()) {

		foreach($dbSettings as $setting => $value) {
			switch($setting) {
			case 'host':
				if(!empty($value))
					$this->dbHost = $value;
				break;
			case 'user':
				if(!empty($value))
					$this->dbUser = $value;
				break;
			case 'pass':
				if(!empty($value))
					$this->dbPass = $value;
				break;
			case 'sock':
				if(!empty($value))
					$this->dbSock = $value;
				break;
			case 'port':
				if(!empty($value) && is_numeric($value))
					$this->dbPort = intval($value);
				break;
			default:
				break;
			}
		}

		// {{{ check settings
		$dropOutFlag = false;
		$dropOutMessage = "";
		if(empty($this->dbHost)) {
			$dropOutFlag = true;
			$dropOutMessage .= "Host cant be empty\n";
		}
		if(empty($this->dbUser)) {
			$dropOutFlag = true;
			$dropOutMessage .= "User cant be empty\n";
		}
		if(empty($this->dbPass)) {
			$dropOutFlag = true;
			$dropOutMessage .= "Pass cant be empty\n";
		}
		if($dropOutFlag)
			throw new Exception($dropOutMessage);
		// }}}
	}

	/**
	 * destroy object.
	 * make sure the username and password are removed from memory
	 * if still connected disconnect from the database ( just cleaner )
	 *
	 * @access public
	 * @return void
	 */
	public function __destruct() {
		// clear this sensitive data from memory
		unset($this->dbUser, $this->dbPass);
		// close connection
		$this->disConnect();
	}
	// }}}
	
	// {{{ connection fucntions
	/**
	 * connect.
	 * connect to the database
	 * localhost can connect via socket
	 * all the rest connects via tcp
	 *
	 * @access private
	 * @return void
	 */
	private function connect() {
		if($this->isConnected())
			return $this->isConnected();

		$server = $this->dbHost;
		if(
			$this->dbHost == "localhost" ||
			$this->dbHost == "127.0.0.1" ||
			$this->dbHost == "::1"
		) {
			// localhost :p might be able to connect with socket
			if(!empty($this->dbSock))
				$server .= ":".$this->dbSock;
			elseif(!empty($this->dbPort))
				$server .= ":".$this->dbPort;
		} else {
			if(!empty($this->dbPort))
				$server .= ":".$this->dbPort;
		}
		$this->_connection = mysql_connect($server, $this->dbUser, $this->dbPass);
		if(!$this->isConnected())
			throw new Exception(mysql_errno().": ".mysql_error());

		if(!empty($this->dbDatabase))
			$this->setDatabase($this->dbDatabase);

		if(!empty($this->dbCharSet))
			$this->setCharSet($this->dbCharSet);
		else
			$this->dbCharSet = $this->getCharSet();

		return $this->isConnected();
	}

	/**
	 * is connected ?
	 *
	 * @access private
	 * @return void
	 */
	private function isConnected() {
		return isset($this->_connection);
	}

	/**
	 * disconnect.
	 * close the open connection to the database
	 *
	 * @access private
	 * @return void
	 */
	private function disConnect() {
		if($this->isConnected())
			mysql_close($this->_connection);
	}
	// }}}

	// {{{ select database and charset
	/**
	 * set the database you want to use.
	 * if all your tables reside in one database, this is the way to go
	 *
	 * it makes sure your query's are reduced in complexity
	 *
	 * @param string $database
	 * @access public
	 * @return void
	 */
	public function setDatabase($database) {
		if(!empty($database)) {
			$this->dbDatabase = $database;
			if($this->isConnected()) {
				if(!mysql_select_db($this->dbDatabase, $this->_connection))
					throw new Exception(mysql_errno().": ".mysql_error());
			}
		}
	}

	/**
	 * get what database you had selected.
	 *
	 * @access public
	 * @return string
	 */
	public function getDatabase() {
		return $this->dbDatabase;
	}

	/**
	 * set the character set.
	 * choose what character set you want to use:
	 * - utf8
	 * - iso-8859-1
	 * - cp1252
	 * - ...
	 *
	 * @param string $charset
	 * @access public
	 * @return void
	 */
	public function setCharSet($charset) {
		if(!empty($charset)) {
			$this->dbCharSet = $charset;
			if($this->isConnected()) {
				if(!mysql_set_charset($this->dbCharSet, $this->_connection))
					throw new Exception(mysql_errno().": ".mysql_error());
			}
		}
	}

	/**
	 * get the used character set.
	 * if you didnt manually selected one, the one chosen on the server will
	 * be returned
	 *
	 * @access public
	 * @return string
	 */
	public function getCharSet() {
		if($this->isConnected())
			return mysql_client_encoding($this->_connection);
		else
			return $this->dbCharSet;
	}
	// }}}

	// {{{ info functions
	/**
	 * get client info.
	 * version, ... of the used client to connect to the database
	 *
	 * @access public
	 * @return string 
	 */
	public function getClientInfo() {
		return mysql_get_client_info();
	}

	/**
	 * get server info.
	 * version, ... of the used server
	 *
	 * @access public
	 * @return string
	 */
	public function getServerInfo() {
		if($this->connect())
			return mysql_get_server_info($this->_connection);

		return null;
	}

	/**
	 * get host info.
	 * Returns a string describing the type of MySQL connection in use
	 *
	 * @access public
	 * @return string
	 */
	public function getHostInfo() {
		if($this->connect())
			return mysql_get_host_info($this->_connection);

		return null;
	}

	/**
	 * get protocol info.
	 * returns the mysql protocol version
	 *
	 * @access public
	 * @return string 
	 */
	public function getProtocolInfo() {
		if($this->connect())
			return mysql_get_proto_info($this->_connection);

		return null;
	}
	// }}}

	// {{{ database server functions
	/**
	 * get a list of databases.
	 * get all the databases available on this server ( or for this user )
	 *
	 * @access public
	 * @return array
	 */
	public function listDbs() {
		$out = array();
		if($this->connect()) {
			$db_list = mysql_list_dbs($link);

			while ($row = mysql_fetch_assoc($db_list)) {
				 array_push($out, $row['Database']);
			}

			mysql_free_result($db_list);
		}
		return $out;
	}

	/**
	 * list processes.
	 * show a list of running (connected) processes and what they are doing
	 *
	 * @access public
	 * @return array
	 */
	public function listProcesses() {
		$out = array();
		if($this->connect()) {
			$process_list = mysql_list_processes($this->_connection);

			while($row = mysql_fetch_assoc($process_list)) {
				array_push($out, $row);
			}

			mysql_free_result($process_list);
		}
		return $out;
	}

	/**
	 * get server status.
	 * get a status string from the mysql server.
	 *
	 * - uptime
	 * - threads
	 * - questions handled
	 * - # slow queries
	 * - open connections
	 * - # flush tables
	 * - # open tables
	 * - # queries / second
	 *
	 * @access public
	 * @return string
	 */
	public function getStatus() {
		if($this->connect())
			return mysql_stat($this->_connection);

		return null;
	}

	/**
	 * get thread id.
	 * get the mysql thread id of the current connection
	 * when one gets reconnected the threadid will be changed
	 *
	 * @access public
	 * @return void
	 */
	public function getThreadId() {
		if($this->connect())
			return mysql_thread_id($this->_connection);

		return null;
	}
	// }}}

	// {{{ query settings
	/**
	 * buffer or not.
	 * set if the mysql results will be bufferd or not
	 * for huge resultsets unbuffered will be interesting to reduce the
	 * memory footprint
	 *
	 * @param bool $buffered
	 * @access public
	 * @return void
	 */
	public function setQueryBuffered($buffered) {
		$this->dbQueryBuffered = isset($buffered);
	}

	/**
	 * will the query be buffered.
	 * return if we will run unbuffered or buffered queries
	 *
	 * @access public
	 * @return bool
	 */
	public function getQueryBuffered() {
		return $this->dbQueryBuffered;
	}
	// }}}

	// {{{ query functions
	/**
	 * query.
	 * depending on the buffer setting will result in a buffered or unbuffered
	 * result
	 *
	 * values can be given to the query, this to mimic prepared statements
	 * which can be used in mysqli or pdo, but since we cant use those, some
	 * trick to make it work in a similar way.
	 *
	 * @param string $query
	 * @param array $values -- has to be assoc array
	 * @access public
	 * @return Db_MySqlResult
	 */
	public function query($query, $values = null) {
		if($this->connect()) {
			if(!empty($values) && is_array($values)) {
				$search = array();
				$replace = array();
				foreach($values as $lbl => $repl) {
					array_push($search, $lbl);
					array_push($replace, $this->escape($repl));
				}
				$query = str_replace($search, $replace, $query);
			}
			if($this->dbQueryBuffered)
				$result = mysql_query($query, $this->_connection);
			else
				$result = mysql_unbuffered_query($query, $this->_connection);

			return new Db_MySqlResult($result);
		}

		return null;
	}

	/**
	 * escape.
	 * escape string which will be used in queries
	 * this to prevent Sql-injection
	 *
	 * this will be called if you use the 'prepare' way of queriing
	 *
	 * @param mixed $string
	 * @access private
	 * @return void
	 */
	private function escape($string) {
		if($this->connect())
			return mysql_real_escape_string($string, $this->_connection);

		return null;
	}

	/**
	 * affected rows.
	 * give the number of affected rows by the last query.
	 * meaning, insert, update, delete, ...
	 *
	 * @access public
	 * @return int
	 */
	public function getAffectedRows() {
		if($this->connect())
			return mysql_affected_rows($this->_connection);

		return null;
	}

	/**
	 * info about the last query ran.
	 * some extended info about the last query done
	 *
	 * @access public
	 * @return string
	 */
	public function getQueryInfo() {
		if($this->connect())
			return mysql_info($this->_connection);

		return null;
	}

	/**
	 * get the last insert id.
	 *
	 * @access public
	 * @return double / int
	 */
	public function getLastInsertId() {
		if($this->connect()) {
			$result = mysql_query('SELECT LAST_INSERT_ID() as insertId');
			$insIdArr = mysql_fetch_assoc($result);
			mysql_free_result($result);
			return doubleval($insIdArr['insertId']);
		}

		return null;
	}
	// }}}
}
