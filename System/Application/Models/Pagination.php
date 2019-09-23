<?php
namespace System\Application\Models;
use System\Application\Models\Pagination;

class Pagination extends \System\Core\Model
{
	public $currentPage;
	public $perPage; // limit
	public $totalPage; // count all posts
	public $countPages;
	public $prevPage;
	public $nextPage;
	public $firstPage;
	public $lastPage;
	public $listPages = array();
	
	public function __construct($page, $perPage, $totalPage)
	{
		$this->perPage = $perPage;
		$this->totalPage = $totalPage;
		$this->countPages = $this->getCountPages();
		$this->currentPage = $this->getCurrentPage($page);
		$this->firstPage = $this->getFirst();
		$this->lastPage = $this->getLast();
		$this->listPages();
	}
	/*
	public static function paginator($countNum = 0, )
	{
		$LoadConfig = new \System\Core\Configurator;
		$settings = $LoadConfig->getConfig();
		
	}
	*/
	public function getCountPages()
	{
		return ceil($this->totalPage / $this->perPage) ?: 1;
	}
	
	public function getCurrentPage($page)
	{
		if (!$page || $page < 1) {
			$page = 1;
		}
		if ($page > $this->countPages) {
			$page = $this->countPages;
		}
		return $page;
	}
	
	public function getStart()
	{
		return ($this->currentPage - 1) * $this->perPage;
	}
	
	public function getFirst()
	{
		return 1;
	}
	
	public function getLast()
	{
		return $this->countPages;
	}
	
	public function listPages()
	{
		$calcList = ceil(5 / 2);
		$minExp = $this->currentPage - $calcList;
		$maxExp = $this->currentPage + $calcList;
		for ($i = $minExp; $i <= $maxExp; ++$i) {
			if ($i >= 1 && $i <= $this->countPages) {
				$this->listPages[$i] = $i;
			}
		}
	}
}
?>