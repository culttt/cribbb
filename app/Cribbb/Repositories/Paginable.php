<?php namespace Cribbb\Repositories;

interface Paginable {

  /**
  * Get Results by Page
  *
  * @param int $page
  * @param int $limit
  * @param array $with
  * @return StdClass Object with $items and $totalItems for pagination
  */
  public function getByPage($page = 1, $limit = 10, $with = array());

}
