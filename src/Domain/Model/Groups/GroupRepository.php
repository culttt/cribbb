<?php namespace Cribbb\Domain\Model\Groups;

interface GroupRepository
{
    /**
     * Return the next identity
     *
     * @return UserId
     */
    public function nextIdentity();

    /**
     * Add a new Group
     *
     * @param Group $group
     * @return void
     */
    public function add(Group $group);

    /**
     * Find a Group by it's Name
     *
     * @param Name $name
     * @return Group
     */
    public function groupOfName(Name $name);

    /**
     * Find a Group by it's Slug
     *
     * @param Slug $slug
     * @return Group
     */
    public function groupOfSlug(Slug $slug);
}
