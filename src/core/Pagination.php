<?php

namespace App\core;

class Pagination
{
	private Database $db;
	private int $length;

	public function __construct()
	{
		$this->db = new Database();
		[$this->length] = $this->db->getAccountsLength();
	}

	public function getAccountsByPage(int|null $page_id): array
	{
		$start = 0;
		$row_per_page = 10;

		$pages = ceil($this->length / $row_per_page);

		if ($page_id < 1 || $page_id > $pages) {
			$page_id = null;
		}

		if (isset($page_id)) {
			$page = $page_id - 1;
			$start = $page * $row_per_page;
		}

		$accounts = $this->db->getAccountsByLimit($start, $row_per_page);

		return [$accounts, $pages, $page_id, $this->length];
	}
}