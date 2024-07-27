<?php

require_once dirname(__DIR__) . '/core/Database.php';

function pagination($page_id)
{
  $db = new Database();

  $length = $db->getAccountsLength();

  $start = 0;
  $row_per_page = 10;

  $pages = ceil($length / $row_per_page);

  if ($page_id < 1 || $page_id > $pages) {
    $page_id = null;
  }

  if (isset($page_id)) {
    $page = $page_id - 1;
    $start = $page * $row_per_page;
  }

  $accounts = $db->getAccountsByLimit($start, $row_per_page);

  return [$accounts, $pages, $page_id, $length];
}
