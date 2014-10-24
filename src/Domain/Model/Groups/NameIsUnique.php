<?php namespace Cribbb\Domain\Model\Groups;

class NameIsUnique implements NameSpecification
{
    /**
     * @var GroupRepository
     */
    private $repository;

    /**
     * Create a new NameIsUnique specification
     *
     * @param GroupRepository $repository
     */
    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Check to see if the specification is satisfied
     *
     * @param Name $name
     * @return bool
     */
    public function isSatisfiedBy(Name $name)
    {
        if (! $this->repository->groupOfName($name)) {
            return true;
        }

        return false;
    }
}
