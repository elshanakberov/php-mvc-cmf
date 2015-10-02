<?php 
/**
 * Pagemodel
 */
namespace Models\Pages;

use WebSupportDK\PHPMvcFramework\Model;

class PageModel extends Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getName($name)
	{
		$sql = 'SELECT * FROM Pages WHERE Name = ? LIMIT 1';
		$params = array($name);
		$this->_db->query($sql, $params);
		return $this->_db->results();
	}
}