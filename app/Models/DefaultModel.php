<?php 
/**
 * Default model for example
 */
namespace App\Models;

use WebSupportDK\PHPMvcFramework\Model;

class DefaultModel extends Model
{

	// object instance 
	protected static
		$instance = null;
	private
		$table,
		$attributes;

	public
		function __construct()
	{
		parent::__construct();
		$this->table = DB_PREFIX . '';
		$this->attributes = "$this->table.ID, $this->table.Name,";
	}

	public static
		function load()
	{
		if (!isset(self::$instance)) {
			//self::$instance = new DefaultModel();
		}
		return self::$instance;
	}

	public
		function setModel($name, $value)
	{
		$this->$name = $value;
	}

	public
		function search($query)
	{
		return $this->_DB->search($this->table, $this->rows, $query, array($this->attributes));
	}

	// create 
	public
		function create($fields = array())
	{
		return $this->_DB->insert($this->table, $fields);
	}

	// read
	public
		function read($where = array(array()))
	{
		$this->_DB->select(array($this->attributes), $this->table, $where);
		return $this->_DB->results();
	}

	// get page by specific search 
	public function get($paging = array(), $where = array(), $options = array())
	{

		$this->_DB->select(array($this->attributes), $this->table, $paging, $where, $options);
		return $this->_DB->results();
	}

	public function getPostByName($name)
	{
		$this->_DB->select(array($this->attributes), $this->table, null, array(array('Name', '=', $name), array('Type', '=', 'post')));
		return $this->_DB->results();
	}

	public function getPageByName($name)
	{
		$this->_DB->select(array($this->attributes), $this->table, null, array(array('Name', '=', $name), array('Type', '=', 'page')));
		return $this->_DB->results();
	}

	// get last ind fro SQL INSERT
	public function getLastInsertId()
	{
		return $this->_DB->lastInsertId();
	}

	public function count($where = array(array()))
	{
		$this->_DB->select(array("count(*) AS Total"), $this->table, $where);
		return $this->_DB->results();
	}

	public
		function update($fields = array(), $ID = null)
	{
		return $this->_DB->update($this->table, 'ID', $ID, $fields);
	}

	public
		function delete($where = array(array()))
	{
		return $this->_DB->delete($this->table, $where);
	}
}
