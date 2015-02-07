<?php namespace Cribbb\Application\Groups;

use Cribbb\Domain\Model\Groups\GroupRepository;
use Cribbb\Domain\Model\ValueNotFoundException;

class FindGroupBySlug
{
    /**
     * @var GroupRepository
     */
    private $groups;

    /**
     * @var GroupRepository $groups
     * @return void
     */
    public function __construct(GroupRepository $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Find a Group by it's slug
     *
     * @param string $slug
     * @return Group
     */
    public function find($slug)
    {
        $group = $this->groups->groupBySlug($slug);

        if ($group) return $group;

        throw new ValueNotFoundException("$slug is not a valid Group slug");
    }
}